<?php
namespace Anahata\Modules\PricingTables;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTables implements ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkd_pricing_tables';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(array(
            'name'                    => esc_html__('Pricing Tables', 'mikado-core'),
            'base'                    => $this->base,
            'as_parent'               => array('only' => 'mkd_pricing_table'),
            'content_element'         => true,
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                    => 'icon-wpb-pricing-tables extended-custom-icon',
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Columns', 'mikado-core'),
                    'param_name'  => 'columns',
                    'value'       => array(
                        esc_html__('Two', 'mikado-core')   => 'mkd-two-columns',
                        esc_html__('Three', 'mikado-core') => 'mkd-three-columns',
                        esc_html__('Four', 'mikado-core')  => 'mkd-four-columns',
                    ),
                    'save_always' => true,
                    'description' => ''
                )
            ),
            'js_view'                 => 'VcColumnView'
        ));

    }

    public function render($atts, $content = null) {
        $args = array(
            'columns' => 'mkd-two-columns'
        );

        $params = shortcode_atts($args, $atts);
        extract($params);

        $html = '<div class="mkd-pricing-tables clearfix '.$columns.'">';
        $html .= anahata_mikado_remove_auto_ptag($content);
        $html .= '</div>';

        return $html;
    }

}
