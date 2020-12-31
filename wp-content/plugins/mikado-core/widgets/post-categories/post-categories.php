<?php

class AnahataMikadoPostCategories extends AnahataMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkd_post_categories', // Base ID
            esc_html__('Mikado Post Categories', 'mikado-core') // Name
        );

        $this->setParams();
    }

    protected function setParams() {
        $this->params = array(
            array(
                'name'  => 'title',
                'type'  => 'textfield',
                'title' => esc_html__('Categories', 'mikado-core')
            )
        );
    }

    public function widget($args, $instance) {
        extract($args);

        $params = array();

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params[$key] = $value;
            }
        }
        ?>
        <div class="widget widget_categories">
            <?php echo anahata_mikado_get_module_part($args['before_title'].$instance['title'].$args['after_title']); ?>
            <ul>
                <?php
                $categories = get_categories();
                foreach($categories as $category) {
                    echo '<li class="cat-item cat-item-'.$category->term_id.'">'.anahata_mikado_get_category_color_name($category, true).'</li>';
                }
                ?>
            </ul>
        </div>
        <?php
    }
}