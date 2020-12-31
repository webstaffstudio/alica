<?php
namespace Anahata\Modules\Team;

use Anahata\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Team
 */
class Team implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'mkd_team';

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

        $team_social_icons_array = array();
        for($x = 1; $x < 6; $x++) {
            $teamIconCollections = anahata_mikado_icon_collections()->getCollectionsWithSocialIcons();
            foreach($teamIconCollections as $collection_key => $collection) {

                $team_social_icons_array[] = array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__('Social Icon ', 'mikado-core').$x,
                    'param_name' => 'team_social_'.$collection->param.'_'.$x,
                    'value'      => $collection->getSocialIconsArrayVC(),
                    'dependency' => Array('element' => 'team_social_icon_pack', 'value' => array($collection_key))
                );

            }

            $team_social_icons_array[] = array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Social Icon ', 'mikado-core').$x.esc_html__(' Link', 'mikado-core'),
                'param_name' => 'team_social_icon_'.$x.'_link',
                'dependency' => array(
                    'element' => 'team_social_icon_pack',
                    'value'   => anahata_mikado_icon_collections()->getIconCollectionsKeys()
                )
            );

            $team_social_icons_array[] = array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Social Icon ', 'mikado-core').$x.esc_html__(' Target', 'mikado-core'),
                'param_name' => 'team_social_icon_'.$x.'_target',
                'value'      => array(
                    ''                         => '',
                    esc_html__('Self', 'mikado-core')  => '_self',
                    esc_html__('Blank', 'mikado-core') => '_blank'
                ),
                'dependency' => Array('element' => 'team_social_icon_'.$x.'_link', 'not_empty' => true)
            );

        }

        vc_map(array(
            'name'                      => esc_html__('Team', 'mikado-core'),
            'base'                      => $this->base,
            'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                      => 'icon-wpb-team extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                array(
                    array(
                        'type'        => 'dropdown',
                        'admin_label' => true,
                        'heading'     => esc_html__('Type', 'mikado-core'),
                        'param_name'  => 'team_type',
                        'value'       => array(
                            esc_html__('Main Info on Hover', 'mikado-core')    => 'main-info-on-hover',
                            esc_html__('Main Info Below Image', 'mikado-core') => 'main-info-below-image'
                        ),
                        'save_always' => true
                    ),
                    array(
                        'type'       => 'attach_image',
                        'heading'    => esc_html__('Image', 'mikado-core'),
                        'param_name' => 'team_image'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__('Set Dark/Light Type', 'mikado-core'),
                        'param_name' => 'dark_light_type',
                        'value'      => array(
                            esc_html__('Dark', 'mikado-core')  => 'dark',
                            esc_html__('Light', 'mikado-core') => 'light',
                        ),
                        'dependency' => array('element' => 'team_type', 'value' => 'main-info-below-image')
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__('Add Box Shadow', 'mikado-core'),
                        'param_name' => 'boxed',
                        'value'      => array(
                            esc_html__('Yes', 'mikado-core') => 'with_box',
                            esc_html__('No', 'mikado-core')  => 'without_box',
                        ),
                        'dependency' => array('element' => 'team_type', 'value' => 'main-info-below-image')
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Name', 'mikado-core'),
                        'admin_label' => true,
                        'param_name'  => 'team_name'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__('Name Tag', 'mikado-core'),
                        'param_name' => 'team_name_tag',
                        'value'      => array(
                            ''   => '',
                            'h2' => 'h2',
                            'h3' => 'h3',
                            'h4' => 'h4',
                            'h5' => 'h5',
                            'h6' => 'h6',
                        ),
                        'dependency' => array('element' => 'team_name', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Position', 'mikado-core'),
                        'admin_label' => true,
                        'param_name'  => 'team_position'
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Background Color For Team Position', 'mikado-core'),
                        'param_name'  => 'background_color',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'team_type', 'value' => 'main-info-below-image')
                    ),
                    array(
                        'type'        => 'textarea',
                        'heading'     => esc_html__('Description', 'mikado-core'),
                        'admin_label' => true,
                        'param_name'  => 'team_description'
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Social Icon Pack', 'mikado-core'),
                        'param_name'  => 'team_social_icon_pack',
                        'admin_label' => true,
                        'value'       => array_merge(array('' => ''), anahata_mikado_icon_collections()->getIconCollectionsVCExclude('linea_icons')),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Social Icons Type', 'mikado-core'),
                        'param_name'  => 'team_social_icon_type',
                        'value'       => array(
                            esc_html__('Normal', 'mikado-core') => 'normal',
                            esc_html__('Circle', 'mikado-core') => 'circle',
                            esc_html__('Square', 'mikado-core') => 'square'
                        ),
                        'save_always' => true,
                        'dependency'  => array(
                            'element' => 'team_social_icon_pack',
                            'value'   => anahata_mikado_icon_collections()->getIconCollectionsKeys()
                        )
                    ),
                ),
                $team_social_icons_array
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
            'team_image'                      => '',
            'team_type'                       => 'main-info-on-hover',
            'team_name'                       => '',
            'team_name_tag'                   => 'h3',
            'team_position'                   => '',
            'team_description'                => '',
            'background_color'                => '',
            'team_social_icon_pack'           => '',
            'team_social_icon_type'           => 'normal_social',
            'dark_light_type'                 => '',
            'boxed'                           => 'with_box'
        );

        $team_social_icons_form_fields = array();
        $number_of_social_icons        = 5;

        for($x = 1; $x <= $number_of_social_icons; $x++) {

            foreach(anahata_mikado_icon_collections()->iconCollections as $collection_key => $collection) {
                $team_social_icons_form_fields['team_social_'.$collection->param.'_'.$x] = '';
            }

            $team_social_icons_form_fields['team_social_icon_'.$x.'_link']   = '';
            $team_social_icons_form_fields['team_social_icon_'.$x.'_target'] = '';

        }

        $args = array_merge($args, $team_social_icons_form_fields);

        $params = shortcode_atts($args, $atts);

        $counter_classes = '';

        if($params['dark_light_type'] == 'light') {
            $counter_classes .= 'light';
        }

        $params['light_class'] = $counter_classes;

        $box_classes = '';

        if($params['boxed'] === 'with_box') {
            $box_classes = ' mkd-team-boxed';
        }

        $params['box_class'] = $box_classes;

        $params['number_of_social_icons'] = 5;
        $params['team_name_tag']          = $this->getTeamNameTag($params, $args);
        $params['team_image_src']         = $this->getTeamImage($params);
        $params['team_social_icons']      = $this->getTeamSocialIcons($params);
        $params['background_styles']      = $this->getPositionStyles($params);


        //Get HTML from template based on type of team
        $html = mikado_core_get_core_shortcode_template_part('templates/'.$params['team_type'], 'team', '', $params);

        return $html;

    }

    /**
     * Return correct heading value. If provided heading isn't valid get the default one
     *
     * @param $params
     *
     * @return mixed
     */
    private function getTeamNameTag($params, $args) {

        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        return (in_array($params['team_name_tag'], $headings_array)) ? $params['team_name_tag'] : $args['team_name_tag'];

    }

    /**
     * Return Team image
     *
     * @param $params
     *
     * @return false|string
     */
    private function getTeamImage($params) {

        if(is_numeric($params['team_image'])) {
            $team_image_src = wp_get_attachment_url($params['team_image']);
        } else {
            $team_image_src = $params['team_image'];
        }

        return $team_image_src;

    }

    private function getPositionStyles($params) {
        $styles = '';

        if(!empty($params['background_color'])) {
            $styles = 'background-color: '.$params['background_color'];
        }

        return $styles;
    }

    private function getTeamSocialIcons($params) {

        extract($params);
        $social_icons = array();

        if($team_social_icon_pack !== '') {

            $icon_pack                    = anahata_mikado_icon_collections()->getIconCollection($team_social_icon_pack);
            $team_social_icon_type_label  = 'team_social_'.$icon_pack->param;
            $team_social_icon_param_label = $icon_pack->param;

            for($i = 1; $i <= $number_of_social_icons; $i++) {

                $team_social_icon   = ${$team_social_icon_type_label.'_'.$i};
                $team_social_link   = ${'team_social_icon_'.$i.'_link'};
                $team_social_target = ${'team_social_icon_'.$i.'_target'};

                if($team_social_icon !== '') {

                    $team_icon_params                                = array();
                    $team_icon_params['icon_pack']                   = $team_social_icon_pack;
                    $team_icon_params[$team_social_icon_param_label] = $team_social_icon;
                    $team_icon_params['link']                        = ($team_social_link !== '') ? $team_social_link : '';
                    $team_icon_params['target']                      = ($team_social_target !== '') ? $team_social_target : '';
                    $team_icon_params['type']                        = ($team_social_icon_type !== '') ? $team_social_icon_type : '';

                    $social_icons[] = anahata_mikado_execute_shortcode('mkd_icon', $team_icon_params);
                }

            }

        }

        return $social_icons;

    }

}