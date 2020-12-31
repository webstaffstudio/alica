<?php

namespace Anahata\Modules\Shortcodes\TeamSlider;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class TeamSlider implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_team_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'         => esc_html__('Team Slider', 'mikado-core'),
            'base'         => $this->base,
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'         => 'icon-wpb-team-slider extended-custom-icon',
            'is_container' => true,
            'js_view'      => 'VcColumnView',
            'as_parent'    => array('only' => 'mkd_team_slider_item'),
            'params'       => array(
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Navigation Skin', 'mikado-core'),
                    'param_name'  => 'skin',
                    'description' => '',
                    'value'       => array(
                        esc_html__('Dark', 'mikado-core')  => 'dark',
                        esc_html__('Light', 'mikado-core') => 'light'
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Number of Items in Row', 'mikado-core'),
                    'param_name'  => 'number_of_items',
                    'description' => '',
                    'value'       => array(
                        '3' => '3',
                        '4' => '4',
                        '5' => '5'
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Enable AutoPlay?', 'mikado-core'),
                    'param_name'  => 'auto_play',
                    'description' => '',
                    'value'       => array(
                        esc_html__('Yes', 'mikado-core') => 'true',
                        esc_html__('No', 'mikado-core')  => 'false'
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Enable Pagination?', 'mikado-core'),
                    'param_name'  => 'show_dots',
                    'description' => '',
                    'value'       => array(
                        esc_html__('Yes', 'mikado-core') => 'true',
                        esc_html__('No', 'mikado-core')  => 'false'
                    ),
                ),
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'skin'            => '',
            'number_of_items' => '3',
            'auto_play'       => 'true',
            'show_dots'       => 'true'
        );
        $params       = shortcode_atts($default_atts, $atts);

        $nav = '';
        if($params['skin'] == 'light') {
            $nav = ' mkd-nav-light';
        }

        $params['light_nav'] = $nav;

        $dots = '';
        if($params['show_dots'] === 'false') {
            $dots = ' mkd-without-bullets';
        }

        $params['show_bullets'] = $dots;

        $params['content'] = $content;

        $params['data_attribute'] = $this->getDataAttribute($params);

        return mikado_core_get_core_shortcode_template_part('templates/team-slider-template', 'team-slider', '', $params);
    }

    private function getDataAttribute($params) {
        $slider_data = [];

        if($params['number_of_items'] !== '') {
            $slider_data['data-items'] = $params['number_of_items'];
        }

        if($params['auto_play'] !== '') {
            $slider_data['data-play'] = $params['auto_play'];
        }

        if($params['show_dots'] !== '') {
            $slider_data['data-dots'] = $params['show_dots'];
        }

        return $slider_data;
    }
}