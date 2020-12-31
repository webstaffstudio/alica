<?php

$title_meta_box = anahata_mikado_create_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post', 'tribe_events', 'tt-events', 'events'),
        'title' => esc_html__('Title', 'anahata'),
        'name'  => 'title_meta'
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_show_title_area_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Show Title Area', 'anahata'),
        'description'   => esc_html__('Disabling this option will turn off page title area', 'anahata'),
        'parent'        => $title_meta_box,
        'options'       => array(
            ''    => '',
            'no'  => esc_html__('No', 'anahata'),
            'yes' => esc_html__('Yes', 'anahata')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                ""    => "",
                "no"  => "#mkd_mkd_show_title_area_meta_container",
                "yes" => ""
            ),
            "show"       => array(
                ""    => "#mkd_mkd_show_title_area_meta_container",
                "no"  => "",
                "yes" => "#mkd_mkd_show_title_area_meta_container"
            )
        )
    )
);

$show_title_area_meta_container = anahata_mikado_add_admin_container(
    array(
        'parent'          => $title_meta_box,
        'name'            => 'mkd_show_title_area_meta_container',
        'hidden_property' => 'mkd_show_title_area_meta',
        'hidden_value'    => 'no'
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_title_area_type_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Title Area Type', 'anahata'),
        'description'   => esc_html__('Choose title type', 'anahata'),
        'parent'        => $show_title_area_meta_container,
        'options'       => array(
            ''           => '',
            'standard'   => esc_html__('Standard', 'anahata'),
            'breadcrumb' => esc_html__('Breadcrumb', 'anahata')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                "standard"   => "",
                "standard"   => "",
                "breadcrumb" => "#mkd_mkd_title_area_type_meta_container"
            ),
            "show"       => array(
                ""           => "#mkd_mkd_title_area_type_meta_container",
                "standard"   => "#mkd_mkd_title_area_type_meta_container",
                "breadcrumb" => ""
            )
        )
    )
);

$title_area_type_meta_container = anahata_mikado_add_admin_container(
    array(
        'parent'          => $show_title_area_meta_container,
        'name'            => 'mkd_title_area_type_meta_container',
        'hidden_property' => 'mkd_title_area_type_meta',
        'hidden_value'    => '',
        'hidden_values'   => array('breadcrumb'),
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_title_area_enable_breadcrumbs_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Enable Breadcrumbs', 'anahata'),
        'description'   => esc_html__('This option will display Breadcrumbs in Title Area', 'anahata'),
        'parent'        => $title_area_type_meta_container,
        'options'       => array(
            ''    => '',
            'no'  => esc_html__('No', 'anahata'),
            'yes' => esc_html('Yes', 'anahata')
        ),
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_title_text_size_meta',
    'type'        => 'select',
    'label'       => esc_html__('Choose Title Text Size', 'anahata'),
    'description' => esc_html__('Choose predefined size for title text', 'anahata'),
    'parent'      => $title_area_type_meta_container,
    'options'     => array(
        ''       => esc_html__('Default', 'anahata'),
        'medium' => esc_html__('Medium', 'anahata'),
        'large'  => esc_html__('Large', 'anahata')
    )
));

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_show_title_separator_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Show Separator With Image', 'anahata'),
        'description'   => esc_html__('Enable this option to show separator and image in Title Area', 'anahata'),
        'parent'        => $title_area_type_meta_container,
        'options'       => array(
            ''    => esc_html__('Default', 'anahata'),
            'yes' => esc_html__('Yes', 'anahata'),
            'no'  => esc_html__('No', 'anahata')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                "dafault" => "#mkd_mkd_show_title_separator_meta_container",
                "yes"     => "",
                "no"      => "#mkd_mkd_show_title_separator_meta_container"
            ),
            "show"       => array(
                "default" => "",
                "yes"     => "#mkd_mkd_show_title_separator_meta_container",
                "no"      => ""
            )
        ),

    )
);

