<?php

if(!function_exists('anahata_mikado_register_top_header_areas')) {
	/**
	 * Registers widget areas for top header bar when it is enabled
	 */
	function anahata_mikado_register_top_header_areas() {
		$top_bar_layout = anahata_mikado_options()->getOptionValue('top_bar_layout');

		register_sidebar(array(
			'name'          => esc_html__('Top Bar Left', 'anahata'),
			'id'            => 'mkd-top-bar-left',
			'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget"><div class="mkd-top-bar-widget-inner">',
			'after_widget'  => '</div></div>',
			'description' => esc_html__('Widgets added here will appear on the left side in top bar', 'anahata')
		));

		//register this widget area only if top bar layout is three columns
		if($top_bar_layout === 'three-columns') {
			register_sidebar(array(
				'name'          => esc_html__('Top Bar Center', 'anahata'),
				'id'            => 'mkd-top-bar-center',
				'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget"><div class="mkd-top-bar-widget-inner">',
				'after_widget'  => '</div></div>',
				'description' => esc_html__('Widgets added here will appear on the center in top bar', 'anahata')
			));
		}

		register_sidebar(array(
			'name'          => esc_html__('Top Bar Right', 'anahata'),
			'id'            => 'mkd-top-bar-right',
			'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget"><div class="mkd-top-bar-widget-inner">',
			'after_widget'  => '</div></div>',
			'description' => esc_html__('Widgets added here will appear on the right side in top bar', 'anahata')
		));
	}

	add_action('widgets_init', 'anahata_mikado_register_top_header_areas');
}

if(!function_exists('anahata_mikado_header_standard_widget_areas')) {
	/**
	 * Registers widget areas for standard header type
	 */
	function anahata_mikado_header_standard_widget_areas() {
        register_sidebar(array(
            'name'          => esc_html__('Right From Logo', 'anahata'),
            'id'            => 'mkd-right-from-logo',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-logo-widget"><div class="mkd-right-from-logo-widget-inner">',
            'after_widget'  => '</div></div>',
            'description'   => esc_html__('Widgets added here will appear on the right hand side from the logo - Standard Extended header type only', 'anahata')
        ));

        if(anahata_mikado_core_installed()) {
			register_sidebar(array(
				'name' => esc_html__('Right From Main Menu', 'anahata'),
				'id' => 'mkd-right-from-main-menu',
				'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-main-menu-widget"><div class="mkd-right-from-main-menu-widget-inner">',
				'after_widget' => '</div></div>',
				'description' => esc_html__('Widgets added here will appear on the right hand side from the main menu', 'anahata')
			));
		}
	}

	add_action('widgets_init', 'anahata_mikado_header_standard_widget_areas');
}

if(!function_exists('anahata_mikado_header_vertical_widget_areas')) {
	/**
	 * Registers widget areas for vertical header
	 */
	function anahata_mikado_header_vertical_widget_areas() {
        register_sidebar(array(
            'name'          => esc_html__('Vertical Area', 'anahata'),
            'id'            => 'mkd-vertical-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-vertical-area-widget">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the bottom of vertical menu', 'anahata')
        ));
	}

	add_action('widgets_init', 'anahata_mikado_header_vertical_widget_areas');
}

if(!function_exists('anahata_mikado_register_mobile_header_areas')) {
	/**
	 * Registers widget areas for mobile header
	 */
	function anahata_mikado_register_mobile_header_areas() {
		if(anahata_mikado_is_responsive_on()) {
			register_sidebar(array(
				'name'          => esc_html__('Right From Mobile Logo', 'anahata'),
				'id'            => 'mkd-right-from-mobile-logo',
				'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-mobile-logo">',
				'after_widget'  => '</div>',
				'description'   => esc_html__('Widgets added here will appear on the right hand side from the mobile logo', 'anahata')
			));
		}
	}

	add_action('widgets_init', 'anahata_mikado_register_mobile_header_areas');
}

if(!function_exists('anahata_mikado_register_sticky_header_areas')) {
	/**
	 * Registers widget area for sticky header
	 */
	function anahata_mikado_register_sticky_header_areas() {

        register_sidebar(array(
            'name'          => esc_html__('Sticky Right', 'anahata'),
            'id'            => 'mkd-sticky-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-sticky-right-widget"><div class="mkd-sticky-right-widget-inner">',
            'after_widget'  => '</div></div>',
            'description'   => esc_html__('Widgets added here will appear on the right hand side in sticky menu', 'anahata')
        ));

	}

	add_action('widgets_init', 'anahata_mikado_register_sticky_header_areas');
}