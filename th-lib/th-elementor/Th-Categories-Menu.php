<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Th_Categories_Menu extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'th-categories-menu';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Categories Menu', 'autopart' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'th-category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'hello-world' ];
	}

	public function get_all_pages($post_type = 'wpcf7_contact_form') {
		global $post;
        $post_temp = $post;
        $page_list = array(''=>esc_html__("--Select one--","autopart"));
        if(is_admin()){
            $pages = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC' ) );
            if(is_array($pages)){
                foreach ($pages as $page) {
                    $page_list[$page->ID] = $page->post_title;
                }
            }
        }
        $post = $post_temp;
        return $page_list;
	}
	
	public function get_text_styles($key='text', $class="text-class", $add="") {
		if(empty($add)) $add = $this;
		$add->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $key.'_typography',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$add->start_controls_tabs( $key.'_effects' );

		$add->start_controls_tab( $key.'_normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);

		$add->add_control(
			$key.'_color',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'color: {{VALUE}};',
				],
			]
		);

		$add->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $key.'_shadow',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$add->end_controls_tab();

		$add->start_controls_tab( $key.'_hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);

		$add->add_control(
			$key.'_color_hover',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover' => 'color: {{VALUE}};',
				],
			]
		);

		$add->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $key.'_shadow_hover',
				'selector' => '{{WRAPPER}} .'.$class.':hover',
			]
		);

		$add->end_controls_tab();

		$add->end_controls_tabs();

		$add->add_responsive_control(
			$key.'_space',
			[
				'label' => esc_html__( 'Space', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

	}

	public function get_box_settings($key='box-key',$class="box-class",$add="") {
		if(empty($add)) $add = $this;
		$add->add_responsive_control(
			$key.'_padding',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $add->add_responsive_control(
			$key.'_margin',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $add->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $key.'_background',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .'.$class,
			]
        );

        $add->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $key.'_border',
                'label' => esc_html__( 'Border', 'autopart' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .'.$class,
			]
        );

        $add->add_responsive_control(
			$key.'_radius',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$add->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_shadow',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'autopart' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label' 	=> esc_html__( 'Style', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''			=> esc_html__( 'Default', 'autopart' ),
					'active'	=> esc_html__( 'Active', 'autopart' ),
				],
			]
		);	

		$this->add_control(
			'title', 
			[
				'label' => esc_html__( 'Title', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
			]
		);	

		$repeater_cate = new Repeater();

		$repeater_cate->add_control(
			'cat', 
			[
				'label' => esc_html__( 'Category', 'autopart' ),
				'description' => esc_html__( 'Enter slug category. The values separated by ",". Example cat-1. Default will show title field', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'cat-1', 'autopart' ),
			]
		);

		$repeater_cate->add_control(
			'title', 
			[
				'label' => esc_html__( 'Title', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
			]
		);

		$repeater_cate->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'autopart' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'autopart' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
				],
			]
		);

		$repeater_cate->add_control(
			'symbol',
			[
				'label' 	=> esc_html__( 'Add symbol', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''			=> esc_html__( 'None', 'autopart' ),
					'icon'		=> esc_html__( 'Icon', 'autopart' ),
					'image'		=> esc_html__( 'image', 'autopart' ),
				],
			]
		);

		$repeater_cate->add_control(
			'badge',
			[
				'label' 	=> esc_html__( 'Add badge', 'autopart' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
			]
		);

		$repeater_cate->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_icon',
				'label' => esc_html__( 'Background badge', 'autopart' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .menu-badge',
				'description' => esc_html__( 'Choose background for badge. Default is #ef262c', 'autopart' ),
			]
		);

		$repeater_cate->add_control(
			'color_badge',
			[
				'label' => esc_html__( 'Badge Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .menu-badge' => 'color: {{VALUE}}',
				],
			]
		);

		$repeater_cate->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'autopart' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => '',
					'library' => 'lineicons',
				],
			]
		);

		$repeater_cate->add_control(
			'color_icon',
			[
				'label' => esc_html__( 'Icon Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .symbol i' => 'color: {{VALUE}}',
				],
			]
		);

		$repeater_cate->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'autopart' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater_cate->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'include' => [],
				'default' => 'full',
			]
		);

		$repeater_cate->add_control(
			'megapage',
			[
				'label' => esc_html__( 'Choose content', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => $this->get_all_pages('th_mega_item'),
			]
		);
		$repeater_cate->add_responsive_control(
			'width_mega',
			[
				'label' => esc_html__( 'Width box mega', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cat-hover-content' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);


		$this->add_control(
			'list_cats',
			[
				'label' => esc_html__( 'Add categories', 'autopart' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater_cate->get_controls(),
				'title_field' => '{{{title}}}',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'autopart' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'autopart' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'autopart' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'autopart' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'autopart' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .vertical-navigation-header' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_dropdown_box',
			[
				'label' => esc_html__( 'Dropdown box', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'dropdown_width',
			[
				'label' => esc_html__( 'Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .vertical-navigation-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->get_box_settings('dropdown_box','vertical-navigation-content');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_mega_box',
			[
				'label' => esc_html__( 'Mega box', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->get_box_settings('mega_box','cat-hover-content');

		$this->end_controls_section();		

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_width',
			[
				'label' => esc_html__( 'Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .vertical-navigation-header' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_height',
			[
				'label' => esc_html__( 'Height', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .vertical-navigation-header' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->get_text_styles('title','vertical-navigation-header');
		$this->get_box_settings('title_box','vertical-navigation-header');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_item',
			[
				'label' => esc_html__( 'item', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_text_styles('item_text','cat-list > li > a .text');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_item_box',
			[
				'label' => esc_html__( 'Item box', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'item_box_effects' );

		$this->start_controls_tab( 'item_box_normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);
		$this->get_box_settings('item','cat-list > li');
		$this->end_controls_tab();

		$this->start_controls_tab( 'item_box_hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);		
		$this->get_box_settings('item_hover','cat-list > li:hover');
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon/Image', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'size_icon',
			[
				'label' => esc_html__( 'Size icon', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .symbol i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'symbol_width',
			[
				'label' => esc_html__( 'Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .symbol' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'max_width',
			[
				'label' => esc_html__( 'Max Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .symbol' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'symbol_space',
			[
				'label' => esc_html__( 'Space', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .symbol' => 'margin-right: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .symbol' => 'margin-right: 0;',
					'.rtl {{WRAPPER}} .symbol' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->get_box_settings('symbol','symbol');

		$this->end_controls_section();
		
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();		
		extract($settings);
		$this->add_render_attribute( 'elth-wrapper', 'class', 'categories-menu-wrap cat-menu-'.$style );
		
		$attr = array(
			'wdata'		=> $this,
			'settings'	=> $settings,
		);
		echo th_get_template_widget('categories-menu/categories',$style,$attr);
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}