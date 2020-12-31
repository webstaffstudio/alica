<?php

$header_meta_box = anahata_mikado_create_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post', 'tribe_events', 'tt-events', 'events'),
        'title' => esc_html__('Header', 'anahata'),
        'name'  => 'header_meta'
    )
);

$temp_holder_show             = '';
$temp_holder_hide             = '';
$temp_array_standard          = array();
$temp_array_standard_extended = array();
$temp_array_box               = array();
$temp_array_divided           = array();
$temp_array_minimal           = array();
$temp_array_centered          = array();
$temp_array_vertical          = array();
$temp_array_top_header        = array();
$temp_array_behaviour         = array();
switch(anahata_mikado_options()->getOptionValue('header_type')) {

    case 'header-standard':
        $temp_holder_show = '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_behaviour_meta';
        $temp_holder_hide = '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container';

        $temp_array_standard = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-boxed'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_divided = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_centered = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_vertical = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value' => 'header-vertical'
        );
        break;

    case 'header-standard-extended':
        $temp_holder_show = '#mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_behaviour_meta';
        $temp_holder_hide = '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_box_type_meta_container';

        $temp_array_standard = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-boxed'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_divided = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_centered = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_vertical = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value' => 'header-vertical'
        );
        break;

    case 'header-box':
        $temp_holder_show = '#mkd_mkd_header_box_type_meta_container, #mkd_mkd_header_behaviour_meta';
        $temp_holder_hide = '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container';

        $temp_array_standard = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-box'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-box'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-box'
            )
        );

        $temp_array_divided = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-box'
            )
        );

        $temp_array_centered = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-box'
            )
        );

        $temp_array_vertical = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-box'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value' => 'header-vertical'
        );
        break;


    case 'header-minimal':
        $temp_holder_show = '#mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_behaviour_meta';
        $temp_holder_hide = '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container';

        $temp_array_standard = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-boxed'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-standard',
                'header-vertical',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_divided = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_centered = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_vertical = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value' => 'header-vertical'
        );
        break;

    case 'header-divided':
        $temp_holder_show = '#mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_behaviour_meta';
        $temp_holder_hide = '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container';

        $temp_array_standard = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-boxed'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_divided = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_centered = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-boxed'
            )
        );


        $temp_array_vertical = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value' => 'header-vertical'
        );
        break;

    case 'header-centered':
        $temp_holder_show = '#mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_behaviour_meta';
        $temp_holder_hide = '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container';

        $temp_array_standard = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-boxed'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_divided = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_centered = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_vertical = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value' => 'header-vertical'
        );
        break;

    case 'header-vertical':
        $temp_holder_show = '#mkd_mkd_header_vertical_type_meta_container';
        $temp_holder_hide = '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_behaviour_meta, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container';

        $temp_array_standard = array(
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_standard_extended = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-boxed'
            )
        );

        $temp_array_box = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                '',
                'header-standard',
                'header-vertical',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended'
            )
        );

        $temp_array_minimal = array(
            'hidden_values' => array(
                '',
                'header-vertical',
                'header-standard',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_divided = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_centered = array(
            'hidden_values' => array(
                '',
                'header-standard',
                'header-minimal',
                'header-vertical',
                'header-divided',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_vertical = array(
            'hidden_value'  => 'default',
            'hidden_values' => array(
                'header-standard',
                'header-minimal',
                'header-divided',
                'header-centered',
                'header-standard-extended',
                'header-boxed'
            )
        );

        $temp_array_behaviour = array(
            'hidden_values' => array('', 'header-vertical')
        );

        $temp_array_top_header = array(
            'hidden_value'  => 'default',
            'hidden_values' => array('', 'header-vertical')
        );
        break;
}

anahata_mikado_create_meta_box_field(
    array(
        'parent'        => $header_meta_box,
        'type'          => 'select',
        'name'          => 'mkd_enable_wide_menu_background_meta',
        'default_value' => '',
        'label'         => esc_html__('Enable Full Width Background for Wide Dropdown Type', 'anahata'),
        'description'   => esc_html__('Enabling this option will show full width background  for wide dropdown type', 'anahata'),
        'options'       => array(
            ''    => '',
            'no'  => esc_html__('No', 'anahata'),
            'yes' => esc_html__('Yes', 'anahata')
        )
    )
);


anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_header_type_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Choose Header Type', 'anahata'),
        'description'   => esc_html__('Select header type layout', 'anahata'),
        'parent'        => $header_meta_box,
        'options'       => array(
            ''                         => 'Default',
            'header-standard'          => esc_html__('Standard Header', 'anahata'),
            'header-standard-extended' => esc_html__('Standard Extended Header', 'anahata'),
            'header-box'               => esc_html__('"In The Box" Header', 'anahata'),
            'header-minimal'           => esc_html__('Minimal Header', 'anahata'),
            'header-divided'           => esc_html__('Divided Header', 'anahata'),
            'header-centered'          => esc_html__('Centered Header', 'anahata'),
            'header-vertical'          => esc_html__('Vertical Header', 'anahata')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                ""                         => $temp_holder_hide,
                'header-standard'          => '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container',
                'header-standard-extended' => '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_box_type_meta_container',
                'header-box'               => '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_standard_type_meta_container',
                'header-minimal'           => '#mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container',
                'header-divided'           => '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container',
                'header-centered'          => '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_vertical_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container',
                'header-vertical'          => '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta, #mkd_mkd_header_divided_type_meta_container, #mkd_mkd_header_centered_type_meta_container, #mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_header_box_type_meta_container'
            ),
            "show"       => array(
                ""                         => $temp_holder_show,
                "header-standard"          => '#mkd_mkd_header_standard_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta',
                "header-standard-extended" => '#mkd_mkd_header_standard_extended_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta',
                "header-box"               => '#mkd_mkd_header_box_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta',
                "header-minimal"           => '#mkd_mkd_header_minimal_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta',
                'header-divided'           => '#mkd_mkd_header_divided_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta',
                'header-centered'          => '#mkd_mkd_header_centered_type_meta_container, #mkd_mkd_top_bar_container_meta_container, #mkd_mkd_header_behaviour_meta',
                "header-vertical"          => '#mkd_mkd_header_vertical_type_meta_container'
            )
        )
    )
);

