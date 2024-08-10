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
class Th_Banner_Info extends Widget_Base {

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
		return 'th-banner-info';
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
		return esc_html__( 'Banner info', 'autopart' );
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
		return 'eicon-image-box';
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

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */

	public function get_thumb_styles($key='base_animation') {
		$this->add_control(
			$key,
			[
				'label' 	=> esc_html__( 'Animation', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''							=> esc_html__( 'None', 'autopart' ),
	                'zoom-image' 				=> esc_html__("Zoom",'autopart'),
	                'fade-out-in' 				=> esc_html__("Fade out-in",'autopart'),
	                'zoom-image fade-out-in' 	=> esc_html__("Zoom Fade out-in",'autopart'),
	                'fade-in-out' 				=> esc_html__("Fade in-out",'autopart'),
	                'zoom-rotate' 				=> esc_html__("Zoom rotate",'autopart'),
	                'zoom-rotate fade-out-in' 	=> esc_html__("Zoom rotate Fade out-in",'autopart'),
	                'overlay-image' 			=> esc_html__("Overlay",'autopart'),
	                'overlay-image zoom-image' 	=> esc_html__("Overlay Zoom",'autopart'),
	                'zoom-image line-scale' 	=> esc_html__("Zoom image line",'autopart'),
	                'gray-image' 				=> esc_html__("Gray image",'autopart'),
	                'gray-image line-scale' 	=> esc_html__("Gray image line",'autopart'),
	                'pull-curtain' 				=> esc_html__("Pull curtain",'autopart'),
	                'pull-curtain gray-image' 	=> esc_html__("Pull curtain gray image",'autopart'),
	                'pull-curtain zoom-image' 	=> esc_html__("Pull curtain zoom image",'autopart'),
				],
			]
		);
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'banner_style',
			[
				'label' => esc_html__( 'Banner Style', 'autopart' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'elth-bndf',
				'options' => [
					'elth-bndf'  => esc_html__( 'Default', 'autopart' ),
					'elth-bnstyle2'  => esc_html__( 'Style 2', 'autopart' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
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

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);
		$this->add_control(
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_info',
			[
				'label' => esc_html__( 'Text info', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater_text = new Repeater();
		$repeater_text->add_control(
			'text', 
			[
				'label' => esc_html__( 'Text', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter text' , 'autopart' ),
				'label_block' => true,
			]
		);
		$repeater_text->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater_text->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);
		$repeater_text->add_control(
			'text_tag',
			[
				'label' => esc_html__( 'Tag wrap text', 'autopart' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h2' 		=> esc_html__( 'H2', 'autopart' ),
					'h3' 		=> esc_html__( 'H3', 'autopart' ),
					'h4' 		=> esc_html__( 'H4', 'autopart' ),
					'h5' 		=> esc_html__( 'H5', 'autopart' ),
					'h6' 		=> esc_html__( 'H6', 'autopart' ),
					'p' 		=> esc_html__( 'p', 'autopart' ),
					'span' 		=> esc_html__( 'Span', 'autopart' ),
					'strong' 	=> esc_html__( 'Strong', 'autopart' ),
					'div' 		=> esc_html__( 'Div', 'autopart' ),
					'label' 	=> esc_html__( 'Label', 'autopart' ),
				],
			]
		);
		$repeater_text->add_responsive_control(
			'spacing',
			[
				'label' => esc_html__( 'Space bottom', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$repeater_text->add_responsive_control(
			'spacing_left',
			[
				'label' => esc_html__( 'Space left', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} {{CURRENT_ITEM}}' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$repeater_text->add_control(
			'disable_mobile',
			[
				'label' => esc_html__( 'Hidden on mobile', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'display_text',
			[
				'label' => esc_html__( 'Display text', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'list_text',
			[
				'label' => esc_html__( 'Add text', 'autopart' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater_text->get_controls(),
				'default' => [
					[
						'text' => esc_html__( 'Enter title', 'autopart' ),
						'text_tag' => 'h2',
					],
					[
						'text' => esc_html__( 'Enter description', 'autopart' ),
						'text_tag' => 'p',
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);


		$repeater_bt = new Repeater();
		$repeater_bt->add_control(
			'text', [
				'label' => esc_html__( 'Label button', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter text' , 'autopart' ),
				'label_block' => true,
			]
		);
		$repeater_bt->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'autopart' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'autopart' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => true,
				],
			]
		);		
		$repeater_bt->add_control(
			'style',
			[
				'label' => esc_html__( 'Style', 'autopart' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'elth-bt-default',
				'options' => [
					'elth-bt-default' 		=> esc_html__( 'Default', 'autopart' ),
					'elth-bt-default style2' 		=> esc_html__( 'Style 2', 'autopart' ),
					'elth-bt-default style3' 		=> esc_html__( 'Style 3', 'autopart' ),
					'elth-bt-default style4' 		=> esc_html__( 'Style 4', 'autopart' ),
				],
			]
		);

		$repeater_bt->add_control(
			'disable_mobile',
			[
				'label' => esc_html__( 'Hidden on mobile', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'separator_list_button',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'display_button',
			[
				'label' => esc_html__( 'Display button', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'list_button',
			[
				'label' => esc_html__( 'Add button', 'autopart' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater_bt->get_controls(),
				'default' => [
					[
						'text' => esc_html__( 'Enter label', 'autopart' ),
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);

		$this->add_responsive_control(
			'spacing',
			[
				'label' => esc_html__( 'Space', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elth-btwrap a' => 'margin: 0 {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elth-btwrap' => 'margin: 0 -{{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_thumb_styles();

		$this->add_responsive_control(
			'width_image',
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
					'{{WRAPPER}} .elth-banner-info-thumb img' => 'width: {{SIZE}}{{UNIT}};',
				],
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
				],
				'selectors' => [
					'{{WRAPPER}} .elth-banner-info-thumb' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'box_overflow',
			[
				'label' => esc_html__( 'Overflow', 'autopart' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'hidden',
				'options' => [
					'elth-hidden' 		=> esc_html__( 'Hidden', 'autopart' ),
					'elth-inherit' 		=> esc_html__( 'Inherit', 'autopart' ),
				],
			]
		);

		$this->add_control(
			'separator_image_style',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);

		$this->add_control(
			'opacity',
			[
				'label' => esc_html__( 'Opacity', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elth-banner-info-thumb img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .elth-banner-info-thumb img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);

		$this->add_control(
			'opacity_hover',
			[
				'label' => esc_html__( 'Opacity', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elth-banner-info-thumb img:hover' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .elth-banner-info-thumb img:hover',
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elth-banner-info-thumb img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'autopart' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .elth-banner-info-thumb',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elth-banner-info-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .elth-banner-info-thumb',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_info',
			[
				'label' => esc_html__( 'Text Info', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'style_info',
			[
				'label' => esc_html__( 'Style Info', 'autopart' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'elth-info-inner',
				'options' => [
					'elth-info-inner' 		=> esc_html__( 'Inner', 'autopart' ),
					'elth-info-outer' 		=> esc_html__( 'Outter', 'autopart' ),
				],
			]
		);
		$this->add_responsive_control(
			'width_info',
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
					'{{WRAPPER}} .elth-banner-info-content' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style_info' => 'elth-info-inner'
				]
			]
		);

		$this->add_responsive_control(
			'height_info',
			[
				'label' => esc_html__( 'Height', 'autopart' ),
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
					'{{WRAPPER}} .elth-banner-info-content' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style_info' => 'elth-info-inner'
				]
			]
		);

		$this->add_responsive_control(
			'align_info',
			[
				'label' => esc_html__( 'Alignment Info', 'autopart' ),
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
				],
				'selectors' => [
					'{{WRAPPER}} .elth-banner-info-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'pos_h_info',
			[
				'label' => esc_html__( 'Horizontal Info', 'autopart' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'inner-left' => [
						'title' => esc_html__( 'Left', 'autopart' ),
						'icon' => 'eicon-text-align-left',
					],
					'inner-center' => [
						'title' => esc_html__( 'Center', 'autopart' ),
						'icon' => 'eicon-text-align-center',
					],
					'inner-right' => [
						'title' => esc_html__( 'Right', 'autopart' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'condition' => [
					'style_info' => 'elth-info-inner'
				]
			]
		);

		$this->add_responsive_control(
			'pos_v_info',
			[
				'label' => esc_html__( 'Vertical Info', 'autopart' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'inner-top' => [
						'title' => esc_html__( 'Top', 'autopart' ),
						'icon' => 'eicon-text-align-left',
					],
					'inner-middle' => [
						'title' => esc_html__( 'Middle', 'autopart' ),
						'icon' => 'eicon-text-align-center',
					],
					'inner-bottom' => [
						'title' => esc_html__( 'Bottom', 'autopart' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'condition' => [
					'style_info' => 'elth-info-inner'
				]
			]
		);

		$this->add_responsive_control(
			'pos_info',
			[
				'label' => esc_html__( 'Position Info', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elth-banner-info-content' => 'top: {{TOP}}{{UNIT}};right: {{RIGHT}}{{UNIT}};bottom: {{BOTTOM}}{{UNIT}};left: {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'style_info' => 'elth-info-inner'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elth-banner-info-content',
			]
		);

		$this->add_responsive_control(
			'padding_info',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elth-banner-info-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'info_shadow',
				'label' => esc_html__( 'Box Shadow', 'autopart' ),
				'selector' => '{{WRAPPER}} .elth-banner-info-content',
			]
		);

		$this->add_responsive_control(
			'margin_info',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elth-banner-info-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

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
		$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
		switch ($settings['banner_style']) {
			case 'elth-bnstyle2':
				echo 	'<div class="elth-banner-info-wrap '.$settings['banner_style'].' box-hover-dir">';
				echo 		'<div class="elth-banner-info-thumb overflow-'.$settings['box_overflow'].' '.$settings['base_animation'].'">
								<a class="adv-thumb-link" href="' . $settings['link']['url'] . '"' . $target . $nofollow . '>'.Group_Control_Image_Size::get_attachment_image_html( $settings ).'</a>
							</div>';
				if($settings['list_text'] || $settings['list_button']){
					$this->add_render_attribute( 'info_attr', 'class', 'elth-banner-info-content' );
					if($settings['style_info']) $this->add_render_attribute( 'info_attr', 'class', $settings['style_info'] );
					if($settings['pos_h_info']) $this->add_render_attribute( 'info_attr', 'class', $settings['pos_h_info'] );
					if($settings['pos_v_info']) $this->add_render_attribute( 'info_attr', 'class', $settings['pos_v_info'] );
					if($settings['display_text'] == 'yes' || $settings['display_button'] == 'yes') echo 		'<div '.$this->get_render_attribute_string( 'info_attr' ).'>';
								if ( $settings['list_text'] && $settings['display_text'] == 'yes') {
									foreach (  $settings['list_text'] as $key => $item ) {
										echo '<'.$item['text_tag'].' class="elth-text-item elementor-repeater-item-'.$item['_id'].' hidden-on-mobile-'.$item['disable_mobile'].'">'.$item['text'].'</'.$item['text_tag'].'>';
									}
								}
								if ( $settings['list_button'] && $settings['display_button'] == 'yes') {
									echo '<div class="elth-btwrap">';
									foreach (  $settings['list_button'] as $item ) {
										$target = $item['link']['is_external'] ? ' target="_blank"' : '';
										$nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
										echo '<a href="'.$settings['link']['url'].'"'.$target.$nofollow.' class="elementor-repeater-item-'.$item['_id'].' '.$item['style'].' hidden-on-mobile-'.$item['disable_mobile'].'">'.$item['text'].'</a>';
									}
									echo '</div>';
								}
					if($settings['display_text'] == 'yes' || $settings['display_button'] == 'yes') echo 		'</div>';
				}
				echo '</div>';
				break;
			
			default:				
				echo 	'<div class="elth-banner-info-wrap '.$settings['banner_style'].'">';
				echo 		'<div class="elth-banner-info-thumb overflow-'.$settings['box_overflow'].' '.$settings['base_animation'].'">
								<a class="adv-thumb-link" href="' . $settings['link']['url'] . '"' . $target . $nofollow . '>'.Group_Control_Image_Size::get_attachment_image_html( $settings ).'</a>
							</div>';
				if($settings['list_text'] || $settings['list_button']){
					$this->add_render_attribute( 'info_attr', 'class', 'elth-banner-info-content' );
					if($settings['style_info']) $this->add_render_attribute( 'info_attr', 'class', $settings['style_info'] );
					if($settings['pos_h_info']) $this->add_render_attribute( 'info_attr', 'class', $settings['pos_h_info'] );
					if($settings['pos_v_info']) $this->add_render_attribute( 'info_attr', 'class', $settings['pos_v_info'] );
					if($settings['display_text'] == 'yes' || $settings['display_button'] == 'yes') echo 		'<div '.$this->get_render_attribute_string( 'info_attr' ).'>';
								if ( $settings['list_text'] && $settings['display_text'] == 'yes') {
									foreach (  $settings['list_text'] as $key => $item ) {
										echo '<'.$item['text_tag'].' class="elth-text-item elementor-repeater-item-'.$item['_id'].' hidden-on-mobile-'.$item['disable_mobile'].'">'.$item['text'].'</'.$item['text_tag'].'>';
									}
								}
								if ( $settings['list_button'] && $settings['display_button'] == 'yes') {
									echo '<div class="elth-btwrap">';
									foreach (  $settings['list_button'] as $item ) {
										$target = $item['link']['is_external'] ? ' target="_blank"' : '';
										$nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
										echo '<a href="'.$settings['link']['url'].'"'.$target.$nofollow.' class="elementor-repeater-item-'.$item['_id'].' '.$item['style'].' hidden-on-mobile-'.$item['disable_mobile'].'">'.$item['text'].'</a>';
									}
									echo '</div>';
								}
					if($settings['display_text'] == 'yes' || $settings['display_button'] == 'yes') echo 		'</div>';
				}
				echo '</div>';
				break;
		}
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