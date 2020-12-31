<?php

$general_meta_box = anahata_mikado_create_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post', 'tribe_events', 'tt-events', 'events'),
        'title' => esc_html__('General', 'anahata'),
        'name'  => 'general_meta'
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_smooth_page_transitions_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Smooth Page Transitions', 'anahata'),
        'description'   => esc_html__('Enabling this option will perform a smooth transition between pages when clicking on links', 'anahata'),
        'parent'        => $general_meta_box,
        'options'       => array(
            ''    => esc_html__('Default', 'anahata'),
            'yes' => esc_html__('Yes', 'anahata'),
            'no'  => esc_html__('No', 'anahata'),
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                ""    => "#mkd_page_transitions_container_meta",
                "no"  => "#mkd_page_transitions_container_meta",
                "yes" => ""
            ),
            "show"       => array(
                ""    => "",
                "no"  => "",
                "yes" => "#mkd_page_transitions_container_meta"
            )
        )
    )
);

$page_transitions_container_meta = anahata_mikado_add_admin_container(
    array(
        'parent'          => $general_meta_box,
        'name'            => 'page_transitions_container_meta',
        'hidden_property' => 'mkd_smooth_page_transitions_meta',
        'hidden_values'   => array('', 'no')
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_page_transition_preloader_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Enable Preloading Animation', 'anahata'),
        'description'   => esc_html__('Enabling this option will display an animated preloader while the page content is loading', 'anahata'),
        'parent'        => $page_transitions_container_meta,
        'options'       => array(
            ''    => esc_html__('Default', 'anahata'),
            'yes' => esc_html__('Yes', 'anahata'),
            'no'  => esc_html__('No', 'anahata'),
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                ""    => "#mkd_page_transition_preloader_container_meta",
                "no"  => "#mkd_page_transition_preloader_container_meta",
                "yes" => ""
            ),
            "show"       => array(
                ""    => "",
                "no"  => "",
                "yes" => "#mkd_page_transition_preloader_container_meta"
            )
        )
    )
);

$page_transition_preloader_container_meta = anahata_mikado_add_admin_container(
    array(
        'parent'          => $page_transitions_container_meta,
        'name'            => 'page_transition_preloader_container_meta',
        'hidden_property' => 'mkd_page_transition_preloader_meta',
        'hidden_values'   => array('', 'no')
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'   => 'mkd_smooth_pt_bgnd_color_meta',
        'type'   => 'color',
        'label'  => esc_html__('Page Loader Background Color', 'anahata'),
        'parent' => $page_transition_preloader_container_meta
    )
);

$group_pt_spinner_animation_meta = anahata_mikado_add_admin_group(
    array(
        'name'        => 'group_pt_spinner_animation_meta',
        'title'       => esc_html__('Loader Style', 'anahata'),
        'description' => esc_html__('Define styles for loader spinner animation', 'anahata'),
        'parent'      => $page_transition_preloader_container_meta
    )
);

$row_pt_spinner_animation_meta = anahata_mikado_add_admin_row(
    array(
        'name'   => 'row_pt_spinner_animation_meta',
        'parent' => $group_pt_spinner_animation_meta
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'type'          => 'selectsimple',
        'name'          => 'mkd_smooth_pt_spinner_type_meta',
        'default_value' => '',
        'label'         => esc_html__('Spinner Type', 'anahata'),
        'parent'        => $row_pt_spinner_animation_meta,
        'options'       => array(
            'rotate_circles'        => esc_html__('Rotate Circles', 'anahata'),
            'pulse'                 => esc_html__('Pulse', 'anahata'),
            'double_pulse'          => esc_html__('Double Pulse', 'anahata'),
            'cube'                  => esc_html__('Cube', 'anahata'),
            'rotating_cubes'        => esc_html__('Rotating Cubes', 'anahata'),
            'stripes'               => esc_html__('Stripes', 'anahata'),
            'wave'                  => esc_html__('Wave', 'anahata'),
            'two_rotating_circles'  => esc_html__('2 Rotating Circles', 'anahata'),
            'five_rotating_circles' => esc_html__('5 Rotating Circles', 'anahata'),
            'atom'                  => esc_html__('Atom', 'anahata'),
            'clock'                 => esc_html__('Clock', 'anahata'),
            'mitosis'               => esc_html__('Mitosis', 'anahata'),
            'lines'                 => esc_html__('Lines', 'anahata'),
            'fussion'               => esc_html__('Fussion', 'anahata'),
            'wave_circles'          => esc_html__('Wave Circles', 'anahata'),
            'pulse_circles'         => esc_html__('Pulse Circles', 'anahata')
        ),
        'args'          => array(
            "dependence" => true,
            'show'       => array(
                "pulse"                 => "#mkd_smooth_pt_spinner_gradient_container",
                "double_pulse"          => "",
                "cube"                  => "#mkd_smooth_pt_spinner_gradient_container",
                "rotating_cubes"        => "",
                "stripes"               => "",
                "wave"                  => "",
                "two_rotating_circles"  => "",
                "five_rotating_circles" => "",
                "atom"                  => "",
                "clock"                 => "",
                "mitosis"               => "",
                "lines"                 => "",
                "fussion"               => "",
                "wave_circles"          => "",
                "pulse_circles"         => ""
            ),
            'hide'       => array(
                "pulse"                 => "",
                "double_pulse"          => "#mkd_smooth_pt_spinner_gradient_container",
                "cube"                  => "",
                "rotating_cubes"        => "#mkd_smooth_pt_spinner_gradient_container",
                "stripes"               => "#mkd_smooth_pt_spinner_gradient_container",
                "wave"                  => "#mkd_smooth_pt_spinner_gradient_container",
                "two_rotating_circles"  => "#mkd_smooth_pt_spinner_gradient_container",
                "five_rotating_circles" => "#mkd_smooth_pt_spinner_gradient_container",
                "atom"                  => "#mkd_smooth_pt_spinner_gradient_container",
                "clock"                 => "#mkd_smooth_pt_spinner_gradient_container",
                "mitosis"               => "#mkd_smooth_pt_spinner_gradient_container",
                "lines"                 => "#mkd_smooth_pt_spinner_gradient_container",
                "fussion"               => "#mkd_smooth_pt_spinner_gradient_container",
                "wave_circles"          => "#mkd_smooth_pt_spinner_gradient_container",
                "pulse_circles"         => "#mkd_smooth_pt_spinner_gradient_container"
            )
        )
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'type'          => 'colorsimple',
        'name'          => 'mkd_smooth_pt_spinner_color_meta',
        'default_value' => '',
        'label'         => esc_html__('Spinner Color', 'anahata'),
        'parent'        => $row_pt_spinner_animation_meta
    )
);

