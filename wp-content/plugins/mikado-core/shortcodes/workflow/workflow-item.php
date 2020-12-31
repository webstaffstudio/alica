<?php
namespace Anahata\Modules\WorkflowItem;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * class Workflow
 */
class WorkflowItem implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkd_workflow_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(array(
            "name"                    => esc_html__('Workflow Item', 'mikado-core'),
            "base"                    => $this->base,
            "as_child"                => array('only' => 'mkd_workflow'),
            "category" => esc_html__( 'by MIKADO', 'mikado-core' ),
            "icon"                    => "icon-wpb-workflow-item extended-custom-icon",
            "show_settings_on_create" => true,
            'params'                  => array_merge(
                array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Title', 'mikado-core'),
                        'param_name'  => 'title',
                        'admin_label' => true,
                        'description' => esc_html__('Enter workflow item title.', 'mikado-core')
                    ),
                    array(
                        'type'        => 'textarea',
                        'heading'     => esc_html__('Text', 'mikado-core'),
                        'param_name'  => 'text',
                        'description' => esc_html__('Enter workflow item text.', 'mikado-core')
                    ),
                    array(
                        'type'        => 'attach_image',
                        'heading'     => esc_html__('Image', 'mikado-core'),
                        'param_name'  => 'image',
                        'description' => esc_html__('Insert workflow item image.', 'mikado-core')
                    ),
                    array(
                        'type'        => 'checkbox',
                        'heading'     => esc_html__('Set image on right side', 'mikado-core'),
                        'param_name'  => 'image_float',
                        'value'       => array('Make Image Float Right?' => 'yes'),
                        'description' => ''
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Image alignment', 'mikado-core'),
                        'param_name'  => 'image_alignment',
                        'admin_label' => true,
                        'value'       => array(
                            esc_html__('Center', 'mikado-core') => 'center',
                            esc_html__('Left', 'mikado-core')   => 'left',
                            esc_html__('Right', 'mikado-core')  => 'right'
                        )
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Circle border color', 'mikado-core'),
                        'param_name'  => 'circle_border_color',
                        'description' => esc_html__('Pick a color for the circle border color.', 'mikado-core')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Circle background color', 'mikado-core'),
                        'param_name'  => 'circle_background_color',
                        'description' => esc_html__('Pick a color for the circle background color.', 'mikado-core')
                    ),
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = (array(
            'title'                   => '',
            'text'                    => '',
            'image'                   => '',
            'image_float'             => '',
            'image_alignment'         => 'center',
            'circle_border_color'     => '',
            'circle_background_color' => '',
        ));
        $params       = shortcode_atts($default_atts, $atts);
        $style_params = $this->getStyleProperties($params);
        $params       = array_merge($params, $style_params);
        extract($params);

        $params['image_on_right_class'] = $this->imageOnRightSideClass($params);

        $output = '';
        $output .= mikado_core_get_core_shortcode_template_part('templates/workflow-item-template', 'workflow', '', $params);

        return $output;
    }

    /**
     * Checks if image is set to be on right and set class
     *
     * @param $params
     *
     * @return string
     */
    private function imageOnRightSideClass($params) {

        $class = '';

        if($params['image_float'] == 'yes') {
            $class .= 'reverse';
        }

        return $class;
    }

    /**
     * Generates circle line color
     *
     * @param $params
     *
     * @return array
     */

    private function getStyleProperties($params) {

        $style                            = array();
        $style['circle_border_color']     = '';
        $style['circle_background_color'] = '';
        $style['line_color']              = '';

        if($params['circle_border_color'] !== '') {
            $style['circle_border_color'] = 'border-color:'.$params['circle_border_color'].';';
        }
        if($params['circle_background_color'] !== '') {
            $style['circle_background_color'] = 'background-color:'.$params['circle_background_color'].';';
            $style['line_color']              = 'background-color:'.$params['circle_background_color'].';';
        }

        return $style;
    }
}
