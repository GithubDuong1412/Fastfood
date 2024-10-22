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
class Th_Testimonial_Slider extends Widget_Base {

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
		return 'th-testimonial-slider';
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
		return esc_html__( 'Testimonial Slider', 'autopart' );
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
		return 'eicon-testimonial-carousel';
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

	public function get_slider_settings() {
		$this->start_controls_section(
			'section_slider',
			[
				'label' => esc_html__( 'Slider', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'slider_items',
			[
				'label' => esc_html__( 'Items', 'autopart' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'slider_auto' => '',
				]
			]
		);

		$this->add_responsive_control(
			'slider_space',
			[
				'label' => esc_html__( 'Space(px)', 'autopart' ),
				'description'	=> esc_html__( 'For example: 20', 'autopart' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'default' => 0
			]
		);

		$this->add_control(
			'slider_column',
			[
				'label' => esc_html__( 'Columns', 'autopart' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label' => esc_html__( 'Speed(ms)', 'autopart' ),
				'description'	=> esc_html__( 'For example: 3000 or 5000', 'autopart' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 3000,
				'max' => 10000,
				'step' => 100,
			]
		);		

		$this->add_control(
			'slider_auto',
			[
				'label' => esc_html__( 'Auto width', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_center',
			[
				'label' => esc_html__( 'Center', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_middle',
			[
				'label' => esc_html__( 'Middle', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_loop',
			[
				'label' => esc_html__( 'Loop', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_mousewheel',
			[
				'label' => esc_html__( 'Mousewheel', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_navigation',
			[
				'label' => esc_html__( 'Navigation', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'autopart' ),
				'label_off' => esc_html__( 'Hide', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_pagination',
			[
				'label' => esc_html__( 'Pagination', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'autopart' ),
				'label_off' => esc_html__( 'Hide', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'slider_effects',
			[
				'label' 	=> esc_html__( 'Effects', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Default', 'autopart' ),
					'fade'			=> esc_html__( 'Fade', 'autopart' ),
					'coverflow'		=> esc_html__( 'Coverflow', 'autopart' ),
					'flip'			=> esc_html__( 'Flip', 'autopart' ),
					'cube'			=> esc_html__( 'cube', 'autopart' ),
				],
			]
		);

		$this->end_controls_section();
	}

	public function get_thumb_styles($key='thumb', $class="thumb-image") {
		$this->start_controls_tabs( $key.'_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);

		$this->add_control(
			$key.'_opacity',
			[
				'label' => esc_html__( 'Opacity', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => $key.'_css_filters',
				'selector' => '{{WRAPPER}} .'.$class.' img',
			]
		);

		$this->add_control(
			$key.'_overlay',
			[
				'label' => esc_html__( 'Overlay', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.' .adv-thumb-link:after' => 'background-color: {{VALUE}}; opacity: 1; visibility: visible;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);

		$this->add_control(
			$key.'_opacity_hover',
			[
				'label' => esc_html__( 'Opacity', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' img:hover' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => $key.'_css_filters_hover',
				'selector' => '{{WRAPPER}} .'.$class.' img:hover',
			]
		);

		$this->add_control(
			$key.'_overlay_hover',
			[
				'label' => esc_html__( 'Overlay', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover .adv-thumb-link:after' => 'background-color: {{VALUE}}; opacity: 1; visibility: visible;',
				],
			]
		);

		$this->add_control(
			$key.'_background_hover_transition',
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
					'{{WRAPPER}} .'.$class.' img' => 'transition-duration: {{SIZE}}s',
					'{{WRAPPER}} .'.$class.' .adv-thumb-link::after' => 'transition-duration: {{SIZE}}s',
					'{{WRAPPER}} .'.$class.' .adv-thumb-link' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			$key.'_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'autopart' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	public function get_box_image($key='box-key',$class="box-class",$add = "") {
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
				'separator' => 'before',
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
			Group_Control_Border::get_type(),
			[
				'name' => $key.'_border',
				'selector' => '{{WRAPPER}} .'.$class.' .adv-thumb-link',
				'separator' => 'before',
			]
		);

		$add->add_responsive_control(
			$key.'_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' .adv-thumb-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$add->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .'.$class.' .adv-thumb-link',
			]
		);
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

	public function get_slider_styles() {
		$this->start_controls_section(
			'section_style_slider_nav',
			[
				'label' => esc_html__( 'Slider Navigation', 'autopart' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'slider_nav_style',
			[
				'label' => esc_html__( 'Style', 'autopart' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => esc_html__( 'Default', 'autopart' ),
					'slider-nav-style2'  => esc_html__( 'Style 2', 'autopart' ),
					'slider-nav-style3'  => esc_html__( 'Style 3', 'autopart' ),
					'slider-nav-style4'	 => esc_html__( 'Style 4', 'autopart' ),
					'slider-nav-style5'	 => esc_html__( 'Style 5', 'autopart' ),
				],
			]
		);

		$this->add_responsive_control(
			'width_slider_nav',
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
					'{{WRAPPER}} .swiper-button-nav' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height_slider_nav',
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
					'{{WRAPPER}} .swiper-button-nav' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .swiper-button-nav i' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_slider_nav',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_slider_nav',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'slider_nav_effects' );

		$this->start_controls_tab( 'slider_nav_normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);

		$this->add_control(
			'nav_color',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_nav',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-button-nav',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_slider_nav',
				'selector' => '{{WRAPPER}} .swiper-button-nav',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_slider_nav',
				'selector' => '{{WRAPPER}} .swiper-button-nav',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_slider_nav',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'slider_nav_hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);

		$this->add_control(
			'nav_color_hover',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_nav_hover',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-button-nav:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_slider_nav_hover',
				'selector' => '{{WRAPPER}} .swiper-button-nav:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_slider_nav_hover',
				'selector' => '{{WRAPPER}} .swiper-button-nav:hover',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_slider_nav_hover',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();	

		$this->add_control(
			'separator_slider_nav',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'slider_icon_next',
			[
				'label' => esc_html__( 'Icon next', 'autopart' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'las la-angle-right',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'slider_icon_prev',
			[
				'label' => esc_html__( 'Icon prev', 'autopart' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'las la-angle-left',
					'library' => 'solid',
				],
			]
		);

		$this->add_responsive_control(
			'slider_icon_size',
			[
				'label' => esc_html__( 'Size icon', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_space',
			[
				'label' => esc_html__( 'Space', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_slider_pag',
			[
				'label' => esc_html__( 'Slider Pagination', 'autopart' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'slider_pagination' => 'yes',
				]
			]
		);

		$this->add_control(
			'slider_pag_style',
			[
				'label' => esc_html__( 'Style', 'autopart' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => esc_html__( 'Default', 'autopart' ),
					'slider-pag-style2'  => esc_html__( 'Style 2', 'autopart' ),
					'slider-pag-style3'  => esc_html__( 'Style 3', 'autopart' ),
					'slider-pag-style4'  => esc_html__( 'Style 4', 'autopart' ),
					'slider-nav-style5'	 => esc_html__( 'Style 5', 'autopart' ),
				],
			]
		);

		$this->add_responsive_control(
			'width_slider_pag',
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
					'{{WRAPPER}} .swiper-pagination span' => 'width: {{SIZE}}{{UNIT}};',
				], 
			]
		);

		$this->add_responsive_control(
			'height_slider_pag',
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
					'{{WRAPPER}} .swiper-pagination span' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_bg_normal',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'background_pag_heading',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_pag',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-pagination span',
			]
		);

		$this->add_control(
			'opacity_pag',
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
					'{{WRAPPER}} .swiper-pagination span' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'separator_bg_active',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'background_pag_heading_active',
			[
				'label' => esc_html__( 'Active', 'autopart' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_pag_active',
				'label' => esc_html__( 'Background', 'autopart' ),
				'description'	=> esc_html__( 'Active status', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-pagination span.swiper-pagination-bullet-active',
			]
		);

		$this->add_control(
			'opacity_pag_active',
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
					'{{WRAPPER}} .swiper-pagination span.swiper-pagination-bullet-active' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'separator_shadow',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_slider_pag',
				'selector' => '{{WRAPPER}} .swiper-pagination span',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_slider_pag',
				'selector' => '{{WRAPPER}} .swiper-pagination span',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_slider_pag',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_pag_space',
			[
				'label' => esc_html__( 'Space', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
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
				'default'   => 'style1',
				'options'   => [
					'style1'		=> esc_html__( 'Style 1', 'autopart' ),
					'style2'		=> esc_html__( 'Style 2', 'autopart' ),
					'style3'		=> esc_html__( 'Style 3', 'autopart' ),
					'style4'		=> esc_html__( 'Style 4', 'autopart' ),
					'style5'		=> esc_html__( 'Style 5', 'autopart' ),
				],
			]
		);		

		$repeater_testimonial = new Repeater();

		$repeater_testimonial->add_control(
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

		$repeater_testimonial->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'include' => [],
				'default' => 'thumbnail',
			]
		);

		$repeater_testimonial->add_control(
			'separator_title',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$repeater_testimonial->add_control(
			'title', 
			[
				'label' => esc_html__( 'Title/name', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
			]
		);

		$repeater_testimonial->add_control(
			'description', 
			[
				'label' => esc_html__( 'Description/position', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
			]
		);

		$repeater_testimonial->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'autopart' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => '',
				'placeholder' => esc_html__( 'Type your content here', 'autopart' ),
			]
		);

		$repeater_testimonial->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'autopart' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'autopart' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);


		$this->add_control(
			'list_sliders',
			[
				'label' => esc_html__( 'Add slide item', 'autopart' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater_testimonial->get_controls(),
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
					'{{WRAPPER}} .swiper-container .wslider-item' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .swiper-container .wslider-item .image-wrap .adv-thumb-link' => 'margin: auto;',
				],
			]
		);

		$this->end_controls_section();

		$this->get_slider_settings();

		$this->start_controls_section(
			'section_style_slider_box',
			[
				'label' => esc_html__( 'Slider box', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_box_settings('slider_box','swiper-wrapper');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_item_box',
			[
				'label' => esc_html__( 'Item box', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_box_settings('item_box','wslider-item');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_thumb_styles('image','image-wrap');

		$this->get_box_image('image','image-wrap');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_text_styles('title','item-title a');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_des',
			[
				'label' => esc_html__( 'Description', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_text_styles('des','item-des');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content text', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_text_styles('content','item-content');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content_box',
			[
				'label' => esc_html__( 'Content box', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .content-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->get_box_settings('content_box','content-wrap');

		$this->end_controls_section();

		$this->get_slider_styles();
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
		$slider_items_tablet = $slider_items_mobile = $slider_items_laptop = $slider_items_tablet_extra = $slider_column = $slider_space_tablet = $slider_space_mobile = $slider_space_laptop = $slider_space_tablet_extra = '';
		extract($settings);
		$this->add_render_attribute( 'elth-wrapper', 'class', 'elth-swiper-slider swiper-container slider-wrap '.$style );
		if($slider_nav_style) $this->add_render_attribute( 'elth-wrapper', 'class', $slider_nav_style );
		if($slider_pag_style) $this->add_render_attribute( 'elth-wrapper', 'class', $slider_pag_style );
		if($slider_middle == 'yes') $this->add_render_attribute( 'elth-wrapper', 'class', 'slider-middle-item' );
		$this->add_render_attribute( 'elth-wrapper', 'data-items', $slider_items );
		$this->add_render_attribute( 'elth-wrapper', 'data-items-tablet', $slider_items_tablet);
		$this->add_render_attribute( 'elth-wrapper', 'data-items-mobile', $slider_items_mobile );
		$this->add_render_attribute( 'elth-wrapper', 'data-items-laptop', $slider_items_laptop );
		$this->add_render_attribute( 'elth-wrapper', 'data-items-extra_tablet', $slider_items_tablet_extra);
		$this->add_render_attribute( 'elth-wrapper', 'data-space', $slider_space );
		$this->add_render_attribute( 'elth-wrapper', 'data-space-tablet', $slider_space_tablet );
		$this->add_render_attribute( 'elth-wrapper', 'data-space-mobile', $slider_space_mobile );
		$this->add_render_attribute( 'elth-wrapper', 'data-space-laptop', $slider_space_laptop );
		$this->add_render_attribute( 'elth-wrapper', 'data-space-extra_tablet', $slider_space_tablet_extra);
		$this->add_render_attribute( 'elth-wrapper', 'data-column', $slider_column );
		$this->add_render_attribute( 'elth-wrapper', 'data-auto', $slider_auto );
		$this->add_render_attribute( 'elth-wrapper', 'data-center', $slider_center );
		$this->add_render_attribute( 'elth-wrapper', 'data-loop', $slider_loop );
		$this->add_render_attribute( 'elth-wrapper', 'data-speed', $slider_speed );
		$this->add_render_attribute( 'elth-wrapper', 'data-mousewheel', $slider_mousewheel );
		$this->add_render_attribute( 'elth-wrapper', 'data-navigation', $slider_navigation );
		$this->add_render_attribute( 'elth-wrapper', 'data-pagination', $slider_pagination );
		$this->add_render_attribute( 'elth-wrapper', 'data-effect', $slider_effects );
		$this->add_render_attribute( 'elth-inner', 'class', 'swiper-wrapper' );
		$this->add_render_attribute( 'elth-item', 'class', 'swiper-slide' );
		$attr = array(
			'wdata'		=> $this,
			'settings'	=> $settings,
		);
		echo th_get_template_widget('testimonial/testimonial',$settings['style'],$attr);
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