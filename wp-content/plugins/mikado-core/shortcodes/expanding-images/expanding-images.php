<?php

namespace Anahata\Modules\Shortcodes\ExpandingImages;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ExpandingImages
 */
class ExpandingImages implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * ExpandingImages constructor.
     */
    public function __construct() {
        $this->base = 'mkd_expanding_images';

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
            'name'                      => esc_html__('Expanding Images', 'mikado-core'),
            'base'                      => $this->base,
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                      => 'icon-wpb-expanding-images extended-custom-icon',
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
                    'heading'     => esc_html__('Holder Width (%)', 'mikado-core'),
                    'param_name'  => 'width',
                    'description' => esc_html__('Set width of holder relative to container (this is optional, in order to improve responsiveness)', 'mikado-core')
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
            'images' => '',
            'width'  => '',
        );

        $params                 = shortcode_atts($args, $atts);
        $params['images']       = $this->getGalleryImages($params);
        $params['holder_width'] = '';
        if($params['width'] !== '') {
            $params['holder_width'] = 'width:'.$params['width'].'%';
        }

        return mikado_core_get_core_shortcode_template_part('templates/expanding-images', 'expanding-images', '', $params);
    }

    /**
     * Return images for slider
     *
     * @param $params
     *
     * @return array
     */
    private function getGalleryImages($params) {
        $image_ids = array();
        $images    = array();
        $i         = 0;

        if($params['images'] !== '') {
            $image_ids = explode(',', $params['images']);
        }

        foreach($image_ids as $id) {

            $image['image_id']     = $id;
            $image_original        = wp_get_attachment_image_src($id, 'full');
            $image['url']          = $image_original[0];
            $image['title']        = get_the_title($id);
            $image['image_link']   = get_post_meta($id, 'attachment_image_link', true);
            $image['image_target'] = get_post_meta($id, 'attachment_image_target', true);

            $image_dimensions = anahata_mikado_get_image_dimensions($image['url']);
            if(is_array($image_dimensions) && array_key_exists('height', $image_dimensions)) {

                if(!empty($image_dimensions['height']) && $image_dimensions['width']) {
                    $image['height'] = $image_dimensions['height'];
                    $image['width']  = $image_dimensions['width'];
                }
            }

            $images[$i] = $image;
            $i++;
        }

        return $images;

    }
}