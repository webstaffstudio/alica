<?php

if(!function_exists('anahata_mikado_footer_options_map')) {
    /**
     * Add footer options
     */
    function anahata_mikado_footer_options_map() {

        anahata_mikado_add_admin_page(
            array(
                'slug'  => '_footer_page',
                'title' => esc_html__('Footer', 'anahata'),
                'icon'  => 'icon_cone_alt'
            )
        );

        $footer_panel = anahata_mikado_add_admin_panel(
            array(
                'title' => esc_html__('Footer', 'anahata'),
                'name'  => 'footer',
                'page'  => '_footer_page'
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer_behavior',
                'default_value' => 'yes',
                'label'         => esc_html__('Uncovering Footer', 'anahata'),
                'description'   => esc_html__('Enabling this option will make Footer gradually appear on scroll', 'anahata'),
                'parent'        => $footer_panel,
            )
        );
        anahata_mikado_add_admin_field(
            array(
                'parent'        => $footer_panel,
                'type'          => 'select',
                'name'          => 'footer_style',
                'default_value' => '',
                'label'         => esc_html__('Footer Skin', 'anahata'),
                'description'   => esc_html__('Choose Footer Skin for Footer Area', 'anahata'),
                'options'       => array(
                    ''             => '',
                    'dark-footer'  => esc_html__('Dark', 'anahata'),
                    'light-footer' => esc_html__('Light', 'anahata')
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'        => 'footer_background_image',
                'type'        => 'image',
                'label'       => esc_html__('Background Image', 'anahata'),
                'description' => esc_html__('Choose Background Image for Footer Area', 'anahata'),
                'parent'      => $footer_panel
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'footer_in_grid',
                'default_value' => 'yes',
                'label'         => esc_html__('Footer in Grid', 'anahata'),
                'description'   => esc_html__('Enabling this option will place Footer content in grid', 'anahata'),
                'parent'        => $footer_panel,
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'show_footer_top',
                'default_value' => 'yes',
                'label'         => esc_html__('Show Footer Top', 'anahata'),
                'description'   => esc_html__('Enabling this option will show Footer Top area', 'anahata'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_show_footer_top_container'
                ),
                'parent'        => $footer_panel,
            )
        );

        $show_footer_top_container = anahata_mikado_add_admin_container(
            array(
                'name'            => 'show_footer_top_container',
                'hidden_property' => 'show_footer_top',
                'hidden_value'    => 'no',
                'parent'          => $footer_panel
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_top_columns',
                'default_value' => '4',
                'label'         => esc_html__('Footer Top Columns', 'anahata'),
                'description'   => esc_html__('Choose number of columns for Footer Top area', 'anahata'),
                'options'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '5' => '3(25%+25%+50%)',
                    '6' => '3(50%+25%+25%)',
                    '4' => '4'
                ),
                'parent'        => $show_footer_top_container,
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_top_columns_alignment',
                'default_value' => '',
                'label'         => esc_html__('Footer Top Columns Alignment', 'anahata'),
                'description'   => esc_html__('Text Alignment in Footer Columns', 'anahata'),
                'options'       => array(
                    'left'   => esc_html__('Left', 'anahata'),
                    'center' => esc_html__('Center', 'anahata'),
                    'right'  => esc_html__('Right', 'anahata')
                ),
                'parent'        => $show_footer_top_container,
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'show_footer_bottom',
                'default_value' => 'yes',
                'label'         => esc_html__('Show Footer Bottom', 'anahata'),
                'description'   => esc_html__('Enabling this option will show Footer Bottom area', 'anahata'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_show_footer_bottom_container'
                ),
                'parent'        => $footer_panel,
            )
        );

        $show_footer_bottom_container = anahata_mikado_add_admin_container(
            array(
                'name'            => 'show_footer_bottom_container',
                'hidden_property' => 'show_footer_bottom',
                'hidden_value'    => 'no',
                'parent'          => $footer_panel
            )
        );


        anahata_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_bottom_columns',
                'default_value' => '3',
                'label'         => esc_html__('Footer Bottom Columns', 'anahata'),
                'description'   => esc_html__('Choose number of columns for Footer Bottom area', 'anahata'),
                'options'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3'
                ),
                'parent'        => $show_footer_bottom_container,
            )
        );

    }

    add_action('anahata_mikado_options_map', 'anahata_mikado_footer_options_map');

}