anahata_mikado_create_meta_box_field(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'type'            => 'select',
            'name'            => 'mkd_header_behaviour_meta',
            'default_value'   => '',
            'label'           => esc_html__('Choose Header behaviour', 'anahata'),
            'description'     => esc_html__('Select the behaviour of header when you scroll down to page', 'anahata'),
            'options'         => array(
                ''                                => '',
                'no-behavior'                     => esc_html__('No Behavior', 'anahata'),
                'sticky-header-on-scroll-up'      => esc_html__('Sticky on scrol up', 'anahata'),
                'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scrol up/down', 'anahata'),
                'fixed-on-scroll'                 => esc_html__('Fixed on scroll', 'anahata')
            ),
            'hidden_property' => 'mkd_header_type_meta',
            'hidden_value'    => '',
            'args'            => array(
                'dependence' => true,
                'show'       => array(
                    ''                                => '',
                    'sticky-header-on-scroll-up'      => '',
                    'sticky-header-on-scroll-down-up' => '#mkd_mkd_sticky_amount_container_meta_container',
                    'no-behavior'                     => ''
                ),
                'hide'       => array(
                    ''                                => '#mkd_mkd_sticky_amount_container_meta_container',
                    'sticky-header-on-scroll-up'      => '#mkd_mkd_sticky_amount_container_meta_container',
                    'sticky-header-on-scroll-down-up' => '',
                    'no-behavior'                     => '#mkd_mkd_sticky_amount_container_meta_container'
                )
            )
        ),
        $temp_array_behaviour
    )
);

$sticky_amount_container = anahata_mikado_add_admin_container(
    array(
        'parent'          => $header_meta_box,
        'name'            => 'mkd_sticky_amount_container_meta_container',
        'hidden_property' => 'mkd_header_behaviour_meta',
        'hidden_value'    => '',
        'hidden_values'   => array('', 'no-behavior', 'sticky-header-on-scroll-up'),
    )
);

$sticky_amount_group = anahata_mikado_add_admin_group(array(
    'name'        => 'sticky_amount_group',
    'title'       => esc_html__('Scroll Amount for Sticky Header Appearance', 'anahata'),
    'parent'      => $sticky_amount_container,
    'description' => esc_html__('Enter the amount of pixels for sticky header appearance, or set browser height to "Yes" for predefined sticky header appearance amount', 'anahata')
));

$sticky_amount_row = anahata_mikado_add_admin_row(array(
    'name'   => 'sticky_amount_group',
    'parent' => $sticky_amount_group
));

