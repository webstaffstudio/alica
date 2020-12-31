<?php

namespace Anahata\Modules\Shortcodes\StaticTextSlider;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ZoomingSlider
 */
class StaticTextSlider implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * ZoomingSlider constructor.
     */
    public function __construct() {
        $this->base = 'mkd_static_text_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     *
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Static Text Slider', 'mikado-core'),
            'base'                      => $this->base,
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                      => 'icon-wpb-static-text-slider extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'attach_images',
                    'heading'     => esc_html__('Images', 'mikado-core'),
                    'param_name'  => 'images',
                    'description' => esc_html__('Select images from media library', 'mikado-core')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Title', 'mikado-core'),
                    'param_name'  => 'title',
                    'description' => esc_html__('Enter slider title', 'mikado-core'),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__('Text', 'mikado-core'),
                    'param_name'  => 'text',
                    'description' => esc_html__('Enter slider text', 'mikado-core')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Button label', 'mikado-core'),
                    'param_name'  => 'button_label',
                    'description' => esc_html__('Enter slider button label', 'mikado-core')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Button link', 'mikado-core'),
                    'param_name'  => 'button_link',
                    'description' => esc_html__('Enter slider button link', 'mikado-core'),
                    'dependency'  => array('element' => 'button_label', 'not_empty' => true)
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Button Link Target', 'mikado-core'),
                    'param_name'  => 'button_link_target',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__('Same Window', 'mikado-core') => '_self',
                        esc_html__('New Window', 'mikado-core')  => '_blank'
                    ),
                    'dependency'  => array('element' => 'button_label', 'not_empty' => true)
                )

            )
        ));
    }

    /**
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'images'                => '',
            'title'                 => '',
            'text'                  => '',
            'button_label'          => '',
            'button_link'           => '',
            'button_link_target'    => '_self'
        );

        $params                = shortcode_atts($args, $atts);
        $params['images']      = $this->getSliderImages($params);
        $params['button_type'] = 'solid';

        return mikado_core_get_core_shortcode_template_part('templates/static-text-slider', 'static-text-slider', '', $params);
    }

    /**
     * Return images for slider
     *
     * @param $params
     *
     * @return array
     */
    private function getSliderImages($params) {
        $image_ids = array();
        $images    = array();
        $i         = 0;

        if($params['images'] !== '') {
            $image_ids = explode(',', $params['images']);
        }

        foreach($image_ids as $id) {

            $image['image_id'] = $id;
            $image_original    = wp_get_attachment_image_src($id, 'full');
            $image['url']      = $image_original[0];
            $image['title']    = get_the_title($id);

            $images[$i] = $image;
            $i++;
        }

        return $images;

    }
}