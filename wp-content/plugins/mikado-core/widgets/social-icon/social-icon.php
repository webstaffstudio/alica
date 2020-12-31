<?php

/**
 * Widget that adds social icon
 *
 * Class Social_Icon_Widget
 */
class AnahataMikadoSocialIconWidget extends AnahataMikadoWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_social_icon_widget', // Base ID
            esc_html__('Mikado Social Icon Widget', 'mikado-core') // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array_merge(
            anahata_mikado_icon_collections()->getSocialIconWidgetParamsArray(),
            array(
                array(
                    'type'        => 'textfield',
                    'title'       => esc_html__('Link', 'mikado-core'),
                    'name'        => 'link',
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'title'       => esc_html__('Target', 'mikado-core'),
                    'name'        => 'target',
                    'options'     => array(
                        '_self'  => esc_html__('Same Window', 'mikado-core'),
                        '_blank' => esc_html__('New Window', 'mikado-core')
                    ),
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'title'       => esc_html__('Text Size (px)', 'mikado-core'),
                    'name'        => 'text_size',
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'title'       => esc_html__('Color', 'mikado-core'),
                    'name'        => 'color',
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'title'       => esc_html__('Hover Color', 'mikado-core'),
                    'name'        => 'hover_color',
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'title'       => esc_html__('Margin', 'mikado-core'),
                    'name'        => 'margin',
                    'description' => esc_html__('Margin (top right bottom left)', 'mikado-core')
                )
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

        $social_icon_styles = array();

        if(!empty($instance['color']) && $instance['color'] !== '') {
            $social_icon_styles[] = 'color: '.$instance['color'];
        }

        if(!empty($instance['text_size']) && $instance['text_size'] !== '') {
            $social_icon_styles[] = 'font-size: '.$instance['text_size'].'px';
        }

        if(!empty($instance['margin']) && $instance['margin'] !== '') {
            $social_icon_styles[] = 'margin: '.$instance['margin'];
        }

        $link = '#';
        if(!empty($instance['link']) && $instance['link'] !== '') {
            $link = $instance['link'];
        }

        $target = '_self';
        if(!empty($instance['target']) && $instance['target'] !== '') {
            $target = $instance['target'];
        }

        $hover_color = '';
        if(!empty($instance['hover_color']) && $instance['hover_color'] !== '') {
            $hover_color = $instance['hover_color'];
        }

        $icon_html        = 'fa-facebook';
        $icon_holder_html = '';
        if(!empty($instance['icon_pack']) && $instance['icon_pack'] !== '') {
            if(!empty($instance['fa_icon']) && $instance['fa_icon'] !== '' && $instance['icon_pack'] === 'font_awesome') {
                $icon_html        = $instance['fa_icon'];
                $icon_holder_html = '<i class="mkd-social-icon-widget fa '.$icon_html.'"></i>';
            } else if(!empty($instance['fe_icon']) && $instance['fe_icon'] !== '' && $instance['icon_pack'] === 'font_elegant') {
                $icon_html        = $instance['fe_icon'];
                $icon_holder_html = '<span class="mkd-social-icon-widget '.$icon_html.'"></span>';
            } else if(!empty($instance['ion_icon']) && $instance['ion_icon'] !== '' && $instance['icon_pack'] === 'ion_icons') {
                $icon_html        = $instance['ion_icon'];
                $icon_holder_html = '<span class="mkd-social-icon-widget '.$icon_html.'"></span>';
            } else if(!empty($instance['simple_line_icons']) && $instance['simple_line_icons'] !== '' && $instance['icon_pack'] === 'simple_line_icons') {
                $icon_html        = $instance['simple_line_icons'];
                $icon_holder_html = '<span class="mkd-social-icon-widget '.$icon_html.'"></span>';
            } else {
                $icon_holder_html = '<i class="mkd-social-icon-widget fa '.$icon_html.'"></i>';
            }
        }
        ?>

        <?php echo anahata_mikado_get_module_part($args['before_widget']); ?>

        <a class="mkd-social-icon-widget-holder" <?php echo anahata_mikado_get_inline_attr($hover_color, 'data-hover-color'); ?> <?php anahata_mikado_inline_style($social_icon_styles) ?> href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
            <?php echo anahata_mikado_get_module_part($icon_holder_html); ?>
        </a>

        <?php echo anahata_mikado_get_module_part($args['after_widget']); ?>
        <?php
    }
}