anahata_mikado_create_meta_box_field(
    array(
        'name'   => 'mkd_scroll_amount_for_sticky_meta',
        'type'   => 'textsimple',
        'label'  => esc_html__('Amount in px', 'anahata'),
        'parent' => $sticky_amount_row,
        'args'   => array(
            'suffix' => 'px'
        )
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_scroll_amount_for_sticky_fullscreen_meta',
        'type'          => 'yesnosimple',
        'label'         => esc_html__('Browser Height', 'anahata'),
        'default_value' => 'no',
        'parent'        => $sticky_amount_row
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_header_style_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Header Skin', 'anahata'),
        'description'   => esc_html__('Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'anahata'),
        'parent'        => $header_meta_box,
        'options'       => array(
            ''             => '',
            'light-header' => esc_html__('Light', 'anahata'),
            'dark-header'  => esc_html__('Dark', 'anahata')
        )
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'parent'        => $header_meta_box,
        'type'          => 'select',
        'name'          => 'mkd_enable_header_style_on_scroll_meta',
        'default_value' => '',
        'label'         => esc_html__('Enable Header Style on Scroll', 'anahata'),
        'description'   => esc_html__('Enabling this option, header will change style depending on row settings for dark/light style', 'anahata'),
        'options'       => array(
            ''    => '',
            'no'  => esc_html__('No', 'anahata'),
            'yes' => esc_html__('Yes', 'anahata')
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_sticky_header_in_grid_meta',
    'type'          => 'select',
    'label'         => esc_html__('Sticky Header In Grid', 'anahata'),
    'description'   => esc_html__('Set sticky header content to be in grid', 'anahata'),
    'parent'        => $header_meta_box,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'anahata'),
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
));

$header_standard_type_meta_container = anahata_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_standard_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_standard
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_header_standard_meta',
    'type'          => 'select',
    'label'         => esc_html__('Header In Grid', 'anahata'),
    'description'   => esc_html__('Set header content to be in grid', 'anahata'),
    'parent'        => $header_standard_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'anahata'),
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_header_standard_container',
            'no'  => '#mkd_menu_area_in_grid_header_standard_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_header_standard_container'
        )
    )
));

$menu_area_in_grid_header_standard_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_header_standard_container',
    'parent'          => $header_standard_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_header_standard_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_color_header_standard_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'anahata'),
        'description' => esc_html__('Set grid background color for header area', 'anahata'),
        'parent'      => $menu_area_in_grid_header_standard_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_transparency_header_standard_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'anahata'),
        'description' => esc_html__('Set grid background transparency for header (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $menu_area_in_grid_header_standard_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_border_header_standard_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'anahata'),
    'description'   => esc_html__('Set border on grid area', 'anahata'),
    'parent'        => $menu_area_in_grid_header_standard_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_border_header_standard_container',
            'no'  => '#mkd_menu_area_in_grid_border_header_standard_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_border_header_standard_container'
        )
    )
));

$menu_area_in_grid_border_header_standard_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_border_header_standard_container',
    'parent'          => $header_standard_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_border_header_standard_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_menu_area_in_grid_border_color_header_standard_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Set border color for grid area', 'anahata'),
    'parent'      => $menu_area_in_grid_border_header_standard_container
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_color_header_standard_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'anahata'),
        'description' => esc_html__('Choose a background color for header area', 'anahata'),
        'parent'      => $header_standard_type_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_transparency_header_standard_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'anahata'),
        'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $header_standard_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_border_header_standard_meta',
    'type'          => 'select',
    'label'         => esc_html__('Header Area Border', 'anahata'),
    'description'   => esc_html__('Set border on header area', 'anahata'),
    'parent'        => $header_standard_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_border_bottom_color_container',
            'no'  => '#mkd_border_bottom_color_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_border_bottom_color_container'
        )
    )
));

$border_bottom_color_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'border_bottom_color_container',
    'parent'          => $header_standard_type_meta_container,
    'hidden_property' => 'mkd_menu_area_border_header_standard_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_menu_area_border_color_header_standard_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Choose color of header bottom border', 'anahata'),
    'parent'      => $border_bottom_color_container
));


$header_minimal_type_meta_container = anahata_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_minimal_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_minimal
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_header_minimal_meta',
    'type'          => 'select',
    'label'         => esc_html__('Header In Grid', 'anahata'),
    'description'   => esc_html__('Set header content to be in grid', 'anahata'),
    'parent'        => $header_minimal_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'anahata'),
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_header_minimal_container',
            'no'  => '#mkd_menu_area_in_grid_header_minimal_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_header_minimal_container'
        )
    )
));

$menu_area_in_grid_header_minimal_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_header_minimal_container',
    'parent'          => $header_minimal_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_header_minimal_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_color_header_minimal_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'anahata'),
        'description' => esc_html__('Set grid background color for header area', 'anahata'),
        'parent'      => $menu_area_in_grid_header_minimal_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_transparency_header_minimal_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'anahata'),
        'description' => esc_html__('Set grid background transparency for header (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $menu_area_in_grid_header_minimal_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_border_header_minimal_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'anahata'),
    'description'   => esc_html__('Set border on grid area', 'anahata'),
    'parent'        => $menu_area_in_grid_header_minimal_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_border_header_minimal_container',
            'no'  => '#mkd_menu_area_in_grid_border_header_minimal_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_border_header_minimal_container'
        )
    )
));

