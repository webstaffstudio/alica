<?php
namespace Anahata\Modules\Shortcodes\ThumbnailImageSlider;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class ThumbnailImageSlider implements ShortcodeInterface {

    private $base;

    /**
     * Image Slider constructor.
     */
    public function __construct() {
        $this->base = 'mkd_image_slider';

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
     *
     * @see mkd_core_get_carousel_slider_array_vc()
     */
    public function vcMap() {

        vc_map(array(
            'name'                      => esc_html__('Thumbnail Image Slider', 'mikado-core'),
            'base'                      => $this->getBase(),
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                      => 'icon-wpb-thumbnail-image-slider extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'attach_images',
                    'heading'     => esc_html__('Images', 'mikado-core'),
                    'param_name'  => 'images',
                    'description' => esc_html__('Select images from media library', 'mikado-core')
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
            'images' => ''
        );

        $params = shortcode_atts($args, $atts);

        $params['images'] = $this->getSliderImages($params);

        $html = mikado_core_get_core_shortcode_template_part('templates/thumbnail-image-slider-template', 'thumbnail-image-slider', '', $params);

        return $html;

    }

    /**
     * Return images for slider
     *
     * @param $params
     *
     * @return array
     */
    private function getSliderImages($params) {

        $images = array();
        $image  = array();

        if($params['images'] !== '') {

            $image_ids = explode(',', $params['images']);

            foreach($image_ids as $id) {

                $img       = wp_get_attachment_image_src($id, 'full');
                $img_thumb = wp_get_attachment_image_src($id, 'thumbnail');

                $image['url']    = $img[0];
                $image['width']  = $img[1];
                $image['height'] = $img[2];
                $image['thumb']  = $img_thumb[0];

                $images[] = $image;


            }

        }

        return $images;

    }

}