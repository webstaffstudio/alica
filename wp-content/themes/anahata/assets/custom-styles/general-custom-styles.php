<?php
if(!function_exists('anahata_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function anahata_mikado_design_styles() {

        $preload_background_styles = array();

        if(anahata_mikado_options()->getOptionValue('preload_pattern_image') !== "") {
            $preload_background_styles['background-image'] = 'url('.anahata_mikado_options()->getOptionValue('preload_pattern_image').') !important';
        } else {
            $preload_background_styles['background-image'] = 'url('.esc_url(MIKADO_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo anahata_mikado_dynamic_css('.mkd-preload-background', $preload_background_styles);

        if(anahata_mikado_options()->getOptionValue('google_fonts')) {
            $font_family = anahata_mikado_options()->getOptionValue('google_fonts');
            if(anahata_mikado_is_font_option_valid($font_family)) {
                echo anahata_mikado_dynamic_css('body', array('font-family' => anahata_mikado_get_font_option_val($font_family)));
            }
        }

        if(anahata_mikado_options()->getOptionValue('first_color') !== "") {

            extract(anahata_mikado_generate_first_color_selectors());

            echo anahata_mikado_dynamic_css($color_selector, array('color' => anahata_mikado_options()->getOptionValue('first_color')));
            echo anahata_mikado_dynamic_css($color_important_selector, array('color' => anahata_mikado_options()->getOptionValue('first_color').'!important'));
            echo anahata_mikado_dynamic_css('::selection', array('background' => anahata_mikado_options()->getOptionValue('first_color')));
            echo anahata_mikado_dynamic_css('::-moz-selection', array('background' => anahata_mikado_options()->getOptionValue('first_color')));
            echo anahata_mikado_dynamic_css($background_color_selector, array('background-color' => anahata_mikado_options()->getOptionValue('first_color')));
            echo anahata_mikado_dynamic_css($border_color_selector, array('border-color' => anahata_mikado_options()->getOptionValue('first_color')));
            echo anahata_mikado_dynamic_css($border_color_important_selector, array('border-color' => anahata_mikado_options()->getOptionValue('first_color').'!important'));
        }

        if(anahata_mikado_options()->getOptionValue('page_background_color')) {
            $background_color_selector = array(
                '.mkd-wrapper-inner',
                '.mkd-content'
            );
            echo anahata_mikado_dynamic_css($background_color_selector, array('background-color' => anahata_mikado_options()->getOptionValue('page_background_color')));
        }

        if(anahata_mikado_options()->getOptionValue('selection_color')) {
            echo anahata_mikado_dynamic_css('::selection', array('background' => anahata_mikado_options()->getOptionValue('selection_color')));
            echo anahata_mikado_dynamic_css('::-moz-selection', array('background' => anahata_mikado_options()->getOptionValue('selection_color')));
        }

        $boxed_background_style = array();
        if(anahata_mikado_options()->getOptionValue('page_background_color_in_box')) {
            $boxed_background_style['background-color'] = anahata_mikado_options()->getOptionValue('page_background_color_in_box');
        }

        if(anahata_mikado_options()->getOptionValue('boxed_background_image')) {
            $boxed_background_style['background-image']    = 'url('.esc_url(anahata_mikado_options()->getOptionValue('boxed_background_image')).')';
            $boxed_background_style['background-position'] = 'center 0px';
            $boxed_background_style['background-repeat']   = 'no-repeat';
        }

        if(anahata_mikado_options()->getOptionValue('boxed_pattern_background_image')) {
            $boxed_background_style['background-image']    = 'url('.esc_url(anahata_mikado_options()->getOptionValue('boxed_pattern_background_image')).')';
            $boxed_background_style['background-position'] = '0px 0px';
            $boxed_background_style['background-repeat']   = 'repeat';
        }

        if(anahata_mikado_options()->getOptionValue('boxed_background_image_attachment')) {
            $boxed_background_style['background-attachment'] = (anahata_mikado_options()->getOptionValue('boxed_background_image_attachment'));
        }

        echo anahata_mikado_dynamic_css('.mkd-boxed .mkd-wrapper', $boxed_background_style);
    }

    add_action('anahata_mikado_style_dynamic', 'anahata_mikado_design_styles');
}

if(!function_exists('anahata_mikado_h1_styles')) {

    function anahata_mikado_h1_styles() {

        $h1_styles = array();

        if(anahata_mikado_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = anahata_mikado_options()->getOptionValue('h1_color');
        }
        if(anahata_mikado_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = anahata_mikado_get_formatted_font_family(anahata_mikado_options()->getOptionValue('h1_google_fonts'));
        }
        if(anahata_mikado_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = anahata_mikado_options()->getOptionValue('h1_texttransform');
        }
        if(anahata_mikado_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = anahata_mikado_options()->getOptionValue('h1_fontstyle');
        }
        if(anahata_mikado_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = anahata_mikado_options()->getOptionValue('h1_fontweight');
        }
        if(anahata_mikado_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if(!empty($h1_styles)) {
            echo anahata_mikado_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('anahata_mikado_style_dynamic', 'anahata_mikado_h1_styles');
}

if(!function_exists('anahata_mikado_h2_styles')) {

    function anahata_mikado_h2_styles() {

        $h2_styles = array();

        if(anahata_mikado_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = anahata_mikado_options()->getOptionValue('h2_color');
        }
        if(anahata_mikado_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = anahata_mikado_get_formatted_font_family(anahata_mikado_options()->getOptionValue('h2_google_fonts'));
        }
        if(anahata_mikado_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = anahata_mikado_options()->getOptionValue('h2_texttransform');
        }
        if(anahata_mikado_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = anahata_mikado_options()->getOptionValue('h2_fontstyle');
        }
        if(anahata_mikado_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = anahata_mikado_options()->getOptionValue('h2_fontweight');
        }
        if(anahata_mikado_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if(!empty($h2_styles)) {
            echo anahata_mikado_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('anahata_mikado_style_dynamic', 'anahata_mikado_h2_styles');
}

if(!function_exists('anahata_mikado_h3_styles')) {

    function anahata_mikado_h3_styles() {

        $h3_styles = array();

        if(anahata_mikado_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = anahata_mikado_options()->getOptionValue('h3_color');
        }
        if(anahata_mikado_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = anahata_mikado_get_formatted_font_family(anahata_mikado_options()->getOptionValue('h3_google_fonts'));
        }
        if(anahata_mikado_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = anahata_mikado_options()->getOptionValue('h3_texttransform');
        }
        if(anahata_mikado_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = anahata_mikado_options()->getOptionValue('h3_fontstyle');
        }
        if(anahata_mikado_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = anahata_mikado_options()->getOptionValue('h3_fontweight');
        }
        if(anahata_mikado_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if(!empty($h3_styles)) {
            echo anahata_mikado_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('anahata_mikado_style_dynamic', 'anahata_mikado_h3_styles');
}

if(!function_exists('anahata_mikado_h4_styles')) {

    function anahata_mikado_h4_styles() {

        $h4_styles = array();

        if(anahata_mikado_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = anahata_mikado_options()->getOptionValue('h4_color');
        }
        if(anahata_mikado_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = anahata_mikado_get_formatted_font_family(anahata_mikado_options()->getOptionValue('h4_google_fonts'));
        }
        if(anahata_mikado_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = anahata_mikado_options()->getOptionValue('h4_texttransform');
        }
        if(anahata_mikado_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = anahata_mikado_options()->getOptionValue('h4_fontstyle');
        }
        if(anahata_mikado_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = anahata_mikado_options()->getOptionValue('h4_fontweight');
        }
        if(anahata_mikado_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if(!empty($h4_styles)) {
            echo anahata_mikado_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('anahata_mikado_style_dynamic', 'anahata_mikado_h4_styles');
}

if(!function_exists('anahata_mikado_h5_styles')) {

    function anahata_mikado_h5_styles() {

        $h5_styles = array();

        if(anahata_mikado_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = anahata_mikado_options()->getOptionValue('h5_color');
        }
        if(anahata_mikado_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = anahata_mikado_get_formatted_font_family(anahata_mikado_options()->getOptionValue('h5_google_fonts'));
        }
        if(anahata_mikado_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = anahata_mikado_options()->getOptionValue('h5_texttransform');
        }
        if(anahata_mikado_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = anahata_mikado_options()->getOptionValue('h5_fontstyle');
        }
        if(anahata_mikado_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = anahata_mikado_options()->getOptionValue('h5_fontweight');
        }
        if(anahata_mikado_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if(!empty($h5_styles)) {
            echo anahata_mikado_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('anahata_mikado_style_dynamic', 'anahata_mikado_h5_styles');
}

if(!function_exists('anahata_mikado_h6_styles')) {

    function anahata_mikado_h6_styles() {

        $h6_styles = array();

        if(anahata_mikado_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = anahata_mikado_options()->getOptionValue('h6_color');
        }
        if(anahata_mikado_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = anahata_mikado_get_formatted_font_family(anahata_mikado_options()->getOptionValue('h6_google_fonts'));
        }
        if(anahata_mikado_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = anahata_mikado_options()->getOptionValue('h6_texttransform');
        }
        if(anahata_mikado_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = anahata_mikado_options()->getOptionValue('h6_fontstyle');
        }
        if(anahata_mikado_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = anahata_mikado_options()->getOptionValue('h6_fontweight');
        }
        if(anahata_mikado_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if(!empty($h6_styles)) {
            echo anahata_mikado_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('anahata_mikado_style_dynamic', 'anahata_mikado_h6_styles');
}

if(!function_exists('anahata_mikado_text_styles')) {

    function anahata_mikado_text_styles() {

        $text_styles = array();

        if(anahata_mikado_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = anahata_mikado_options()->getOptionValue('text_color');
        }
        if(anahata_mikado_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = anahata_mikado_get_formatted_font_family(anahata_mikado_options()->getOptionValue('text_google_fonts'));
        }
        if(anahata_mikado_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('text_fontsize')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('text_lineheight')).'px';
        }
        if(anahata_mikado_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = anahata_mikado_options()->getOptionValue('text_texttransform');
        }
        if(anahata_mikado_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = anahata_mikado_options()->getOptionValue('text_fontstyle');
        }
        if(anahata_mikado_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = anahata_mikado_options()->getOptionValue('text_fontweight');
        }
        if(anahata_mikado_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = anahata_mikado_filter_px(anahata_mikado_options()->getOptionValue('text_letterspacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if(!empty($text_styles)) {
            echo anahata_mikado_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('anahata_mikado_style_dynamic', 'anahata_mikado_text_styles');
}

if(!function_exists('anahata_mikado_link_styles')) {

    function anahata_mikado_link_styles() {

        $link_styles = array();

        if(anahata_mikado_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = anahata_mikado_options()->getOptionValue('link_color');
        }
        if(anahata_mikado_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = anahata_mikado_options()->getOptionValue('link_fontstyle');
        }
        if(anahata_mikado_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = anahata_mikado_options()->getOptionValue('link_fontweight');
        }
        if(anahata_mikado_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = anahata_mikado_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if(!empty($link_styles)) {
            echo anahata_mikado_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('anahata_mikado_style_dynamic', 'anahata_mikado_link_styles');
}

if(!function_exists('anahata_mikado_link_hover_styles')) {

    function anahata_mikado_link_hover_styles() {

        $link_hover_styles = array();

        if(anahata_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = anahata_mikado_options()->getOptionValue('link_hovercolor');
        }
        if(anahata_mikado_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = anahata_mikado_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if(!empty($link_hover_styles)) {
            echo anahata_mikado_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(anahata_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = anahata_mikado_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if(!empty($link_heading_hover_styles)) {
            echo anahata_mikado_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('anahata_mikado_style_dynamic', 'anahata_mikado_link_hover_styles');
}

if(!function_exists('anahata_mikado_smooth_page_transition_styles')) {

    function anahata_mikado_smooth_page_transition_styles($style) {

        $id            = anahata_mikado_get_page_id();
        $loader_style  = array();
        $current_style = '';

        if(anahata_mikado_get_meta_field_intersect('smooth_pt_bgnd_color', $id) !== '') {
            $loader_style['background-color'] = anahata_mikado_get_meta_field_intersect('smooth_pt_bgnd_color', $id);
        }

        $loader_selector = array('.mkd-smooth-transition-loader');

        if(!empty($loader_style)) {
            $current_style .= anahata_mikado_dynamic_css($loader_selector, $loader_style);
        }

        $spinner_style = array();

        if(anahata_mikado_get_meta_field_intersect('smooth_pt_spinner_color', $id) !== '') {
            $spinner_style['background-color'] = anahata_mikado_get_meta_field_intersect('smooth_pt_spinner_color', $id);
        }

        $spinner_selectors = array(
            '.mkd-st-loader .pulse',
            '.mkd-st-loader .double_pulse .double-bounce1',
            '.mkd-st-loader .double_pulse .double-bounce2',
            '.mkd-st-loader .cube',
            '.mkd-st-loader .rotating_cubes .cube1',
            '.mkd-st-loader .rotating_cubes .cube2',
            '.mkd-st-loader .stripes > div',
            '.mkd-st-loader .wave > div',
            '.mkd-st-loader .two_rotating_circles .dot1',
            '.mkd-st-loader .two_rotating_circles .dot2',
            '.mkd-st-loader .five_rotating_circles .container1 > div',
            '.mkd-st-loader .five_rotating_circles .container2 > div',
            '.mkd-st-loader .five_rotating_circles .container3 > div',
            '.mkd-st-loader .atom .ball-1:before',
            '.mkd-st-loader .atom .ball-2:before',
            '.mkd-st-loader .atom .ball-3:before',
            '.mkd-st-loader .atom .ball-4:before',
            '.mkd-st-loader .clock .ball:before',
            '.mkd-st-loader .mitosis .ball',
            '.mkd-st-loader .lines .line1',
            '.mkd-st-loader .lines .line2',
            '.mkd-st-loader .lines .line3',
            '.mkd-st-loader .lines .line4',
            '.mkd-st-loader .fussion .ball',
            '.mkd-st-loader .fussion .ball-1',
            '.mkd-st-loader .fussion .ball-2',
            '.mkd-st-loader .fussion .ball-3',
            '.mkd-st-loader .fussion .ball-4',
            '.mkd-st-loader .wave_circles .ball',
            '.mkd-st-loader .pulse_circles .ball'
        );

        if(!empty($spinner_style)) {
            $current_style .= anahata_mikado_dynamic_css($spinner_selectors, $spinner_style);
        }

        $current_style = $current_style.$style;

        return $current_style;
    }

    add_filter('anahata_mikado_filter_add_page_custom_style', 'anahata_mikado_smooth_page_transition_styles');
}