$menu_area_in_grid_border_header_minimal_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_border_header_minimal_container',
    'parent'          => $header_minimal_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_border_header_minimal_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_menu_area_in_grid_border_color_header_minimal_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Set border color for grid area', 'anahata'),
    'parent'      => $menu_area_in_grid_border_header_minimal_container
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_color_header_minimal_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'anahata'),
        'description' => esc_html__('Choose a background color for header area', 'anahata'),
        'parent'      => $header_minimal_type_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_transparency_header_minimal_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'anahata'),
        'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $header_minimal_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_border_header_minimal_meta',
    'type'          => 'select',
    'label'         => esc_html__('Header Area Border', 'anahata'),
    'description'   => esc_html__('Set border on header area', 'anahata'),
    'parent'        => $header_minimal_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_border_bottom_color_container',
            'no'  => '#mkd_border_bottom_color_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_border_bottom_color_container'
        )
    )
));

$border_bottom_color_minimal_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'border_bottom_color_container',
    'parent'          => $header_minimal_type_meta_container,
    'hidden_property' => 'mkd_menu_area_border_header_minimal_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_menu_area_border_color_header_minimal_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Choose color of header bottom border', 'anahata'),
    'parent'      => $border_bottom_color_minimal_container
));

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_fullscreen_menu_background_image_meta',
        'type'          => 'image',
        'default_value' => '',
        'label'         => esc_html__('Fullscreen Background Image', 'anahata'),
        'description'   => esc_html__('Set background image for Fullscreen Menu', 'anahata'),
        'parent'        => $header_minimal_type_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_disable_fullscreen_menu_background_image_meta',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Disable Fullscreen Background Image', 'anahata'),
        'description'   => esc_html__('Enabling this option will hide background image in Fullscreen Menu', 'anahata'),
        'parent'        => $header_minimal_type_meta_container
    )
);

$header_divided_type_meta_container = anahata_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_divided_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_divided
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_header_divided_meta',
    'type'          => 'select',
    'label'         => esc_html__('Header In Grid', 'anahata'),
    'description'   => esc_html__('Set header content to be in grid', 'anahata'),
    'parent'        => $header_divided_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'anahata'),
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_header_divided_container',
            'no'  => '#mkd_menu_area_in_grid_header_divided_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_header_divided_container'
        )
    )
));

$menu_area_in_grid_header_divided_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_header_divided_container',
    'parent'          => $header_divided_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_header_divided_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_color_header_divided_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'anahata'),
        'description' => esc_html__('Set grid background color for header area', 'anahata'),
        'parent'      => $menu_area_in_grid_header_divided_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_transparency_header_divided_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'anahata'),
        'description' => esc_html__('Set grid background transparency for header (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $menu_area_in_grid_header_divided_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_border_header_divided_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'anahata'),
    'description'   => esc_html__('Set border on grid area', 'anahata'),
    'parent'        => $menu_area_in_grid_header_divided_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_border_header_divided_container',
            'no'  => '#mkd_menu_area_in_grid_border_header_divided_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_border_header_divided_container'
        )
    )
));

$menu_area_in_grid_border_header_divided_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_border_header_divided_container',
    'parent'          => $header_divided_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_border_header_divided_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_menu_area_in_grid_border_color_header_divided_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Set border color for grid area', 'anahata'),
    'parent'      => $menu_area_in_grid_border_header_divided_container
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_color_header_divided_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'anahata'),
        'description' => esc_html__('Choose a background color for header area', 'anahata'),
        'parent'      => $header_divided_type_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_transparency_header_divided_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'anahata'),
        'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $header_divided_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_border_header_divided_meta',
    'type'          => 'select',
    'label'         => esc_html__('Header Area Border', 'anahata'),
    'description'   => esc_html__('Set border on header area', 'anahata'),
    'parent'        => $header_divided_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_border_bottom_color_container',
            'no'  => '#mkd_border_bottom_color_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_border_bottom_color_container'
        )
    )
));

$border_bottom_color_divided_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'border_bottom_color_container',
    'parent'          => $header_divided_type_meta_container,
    'hidden_property' => 'mkd_menu_area_border_header_divided_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_menu_area_border_color_header_divided_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Choose color of header bottom border', 'anahata'),
    'parent'      => $border_bottom_color_divided_container
));


$header_centered_type_meta_container = anahata_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_centered_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_centered
    )
);

anahata_mikado_add_admin_section_title(array(
    'name'   => 'logo_area_centered_title',
    'parent' => $header_centered_type_meta_container,
    'title'  => esc_html__('Logo Area', 'anahata')
));

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_logo_area_in_grid_header_centered_meta',
    'type'          => 'select',
    'label'         => esc_html__('Logo Area In Grid', 'anahata'),
    'description'   => esc_html__('Set logo area content to be in grid', 'anahata'),
    'parent'        => $header_centered_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'anahata'),
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_logo_area_in_grid_header_centered_container',
            'no'  => '#mkd_logo_area_in_grid_header_centered_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_logo_area_in_grid_header_centered_container'
        )
    )
));

