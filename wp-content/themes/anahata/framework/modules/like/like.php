<?php

class AnahataMikadoLike {

    private static $instance;

    private function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_anahata_mikado_like', array($this, 'ajax'));
        add_action('wp_ajax_nopriv_anahata_mikado_like', array($this, 'ajax'));
    }

    public static function get_instance() {

        if(null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;

    }

    function enqueue_scripts() {

        wp_enqueue_script('mkd-like', MIKADO_ASSETS_ROOT.'/js/like.js', 'jquery', '1.0', true);

        wp_localize_script('mkd-like', 'mkdLike', array(
            'ajaxurl' => admin_url('admin-ajax.php')
        ));
    }

    function ajax() {
		$likes_id = isset( $_POST['likes_id'] ) && ! empty( $_POST['likes_id'] ) ? sanitize_text_field( $_POST['likes_id'] ) : '';

        //update
        if(!empty( $likes_id )) {

            $post_id = str_replace('mkd-like-', '', $likes_id);
            $post_id = substr($post_id, 0, -4);
            $type    = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';

            echo wp_kses($this->like_post($post_id, 'update', $type), array(
                'span' => array(
                    'class'       => true,
                    'aria-hidden' => true,
                    'style'       => true,
                    'id'          => true
                ),
                'i'    => array(
                    'class' => true,
                    'style' => true,
                    'id'    => true
                )
            ));
        } //get
        else {
            $post_id = str_replace('mkd-like-', '', $likes_id);
            $post_id = substr($post_id, 0, -4);
            echo wp_kses($this->like_post($post_id, 'get'), array(
                'span' => array(
                    'class'       => true,
                    'aria-hidden' => true,
                    'style'       => true,
                    'id'          => true
                ),
                'i'    => array(
                    'class' => true,
                    'style' => true,
                    'id'    => true
                )
            ));
        }
        exit;
    }

    public function like_post($post_id, $action = 'get', $type = '') {
        if(!is_numeric($post_id)) {
            return;
        }

        switch($action) {

            case 'get':
                $like_count = get_post_meta($post_id, '_mkd-like', true);
                $like_label = $like_count !== '1' ? esc_html__('likes', 'anahata') : esc_html__('like', 'anahata');
                if(isset($_COOKIE['mkd-like_'.$post_id])) {
                    $icon = '<i class="icon_heart" aria-hidden="true"></i>';
                } else {
                    $icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';
                }
                if(!$like_count) {
                    $like_count = 0;
                    add_post_meta($post_id, '_mkd-like', $like_count, true);
                    $icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';
                }
                $return_value = $icon.'<span class = "mkd-like-number">'.$like_count.'</span><span>'.$like_label.'</span>';

                return $return_value;
                break;

            case 'update':
                $like_count = get_post_meta($post_id, '_mkd-like', true);
                $like_label = $like_count !== '0' ? esc_html__('likes', 'anahata') : esc_html__('like', 'anahata');

                if($type != 'portfolio_list' && isset($_COOKIE['mkd-like_'.$post_id])) {
                    return $like_count;
                }

                $like_count++;

                update_post_meta($post_id, '_mkd-like', $like_count);
                setcookie('mkd-like_'.$post_id, $post_id, time() * 20, '/');

                if($type != 'portfolio_list') {
                    $return_value = '<i class="icon_heart" aria-hidden="true"></i><span class = "mkd-like-number">'.$like_count.'</span><span>'.$like_label.'</span>';

                    $return_value .= '</span>';

                    return $return_value;
                }

                return '';
                break;
            default:
                return '';
                break;
        }
    }

    public function add_like() {
        global $post;

        $output = $this->like_post($post->ID);

        $class       = 'mkd-like';
        $rand_number = rand(100, 999);
        $title       = esc_html__('Like this', 'anahata');
        if(isset($_COOKIE['mkd-like_'.$post->ID])) {
            $class = 'mkd-like liked';
            $title = esc_html__('You already like this!', 'anahata');
        }

		return '<a href="#" class="' . esc_attr( $class ) . '" id="mkd-like-' . esc_attr( $post->ID ) . '-' . $rand_number . '" title="' . esc_attr( $title ) . '">' . $output . '</a>';
    }

    public function add_like_portfolio_list($portfolio_project_id) {

        $class       = 'mkd-like';
        $rand_number = rand(100, 999);
        $title       = esc_html__('Like this', 'anahata');
        if(isset($_COOKIE['mkd-like_'.$portfolio_project_id])) {
            $class = 'mkd-like liked';
            $title = esc_html__('You already like this!', 'anahata');
        }

        return '<a href="#" class="'.$class.'" data-type="portfolio_list" id="mkd-like-'.$portfolio_project_id.'-'.$rand_number.'" title="'.$title.'">'.esc_html__('Like', 'anahata').'</a>';
    }

    public function add_like_blog_list($blog_id) {

        $class       = 'mkd-like';
        $rand_number = rand(100, 999);
        $title       = esc_html__('Like this', 'anahata');
        if(isset($_COOKIE['mkd-like_'.$blog_id])) {
            $class = 'mkd-like liked';
            $title = esc_html__('You already like this!', 'anahata');
        }

        return '<a class="hover_icon '.$class.'" data-type="portfolio_list" id="mkd-like-'.$blog_id.'-'.$rand_number.'" title="'.$title.'"></a>';
    }

}

global $anahata_like;
$anahata_like = AnahataMikadoLike::get_instance();
