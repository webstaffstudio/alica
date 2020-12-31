<?php
namespace Anahata\Modules\Shortcodes\SectionSubtitle;

use Anahata\Modules\Shortcodes\Lib;

class SectionSubtitle implements Lib\ShortcodeInterface {
    private $base;

    /**
     * SectionSubtitle constructor.
     */
    public function __construct() {
        $this->base = 'mkd_section_subtitle';

        add_action('vc_before_init', array($this, 'vcMap'));
    }


    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Section Subtitle', 'mikado-core'),
            'base'                      => $this->base,
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                      => 'icon-wpb-section-subtitle extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Color', 'mikado-core'),
                    'param_name'  => 'color',
                    'value'       => '',
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => esc_html__('Choose color of your subtitle', 'mikado-core')
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Text Align', 'mikado-core'),
                    'param_name'  => 'text_align',
                    'value'       => array(
                        ''                          => '',
                        esc_html__('Center', 'mikado-core') => 'center',
                        esc_html__('Left', 'mikado-core')   => 'left',
                        esc_html__('Right', 'mikado-core')  => 'right'
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => esc_html__('Choose color of your subtitle', 'mikado-core')
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__('Text', 'mikado-core'),
                    'param_name'  => 'text',
                    'value'       => '',
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Width (%)', 'mikado-core'),
                    'param_name'  => 'width',
                    'description' => esc_html__('Adjust the width of section subtitle in percentages. Ommit the unit', 'mikado-core'),
                    'value'       => '',
                    'save_always' => true,
                    'admin_label' => true
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'text'       => '',
            'color'      => '',
            'text_align' => '',
            'width'      => ''
        );

        $params = shortcode_atts($default_atts, $atts);

        if($params['text'] !== '') {

            $params['styles']  = array();
            $params['classes'] = array('mkd-section-subtitle-holder');

            if($params['color'] !== '') {
                $params['styles'][] = 'color: '.$params['color'];
            }

            if($params['text_align'] !== '') {
                $params['styles'][] = 'text-align: '.$params['text_align'];

                $params['classes'][] = 'mkd-section-subtitle-'.$params['text_align'];
            }

            $params['holder_styles'] = array();

            if($params['width'] !== '') {
                $params['holder_styles'][] = 'width: '.$params['width'].'%';
            }

            return mikado_core_get_core_shortcode_template_part('templates/section-subtitle-template', 'section-subtitle', '', $params);
        }
    }

}