$logo_area_in_grid_header_centered_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'logo_area_in_grid_header_centered_container',
    'parent'          => $header_centered_type_meta_container,
    'hidden_property' => 'mkd_logo_area_in_grid_header_centered_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_grid_background_color_header_centered_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'anahata'),
        'description' => esc_html__('Set grid background color for logo area', 'anahata'),
        'parent'      => $logo_area_in_grid_header_centered_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_grid_background_transparency_header_centered_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'anahata'),
        'description' => esc_html__('Set grid background transparency for logo area (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $logo_area_in_grid_header_centered_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_logo_area_in_grid_border_header_centered_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'anahata'),
    'description'   => esc_html__('Set border on grid area', 'anahata'),
    'parent'        => $logo_area_in_grid_header_centered_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_logo_area_in_grid_border_header_centered_container',
            'no'  => '#mkd_logo_area_in_grid_border_header_centered_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_logo_area_in_grid_border_header_centered_container'
        )
    )
));

$logo_area_in_grid_border_header_centered_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'logo_area_in_grid_border_header_centered_container',
    'parent'          => $logo_area_in_grid_header_centered_container,
    'hidden_property' => 'mkd_logo_area_in_grid_border_header_centered_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_logo_area_in_grid_border_color_header_centered_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Set border color for grid area', 'anahata'),
    'parent'      => $logo_area_in_grid_border_header_centered_container
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_background_color_header_centered_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'anahata'),
        'description' => esc_html__('Choose a background color for logo area', 'anahata'),
        'parent'      => $header_centered_type_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_background_transparency_header_centered_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'anahata'),
        'description' => esc_html__('Choose a transparency for the logo area background color (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $header_centered_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_logo_area_border_header_centered_meta',
    'type'          => 'select',
    'label'         => esc_html__('Logo Area Border', 'anahata'),
    'description'   => esc_html__('Set border on logo area', 'anahata'),
    'parent'        => $header_centered_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_logo_border_bottom_color_container',
            'no'  => '#mkd_logo_border_bottom_color_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_logo_border_bottom_color_container'
        )
    )
));

$border_bottom_color_centered_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'logo_border_bottom_color_container',
    'parent'          => $header_centered_type_meta_container,
    'hidden_property' => 'mkd_logo_area_border_header_centered_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_logo_area_border_color_header_centered_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Choose color of logo area bottom border', 'anahata'),
    'parent'      => $border_bottom_color_centered_container
));

anahata_mikado_add_admin_section_title(array(
    'name'   => 'menu_area_centered_title',
    'parent' => $header_centered_type_meta_container,
    'title'  => esc_html__('Menu Area', 'anahata')
));

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_header_centered_meta',
    'type'          => 'select',
    'label'         => esc_html__('Menu Area In Grid', 'anahata'),
    'description'   => esc_html__('Set menu area content to be in grid', 'anahata'),
    'parent'        => $header_centered_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'anahata'),
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_header_centered_container',
            'no'  => '#mkd_menu_area_in_grid_header_centered_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_header_centered_container'
        )
    )
));

$menu_area_in_grid_header_centered_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_header_centered_container',
    'parent'          => $header_centered_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_header_centered_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_color_header_centered_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'anahata'),
        'description' => esc_html__('Set grid background color for menu area', 'anahata'),
        'parent'      => $menu_area_in_grid_header_centered_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_transparency_header_centered_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'anahata'),
        'description' => esc_html__('Set grid background transparency for menu area (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $menu_area_in_grid_header_centered_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_border_header_centered_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'anahata'),
    'description'   => esc_html__('Set border on grid area', 'anahata'),
    'parent'        => $menu_area_in_grid_header_centered_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_border_header_centered_container',
            'no'  => '#mkd_menu_area_in_grid_border_header_centered_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_border_header_centered_container'
        )
    )
));

$menu_area_in_grid_border_header_centered_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_border_header_centered_container',
    'parent'          => $menu_area_in_grid_header_centered_container,
    'hidden_property' => 'mkd_menu_area_in_grid_border_header_centered_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_menu_area_in_grid_border_color_header_centered_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Set border color for grid area', 'anahata'),
    'parent'      => $menu_area_in_grid_border_header_centered_container
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_color_header_centered_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'anahata'),
        'description' => esc_html__('Choose a background color for menu area', 'anahata'),
        'parent'      => $header_centered_type_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_transparency_header_centered_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'anahata'),
        'description' => esc_html__('Choose a transparency for the menu area background color (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $header_centered_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_border_header_centered_meta',
    'type'          => 'select',
    'label'         => esc_html__('Menu Area Border', 'anahata'),
    'description'   => esc_html__('Set border on menu area', 'anahata'),
    'parent'        => $header_centered_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_border_bottom_color_container',
            'no'  => '#mkd_menu_border_bottom_color_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_border_bottom_color_container'
        )
    )
));

