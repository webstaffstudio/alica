<?php

/**
 * Widget that adds separator boxes type
 *
 * Class Separator_Widget
 */
class AnahataMikadoSeparatorWidget extends AnahataMikadoWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_separator_widget', // Base ID
            esc_html__('Mikado Separator Widget', 'mikado-core') // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type'    => 'dropdown',
                'title'   => esc_html__('Type', 'mikado-core'),
                'name'    => 'type',
                'options' => array(
                    'normal'     => esc_html__('Normal', 'mikado-core'),
                    'full-width' => esc_html__('Full Width', 'mikado-core')
                )
            ),
            array(
                'type'    => 'dropdown',
                'title'   => esc_html__('Position', 'mikado-core'),
                'name'    => 'position',
                'options' => array(
                    'center' => esc_html__('Center', 'mikado-core'),
                    'left'   => esc_html__('Left', 'mikado-core'),
                    'right'  => esc_html__('Right', 'mikado-core')
                )
            ),
            array(
                'type'    => 'dropdown',
                'title'   => esc_html__('Style', 'mikado-core'),
                'name'    => 'border_style',
                'options' => array(
                    'solid'  => esc_html__('Solid', 'mikado-core'),
                    'dashed' => esc_html__('Dashed', 'mikado-core'),
                    'dotted' => esc_html__('Dotted', 'mikado-core')
                )
            ),
            array(
                'type'  => 'textfield',
                'title' => esc_html__('Color', 'mikado-core'),
                'name'  => 'color'
            ),
            array(
                'type'        => 'textfield',
                'title'       => esc_html__('Width', 'mikado-core'),
                'name'        => 'width',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'title'       => esc_html__('Thickness (px)', 'mikado-core'),
                'name'        => 'thickness',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'title'       => esc_html__('Top Margin', 'mikado-core'),
                'name'        => 'top_margin',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'title'       => esc_html__('Bottom Margin', 'mikado-core'),
                'name'        => 'bottom_margin',
                'description' => ''
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        extract($args);

        //prepare variables
        $params = '';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params .= " $key='$value' ";
            }
        }

        echo '<div class="widget mkd-separator-widget">';

        //finally call the shortcode
        echo do_shortcode("[mkd_separator $params]"); // XSS OK

        echo '</div>'; //close div.mkd-separator-widget
    }
}