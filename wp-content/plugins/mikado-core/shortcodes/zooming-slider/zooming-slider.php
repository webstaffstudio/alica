<?php

namespace Anahata\Modules\Shortcodes\ZoomingSlider;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ZoomingSlider
 */
class ZoomingSlider implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * ZoomingSlider constructor.
     */
    public function __construct() {
        $this->base = 'mkd_zooming_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     *
     */
    public function vcMap() {
        vc_map(array(
            'name'            => esc_html__('Zooming Slider', 'mikado-core'),
            'base'            => $this->base,
            'as_parent'       => array('only' => 'mkd_zooming_slider_item'),
            'content_element' => true,
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'            => 'icon-wpb-zooming-slider extended-custom-icon',
            'js_view'         => 'VcColumnView',
            'params'          => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Autoplay Slider', 'mikado-core'),
                    'param_name'  => 'autoplay',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__('No', 'mikado-core')  => 'false',
                        esc_html__('Yes', 'mikado-core') => 'true'
                    )
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Slides to show', 'mikado-core'),
                    'param_name'  => 'slides_to_show',
                    'admin_label' => true,
                    'value'       => array(
                        '5' => '5',
                        '3' => '3'
                    ),
                    'save_always' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Left/Right Margin (%)', 'mikado-core'),
                    'param_name'  => 'margin',
                    'description' => esc_html__('Set left/right margin of holder relative to container', 'mikado-core')
                )
            )
        ));
    }

    /**
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_attrs = array(
            'autoplay'       => 'false',
            'slides_to_show' => '',
            'margin'         => ''
        );
        $params        = shortcode_atts($default_attrs, $atts);

        $params['content']       = $content;
        $params['holder_margin'] = '';
        if($params['margin'] !== '') {
            $params['holder_margin'] = 'margin: 0 '.$params['margin'].'%';
        }

        return mikado_core_get_core_shortcode_template_part('templates/zooming-slider-holder', 'zooming-slider', '', $params);
    }
}