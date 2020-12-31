<?php
namespace Anahata\Modules\PricingTable;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTable implements ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkd_pricing_table';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Pricing Table', 'mikado-core'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-pricing-table extended-custom-icon',
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'allowed_container_element' => 'vc_row',
            'as_child'                  => array('only' => 'mkd_pricing_tables'),
            'params'                    => array(
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Title', 'mikado-core'),
                    'param_name'  => 'title',
                    'value'       => esc_html__('Basic Plan', 'mikado-core'),
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Title Size (px)', 'mikado-core'),
                    'param_name'  => 'title_size',
                    'value'       => '',
                    'description' => '',
                    'dependency'  => array('element' => 'title', 'not_empty' => true)
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Price', 'mikado-core'),
                    'param_name'  => 'price'
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Currency', 'mikado-core'),
                    'param_name'  => 'currency'
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Price Period', 'mikado-core'),
                    'param_name'  => 'price_period'
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Label', 'mikado-core'),
                    'param_name'  => 'label',
                    'save_always' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Show Button', 'mikado-core'),
                    'param_name'  => 'show_button',
                    'value'       => array(
                        esc_html__('Default', 'mikado-core') => '',
                        esc_html__('Yes', 'mikado-core')     => 'yes',
                        esc_html__('No', 'mikado-core')      => 'no'
                    ),
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Button Text', 'mikado-core'),
                    'param_name'  => 'button_text',
                    'dependency'  => array('element' => 'show_button', 'value' => 'yes')
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Button Link', 'mikado-core'),
                    'param_name'  => 'link',
                    'dependency'  => array('element' => 'show_button', 'value' => 'yes')
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Active', 'mikado-core'),
                    'param_name'  => 'active',
                    'value'       => array(
                        esc_html__('No', 'mikado-core')  => 'no',
                        esc_html__('Yes', 'mikado-core') => 'yes'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'        => 'textarea_html',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Content', 'mikado-core'),
                    'param_name'  => 'content',
                    'value'       => '<li>content content content</li><li>content content content</li><li>content content content</li>',
                    'description' => ''
                )
            )
        ));
    }

    public function render($atts, $content = null) {

        $args   = array(
            'title'                        => esc_html__('Basic Plan', 'mikado-core'),
            'title_size'                   => '',
            'price'                        => '100',
            'currency'                     => '',
            'price_period'                 => '',
            'label'                        => '',
            'active'                       => 'no',
            'show_button'                  => 'yes',
            'link'                         => '',
            'button_text'                  => 'button',
            'active_pricing_table_classes' => ''
        );
        $params = shortcode_atts($args, $atts);
        extract($params);

        $html                  = '';
        $pricing_table_clasess = 'mkd-price-table';

        if($active == 'yes') {
            $pricing_table_clasess .= ' mkd-pt-active';
        }

        $params['pricing_table_classes'] = $pricing_table_clasess;
        $params['content']               = $content;
        $params['button_params']         = $this->getButtonParams($params);

        $params['title_styles'] = array();

        if(!empty($params['title_size'])) {
            $params['title_styles'][] = 'font-size: '.anahata_mikado_filter_px($params['title_size']).'px';
        }

        $html .= mikado_core_get_core_shortcode_template_part('templates/pricing-table-template', 'pricing-table', '', $params);

        return $html;

    }

    private function getButtonParams($params) {
        $buttonParams = array();

        if($params['show_button'] === 'yes' && $params['button_text'] !== '') {
            $buttonParams = array(
                'link' => $params['link'],
                'text' => $params['button_text'],
                'size' => 'small'
            );

            $buttonParams['type']           = $params['active'] === 'yes' ? 'white' : 'solid';
            $buttonParams['hover_type']     = $params['active'] === 'yes' ? 'white' : 'outline';
            $buttonParams['border_color']   = 'transparent';
        }

        return $buttonParams;
    }

}
