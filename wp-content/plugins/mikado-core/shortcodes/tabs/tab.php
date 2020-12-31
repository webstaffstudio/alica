<?php
namespace Anahata\Modules\Tab;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tab
 */
class Tab implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkd_tab';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(array(
            'name'                    => esc_html__('Tab', 'mikado-core'),
            'base'                    => $this->getBase(),
            'as_parent'               => array('except' => 'vc_row'),
            'as_child'                => array('only' => 'mkd_tabs'),
            'is_container'            => true,
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                    => 'icon-wpb-tab-item extended-custom-icon',
            'show_settings_on_create' => true,
            'js_view'                 => 'VcColumnView',
            'params'                  => array_merge(
                \AnahataMikadoIconCollections::get_instance()->getVCParamsArray(),
                array(
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Title', 'mikado-core'),
                        'param_name'  => 'tab_title',
                        'description' => ''
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Subtitle', 'mikado-core'),
                        'param_name'  => 'tab_subtitle',
                        'description' => ''
                    ),
                    array(
                        'type'        => 'attach_image',
                        'admin_label' => true,
                        'heading'     => esc_html__('Background Image', 'mikado-core'),
                        'param_name'  => 'background_image',
                        'description' => ''
                    )
                )
            )
        ));

    }

    public function render($atts, $content = null) {

        $default_atts = array(
            'tab_title'        => esc_html__('Tab', 'mikado-core'),
            'tab_id'           => '',
            'background_image' => ''
        );

        $default_atts = array_merge($default_atts, anahata_mikado_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);
        extract($params);

        $iconPackName   = anahata_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
        $params['icon'] = $params[$iconPackName];

        $rand_number         = rand(0, 1000);
        $params['tab_title'] = $params['tab_title'].'-'.$rand_number;

        $params['content']     = $content;
        $params['tab_styles']  = $this->getImageStyles($params);
        $params['tab_classes'] = $this->getTabClasses($params);

        $output = '';
        $output .= mikado_core_get_core_shortcode_template_part('templates/tab_content', 'tabs', '', $params);

        return $output;

    }

    private function getImageStyles($params) {
        $styles = array();

        if($params['background_image'] != '') {
            $styles[] = 'background-image: url('.wp_get_attachment_url($params['background_image']).')';
        }

        return $styles;
    }

    private function getTabClasses($params) {
        $classes = array('mkd-tab-container');

        if($params['background_image'] != '') {
            $classes[] = 'mkd-tab-image';
        }

        return $classes;
    }
}