<?php

if(anahata_mikado_visual_composer_installed()) {
    if(!function_exists('anahata_mikado_ttsingle_hours_vc_map')) {
        function anahata_mikado_ttsingle_hours_vc_map() {
            vc_map(array(
                'name' => esc_html__( 'Timetable Event Hours', 'anahata' ),
                'base'                      => 'tt_event_hours',
                'category' => esc_html__( 'by MIKADO', 'anahata' ),
                'icon'                      => '',
                'allowed_container_element' => 'vc_row'
            ));
        }

        add_action('vc_before_init', 'anahata_mikado_ttsingle_hours_vc_map');
    }

    if(!function_exists('anahata_mikado_ttsingle_info_holder')) {
        function anahata_mikado_ttsingle_info_holder() {
            vc_map(array(
                "name"                    => esc_html__('Timetable Event Info Holder', 'anahata'),
                'base'                    => 'tt_items_list',
                'as_parent'               => array('only' => 'tt_item'),
                'content_element'         => true,
                'category' => esc_html__( 'by MIKADO', 'anahata' ),
                'icon'                    => 'extended-custom-icon',
                'show_settings_on_create' => true,
                'js_view'                 => 'VcColumnView'
            ));
        }

        add_action('vc_before_init', 'anahata_mikado_ttsingle_info_holder');
    }

    if(!function_exists('anahata_mikado_ttsingle_info_table_item')) {
        function anahata_mikado_ttsingle_info_table_item() {
            vc_map(array(
                'name'                    => esc_html__('Timetable Event Info Table Item', 'anahata'),
                'base'                    => 'tt_item',
                'as_child'                => array('only' => 'tt_items_list'),
                'category' => esc_html__( 'by MIKADO', 'anahata' ),
                'icon'                    => '',
                'show_settings_on_create' => true,
                'params'                  => array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Label', 'anahata'),
                        'param_name'  => 'content',
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Value', 'anahata'),
                        'param_name'  => 'value',
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Type', 'anahata'),
                        'param_name'  => 'type',
                        'admin_label' => true,
                        'value'       => array(
                            'Table' => 'info'
                        ),
                        'save_always' => true
                    ),
                )
            ));
        }

        add_action('vc_before_init', 'anahata_mikado_ttsingle_info_table_item');
    }

    class WPBakeryShortCode_Tt_Items_List extends WPBakeryShortCodesContainer {
    }
}

