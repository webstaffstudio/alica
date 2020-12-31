<?php
namespace Anahata\Modules\Shortcodes\TabSlider;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class TabSlider implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_tab_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Tab Slider', 'mikado-core'),
            'base'                    => $this->base,
            'as_parent'               => array('only' => 'mkd_tab_slider_item'),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                    => 'icon-wpb-tab-slider extended-custom-icon',
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array();

        $params = array('content' => $content);

        return mikado_core_get_core_shortcode_template_part('templates/tab-slider-holder', 'tab-slider', '', $params);
    }

}