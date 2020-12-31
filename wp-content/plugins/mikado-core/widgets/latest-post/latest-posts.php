<?php

class AnahataMikadoLatestPosts extends AnahataMikadoWidget {
    protected $params;

    public function __construct() {
        parent::__construct(
            'mkd_latest_posts_widget', // Base ID
            esc_html__('Mikado Latest Post', 'mikado-core'), // Name
            array('description' => esc_html__('Display posts from your blog', 'mikado-core'),) // Args
        );

        $this->setParams();
    }

    protected function setParams() {
        $this->params = array(
            array(
                'name'  => 'title',
                'type'  => 'textfield',
                'title' => esc_html__('Title', 'mikado-core')
            ),
            array(
                'name'    => 'type',
                'type'    => 'dropdown',
                'title'   => esc_html__('Type', 'mikado-core'),
                'options' => array(
                    'minimal'      => esc_html__('Minimal', 'mikado-core'),
                    'image-in-box' => esc_html__('Image in box', 'mikado-core')
                )
            ),
            array(
                'name'  => 'number_of_posts',
                'type'  => 'textfield',
                'title' => esc_html__('Number of posts', 'mikado-core')
            ),
            array(
                'name'    => 'order_by',
                'type'    => 'dropdown',
                'title'   => esc_html__('Order By', 'mikado-core'),
                'options' => array(
                    'title' => esc_html__('Title', 'mikado-core'),
                    'date'  => esc_html__('Date', 'mikado-core')
                )
            ),
            array(
                'name'    => 'order',
                'type'    => 'dropdown',
                'title'   => esc_html__('Order', 'mikado-core'),
                'options' => array(
                    'ASC'  => esc_html__('ASC', 'mikado-core'),
                    'DESC' => esc_html__('DESC', 'mikado-core')
                )
            ),
            array(
                'name'    => 'image_size',
                'type'    => 'dropdown',
                'title'   => esc_html__('Image Size', 'mikado-core'),
                'options' => array(
                    'original'  => esc_html__('Original', 'mikado-core'),
                    'landscape' => esc_html__('Landscape', 'mikado-core'),
                    'square'    => esc_html__('Square', 'mikado-core'),
                    'custom'    => esc_html__('Custom', 'mikado-core')
                )
            ),
            array(
                'name'  => 'custom_image_size',
                'type'  => 'textfield',
                'title' => esc_html__('Custom Image Size', 'mikado-core')
            ),
            array(
                'name'  => 'category',
                'type'  => 'textfield',
                'title' => esc_html__('Category Slug', 'mikado-core')
            ),
            array(
                'name'  => 'text_length',
                'type'  => 'textfield',
                'title' => esc_html__('Number of characters', 'mikado-core')
            ),
            array(
                'name'    => 'title_tag',
                'type'    => 'dropdown',
                'title'   => esc_html__('Title Tag', 'mikado-core'),
                'options' => array(
                    ""   => "",
                    "h2" => "h2",
                    "h3" => "h3",
                    "h4" => "h4",
                    "h5" => "h5",
                    "h6" => "h6"
                )
            )
        );
    }

    public function widget($args, $instance) {
        extract($args);

        //prepare variables
        $content        = '';
        $params         = array();
        $params['type'] = 'image_in_box';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params[$key] = $value;
            }
        }
        if(empty($params['title_tag'])) {
            $params['title_tag'] = 'h6';
        }
        echo '<div class="widget mkd-latest-posts-widget">';

        if(!empty($instance['title'])) {
			echo anahata_mikado_get_module_part($args['before_title'].$instance['title'].$args['after_title']);
        }

        echo anahata_mikado_execute_shortcode('mkd_blog_list', $params);

        echo '</div>'; //close mkd-latest-posts-widget
    }
}
