<?php
namespace Anahata\Modules\VideoButton;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class VideoButton
 */
class VideoButton implements ShortcodeInterface {

    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'mkd_video_button';

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
            'name'                      => esc_html__('Video Button', 'mikado-core'),
            'base'                      => $this->getBase(),
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                      => 'icon-wpb-video-button extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    "type"       => "textfield",
                    "heading"    => esc_html__('Video Link', 'mikado-core'),
                    "param_name" => "video_link",
                    "value"      => ""
                ),
                array(
                    "type"       => "textfield",
                    "heading"    => esc_html__('Play Button Size (px)', 'mikado-core'),
                    "param_name" => "button_size",
                    "value"      => "",
                    "dependency" => array('element' => 'video_link', 'not_empty' => true),
                ),
                array(
                    "type"       => "textfield",
                    "heading"    => esc_html__('Title', 'mikado-core'),
                    "param_name" => "title",
                    "value"      => "",
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Video Button Style', 'mikado-core'),
                    'param_name'  => 'title_style',
                    'value'       => array(
                        esc_html__('Dark', 'mikado-core')  => 'dark',
                        esc_html__('Light', 'mikado-core') => 'light'
                    ),
                    'description' => '',
                    'save_always' => true
                ),
                array(
                    "type"       => "dropdown",
                    "heading"    => esc_html__('Title Tag', 'mikado-core'),
                    "param_name" => "title_tag",
                    "value"      => array(
                        "h1" => "h1",
                        "h2" => "h2",
                        "h3" => "h3",
                        "h4" => "h4",
                        "h5" => "h5",
                        "h6" => "h6",
                    ),
                    "dependency" => array('element' => 'title', 'not_empty' => true),
                ),
            )
        ));

    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     *
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'video_link'  => '#',
            'button_size' => '',
            'title'       => '',
            'title_style' => 'dark',
            'title_tag'   => 'h1',
        );

        $params = shortcode_atts($args, $atts);

        $title_class = '';

        if($params['title_style'] === 'light') {
            $title_class .= 'mkd-light';
        }

        $params['button_light'] = $title_class;

        $params['button_style']    = $this->getButtonStyle($params);
        $params['video_title_tag'] = $this->getVideoButtonTitleTag($params, $args);

        //Get HTML from template
        $html = mikado_core_get_core_shortcode_template_part('templates/video-button-template', 'videobutton', '', $params);

        return $html;

    }

    /**
     * Return Style for Button
     *
     * @param $params
     *
     * @return string
     */
    private function getButtonStyle($params) {
        $button_style = array();

        if($params['button_size'] !== '') {
            $button_size    = strstr($params['button_size'], 'px') ? $params['button_size'] : $params['button_size'].'px';
            $button_style[] = 'width: '.$button_size;
            $button_style[] = 'height: '.$button_size;
            $button_style[] = 'font-size: '.intval($button_size).'px';
        }

        return implode(';', $button_style);
    }

    /**
     * Return Title Tag. If provided heading isn't valid get the default one
     *
     * @param $params
     *
     * @return string
     */
    private function getVideoButtonTitleTag($params, $args) {
        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];
    }
}