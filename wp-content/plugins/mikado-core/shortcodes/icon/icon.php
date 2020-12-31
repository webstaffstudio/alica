<?php
namespace Anahata\Modules\Shortcodes\Icon;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Icon
 * @package Anahata\Modules\Shortcodes\Icon
 */
class Icon implements ShortcodeInterface {


    /**
     * Icon constructor.
     */
    public function __construct() {
        $this->base = 'mkd_icon';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     *
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Icon', 'mikado-core'),
            'base'                      => $this->base,
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                      => 'icon-wpb-icons extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                \AnahataMikadoIconCollections::get_instance()->getVCParamsArray(),
                array(
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Size', 'mikado-core'),
                        'admin_label' => true,
                        'param_name'  => 'size',
                        'value'       => array(
                            esc_html__('Tiny', 'mikado-core')       => 'mkd-icon-tiny',
                            esc_html__('Small', 'mikado-core')      => 'mkd-icon-small',
                            esc_html__('Medium', 'mikado-core')     => 'mkd-icon-medium',
                            esc_html__('Large', 'mikado-core')      => 'mkd-icon-large',
                            esc_html__('Very Large', 'mikado-core') => 'mkd-icon-huge'
                        ),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Custom Size (px)', 'mikado-core'),
                        'param_name'  => 'custom_size',
                        'value'       => ''
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Type', 'mikado-core'),
                        'param_name'  => 'type',
                        'admin_label' => true,
                        'value'       => array(
                            esc_html__('Normal', 'mikado-core')   => 'normal',
                            esc_html__('Circle', 'mikado-core')   => 'circle',
                            esc_html__('Square', 'mikado-core')   => 'square'
                        ),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Border radius', 'mikado-core'),
                        'param_name'  => 'border_radius',
                        'description' => esc_html__('Please insert border radius(Rounded corners) in px. For example: 4 ', 'mikado-core'),
                        'dependency'  => array('element' => 'type', 'value' => array('square'))
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Shape Size (px)', 'mikado-core'),
                        'param_name'  => 'shape_size',
                        'admin_label' => true,
                        'value'       => '',
                        'description' => '',
                        'dependency'  => array('element' => 'type', 'value' => array('circle', 'square'))
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Icon Color', 'mikado-core'),
                        'param_name'  => 'icon_color',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'type', 'value' => array('normal', 'circle', 'square'))
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Border Color', 'mikado-core'),
                        'param_name'  => 'border_color',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'type', 'value' => array('circle', 'square'))
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Border Width', 'mikado-core'),
                        'param_name'  => 'border_width',
                        'admin_label' => true,
                        'description' => esc_html__('Enter just number. Omit pixels', 'mikado-core'),
                        'dependency'  => array('element' => 'type', 'value' => array('circle', 'square'))
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Background Color', 'mikado-core'),
                        'param_name'  => 'background_color',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'type', 'value' => array('circle', 'square'))
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Hover Icon Color', 'mikado-core'),
                        'param_name'  => 'hover_icon_color',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'type', 'value' => array('normal', 'circle', 'square'))
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Hover Border Color', 'mikado-core'),
                        'param_name'  => 'hover_border_color',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'type', 'value' => array('circle', 'square'))
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Hover Background Color', 'mikado-core'),
                        'param_name'  => 'hover_background_color',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'type', 'value' => array('circle', 'square'))
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Margin', 'mikado-core'),
                        'param_name'  => 'margin',
                        'admin_label' => true,
                        'description' => esc_html__('Margin (top right bottom left)', 'mikado-core')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Icon Animation', 'mikado-core'),
                        'param_name'  => 'icon_animation',
                        'admin_label' => true,
                        'value'       => array(
                            esc_html__('No', 'mikado-core')  => '',
                            esc_html__('Yes', 'mikado-core') => 'yes'
                        ),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Icon Animation Delay (ms)', 'mikado-core'),
                        'param_name'  => 'icon_animation_delay',
                        'value'       => '',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'icon_animation', 'value' => 'yes')
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Link', 'mikado-core'),
                        'param_name'  => 'link',
                        'value'       => '',
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'checkbox',
                        'heading'     => esc_html__('Use Link as Anchor', 'mikado-core'),
                        'value'       => array('Use this icon as Anchor?' => 'yes'),
                        'param_name'  => 'anchor_icon',
                        'admin_label' => true,
                        'description' => esc_html__('Check this box to use icon as anchor link (eg. #contact)', 'mikado-core'),
                        'dependency'  => Array('element' => 'link', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Target', 'mikado-core'),
                        'param_name'  => 'target',
                        'admin_label' => true,
                        'value'       => array(
                            esc_html__('Self', 'mikado-core')  => '_self',
                            esc_html__('Blank', 'mikado-core') => '_blank'
                        ),
                        'save_always' => true,
                        'dependency'  => array('element' => 'link', 'not_empty' => true)
                    )
                )
            )
        ));
    }

    /**
     * Renders shortcode's HTML
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'size'                   => '',
            'custom_size'            => '',
            'type'                   => 'normal',
            'border_radius'          => '',
            'shape_size'             => '',
            'icon_color'             => '',
            'border_color'           => '',
            'border_width'           => '',
            'background_color'       => '',
            'hover_icon_color'       => '',
            'hover_border_color'     => '',
            'hover_background_color' => '',
            'margin'                 => '',
            'icon_animation'         => '',
            'icon_animation_delay'   => '',
            'link'                   => '',
            'anchor_icon'            => '',
            'target'                 => ''
        );

        $default_atts = array_merge($default_atts, anahata_mikado_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        $iconPackName = anahata_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        //generate icon holder classes
        $iconHolderClasses = array('mkd-icon-shortcode', $params['type']);

        if($params['icon_animation'] == 'yes') {
            $iconHolderClasses[] = 'mkd-icon-animation';
        }

        if($params['custom_size'] == '') {
            $iconHolderClasses[] = $params['size'];
        }

        //prepare params for template
        $params['icon']                         = $params[$iconPackName];
        $params['icon_holder_classes']          = $iconHolderClasses;
        $params['icon_holder_styles']           = $this->generateIconHolderStyles($params);
        $params['icon_holder_data']             = $this->generateIconHolderData($params);
        $params['icon_params']                  = $this->generateIconParams($params);
        $params['icon_animation_holder']        = isset($params['icon_animation']) && $params['icon_animation'] == 'yes';
        $params['icon_animation_holder_styles'] = $this->generateIconAnimationHolderStyles($params);

        $html = mikado_core_get_core_shortcode_template_part('templates/icon', 'icon', '', $params);

        return $html;
    }

    /**
     * Generates icon parameters array
     *
     * @param $params
     *
     * @return array
     */
    private function generateIconParams($params) {
        $iconParams = array('icon_attributes' => array());

        $iconParams['icon_attributes']['style'] = $this->generateIconStyles($params);
        $iconParams['icon_attributes']['class'] = 'mkd-icon-element';

        return $iconParams;
    }

    /**
     * Generates icon styles array
     *
     * @param $params
     *
     * @return string
     */
    private function generateIconStyles($params) {
        $iconStyles = array();

        if(!empty($params['icon_color'])) {
            $iconStyles[] = 'color: '.$params['icon_color'];
        }

        if(($params['type'] !== 'normal' && !empty($params['shape_size'])) ||
           ($params['type'] == 'normal')
        ) {
            if(!empty($params['custom_size'])) {
                $iconStyles[] = 'font-size:'.anahata_mikado_filter_px($params['custom_size']).'px';
            }
        }

        return implode(';', $iconStyles);
    }

    /**
     * Generates icon holder styles for circle and square icon type
     *
     * @param $params
     *
     * @return array
     */
    private function generateIconHolderStyles($params) {
        $iconHolderStyles = array();

        if(isset($params['margin']) && $params['margin'] !== '') {
            $iconHolderStyles[] = 'margin: '.$params['margin'];
        }

        //generate styles attribute only if type isn't normal
        if(isset($params['type']) && $params['type'] !== 'normal') {
            $shapeSize = '';
            if(!empty($params['shape_size'])) {
                $shapeSize = $params['shape_size'];
            } elseif(!empty($params['custom_size'])) {
                $shapeSize = $params['custom_size'];
            }

            if(!empty($shapeSize)) {
                $iconHolderStyles[] = 'width: '.anahata_mikado_filter_px($shapeSize + 1).'px'; //because some icones are cutted
                $iconHolderStyles[] = 'height: '.anahata_mikado_filter_px($shapeSize).'px';
                $iconHolderStyles[] = 'line-height: '.anahata_mikado_filter_px($shapeSize).'px';
            }

            if(!empty($params['background_color'])) {
                $iconHolderStyles[] = 'background-color: '.$params['background_color'];
            }

            if(!empty($params['border_color']) && (isset($params['border_width']) && $params['border_width'] !== '')) {
                $iconHolderStyles[] = 'border-style: solid';
                $iconHolderStyles[] = 'border-color: '.$params['border_color'];
                $iconHolderStyles[] = 'border-width: '.anahata_mikado_filter_px($params['border_width']).'px';
            } else if(isset($params['border_width']) && $params['border_width'] !== '') {
                $iconHolderStyles[] = 'border-style: solid';
                $iconHolderStyles[] = 'border-width: '.anahata_mikado_filter_px($params['border_width']).'px';
            } else if(!empty($params['border_color'])) {
                $iconHolderStyles[] = 'border-color: '.$params['border_color'];
            }

            if($params['type'] == 'square') {
                if(isset($params['border_radius']) && $params['border_radius'] !== '') {
                    $iconHolderStyles[] = 'border-radius: '.anahata_mikado_filter_px($params['border_radius']).'px';
                }
            }
        }

        return $iconHolderStyles;
    }

    /**
     * Generates icon holder data attribute array
     *
     * @param $params
     *
     * @return array
     */
    private function generateIconHolderData($params) {
        $iconHolderData = array();

        if(isset($params['type']) && $params['type'] !== 'normal') {
            if(!empty($params['hover_border_color'])) {
                $iconHolderData['data-hover-border-color'] = $params['hover_border_color'];
            }

            if(!empty($params['hover_background_color'])) {
                $iconHolderData['data-hover-background-color'] = $params['hover_background_color'];
            }
        }

        if((isset($params['icon_animation']) && $params['icon_animation'] == 'yes')
           && (isset($params['icon_animation_delay']) && $params['icon_animation_delay'] !== '')
        ) {
            $iconHolderData['data-animation-delay'] = $params['icon_animation_delay'];
        }

        if(!empty($params['hover_icon_color'])) {
            $iconHolderData['data-hover-color'] = $params['hover_icon_color'];
        }

        if(!empty($params['icon_color'])) {
            $iconHolderData['data-color'] = $params['icon_color'];
        }

        return $iconHolderData;
    }

    private function generateIconAnimationHolderStyles($params) {
        $styles = array();

        if((isset($params['icon_animation']) && $params['icon_animation'] == 'yes')
           && (isset($params['icon_animation_delay']) && $params['icon_animation_delay'] !== '')
        ) {
            $styles[] = 'transition-delay: '.$params['icon_animation_delay'].'ms';
            $styles[] = '-webkit-transition-delay: '.$params['icon_animation_delay'].'ms';
            $styles[] = '-moz-transition-delay: '.$params['icon_animation_delay'].'ms';
            $styles[] = '-ms-transition-delay: '.$params['icon_animation_delay'].'ms';
        }

        return $styles;
    }
}