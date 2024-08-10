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
class Th_Search extends Widget_Base {

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
		return 'th-search';
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
		return esc_html__( 'Search form', 'autopart' );
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
		return 'eicon-search';
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
	protected function register_controls() {
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 	=> esc_html__( 'Style', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'elth-search-default',
				'options'   => [
					'elth-search-default'		=> esc_html__( 'Default', 'autopart' ),
					'elth-search-icon'  		=> esc_html__( 'Icon', 'autopart' ),
					'elth-search-advance1'  	=> esc_html__( 'Advanced 1', 'autopart' ),
					'elth-search-advance2'  	=> esc_html__( 'Advanced 2', 'autopart' ),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your title of search form', 'autopart' ),
				'condition' => [
					'style' => 'elth-search-advance1',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_button',
			[
				'label' => esc_html__( 'Search button', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'autopart' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'la la-search',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'search_bttext',
			[
				'label' => esc_html__( 'Add text', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your text to add search button', 'autopart' ),
			]
		);

		$this->add_control(
			'search_bttext_pos',
			[
				'label' => esc_html__( 'Text position', 'autopart' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after-icon',
				'options' => [
					'after-icon'   => esc_html__( 'After icon', 'autopart' ),
					'before-icon'  => esc_html__( 'Before icon', 'autopart' ),
				],
				'condition' => [
					'search_bttext!' => '',
					'icon[value]!' => '',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_form',
			[
				'label' => esc_html__( 'Form', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label' => esc_html__( 'Placeholder', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter key to search', 'autopart' ),
				'placeholder' => esc_html__( 'Type your placeholder here', 'autopart' ),
			]
		);
		$this->add_control(
			'search_in',
			[
				'label'		=> esc_html__( 'Search in', 'autopart' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> 'product',
				'options'   => [
					'product'  => esc_html__( 'Product', 'autopart' ),
					'post'     => esc_html__( 'Post', 'autopart' ),
					'all'      => esc_html__( 'All', 'autopart' ),
				],
			]
		);
		$this->add_control(
			'show_cat',
			[
				'label' => esc_html__( 'Show choose category', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'autopart' ),
				'label_off' => esc_html__( 'Hide', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'search_in!' => 'all'
				]
			]
		);
		$this->add_control(
			'cats', 
			[
				'label' => esc_html__( 'Categories', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter slug categories. The values separated by ",". Example cat-1,cat-2. Default will show all categories', 'autopart' ),
				'condition' => [
					'show_cat' => 'yes'
				]
			]
		);
		$this->add_control(
			'live_search',
			[
				'label' => esc_html__( 'Live search', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_popup',
			[
				'label' => esc_html__( 'Icon - popup', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon_popup',
			[
				'label' => esc_html__( 'Icon', 'autopart' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'la la-search',
					'library' => 'solid',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_search_button',
			[
				'label' => esc_html__( 'Search button', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width_icon',
			[
				'label' => esc_html__( 'Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elth-search-form input[type="submit"]' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .search-icon-popup' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);	

		$this->add_responsive_control(
			'height_icon',
			[
				'label' => esc_html__( 'Height', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .search-icon-popup' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elth-search-form input[type="submit"]' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elth-search-form .elth-text-bt-search > *' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);	

		$this->add_responsive_control(
			'size_icon',
			[
				'label' => esc_html__( 'Size icon', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elth-search-form .elth-text-bt-search > i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_begin_tabs',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( 'search_button_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Icon Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elth-search-form .elth-text-bt-search > i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'search_text_button_typography',
				'label' => esc_html__( 'Typography button text', 'autopart' ),
				'selector' => '{{WRAPPER}} .elth-search-form .elth-text-bt-search > span',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_icon',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elth-search-form input[type="submit"]',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__( 'Icon Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elth-search-form .elth-submit-form:hover .elth-text-bt-search > i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'search_text_button_typography_hover',
				'label' => esc_html__( 'Typography button text', 'autopart' ),
				'selector' => '{{WRAPPER}} .elth-search-form .elth-submit-form:hover .elth-text-bt-search > span',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_icon_hover',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elth-search-form input[type="submit"]:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();		

		$this->add_control(
			'separator_end_tabs',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_responsive_control(
			'padding_icon',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elth-search-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_icon',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elth-search-form input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'icon_border',
				'selector'  => '{{WRAPPER}} .elth-search-form input[type="submit"]',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elth-search-form input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_form',
			[
				'label' => esc_html__( 'Form', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width_form',
			[
				'label' => esc_html__( 'Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' , '%'],
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
					'{{WRAPPER}} .elth-search-form' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height_form',
			[
				'label' => esc_html__( 'Height', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elth-search-form' => 'line-height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align_form',
			[
				'label' => esc_html__( 'Alignment', 'autopart' ),
				'type' => Controls_Manager::CHOOSE,
				'default'	=> '',
				'options' => [
					'form-left' => [
						'title' => esc_html__( 'Left', 'autopart' ),
						'icon' => 'eicon-text-align-left',
					],
					'form-center' => [
						'title' => esc_html__( 'Center', 'autopart' ),
						'icon' => 'eicon-text-align-center',
					],
					'form-right' => [
						'title' => esc_html__( 'Right', 'autopart' ),
						'icon' => 'eicon-text-align-right',
					],
				],
			]
		);

		$this->add_responsive_control(
			'padding_form',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elth-search-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_form',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elth-search-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_form',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elth-search-form',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_form',
				'selector' => '{{WRAPPER}} .elth-search-form',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_form_radius',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elth-search-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .elth-search-form',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_cat',
			[
				'label' => esc_html__( 'Categories dropdown', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_cat',
			[
				'label' => esc_html__( 'Title', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'All categories', 'autopart' ),
				'placeholder' => esc_html__( 'Type your title here', 'autopart' ),
			]
		);

		$this->add_control(
			'title_cat_color',
			[
				'label' => esc_html__( 'Title Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elth-dropdown-box .current-search-cat' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'width_cat',
			[
				'label' => esc_html__( 'Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elth-dropdown-box' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_cat',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elth-dropdown-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_cat',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elth-dropdown-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_cat',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elth-dropdown-box',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_cat',
				'selector' => '{{WRAPPER}} .elth-dropdown-box',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_cat_radius',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elth-dropdown-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon_popup',
			[
				'label' => esc_html__( 'Icon - popup', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width_icon_popup',
			[
				'label' => esc_html__( 'Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' , '%'],
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
					'{{WRAPPER}} .elth-search-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height_icon_popup',
			[
				'label' => esc_html__( 'Height', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elth-search-icon' => 'line-height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'size_icon_popup',
			[
				'label' => esc_html__( 'Size icon', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'icon_popup_effects' );

		$this->start_controls_tab( 'icon_popup_normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);

		$this->add_control(
			'color_icon_popup',
			[
				'label' => esc_html__( 'Icon Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_icon_popup',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .search-icon-popup',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_icon_popup',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .search-icon-popup',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_icon_popup',
				'selector' => '{{WRAPPER}} .search-icon-popup',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_icon_popup',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'icon_popup_hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);

		$this->add_control(
			'color_icon_popup_hover',
			[
				'label' => esc_html__( 'Icon Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_icon_popup_hover',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .search-icon-popup:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_icon_popup_hover',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .search-icon-popup:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_icon_popup_hover',
				'selector' => '{{WRAPPER}} .search-icon-popup:hover',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_icon_popup_hover',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();	

		$this->add_control(
			'separator_icon_popup',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_responsive_control(
			'padding_icon_popup',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_icon_popup',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_bg_popup',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'background_search_popup_heading',
			[
				'label' => esc_html__( 'Background popup', 'autopart' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_search_popup',
				'label' => esc_html__( 'Background popup', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elth-search-icon .elth-search-form-wrap',
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
		$attr = array(
			'wdata'		=> $this,
			'settings'	=> $settings,
		);
		$slug = str_replace('elth-search-', '', $settings['style']);
		echo th_get_template_widget('search/search',$slug,$attr);
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