$border_bottom_color_centered_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_border_bottom_color_container',
    'parent'          => $header_centered_type_meta_container,
    'hidden_property' => 'mkd_menu_area_border_header_centered_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_menu_area_border_color_header_centered_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Choose color of menu area bottom border', 'anahata'),
    'parent'      => $border_bottom_color_centered_container
));


$header_standard_extended_type_meta_container = anahata_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_standard_extended_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_standard_extended
    )
);

anahata_mikado_add_admin_section_title(array(
    'name'   => 'logo_area_standard_extended_title',
    'parent' => $header_standard_extended_type_meta_container,
    'title'  => esc_html__('Logo Area', 'anahata')
));

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_logo_area_in_grid_header_standard_extended_meta',
    'type'          => 'select',
    'label'         => esc_html__('Logo Area In Grid', 'anahata'),
    'description'   => esc_html__('Set logo area content to be in grid', 'anahata'),
    'parent'        => $header_standard_extended_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'anahata'),
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_logo_area_in_grid_header_standard_extended_container',
            'no'  => '#mkd_logo_area_in_grid_header_standard_extended_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_logo_area_in_grid_header_standard_extended_container'
        )
    )
));

$logo_area_in_grid_header_standard_extended_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'logo_area_in_grid_header_standard_extended_container',
    'parent'          => $header_standard_extended_type_meta_container,
    'hidden_property' => 'mkd_logo_area_in_grid_header_standard_extended_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_grid_background_color_header_standard_extended_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'anahata'),
        'description' => esc_html__('Set grid background color for logo area', 'anahata'),
        'parent'      => $logo_area_in_grid_header_standard_extended_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_grid_background_transparency_header_standard_extended_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'anahata'),
        'description' => esc_html__('Set grid background transparency for logo area (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $logo_area_in_grid_header_standard_extended_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_logo_area_in_grid_border_header_standard_extended_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'anahata'),
    'description'   => esc_html__('Set border on grid area', 'anahata'),
    'parent'        => $logo_area_in_grid_header_standard_extended_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_logo_area_in_grid_border_header_standard_extended_container',
            'no'  => '#mkd_logo_area_in_grid_border_header_standard_extended_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_logo_area_in_grid_border_header_standard_extended_container'
        )
    )
));

$logo_area_in_grid_border_header_standard_extended_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'logo_area_in_grid_border_header_standard_extended_container',
    'parent'          => $logo_area_in_grid_header_standard_extended_container,
    'hidden_property' => 'mkd_logo_area_in_grid_border_header_standard_extended_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_logo_area_in_grid_border_color_header_standard_extended_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Set border color for grid area', 'anahata'),
    'parent'      => $logo_area_in_grid_border_header_standard_extended_container
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_background_color_header_standard_extended_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'anahata'),
        'description' => esc_html__('Choose a background color for logo area', 'anahata'),
        'parent'      => $header_standard_extended_type_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_logo_area_background_transparency_header_standard_extended_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'anahata'),
        'description' => esc_html__('Choose a transparency for the logo area background color (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $header_standard_extended_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_logo_area_border_header_standard_extended_meta',
    'type'          => 'select',
    'label'         => esc_html__('Logo Area Border', 'anahata'),
    'description'   => esc_html__('Set border on logo area', 'anahata'),
    'parent'        => $header_standard_extended_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_logo_border_bottom_color_standard_extended_container',
            'no'  => '#mkd_logo_border_bottom_color_standard_extended_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_logo_border_bottom_color_standard_extended_container'
        )
    )
));

$border_bottom_color_standard_extended_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'logo_border_bottom_color_standard_extended_container',
    'parent'          => $header_standard_extended_type_meta_container,
    'hidden_property' => 'mkd_logo_area_border_header_standard_extended_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_logo_area_border_color_header_standard_extended_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Choose color of logo area bottom border', 'anahata'),
    'parent'      => $border_bottom_color_standard_extended_container
));

anahata_mikado_add_admin_section_title(array(
    'name'   => 'menu_area_standard_extended_title',
    'parent' => $header_standard_extended_type_meta_container,
    'title'  => esc_html__('Menu Area', 'anahata')
));

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_header_standard_extended_meta',
    'type'          => 'select',
    'label'         => esc_html__('Menu Area In Grid', 'anahata'),
    'description'   => esc_html__('Set menu area content to be in grid', 'anahata'),
    'parent'        => $header_standard_extended_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'anahata'),
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_header_standard_extended_container',
            'no'  => '#mkd_menu_area_in_grid_header_standard_extended_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_header_standard_extended_container'
        )
    )
));

