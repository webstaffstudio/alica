<?php
namespace Anahata\Modules\PieCharts\PieChartWithIcon;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

class PieChartWithIcon implements ShortcodeInterface {

    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'mkd_pie_chart_with_icon';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * @see mkd_core_get_carousel_slider_array_vc()
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Pie Chart With Icon', 'mikado-core'),
            'base'                      => $this->getBase(),
            'icon'                      => 'icon-wpb-pie-chart-with-icon extended-custom-icon',
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Percentage', 'mikado-core'),
                        'param_name'  => 'percent',
                        'description' => '',
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Size(px)', 'mikado-core'),
                        'param_name'  => 'size',
                        'description' => '',
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options', 'mikado-core'),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Active Color', 'mikado-core'),
                        'param_name'  => 'active_color',
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options', 'mikado-core'),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Inactive Color', 'mikado-core'),
                        'param_name'  => 'inactive_color',
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options', 'mikado-core'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Margin below chart (px)', 'mikado-core'),
                        'param_name'  => 'margin_below_chart',
                        'description' => '',
                        'group'       => esc_html__('Design Options', 'mikado-core'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Title', 'mikado-core'),
                        'param_name'  => 'title',
                        'description' => '',
                        'admin_label' => true
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__('Title Tag', 'mikado-core'),
                        'param_name' => 'title_tag',
                        'value'      => array(
                            ''   => '',
                            'h2' => 'h2',
                            'h3' => 'h3',
                            'h4' => 'h4',
                            'h5' => 'h5',
                            'h6' => 'h6',
                        ),
                        'dependency' => array('element' => 'title', 'not_empty' => true)
                    ),
                ),
                anahata_mikado_icon_collections()->getVCParamsArray(),
                array(
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__('Icon Color', 'mikado-core'),
                        'param_name' => 'icon_color',
                        'group'       => esc_html__('Design Options', 'mikado-core'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Icon Size (px)', 'mikado-core'),
                        'param_name'  => 'icon_custom_size',
                        'dependency'  => Array(
                            'element' => 'icon_pack',
                            'value'   => anahata_mikado_icon_collections()->getIconCollectionsKeys()
                        ),
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options', 'mikado-core'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Text', 'mikado-core'),
                        'param_name'  => 'text',
                        'description' => '',
                        'admin_label' => true
                    )
                )
            )

        ));
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'size'                => '',
            'percent'             => '',
            'icon_color'          => '',
            'icon_custom_size'    => '',
            'title'               => '',
            'title_tag'           => 'h4',
            'text'                => '',
            'margin_below_chart'  => '',
            'active_color'        => '',
            'inactive_color'      => ''

        );

        $args   = array_merge($args, anahata_mikado_icon_collections()->getShortcodeParams());
        $params = shortcode_atts($args, $atts);

        $params['active_color'] = $params['active_color'] !== '' ? $params['active_color'] : anahata_mikado_get_first_main_color();

        $params['title_tag']       = $this->getValidTitleTag($params, $args);
        $params['pie_chart_data']  = $this->getPieChartData($params);
        $params['pie_chart_style'] = $this->getPieChartStyle($params);
        $params['data_attr']       = $this->getDataParams($params);
        $params['icon']            = $this->getPieChartIcon($params);

        $html = mikado_core_get_core_shortcode_template_part('templates/pie-chart-with-icon', 'piecharts/piechartwithicon', '', $params);

        return $html;

    }

    /**
     * Return correct heading value. If provided heading isn't valid get the default one
     *
     * @param $params
     * @param $args
     */
    private function getValidTitleTag($params, $args) {

        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];

    }

    /**
     * Return Pie Chart icon style for icon getPieChartIcon() method
     *
     * @param $params
     *
     * @return string
     */
    private function getIconStyles($params) {

        $iconStyles = array();

        if($params['icon_color'] !== '') {
            $iconStyles[] = 'color: '.$params['icon_color'];
        }

        if($params['icon_custom_size'] !== '') {
            $iconStyles[] = 'font-size: '.$params['icon_custom_size'].'px';
        }

        return implode(';', $iconStyles);

    }

    /**
     * Return Pie Chart style
     *
     * @param $params
     *
     * @return array
     */
    private function getPieChartStyle($params) {

        $pieChartStyle = array();

        if($params['margin_below_chart'] !== '') {
            $pieChartStyle[] = 'margin-top: '.$params['margin_below_chart'].'px';
        }

        return $pieChartStyle;

    }

    private function getDataParams($params) {

        $data_attr = array();

        if($params['active_color'] !== '') {
            $data_attr['data-bar-color'] = $params['active_color'];
        }

        if($params['inactive_color'] !== '') {
            $data_attr['data-track-color'] = $params['inactive_color'];
        }

        return $data_attr;
    }

    /**
     * Return data attributes for Pie Chart
     *
     * @param $params
     *
     * @return array
     */
    private function getPieChartData($params) {

        $pieChartData = array();

        if($params['size'] !== '') {
            $pieChartData['data-size'] = $params['size'];
        }
        if($params['percent'] !== '') {
            $pieChartData['data-percent'] = $params['percent'];
        }

        return $pieChartData;

    }

    /**
     * Return Pie Chart Icon
     *
     * @param $params
     *
     * @return mixed
     */
    private function getPieChartIcon($params) {

        $icon                                   = anahata_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
        $iconStyles                             = array();
        $iconStyles['icon_attributes']['style'] = $this->getIconStyles($params);

        $pie_chart_icon = anahata_mikado_icon_collections()->renderIcon($params[$icon], $params['icon_pack'], $iconStyles);

        return $pie_chart_icon;

    }

}