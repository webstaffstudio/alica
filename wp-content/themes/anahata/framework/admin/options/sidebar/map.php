<?php

if(!function_exists('anahata_mikado_sidebar_options_map')) {

    function anahata_mikado_sidebar_options_map() {

        $panel_widgets = anahata_mikado_add_admin_panel(
            array(
                'page'  => '_page_page',
                'name'  => 'panel_widgets',
                'title' => esc_html__('Widgets', 'anahata')
            )
        );

        /**
         * Navigation style
         */
        anahata_mikado_add_admin_field(array(
            'type'          => 'color',
            'name'          => 'sidebar_background_color',
            'default_value' => '',
            'label'         => esc_html__('Sidebar Background Color', 'anahata'),
            'description'   => esc_html__('Choose background color for sidebar', 'anahata'),
            'parent'        => $panel_widgets
        ));

        $group_sidebar_padding = anahata_mikado_add_admin_group(array(
            'name'   => 'group_sidebar_padding',
            'title'  => esc_html__('Padding', 'anahata'),
            'parent' => $panel_widgets
        ));

        $row_sidebar_padding = anahata_mikado_add_admin_row(array(
            'name'   => 'row_sidebar_padding',
            'parent' => $group_sidebar_padding
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'sidebar_padding_top',
            'default_value' => '',
            'label'         => esc_html__('Top Padding', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_sidebar_padding
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'sidebar_padding_right',
            'default_value' => '',
            'label'         => esc_html__('Right Padding', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_sidebar_padding
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'sidebar_padding_bottom',
            'default_value' => '',
            'label'         => esc_html__('Bottom Padding', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_sidebar_padding
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'sidebar_padding_left',
            'default_value' => '',
            'label'         => esc_html__('Left Padding', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_sidebar_padding
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'select',
            'name'          => 'sidebar_alignment',
            'default_value' => '',
            'label'         => esc_html__('Text Alignment', 'anahata'),
            'description'   => esc_html__('Choose text aligment', 'anahata'),
            'options'       => array(
                'left'   => esc_html__('Left', 'anahata'),
                'center' => esc_html__('Center', 'anahata'),
                'right'  => esc_html__('Right', 'anahata')
            ),
            'parent'        => $panel_widgets
        ));

    }

    add_action('anahata_mikado_options_map', 'anahata_mikado_sidebar_options_map');

}