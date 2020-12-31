<?php
namespace Anahata\Modules\Shortcodes\BlogSlider;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class BlogSlider implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkd_blog_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(array(
            'name'                      => esc_html__('Blog Slider', 'mikado-core'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-blog-slider extended-custom-icon',
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Slider type', 'mikado-core'),
                    'param_name'  => 'blog_slider_type',
                    'value'       => array(
                        esc_html__('Type 1', 'mikado-core') => 'blog_slider_one',
                        esc_html__('Type 2', 'mikado-core') => 'blog_slider_two'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Posts to show', 'mikado-core'),
                    'param_name'  => 'posts_to_show',
                    'value'       => array(
                        '3' => 3,
                        '4' => 4
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Navigation', 'mikado-core'),
                    'param_name'  => 'slider_navigation',
                    'value'       => array(
                        esc_html__('Dots', 'mikado-core')            => 'dots',
                        esc_html__('Arrows', 'mikado-core')          => 'arrows',
                        esc_html__('Dots and Arrows', 'mikado-core') => 'dots_arrows'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Navigation Color', 'mikado-core'),
                    'param_name'  => 'navigation_color',
                    'value'       => '',
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => esc_html__('Choose dots color', 'mikado-core')
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Navigation Active Color', 'mikado-core'),
                    'param_name'  => 'navigation_active_color',
                    'value'       => '',
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => esc_html__('Choose dots active color', 'mikado-core')
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Number of Posts', 'mikado-core'),
                    'param_name'  => 'number_of_posts',
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Order By', 'mikado-core'),
                    'param_name'  => 'order_by',
                    'value'       => array(
                        esc_html__('Title', 'mikado-core') => 'title',
                        esc_html__('Date', 'mikado-core')  => 'date'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Order', 'mikado-core'),
                    'param_name'  => 'order',
                    'value'       => array(
                        esc_html__('ASC', 'mikado-core')  => 'ASC',
                        esc_html__('DESC', 'mikado-core') => 'DESC'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Category Slug', 'mikado-core'),
                    'param_name'  => 'category',
                    'description' => esc_html__('Leave empty for all or use comma for list', 'mikado-core')
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Title length', 'mikado-core'),
                    'param_name'  => 'title_length',
                    'description' => esc_html__('Enter a number of letters in title', 'mikado-core')
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Excerpt length', 'mikado-core'),
                    'param_name'  => 'excerpt_length',
                    'description' => esc_html__('Enter a number of words in excerpt (article summary)', 'mikado-core')
                )
            )
        ));

    }

    public function render($atts, $content = null) {
        if(anahata_mikado_options()->getOptionValue('number_of_chars') !== '') {
            $excerpt_length = esc_attr(anahata_mikado_options()->getOptionValue('number_of_chars'));
        } else {
            $excerpt_length = 45;
        }

        $default_atts = array(
            'blog_slider_type'        => 'blog_slider_one',
            'posts_to_show'           => 3,
            'slider_navigation'       => 'dots',
            'navigation_color'        => '',
            'navigation_active_color' => '',
            'number_of_posts'         => '',
            'order_by'                => '',
            'order'                   => '',
            'category'                => '',
            'title_length'            => '',
            'excerpt_length'          => $excerpt_length
        );

        $params = shortcode_atts($default_atts, $atts);

        $queryParams = $this->generateBlogQueryArray($params);

        $query = new \WP_Query($queryParams);

        $params['query'] = $query;

        $params['additional_classes'] = $this->getAddtionalClasses($params);
        $params['data_attribute']     = $this->getDataAttribute($params);

        if($params['blog_slider_type'] == 'blog_slider_one') {
            return mikado_core_get_core_shortcode_template_part('templates/blog-slider-template-one', 'blog-slider', '', $params);
        } else {
            return mikado_core_get_core_shortcode_template_part('templates/blog-slider-template-two', 'blog-slider', '', $params);
        }
    }

    /**
     * Return Blog Slider holder calsses
     *
     * @param $params
     *
     * @return string
     */
    private function getAddtionalClasses($params) {
        $additional_classes = '';

        if($params['slider_navigation'] != 'arrows') {
            $additional_classes .= " dots_navigation";
        }

        return $additional_classes;
    }


    /**
     * Generates query array
     *
     * @param $params
     *
     * @return array
     */
    public function generateBlogQueryArray($params) {

        $queryArray = array(
            'orderby'        => $params['order_by'],
            'order'          => $params['order'],
            'posts_per_page' => $params['number_of_posts'],
            'category_name'  => $params['category']
        );

        return $queryArray;
    }

    /**
     * Return Blog Slider data attribute
     *
     * @param $params
     *
     * @return string
     */
    private function getDataAttribute($params) {
        $data_attribute = '';
        $data_attribute .= ' data-posts_to_show="'.$params['posts_to_show'].'"';
        $data_attribute .= ' data-slider_navigation="'.$params['slider_navigation'].'"';
        $data_attribute .= ' data-navigation_color="'.$params['navigation_color'].'"';
        $data_attribute .= ' data-navigation_active_color="'.$params['navigation_active_color'].'"';

        return $data_attribute;
    }
}