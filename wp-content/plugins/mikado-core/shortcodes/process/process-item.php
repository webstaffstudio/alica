<?php
namespace Anahata\Modules\Shortcodes\Process;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProcessItem implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_process_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Process Item', 'mikado-core'),
            'base'                    => $this->getBase(),
            'as_child'                => array('only' => 'mkd_process_holder'),
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                    => 'icon-wpb-process-item extended-custom-icon',
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__('Custom Image', 'mikado-core'),
                    'param_name' => 'custom_image'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Title', 'mikado-core'),
                    'param_name'  => 'title',
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__('Text', 'mikado-core'),
                    'param_name'  => 'text',
                    'save_always' => true,
                    'admin_label' => true
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'custom_image' => '',
            'title'        => '',
            'text'         => '',
        );

        $params                    = shortcode_atts($default_atts, $atts);
        $params['image_url_style'] = $this->getImageUrl($params);

        return mikado_core_get_core_shortcode_template_part('templates/process-item-template', 'process', '', $params);
    }

    private function getImageUrl($params) {
        $image_style = '';

        if($params['custom_image'] !== '') {
            $image_style = 'background-image: url('.wp_get_attachment_url($params['custom_image'], 'full').')';
        }

        return $image_style;
    }

}