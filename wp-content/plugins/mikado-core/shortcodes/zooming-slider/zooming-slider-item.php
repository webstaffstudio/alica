<?php

namespace Anahata\Modules\Shortcodes\ZoomingSlider;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class ZoomingSliderItem implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_zooming_slider_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Zooming Slider Item', 'mikado-core'),
            'base'                      => $this->base,
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                      => 'icon-wpb-zooming-slider-item extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'as_child'                  => array('only' => 'mkd_zooming_slider'),
            'params'                    => array(
                array(
                    'type'        => 'attach_image',
                    'heading'     => esc_html__('Image', 'mikado-core'),
                    'param_name'  => 'image',
                    'description' => esc_html__('Choose image from media library', 'mikado-core'),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Title', 'mikado-core'),
                    'param_name'  => 'title',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Title Style', 'mikado-core'),
                    'param_name'  => 'title_style',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__('Black', 'mikado-core') => 'black',
                        esc_html__('White', 'mikado-core') => 'white'
                    ),
                    'dependency'  => array('element' => 'title', 'not_empty' => true)
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Link', 'mikado-core'),
                    'param_name'  => 'link',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Link Target', 'mikado-core'),
                    'param_name'  => 'link_target',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__('Same Window', 'mikado-core') => '_self',
                        esc_html__('New Window', 'mikado-core')  => '_blank'
                    ),
                    'dependency'  => array('element' => 'link', 'not_empty' => true)
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'image'       => '',
            'title'       => '',
            'title_style' => 'black',
            'link'        => '',
            'link_target' => '_self'
        );

        $params = shortcode_atts($default_atts, $atts);

        return mikado_core_get_core_shortcode_template_part('templates/zooming-slider-item-template', 'zooming-slider', '', $params);
    }
}