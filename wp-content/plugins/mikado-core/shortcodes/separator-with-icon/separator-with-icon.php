<?php
namespace Anahata\Modules\SeparatorWithIcon;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class SeparatorWithIcon implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'mkd_separator_with_icon';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(
            array(
                'name'                    => esc_html__('Separator With Icon', 'mikado-core'),
                'base'                    => $this->base,
                'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
                'icon'                    => 'icon-wpb-separator-with-icon extended-custom-icon',
                'show_settings_on_create' => true,
                'class'                   => 'wpb_vc_separator_with_icon',
                'custom_markup'           => '<div></div>',
                'params'                  => array_merge(
                    \AnahataMikadoIconCollections::get_instance()->getVCParamsArray(),
                    array(
                        array(
                            'type'       => 'attach_image',
                            'heading'    => esc_html__('Custom Icon', 'mikado-core'),
                            'param_name' => 'custom_icon'
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'heading'    => esc_html__('Separator Color', 'mikado-core'),
                            'param_name' => 'sep_color',
                            'value'      => ''
                        ),
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__('Separator Animation', 'mikado-core'),
                            'param_name' => 'sep_animation',
                            'value'       => array(
                                esc_html__('Yes', 'mikado-core')    => 'yes',
                                esc_html__('No', 'mikado-core')     => 'no'
                            ),
                        ),
                    )
                )
            ));

    }

    public function render($atts, $content = null) {
        $args = array(
            'custom_icon'   => '',
            'sep_color'     => '',
            'sep_animation' => 'yes'
        );

        $default_atts = array_merge($args, anahata_mikado_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        $iconPackName = anahata_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        extract($params);

        if(empty($params['custom_icon'])) {
            $params['icon'] = $params[$iconPackName];
        }

        $params['separator_classes']    = $this->getSeparatorClasses($params);
        $params['separator_style']      = $this->getSeparatorStyle($params);

        $html = mikado_core_get_core_shortcode_template_part('templates/separator-with-icon', 'separator-with-icon', '', $params);

        return $html;
    }

    /**
     * Returns array of separator classes
     *
     * @param $params
     *
     * @return array
     */
    private function getSeparatorClasses($params) {
        $classes = array('mkd-separator-with-icon-holder', 'mkd-separator-with-icon-holder clearfix');

        if($params['sep_animation'] == 'yes') {
            $classes[] = 'mkd-separator-with-icon-animation';
        }

        return $classes;
    }

    private function getSeparatorStyle($params) {
        $styles = array();

        if($params['sep_color'] !== '') {
            $styles[] = 'border-top: 1px solid '.$params['sep_color'];
        }

        return $styles;
    }


}
