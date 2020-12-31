<?php
if(!function_exists('anahata_mikado_events_options_map')) {

    /**
     * Add Evetns options page
     */
    if(anahata_mikado_the_events_calendar_installed()) {
        function anahata_mikado_events_options_map() {

            anahata_mikado_add_admin_page(
                array(
                    'slug'  => '_events_page',
                    'title' => esc_html__('Events', 'anahata'),
                    'icon'  => 'icon_calendar'
                )
            );


            $panel_title = anahata_mikado_add_admin_panel(
                array(
                    'page'  => '_events_page',
                    'name'  => 'panel_title',
                    'title' => esc_html__('Title Settings', 'anahata')
                )
            );

            $show_events_title_area_container = anahata_mikado_add_admin_container(
                array(
                    'parent'          => $panel_title,
                    'name'            => 'show_events_title_area_container',
                    'hidden_property' => 'show_title_area',
                    'hidden_value'    => 'no'
                )
            );

            anahata_mikado_add_admin_field(
                array(
                    'name'          => 'title_events_area_type',
                    'type'          => 'select',
                    'default_value' => 'breadcrumb',
                    'label'         => esc_html__('Title Area Type', 'anahata'),
                    'description'   => esc_html__('Choose title type', 'anahata'),
                    'parent'        => $show_events_title_area_container,
                    'options'       => array(
                        'standard'   => esc_html__('Standard', 'anahata'),
                        'breadcrumb' => esc_html__('Breadcrumb', 'anahata')
                    ),
                    'args'          => array(
                        "dependence" => true,
                        "hide"       => array(
                            "standard"   => "",
                            "breadcrumb" => "#mkd_title_events_area_type_container"
                        ),
                        "show"       => array(
                            "standard"   => "#mkd_title_events_area_type_container",
                            "breadcrumb" => ""
                        )
                    )
                )
            );
            anahata_mikado_add_admin_field(
                array(
                    'name'        => 'title_events_area_background_image',
                    'type'        => 'image',
                    'label'       => esc_html__('Background Image', 'anahata'),
                    'description' => esc_html__('Choose an Image for Title Area', 'anahata'),
                    'parent'      => $show_events_title_area_container
                )
            );

            anahata_mikado_add_admin_field(
                array(
                    'name'        => 'title_events_area_background_color',
                    'type'        => 'color',
                    'label'       => esc_html__('Background Color', 'anahata'),
                    'description' => esc_html__('Choose a background color for Title Area', 'anahata'),
                    'parent'      => $show_events_title_area_container
                )
            );

            anahata_mikado_add_admin_field(array(
                'name'        => 'title_events_area_height',
                'type'        => 'text',
                'label'       => esc_html__('Height', 'anahata'),
                'description' => esc_html__('Set a height for Title Area', 'anahata'),
                'parent'      => $show_events_title_area_container,
                'args'        => array(
                    'col_width' => 2,
                    'suffix'    => 'px'
                )
            ));

            anahata_mikado_add_admin_field(
                array(
                    'name'          => 'title_events_area_content_alignment',
                    'type'          => 'select',
                    'default_value' => 'left',
                    'label'         => esc_html__('Horizontal Alignment', 'anahata'),
                    'description'   => esc_html__('Specify title horizontal alignment', 'anahata'),
                    'parent'        => $show_events_title_area_container,
                    'options'       => array(
                        'center' => esc_html__('Center', 'anahata'),
                        'left'   => esc_html__('Left', 'anahata'),
                        'right'  => esc_html__('Right', 'anahata')
                    )
                )
            );

        }

        add_action('anahata_mikado_options_map', 'anahata_mikado_events_options_map', 19);
    }
}