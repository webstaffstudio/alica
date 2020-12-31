<?php
namespace Anahata\Modules\Shortcodes;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class IconProgressBar implements ShortcodeInterface {
    private $base;

    /**
     * IconProgressBar constructor.
     */
    public function __construct() {
        $this->base = 'mkd_icon_progress_bar';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'     => esc_html__('Icon Progress Bar', 'mikado-core'),
            'base'     => $this->base,
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'     => 'icon-wpb-icon-progress-bar extended-custom-icon',
            'params'   => array_merge(
                anahata_mikado_icon_collections()->getVCParamsArray(),
                array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Number of Icons', 'mikado-core'),
                        'param_name'  => 'number_of_icons',
                        'value'       => '',
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Number of Active Icons', 'mikado-core'),
                        'param_name'  => 'number_of_active_icons',
                        'value'       => '',
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Size', 'mikado-core'),
                        'admin_label' => true,
                        'param_name'  => 'size',
                        'value'       => array(
                            esc_html__('Tiny', 'mikado-core')       => 'mkd-icon-tiny',
                            esc_html__('Small', 'mikado-core')      => 'mkd-icon-small',
                            esc_html__('Medium', 'mikado-core')     => 'mkd-icon-medium',
                            esc_html__('Large', 'mikado-core')      => 'mkd-icon-large',
                            esc_html__('Very Large', 'mikado-core') => 'mkd-icon-huge'
                        ),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Custom Icon Size (px)', 'mikado-core'),
                        'admin_label' => true,
                        'param_name'  => 'custom_icon_size',
                        'value'       => '',
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Icon Color', 'mikado-core'),
                        'admin_label' => true,
                        'param_name'  => 'icon_color',
                        'value'       => '',
                        'save_always' => true,
                        'group'       => esc_html__('Design Options', 'mikado-core'),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Active Icon Color', 'mikado-core'),
                        'admin_label' => true,
                        'param_name'  => 'active_icon_color',
                        'value'       => '',
                        'save_always' => true,
                        'group'       => esc_html__('Design Options', 'mikado-core'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Spacing Between Icons (px)', 'mikado-core'),
                        'admin_label' => true,
                        'param_name'  => 'spacing_between_icons',
                        'value'       => '',
                        'save_always' => true,
                        'group'       => esc_html__('Design Options', 'mikado-core'),
                    )
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'number_of_icons'        => '',
            'number_of_active_icons' => '',
            'size'                   => '',
            'custom_icon_size'       => '',
            'icon_color'             => '',
            'active_icon_color'      => '',
            'spacing_between_icons'  => ''
        );

        $default_atts = array_merge($default_atts, anahata_mikado_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        $iconPackName = anahata_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        $params['icon']           = $params[$iconPackName];
        $params['data']           = $this->getDataAttrs($params);
        $params['icon_styles']    = $this->getIconStyles($params);
        $params['holder_classes'] = $this->getHolderClasses($params);

        return mikado_core_get_core_shortcode_template_part('templates/icon-progress-bar-template', 'icon-progress-bar', '', $params);
    }

    private function getDataAttrs($params) {
        $data = array();

        if($params['number_of_active_icons'] !== '') {
            $data['data-number-of-active-icons'] = $params['number_of_active_icons'];
        }

        if($params['active_icon_color'] !== '') {
            $data['data-icon-active-color'] = $params['active_icon_color'];
        }

        return $data;
    }

    private function getIconStyles($params) {
        $styles = array();

        if($params['icon_color'] !== '') {
            $styles[] = 'color: '.$params['icon_color'];
        }

        if($params['custom_icon_size'] !== '') {
            $styles[] = 'font-size: '.anahata_mikado_filter_px($params['custom_icon_size']).'px';
        }

        if($params['spacing_between_icons'] !== '') {
            $styles[] = 'margin-right: '.anahata_mikado_filter_px($params['spacing_between_icons']).'px';
        }

        return implode(';', $styles);
    }

    private function getHolderClasses($params) {
        $classes = array('mkd-icon-progress-bar');

        if($params['size'] !== '') {
            $classes[] = $params['size'];
        }

        return $classes;
    }
}