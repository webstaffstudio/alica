<?php

if(!function_exists('anahata_mikado_button_typography_styles')) {
	/**
	 * Typography styles for all button types
	 */
	function anahata_mikado_button_typography_styles() {
		$selector = '.mkd-btn';
		$styles   = array();

		$font_family = anahata_mikado_options()->getOptionValue('button_font_family');
		if(anahata_mikado_is_font_option_valid($font_family)) {
			$styles['font-family'] = anahata_mikado_get_font_option_val($font_family);
		}

		$text_transform = anahata_mikado_options()->getOptionValue('button_text_transform');
		if(!empty($text_transform)) {
			$styles['text-transform'] = $text_transform;
		}

		$font_style = anahata_mikado_options()->getOptionValue('button_font_style');
		if(!empty($font_style)) {
			$styles['font-style'] = $font_style;
		}

		$letter_spacing = anahata_mikado_options()->getOptionValue('button_letter_spacing');
		if($letter_spacing !== '') {
			$styles['letter-spacing'] = anahata_mikado_filter_px($letter_spacing).'px';
		}

		$font_weight = anahata_mikado_options()->getOptionValue('button_font_weight');
		if(!empty($font_weight)) {
			$styles['font-weight'] = $font_weight;
		}

		echo anahata_mikado_dynamic_css($selector, $styles);
	}

	add_action('anahata_mikado_style_dynamic', 'anahata_mikado_button_typography_styles');
}

if(!function_exists('anahata_mikado_button_outline_styles')) {
	/**
	 * Generate styles for outline button
	 */
	function anahata_mikado_button_outline_styles() {
		//outline styles
		$outline_styles   = array();
		$outline_selector = '.mkd-btn.mkd-btn-outline';

		if(anahata_mikado_options()->getOptionValue('btn_outline_text_color')) {
			$outline_styles['color'] = anahata_mikado_options()->getOptionValue('btn_outline_text_color');
		}

		if(anahata_mikado_options()->getOptionValue('btn_outline_border_color')) {
			$outline_styles['border-color'] = anahata_mikado_options()->getOptionValue('btn_outline_border_color');
		}

		echo anahata_mikado_dynamic_css($outline_selector, $outline_styles);

		//outline hover styles
		if(anahata_mikado_options()->getOptionValue('btn_outline_hover_text_color')) {
			echo anahata_mikado_dynamic_css(
				'.mkd-btn.mkd-btn-outline:not(.mkd-btn-custom-hover-color):hover',
				array('color' => anahata_mikado_options()->getOptionValue('btn_outline_hover_text_color').'!important')
			);
		}

		if(anahata_mikado_options()->getOptionValue('btn_outline_hover_bg_color')) {
			echo anahata_mikado_dynamic_css(
				'.mkd-btn.mkd-btn-outline:not(.mkd-btn-custom-hover-bg):hover',
				array('background-color' => anahata_mikado_options()->getOptionValue('btn_outline_hover_bg_color').'!important')
			);
		}

		if(anahata_mikado_options()->getOptionValue('btn_outline_hover_border_color')) {
			echo anahata_mikado_dynamic_css(
				'.mkd-btn.mkd-btn-outline:not(.mkd-btn-custom-border-hover):hover',
				array('border-color' => anahata_mikado_options()->getOptionValue('btn_outline_hover_border_color').'!important')
			);
		}
	}

	add_action('anahata_mikado_style_dynamic', 'anahata_mikado_button_outline_styles');
}

if(!function_exists('anahata_mikado_button_solid_styles')) {
	/**
	 * Generate styles for solid type buttons
	 */
	function anahata_mikado_button_solid_styles() {
		//solid styles
		$solid_selector = '.mkd-btn.mkd-btn-solid';
		$solid_styles   = array();

		if(anahata_mikado_options()->getOptionValue('btn_solid_text_color')) {
			$solid_styles['color'] = anahata_mikado_options()->getOptionValue('btn_solid_text_color');
		}

		if(anahata_mikado_options()->getOptionValue('btn_solid_border_color')) {
			$solid_styles['border-color'] = anahata_mikado_options()->getOptionValue('btn_solid_border_color');
		}

		if(anahata_mikado_options()->getOptionValue('btn_solid_bg_color')) {
			$solid_styles['background-color'] = anahata_mikado_options()->getOptionValue('btn_solid_bg_color');
		}

		echo anahata_mikado_dynamic_css($solid_selector, $solid_styles);

		//solid hover styles
		if(anahata_mikado_options()->getOptionValue('btn_solid_hover_text_color')) {
			echo anahata_mikado_dynamic_css(
				'.mkd-btn.mkd-btn-solid:not(.mkd-btn-custom-hover-color):hover',
				array('color' => anahata_mikado_options()->getOptionValue('btn_solid_hover_text_color').'!important')
			);
		}

		if(anahata_mikado_options()->getOptionValue('btn_solid_hover_bg_color')) {
			echo anahata_mikado_dynamic_css(
				'.mkd-btn.mkd-btn-solid:not(.mkd-btn-custom-hover-bg):hover',
				array('background-color' => anahata_mikado_options()->getOptionValue('btn_solid_hover_bg_color').'!important')
			);
		}

		if(anahata_mikado_options()->getOptionValue('btn_solid_hover_border_color')) {
			echo anahata_mikado_dynamic_css(
				'.mkd-btn.mkd-btn-solid:not(.mkd-btn-custom-hover-bg):hover',
				array('border-color' => anahata_mikado_options()->getOptionValue('btn_solid_hover_border_color').'!important')
			);
		}
	}

	add_action('anahata_mikado_style_dynamic', 'anahata_mikado_button_solid_styles');
}