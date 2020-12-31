<?php
namespace Anahata\Modules\Shortcodes\ClientsBoxesItem;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class ClientsBoxesItem implements ShortcodeInterface {

    private $base;

    /**
     * Clients Boxes Item constructor.
     */
    public function __construct() {
        $this->base = 'mkd_clients_boxes_item';

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
            'name'                    => esc_html__('Mikado Clients Boxes Item', 'mikado-core'),
            'base'                    => $this->getBase(),
            'category'                => esc_html__('by MIKADO', 'mikado-core'),
            'icon'                    => 'icon-wpb-clients-boxes-item extended-custom-icon',
            'as_child'                => array('only' => 'mkd_clients_boxes'),
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'        => 'attach_image',
                    'param_name'  => 'image',
                    'heading'     => esc_html__('Image', 'mikado-core'),
                    'description' => esc_html__('Select image from media library', 'mikado-core')
                ),
                array(
                    'type'        => 'attach_image',
                    'param_name'  => 'hover_image',
                    'heading'     => esc_html__('Hover Image', 'mikado-core'),
                    'description' => esc_html__('Select image from media library', 'mikado-core')
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'image_size',
                    'heading'     => esc_html__('Image Size', 'mikado-core'),
                    'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'mikado-core')
                ),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'link',
                    'heading'    => esc_html__('Custom Link', 'mikado-core')
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'target',
                    'heading'     => esc_html__('Custom Link Target', 'mikado-core'),
                    'value'       => array(
                        esc_html__('Same Window', 'mikado-core') => '_self',
                        esc_html__('New Window', 'mikado-core')  => '_blank'
                    ),
                    'save_always' => true
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
            'image'       => '',
            'hover_image' => '',
            'image_size'  => 'full',
            'link'        => '',
            'target'      => '_self'
        );

        $params = shortcode_atts($args, $atts);

        $params['image']       = $this->getImage($params);
        $params['hover_image'] = $this->getHoverImage($params);
        $params['image_size']  = $this->getImageSize($params['image_size']);
        $params['target']      = !empty($params['custom_link_target']) ? $params['custom_link_target'] : '_self';

        $html = mikado_core_get_core_shortcode_template_part('templates/clients-boxes-item', 'clients-boxes', '', $params);

        return $html;
    }

    /**
     * Return images
     *
     * @param $params
     *
     * @return array
     */
    private function getImage($params) {
        $image_meta = array();

        if(!empty($params['image'])) {
            $image_id       = $params['image'];
            $image_original = wp_get_attachment_image_src($image_id, 'full');
            $image['url']   = $image_original[0];
            $image['alt']   = get_post_meta($image_id, '_wp_attachment_image_alt', true);

            $image_meta = $image;
        }

        return $image_meta;
    }

    /**
     * Return images
     *
     * @param $params
     *
     * @return array
     */
    private function getHoverImage($params) {
        $image_meta = array();

        if(!empty($params['hover_image'])) {
            $image_id       = $params['hover_image'];
            $image_original = wp_get_attachment_image_src($image_id, 'full');
            $image['url']   = $image_original[0];
            $image['alt']   = get_post_meta($image_id, '_wp_attachment_image_alt', true);

            $image_meta = $image;
        }

        return $image_meta;
    }

    /**
     * Return image size or custom image size array
     *
     * @param $image_size
     *
     * @return array
     */
    private function getImageSize($image_size) {

        $image_size = trim($image_size);
        //Find digits
        preg_match_all('/\d+/', $image_size, $matches);
        if(in_array($image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
            return $image_size;
        } elseif(!empty($matches[0])) {
            return array(
                $matches[0][0],
                $matches[0][1]
            );
        } else {
            return 'full';
        }
    }
}