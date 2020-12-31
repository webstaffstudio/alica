<?php

if(!function_exists('anahata_mikado_error_404_options_map')) {

    function anahata_mikado_error_404_options_map() {

        anahata_mikado_add_admin_page(array(
            'slug'  => '__404_error_page',
            'title' => esc_html__('404 Error Page', 'anahata'),
            'icon'  => 'icon_info_alt'
        ));

        $panel_404_options = anahata_mikado_add_admin_panel(array(
            'page'  => '__404_error_page',
            'name'  => 'panel_404_options',
            'title' => esc_html__('404 Page Option', 'anahata')
        ));

        anahata_mikado_add_admin_field(array(
            'parent'        => $panel_404_options,
            'type'          => 'text',
            'name'          => '404_title',
            'default_value' => '',
            'label'         => esc_html__('Title', 'anahata'),
            'description'   => esc_html__('Enter title for 404 page', 'anahata')
        ));

        anahata_mikado_add_admin_field(array(
            'parent'        => $panel_404_options,
            'type'          => 'text',
            'name'          => '404_text',
            'default_value' => '',
            'label'         => esc_html__('Text', 'anahata'),
            'description'   => esc_html__('Enter text for 404 page', 'anahata')
        ));

        anahata_mikado_add_admin_field(array(
            'parent'        => $panel_404_options,
            'type'          => 'text',
            'name'          => '404_back_to_home',
            'default_value' => '',
            'label'         => esc_html__('Back to Home Button Label', 'anahata'),
            'description'   => esc_html__('Enter label for "Back to Home" button', 'anahata')
        ));

    }

    add_action('anahata_mikado_options_map', 'anahata_mikado_error_404_options_map', 17);

}