$smooth_pt_spinner_gradient_container = anahata_mikado_add_admin_container(
    array(
        'parent'          => $page_transition_preloader_container_meta,
        'name'            => 'smooth_pt_spinner_gradient_container',
        'hidden_property' => 'smooth_pt_spinner_type',
        'hidden_value'    => '',
        'hidden_values'   => array(
            "double_pulse",
            "rotating_cubes",
            "stripes",
            "wave",
            "two_rotating_circles",
            "five_rotating_circles",
            "atom",
            "clock",
            "mitosis",
            "lines",
            "fussion",
            "wave_circles",
            "pulse_circles"
        )
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_first_color_meta',
        'type'          => 'color',
        'default_value' => '',
        'label'         => esc_html__('Page Main Color', 'anahata'),
        'description'   => esc_html__('Choose page main color', 'anahata'),
        'parent'        => $general_meta_box
    )
);


anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_page_background_color_meta',
        'type'          => 'color',
        'default_value' => '',
        'label'         => esc_html__('Page Background Color', 'anahata'),
        'description'   => esc_html__('Choose background color for page content', 'anahata'),
        'parent'        => $general_meta_box
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_page_padding_meta',
        'type'          => 'text',
        'default_value' => '',
        'label'         => esc_html__('Page Padding', 'anahata'),
        'description'   => esc_html__('Insert padding in format 10px 10px 10px 10px', 'anahata'),
        'parent'        => $general_meta_box
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_page_content_behind_header_meta',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Always put content behind header', 'anahata'),
        'description'   => esc_html__('Enabling this option will put page content behind page header', 'anahata'),
        'parent'        => $general_meta_box,
        'args'          => array(
            'suffix' => 'px'
        )
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_page_transition_fadeout_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Enable Fade Out Animation', 'anahata'),
        'description'   => esc_html__('Enabling this option will turn on fade out animation when leaving page', 'anahata'),
        'options'       => array(
            ''    => esc_html__('Default', 'anahata'),
            'yes' => esc_html__('Yes', 'anahata'),
            'no'  => esc_html__('No', 'anahata'),
        ),
        'parent'        => $page_transitions_container_meta

    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_page_slider_meta',
        'type'          => 'text',
        'default_value' => '',
        'label'         => esc_html__('Slider Shortcode', 'anahata'),
        'description'   => esc_html__('Paste your slider shortcode here', 'anahata'),
        'parent'        => $general_meta_box
    )
);

if(anahata_mikado_options()->getOptionValue('smooth_pt_true_ajax') === 'yes') {
    anahata_mikado_create_meta_box_field(
        array(
            'name'          => 'mkd_page_transition_type',
            'type'          => 'selectblank',
            'label'         => esc_html__('Page Transition', 'anahata'),
            'description'   => esc_html__('Choose the type of transition to this page', 'anahata'),
            'parent'        => $general_meta_box,
            'default_value' => '',
            'options'       => array(
                'no-animation' => esc_html__('No animation', 'anahata'),
                'fade'         => esc_html__('Fade', 'anahata')
            )
        )
    );
}

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_page_likes_meta',
        'type'        => 'selectblank',
        'label'       => esc_html__('Show Likes', 'anahata'),
        'description' => esc_html__('Enabling this option will show likes on your page', 'anahata'),
        'parent'      => $general_meta_box,
        'options'     => array(
            'yes' => esc_html__('Yes', 'anahata'),
            'no'  => esc_html__('No', 'anahata'),
        )
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_page_comments_meta',
        'type'        => 'selectblank',
        'label'       => esc_html__('Show Comments', 'anahata'),
        'description' => esc_html__('Enabling this option will show comments on your page', 'anahata'),
        'parent'      => $general_meta_box,
        'options'     => array(
            'yes' => esc_html__('Yes', 'anahata'),
            'no'  => esc_html__('No', 'anahata'),
        )
    )
);