$menu_area_in_grid_header_standard_extended_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_header_standard_extended_container',
    'parent'          => $header_standard_extended_type_meta_container,
    'hidden_property' => 'mkd_menu_area_in_grid_header_standard_extended_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_color_header_standard_extended_meta',
        'type'        => 'color',
        'label'       => esc_html__('Grid Background Color', 'anahata'),
        'description' => esc_html__('Set grid background color for menu area', 'anahata'),
        'parent'      => $menu_area_in_grid_header_standard_extended_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_transparency_header_standard_extended_meta',
        'type'        => 'text',
        'label'       => esc_html__('Grid Background Transparency', 'anahata'),
        'description' => esc_html__('Set grid background transparency for menu area (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $menu_area_in_grid_header_standard_extended_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_in_grid_border_header_standard_extended_meta',
    'type'          => 'select',
    'label'         => esc_html__('Grid Area Border', 'anahata'),
    'description'   => esc_html__('Set border on grid area', 'anahata'),
    'parent'        => $menu_area_in_grid_header_standard_extended_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_area_in_grid_border_header_standard_extended_container',
            'no'  => '#mkd_menu_area_in_grid_border_header_standard_extended_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_area_in_grid_border_header_standard_extended_container'
        )
    )
));

$menu_area_in_grid_border_header_standard_extended_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_area_in_grid_border_header_standard_extended_container',
    'parent'          => $menu_area_in_grid_header_standard_extended_container,
    'hidden_property' => 'mkd_menu_area_in_grid_border_header_standard_extended_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_menu_area_in_grid_border_color_header_standard_extended_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Set border color for grid area', 'anahata'),
    'parent'      => $menu_area_in_grid_border_header_standard_extended_container
));


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_color_header_standard_extended_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'anahata'),
        'description' => esc_html__('Choose a background color for menu area', 'anahata'),
        'parent'      => $header_standard_extended_type_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_background_transparency_header_standard_extended_meta',
        'type'        => 'text',
        'label'       => esc_html__('Transparency', 'anahata'),
        'description' => esc_html__('Choose a transparency for the menu area background color (0 = fully transparent, 1 = opaque)', 'anahata'),
        'parent'      => $header_standard_extended_type_meta_container,
        'args'        => array(
            'col_width' => 2
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_menu_area_border_header_standard_extended_meta',
    'type'          => 'select',
    'label'         => esc_html__('Menu Area Border', 'anahata'),
    'description'   => esc_html__('Set border on menu area', 'anahata'),
    'parent'        => $header_standard_extended_type_meta_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_menu_border_bottom_color_standard_extended_container',
            'no'  => '#mkd_menu_border_bottom_color_standard_extended_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_menu_border_bottom_color_standard_extended_container'
        )
    )
));

$border_bottom_color_standard_extended_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'menu_border_bottom_color_standard_extended_container',
    'parent'          => $header_standard_extended_type_meta_container,
    'hidden_property' => 'mkd_menu_area_border_header_standard_extended_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_menu_area_border_color_header_standard_extended_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Choose color of menu area bottom border', 'anahata'),
    'parent'      => $border_bottom_color_standard_extended_container
));


$header_box_type_meta_container = anahata_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_box_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_box
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_menu_area_grid_background_color_header_box_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'anahata'),
        'description' => esc_html__('Set grid background color for header area', 'anahata'),
        'parent'      => $header_box_type_meta_container
    )
);

$top_bar_container = anahata_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_top_bar_container_meta_container',
            'hidden_property' => 'mkd_header_type_meta',

        ),
        $temp_array_top_header
    )
);

anahata_mikado_add_admin_section_title(array(
    'name'   => 'top_bar_section_title',
    'parent' => $top_bar_container,
    'title'  => esc_html__('Top Bar', 'anahata')
));

$top_bar_global_option = anahata_mikado_options()->getOptionValue('top_bar');

$top_bar_default_dependency = array(
    '' => '#mkd_top_bar_container_no_style'
);

$top_bar_show_array = array(
    'yes' => '#mkd_top_bar_container_no_style'
);

$top_bar_hide_array = array(
    'no' => '#mkd_top_bar_container_no_style'
);

if($top_bar_global_option === 'yes') {
    $top_bar_show_array           = array_merge($top_bar_show_array, $top_bar_default_dependency);
    $top_bar_container_hide_array = array('no');
} else {
    $top_bar_hide_array           = array_merge($top_bar_hide_array, $top_bar_default_dependency);
    $top_bar_container_hide_array = array('', 'no');
}


anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_top_bar_meta',
    'type'          => 'select',
    'label'         => esc_html__('Enable Top Bar on This Page', 'anahata'),
    'description'   => esc_html__('Enabling this option will enable top bar on this page', 'anahata'),
    'parent'        => $top_bar_container,
    'default_value' => '',
    'options'       => array(
        ''    => esc_html__('Default', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata'),
        'no'  => esc_html__('No', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'show'       => $top_bar_show_array,
        'hide'       => $top_bar_hide_array
    )
));

