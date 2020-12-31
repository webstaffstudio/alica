<?php
namespace Anahata\Modules\Shortcodes\VerticalSplitSliderLeftPanel;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class VerticalSplitSliderLeftPanel implements ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkd_vertical_split_slider_left_panel';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if(function_exists('vc_map')) {
            vc_map(
                array(
                    'name'                    => esc_html__('Left Sliding Panel', 'mikado-core'),
                    'base'                    => $this->base,
                    'as_parent'               => array('only' => 'mkd_vertical_split_slider_content_item'),
                    'as_child'                => array('only' => 'mkd_vertical_split_slider'),
                    'content_element'         => true,
                    'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
                    'icon'                    => 'icon-wpb-vertical-split-slider-left-panel extended-custom-icon',
                    'show_settings_on_create' => false,
                    'js_view'                 => 'VcColumnView',
                    'params'                  => array()
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array();

        $params = shortcode_atts($args, $atts);
        extract($params);
        $html = '<div class="mkd-vss-ms-left">';
        $html .= do_shortcode($content);
        $html .= '</div>';

        return $html;
    }

}
