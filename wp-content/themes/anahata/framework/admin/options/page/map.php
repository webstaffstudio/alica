<?php

if(!function_exists('anahata_mikado_page_options_map')) {

    function anahata_mikado_page_options_map() {

        anahata_mikado_add_admin_page(
            array(
                'slug'  => '_page_page',
                'title' => esc_html__('Page', 'anahata'),
                'icon'  => 'icon_document_alt'
            )
        );

        $custom_sidebars = anahata_mikado_get_custom_sidebars();

        $panel_sidebar = anahata_mikado_add_admin_panel(
            array(
                'page'  => '_page_page',
                'name'  => 'panel_sidebar',
                'title' => esc_html__('Design Style', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(array(
            'name'          => 'page_sidebar_layout',
            'type'          => 'select',
            'label'         => esc_html__('Sidebar Layout', 'anahata'),
            'description'   => esc_html__('Choose a sidebar layout for pages', 'anahata'),
            'default_value' => 'default',
            'parent'        => $panel_sidebar,
            'options'       => array(
                'default'          => esc_html__('No Sidebar', 'anahata'),
                'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'anahata'),
                'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'anahata'),
                'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'anahata'),
                'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'anahata')
            )
        ));


        if(count($custom_sidebars) > 0) {
            anahata_mikado_add_admin_field(array(
                'name'        => 'page_custom_sidebar',
                'type'        => 'selectblank',
                'label'       => esc_html__('Sidebar to Display', 'anahata'),
                'description' => esc_html__('Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'anahata'),
                'parent'      => $panel_sidebar,
                'options'     => $custom_sidebars
            ));
        }

        anahata_mikado_add_admin_field(array(
            'name'          => 'page_show_likes',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Likes', 'anahata'),
            'description'   => esc_html__('Enabling this option will show likes on your page', 'anahata'),
            'default_value' => 'no',
            'parent'        => $panel_sidebar
        ));

        anahata_mikado_add_admin_field(array(
            'name'          => 'page_show_comments',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Comments', 'anahata'),
            'description'   => esc_html__('Enabling this option will show comments on your page', 'anahata'),
            'default_value' => 'yes',
            'parent'        => $panel_sidebar
        ));

    }

    add_action('anahata_mikado_options_map', 'anahata_mikado_page_options_map', 9);

}