$top_bar_container = anahata_mikado_add_admin_container_no_style(array(
    'name'            => 'top_bar_container_no_style',
    'parent'          => $top_bar_container,
    'hidden_property' => 'mkd_top_bar_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => $top_bar_container_hide_array
));

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_top_bar_in_grid_meta',
    'type'          => 'select',
    'label'         => esc_html__('Top Bar In Grid', 'anahata'),
    'description'   => esc_html__('Set top bar content to be in grid', 'anahata'),
    'parent'        => $top_bar_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_top_bar_grid_container',
            'no'  => '#mkd_top_bar_grid_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_top_bar_grid_container'
        )
    )
));

$top_bar_grid_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'top_bar_grid_container',
    'parent'          => $top_bar_container,
    'hidden_property' => 'mkd_top_bar_in_grid_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_top_bar_grid_background_color_meta',
    'type'        => 'color',
    'label'       => esc_html__('Grid Background Color', 'anahata'),
    'description' => esc_html__('Set grid background color for top bar', 'anahata'),
    'parent'      => $top_bar_grid_container
));


anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_top_bar_grid_background_transparency_meta',
    'type'        => 'text',
    'label'       => esc_html__('Grid Background Transparency', 'anahata'),
    'description' => esc_html__('Set grid background transparency for top bar', 'anahata'),
    'parent'      => $top_bar_grid_container,
    'args'        => array('col_width' => 3)
));

anahata_mikado_create_meta_box_field(array(
    'name'    => 'mkd_top_bar_skin_meta',
    'type'    => 'select',
    'label'   => esc_html__('Top Bar Skin', 'anahata'),
    'options' => array(
        ''      => esc_html__('Default', 'anahata'),
        'light' => esc_html__('White', 'anahata'),
        'dark'  => esc_html__('Black', 'anahata'),
        'gray'  => esc_html__('Gray', 'anahata'),
    ),
    'parent'  => $top_bar_container
));

anahata_mikado_create_meta_box_field(array(
    'name'   => 'mkd_top_bar_background_color_meta',
    'type'   => 'color',
    'label'  => esc_html__('Top Bar Background Color', 'anahata'),
    'parent' => $top_bar_container
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_top_bar_background_transparency_meta',
    'type'        => 'text',
    'label'       => esc_html__('Top Bar Background Color Transparency', 'anahata'),
    'description' => esc_html__('Set top bar background color transparenct. Value should be between 0 and 1', 'anahata'),
    'parent'      => $top_bar_container,
    'args'        => array(
        'col_width' => 3
    )
));

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_top_bar_border_meta',
    'type'          => 'select',
    'label'         => esc_html__('Top Bar Border', 'anahata'),
    'description'   => esc_html__('Set border on top bar', 'anahata'),
    'parent'        => $top_bar_container,
    'default_value' => '',
    'options'       => array(
        ''    => '',
        'no'  => esc_html__('No', 'anahata'),
        'yes' => esc_html__('Yes', 'anahata')
    ),
    'args'          => array(
        'dependence' => true,
        'hide'       => array(
            ''    => '#mkd_top_bar_border_container',
            'no'  => '#mkd_top_bar_border_container',
            'yes' => ''
        ),
        'show'       => array(
            ''    => '',
            'no'  => '',
            'yes' => '#mkd_top_bar_border_container'
        )
    )
));

$top_bar_border_container = anahata_mikado_add_admin_container(array(
    'type'            => 'container',
    'name'            => 'top_bar_border_container',
    'parent'          => $top_bar_container,
    'hidden_property' => 'mkd_top_bar_border_meta',
    'hidden_value'    => 'no',
    'hidden_values'   => array('', 'no')
));

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_top_bar_border_color_meta',
    'type'        => 'color',
    'label'       => esc_html__('Border Color', 'anahata'),
    'description' => esc_html__('Choose color for top bar border', 'anahata'),
    'parent'      => $top_bar_border_container
));

$header_vertical_type_meta_container = anahata_mikado_add_admin_container(
    array_merge(
        array(
            'parent'          => $header_meta_box,
            'name'            => 'mkd_header_vertical_type_meta_container',
            'hidden_property' => 'mkd_header_type_meta'
        ),
        $temp_array_vertical
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_vertical_header_background_color_meta',
    'type'        => 'color',
    'label'       => esc_html__('Background Color', 'anahata'),
    'description' => esc_html__('Set background color for vertical menu', 'anahata'),
    'parent'      => $header_vertical_type_meta_container
));

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_vertical_header_background_image_meta',
        'type'          => 'image',
        'default_value' => '',
        'label'         => esc_html__('Background Image', 'anahata'),
        'description'   => esc_html__('Set background image for vertical menu', 'anahata'),
        'parent'        => $header_vertical_type_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_disable_vertical_header_background_image_meta',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Disable Background Image', 'anahata'),
        'description'   => esc_html__('Enabling this option will hide background image in Vertical Menu', 'anahata'),
        'parent'        => $header_vertical_type_meta_container
    )
);

