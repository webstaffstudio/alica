<?php
namespace Anahata\Modules\Shortcodes\AnimationsHolder;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class AnimationsHolder implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_animations_holder';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(
            array(
                'name'                    => esc_html__('Animations Holder', 'mikado-core'),
                'base'                    => $this->base,
                'as_parent'               => array('except' => 'vc_row, vc_accordion, vc_tabs, mkd_elements_holder, mkd_pricing_tables, mkd_text_slider_holder, mkd_info_card_slider, mkd_icon_slider'),
                'content_element'         => true,
                'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
                'icon'                    => 'icon-wpb-animation-holder extended-custom-icon',
                'show_settings_on_create' => true,
                'js_view'                 => 'VcColumnView',
                'params'                  => array(
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Animation', 'mikado-core'),
                        'param_name'  => 'css_animation',
                        'value'       => array(
                            esc_html__('No animation', 'mikado-core')                    => '',
                            esc_html__('Elements Shows From Left Side', 'mikado-core')   => 'mkd-element-from-left',
                            esc_html__('Elements Shows From Right Side', 'mikado-core')  => 'mkd-element-from-right',
                            esc_html__('Elements Shows From Top Side', 'mikado-core')    => 'mkd-element-from-top',
                            esc_html__('Elements Shows From Bottom Side', 'mikado-core') => 'mkd-element-from-bottom',
                            esc_html__('Elements Shows From Fade', 'mikado-core')        => 'mkd-element-from-fade'
                        ),
                        'save_always' => true,
                        'admin_label' => true,
                        'description' => ''
                    ),
                    array(
                        'type'        => 'textfield',
                        'class'       => '',
                        'heading'     => esc_html__('Animation Delay (ms)', 'mikado-core'),
                        'param_name'  => 'animation_delay',
                        'value'       => '',
                        'description' => ''
                    ),
                    array(
                        'type'        => 'textfield',
                        'class'       => '',
                        'heading'     => esc_html__('Animation Speed (ms)', 'mikado-core'),
                        'param_name'  => 'animation_speed',
                        'value'       => '',
                        'description' => ''
                    )
                )
            )
        );
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'css_animation'   => '',
            'animation_delay' => '',
            'animation_speed' => '500'
        );

        $params            = shortcode_atts($default_atts, $atts);
        $params['content'] = $content;
        $params['class']   = array(
            'mkd-animations-holder',
            $params['css_animation']
        );

        $params['style'] = $this->getHolderStyles($params);
        $params['data']  = array(
            'data-animation' => $params['css_animation']
        );

        return mikado_core_get_core_shortcode_template_part('templates/animations-holder-template', 'animations-holder', '', $params);
    }

    private function getHolderStyles($params) {
        $styles = array();

        if($params['animation_delay'] !== '') {
            $styles[] = 'transition-delay: '.$params['animation_delay'].'ms';
            $styles[] = '-webkit-animation-delay: '.$params['animation_delay'].'ms';
            $styles[] = 'animation-delay: '.$params['animation_delay'].'ms';
        }

        if($params['animation_speed'] !== '') {
            $styles[] = 'animation-duration: '.$params['animation_speed'].'ms';
            $styles[] = '-webkit-animation-duration: '.$params['animation_speed'].'ms';
            $styles[] = '-moz-animation-duration: '.$params['animation_speed'].'ms';
        }

        return $styles;
    }
}