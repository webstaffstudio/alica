<?php
namespace Anahata\Modules\Shortcodes\ClientsBoxes;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class ClientsBoxes implements ShortcodeInterface {

    private $base;

    /**
     * Clients Boxes constructor.
     */
    public function __construct() {
        $this->base = 'mkd_clients_boxes';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     */
    public function vcMap() {
        vc_map(array(
            'name'      => esc_html__('Mikado Clients Boxes', 'mikado-core'),
            'base'      => $this->getBase(),
            'category'  => esc_html__('by MIKADO', 'mikado-core'),
            'icon'      => 'icon-wpb-clients-boxes extended-custom-icon',
            'as_parent' => array('only' => 'mkd_clients_boxes_item'),
            'js_view'   => 'VcColumnView',
            'params'    => array(
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'number_of_columns',
                    'heading'    => esc_html__('Number of Columns', 'mikado-core'),
                    'value'      => array(
                        esc_html__('Three', 'mikado-core') => 'three',
                        esc_html__('Four', 'mikado-core')  => 'four'
                    )
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'items_hover_animation',
                    'heading'    => esc_html__('Items Hover Animation', 'mikado-core'),
                    'value'      => array(
                        esc_html__('Switch Images', 'mikado-core') => 'switch-images',
                        esc_html__('Roll Over', 'mikado-core')     => 'roll-over'
                    )
                )
            )
        ));
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'number_of_columns'     => 'four',
            'items_hover_animation' => 'switch-images'
        );

        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['content']        = $content;

        $html = anahata_Mikado_get_shortcode_module_template_part('templates/clients-boxes', 'clients-boxes', '', $params);

        return $html;
    }

    /**
     * Generates holder classes
     *
     * @param $params
     *
     * @return string
     */
    private function getHolderClasses($params) {
        $holderClasses = '';

        $holderClasses .= !empty($params['number_of_columns']) ? ' mkd-cb-columns-'.$params['number_of_columns'] : ' mkd-cb-columns-four';
        $holderClasses .= !empty($params['items_hover_animation']) ? ' mkd-cb-hover-'.$params['items_hover_animation'] : ' mkd-cb-hover-switch-images';

        return $holderClasses;
    }
}