$mkd_show_title_separator_meta_container = anahata_mikado_add_admin_container(
    array(
        'parent'          => $title_area_type_meta_container,
        'name'            => 'mkd_show_title_separator_meta_container',
        'hidden_property' => 'mkd_show_title_separator_meta',
        'hidden_values'    => array('','no')
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_title_separator_icon_meta',
        'type'        => 'image',
        'label'       => esc_html__('Separator Image', 'anahata'),
        'description' => esc_html__('Choose an Image for Separator in Title Area', 'anahata'),
        'parent'      => $mkd_show_title_separator_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_title_area_animation_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Animations', 'anahata'),
        'description'   => esc_html__('Choose an animation for Title Area', 'anahata'),
        'parent'        => $show_title_area_meta_container,
        'options'       => array(
            ''           => '',
            'no'         => esc_html__('No Animation', 'anahata'),
            'right-left' => esc_html__('Text right to left', 'anahata'),
            'left-right' => esc_html__('Text left to right', 'anahata')
        )
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_title_area_vertial_alignment_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Vertical Alignment', 'anahata'),
        'description'   => esc_html__('Specify title vertical alignment', 'anahata'),
        'parent'        => $show_title_area_meta_container,
        'options'       => array(
            ''              => '',
            'header_bottom' => esc_html__('From Bottom of Header', 'anahata'),
            'window_top'    => esc_html__('From Window Top', 'anahata')
        )
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_title_area_content_alignment_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Horizontal Alignment', 'anahata'),
        'description'   => esc_html__('Specify title horizontal alignment', 'anahata'),
        'parent'        => $show_title_area_meta_container,
        'options'       => array(
            ''       => '',
            'left'   => esc_html__('Left', 'anahata'),
            'center' => esc_html__('Center', 'anahata'),
            'right'  => esc_html__('Right', 'anahata')
        )
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_title_text_color_meta',
        'type'        => 'color',
        'label'       => esc_html__('Title Color', 'anahata'),
        'description' => esc_html__('Choose a color for title text', 'anahata'),
        'parent'      => $show_title_area_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_title_breadcrumb_color_meta',
        'type'        => 'color',
        'label'       => esc_html__('Breadcrumb Color', 'anahata'),
        'description' => esc_html__('Choose a color for breadcrumb text', 'anahata'),
        'parent'      => $show_title_area_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_title_area_background_color_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'anahata'),
        'description' => esc_html__('Choose a background color for Title Area', 'anahata'),
        'parent'      => $show_title_area_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_hide_background_image_meta',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Hide Background Image', 'anahata'),
        'description'   => esc_html__('Enable this option to hide background image in Title Area', 'anahata'),
        'parent'        => $show_title_area_meta_container,
        'args'          => array(
            "dependence"             => true,
            "dependence_hide_on_yes" => "#mkd_mkd_hide_background_image_meta_container",
            "dependence_show_on_yes" => ""
        )
    )
);

$hide_background_image_meta_container = anahata_mikado_add_admin_container(
    array(
        'parent'          => $show_title_area_meta_container,
        'name'            => 'mkd_hide_background_image_meta_container',
        'hidden_property' => 'mkd_hide_background_image_meta',
        'hidden_value'    => 'yes'
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_title_area_background_image_meta',
        'type'        => 'image',
        'label'       => esc_html__('Background Image', 'anahata'),
        'description' => esc_html__('Choose an Image for Title Area', 'anahata'),
        'parent'      => $hide_background_image_meta_container
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_title_area_background_image_responsive_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Background Responsive Image', 'anahata'),
        'description'   => esc_html__('Enabling this option will make Title background image responsive', 'anahata'),
        'parent'        => $hide_background_image_meta_container,
        'options'       => array(
            ''    => '',
            'no'  => esc_html__('No', 'anahata'),
            'yes' => esc_html__('Yes', 'anahata')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                ""    => "",
                "no"  => "",
                "yes" => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta"
            ),
            "show"       => array(
                ""    => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta",
                "no"  => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta",
                "yes" => ""
            )
        )
    )
);

$title_area_background_image_responsive_meta_container = anahata_mikado_add_admin_container(
    array(
        'parent'          => $hide_background_image_meta_container,
        'name'            => 'mkd_title_area_background_image_responsive_meta_container',
        'hidden_property' => 'mkd_title_area_background_image_responsive_meta',
        'hidden_value'    => 'yes'
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_title_area_background_image_parallax_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Background Image in Parallax', 'anahata'),
        'description'   => esc_html__('Enabling this option will make Title background image parallax', 'anahata'),
        'parent'        => $title_area_background_image_responsive_meta_container,
        'options'       => array(
            ''         => '',
            'no'       => esc_html__('No', 'anahata'),
            'yes'      => esc_html__('Yes', 'anahata'),
            'yes_zoom' => esc_html__('Yes, with zoom out', 'anahata')
        )
    )
);

anahata_mikado_create_meta_box_field(array(
    'name'        => 'mkd_title_area_height_meta',
    'type'        => 'text',
    'label'       => esc_html__('Height', 'anahata'),
    'description' => esc_html__('Set a height for Title Area', 'anahata'),
    'parent'      => $show_title_area_meta_container,
    'args'        => array(
        'col_width' => 2,
        'suffix'    => 'px'
    )
));

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_disable_title_bottom_border_meta',
    'type'          => 'yesno',
    'label'         => esc_html__('Disable Title Bottom Border', 'anahata'),
    'description'   => esc_html__('This option will disable title area bottom border', 'anahata'),
    'parent'        => $show_title_area_meta_container,
    'default_value' => 'no'
));

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_title_area_subtitle_meta',
    'type'          => 'text',
    'default_value' => '',
    'label'         => esc_html__('Subtitle Text', 'anahata'),
    'description'   => esc_html__('Enter your subtitle text', 'anahata'),
    'parent'        => $show_title_area_meta_container,
    'args'          => array(
        'col_width' => 6
    )
));

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_subtitle_color_meta',
        'type'        => 'color',
        'label'       => esc_html__('Subtitle Color', 'anahata'),
        'description' => esc_html__('Choose a color for subtitle text', 'anahata'),
        'parent'      => $show_title_area_meta_container
    )
);