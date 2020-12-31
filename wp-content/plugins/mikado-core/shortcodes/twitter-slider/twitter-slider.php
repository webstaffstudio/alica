<?php
namespace Anahata\Modules\Shortcodes\TwitterSlider;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class TwitterSlider implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_twitter_slider';

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
            'name'                      => esc_html__('Twitter Slider', 'mikado-core'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-twitter-slider extended-custom-icon',
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('User ID', 'mikado-core'),
                    'param_name'  => 'user_id',
                    'value'       => '',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Number of tweets', 'mikado-core'),
                    'param_name'  => 'count',
                    'value'       => '',
                    'description' => esc_html__('Default Number is 4', 'mikado-core'),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Tweets Color', 'mikado-core'),
                    'param_name'  => 'tweets_color',
                    'value'       => '',
                    'description' => '',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'class'       => '',
                    'heading'     => esc_html__('Tweet Cache Time', 'mikado-core'),
                    'param_name'  => 'transient_time',
                    'value'       => '',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Navigation Skin', 'mikado-core'),
                    'param_name'  => 'skin',
                    'description' => '',
                    'value'       => array(
                        esc_html__('Dark', 'mikado-core')  => 'dark',
                        esc_html__('Light', 'mikado-core') => 'light'
                    ),
                ),
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
        $params = array(
            'user_id'        => '',
            'count'          => '4',
            'tweets_color'   => '',
            'transient_time' => '0',
            'skin'           => 'dark'
        );

        $params = shortcode_atts($params, $atts);

        $html = '';

        $nav = '';
        if($params['skin'] == 'dark') {
            $nav = ' mkd-nav-dark';
        }

        $params['dark_nav'] = $nav;

        $twitter_api = \MikadoTwitterApi::getInstance();

        if($twitter_api->hasUserConnected()) {
            $response = $twitter_api->fetchTweets($params['user_id'], $params['count'], array(
                'transient_time' => $params['transient_time'],
                'transient_id'   => 'mkd_twitter_slider_cache'
            ));

            $params['response']     = $response;
            $params['twitter_api']  = $twitter_api;
            $params['tweet_styles'] = $this->getTweetStyles($params);

            $html .= mikado_core_get_core_shortcode_template_part('templates/twitter-slider', 'twitter-slider', '', $params);
        } else {
            $html .= esc_html__('It seams that you haven\'t connected with your Twitter account', 'mikado-core');
        }

        return $html;
    }

    /**
     * @param $params
     *
     * @return array
     */
    private function getTweetStyles($params) {
        $styles = array();

        if(!empty($params['tweets_color'])) {
            $styles[] = 'color: '.$params['tweets_color'];
        }

        return $styles;
    }

}