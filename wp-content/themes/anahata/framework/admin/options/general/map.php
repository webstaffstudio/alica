<?php

if(!function_exists('anahata_mikado_general_options_map')) {
    /**
     * General options page
     */
    function anahata_mikado_general_options_map() {

        anahata_mikado_add_admin_page(
            array(
                'slug'  => '',
                'title' => esc_html__('General', 'anahata'),
                'icon'  => 'icon_building'
            )
        );

        $panel_logo = anahata_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_logo',
                'title' => esc_html__('Branding', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $panel_logo,
                'type'          => 'yesno',
                'name'          => 'hide_logo',
                'default_value' => 'no',
                'label'         => esc_html__('Hide Logo', 'anahata'),
                'description'   => esc_html__('Enabling this option will hide logo image', 'anahata'),
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "#mkd_hide_logo_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $hide_logo_container = anahata_mikado_add_admin_container(
            array(
                'parent'          => $panel_logo,
                'name'            => 'hide_logo_container',
                'hidden_property' => 'hide_logo',
                'hidden_value'    => 'yes'
            )
        );

        anahata_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'standard_minimal_logo_title',
                'title'  => esc_html__('Standard, Minimal & Boxed Header Logo', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label'         => esc_html__('Logo Image - Default', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display ', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_dark',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_black.png",
                'label'         => esc_html__('Logo Image - Dark', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display ', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_light',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_white.png",
                'label'         => esc_html__('Logo Image - Light', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display ', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_sticky',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label'         => esc_html__('Logo Image - Sticky', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display ', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        anahata_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'divided_logo_title',
                'title'  => esc_html__('Divided Header Logo', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_divided',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_divided.png",
                'label'         => esc_html__('Logo Image - Divided', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display ', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_divided_dark',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_divided_dark.png",
                'label'         => esc_html__('Logo Image - Divided Dark', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display ', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_divided_light',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_divided_light.png",
                'label'         => esc_html__('Logo Image - Divided Light', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display ', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_divided_sticky',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_divided.png",
                'label'         => esc_html__('Logo Image - Divided Sticky', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display ', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        anahata_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'centered_logo_title',
                'title'  => esc_html__('Centered Header Logo', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_centered',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_centered.png",
                'label'         => esc_html__('Logo Image - Centered', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display ', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_centered_dark',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_centered_dark.png",
                'label'         => esc_html__('Logo Image - Centered Dark', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display ', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_centered_light',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_centered_light.png",
                'label'         => esc_html__('Logo Image - Centered Light', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display ', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_centered_sticky',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_centered.png",
                'label'         => esc_html__('Logo Image - Centered Sticky', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display ', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        anahata_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'vertical_logo_title',
                'title'  => esc_html__('Vertical Header Logo', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_vertical',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label'         => esc_html__('Logo Image - Vertical Header', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display on vertilcal header', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        anahata_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'mobile_logo_title',
                'title'  => esc_html__('Mobile Header Logo', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_mobile',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label'         => esc_html__('Logo Image - Mobile', 'anahata'),
                'description'   => esc_html__('Choose a default logo image to display ', 'anahata'),
                'parent'        => $hide_logo_container
            )
        );

        $panel_design_style = anahata_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_design_style',
                'title' => esc_html__('Appearance', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'google_fonts',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'anahata'),
                'description'   => esc_html__('Choose a default Google font for your site', 'anahata'),
                'parent'        => $panel_design_style
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_fonts',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Additional Google Fonts', 'anahata'),
                'description'   => '',
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_additional_google_fonts_container"
                )
            )
        );

        $additional_google_fonts_container = anahata_mikado_add_admin_container(
            array(
                'parent'          => $panel_design_style,
                'name'            => 'additional_google_fonts_container',
                'hidden_property' => 'additional_google_fonts',
                'hidden_value'    => 'no'
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font1',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'anahata'),
                'description'   => esc_html__('Choose additional Google font for your site', 'anahata'),
                'parent'        => $additional_google_fonts_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font2',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'anahata'),
                'description'   => esc_html__('Choose additional Google font for your site', 'anahata'),
                'parent'        => $additional_google_fonts_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font3',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'anahata'),
                'description'   => esc_html__('Choose additional Google font for your site', 'anahata'),
                'parent'        => $additional_google_fonts_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font4',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'anahata'),
                'description'   => esc_html__('Choose additional Google font for your site', 'anahata'),
                'parent'        => $additional_google_fonts_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font5',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'anahata'),
                'description'   => esc_html__('Choose additional Google font for your site', 'anahata'),
                'parent'        => $additional_google_fonts_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'        => 'first_color',
                'type'        => 'color',
                'label'       => esc_html__('First Main Color', 'anahata'),
                'description' => esc_html__('Choose the most dominant theme color. Default color is #5ed6c1', 'anahata'),
                'parent'      => $panel_design_style
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'        => 'page_background_color',
                'type'        => 'color',
                'label'       => esc_html__('Page Background Color', 'anahata'),
                'description' => esc_html__('Choose the background color for page content. Default color is #ffffff', 'anahata'),
                'parent'      => $panel_design_style
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'        => 'selection_color',
                'type'        => 'color',
                'label'       => esc_html__('Text Selection Color', 'anahata'),
                'description' => esc_html__('Choose the color users see when selecting text', 'anahata'),
                'parent'      => $panel_design_style
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'boxed',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Boxed Layout', 'anahata'),
                'description'   => '',
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_boxed_container"
                )
            )
        );

        $boxed_container = anahata_mikado_add_admin_container(
            array(
                'parent'          => $panel_design_style,
                'name'            => 'boxed_container',
                'hidden_property' => 'boxed',
                'hidden_value'    => 'no'
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'        => 'page_background_color_in_box',
                'type'        => 'color',
                'label'       => esc_html__('Page Background Color', 'anahata'),
                'description' => esc_html__('Choose the page background color outside box.', 'anahata'),
                'parent'      => $boxed_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'        => 'boxed_background_image',
                'type'        => 'image',
                'label'       => esc_html__('Background Image', 'anahata'),
                'description' => esc_html__('Choose an image to be displayed in background', 'anahata'),
                'parent'      => $boxed_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'        => 'boxed_pattern_background_image',
                'type'        => 'image',
                'label'       => esc_html__('Background Pattern', 'anahata'),
                'description' => esc_html__('Choose an image to be used as background pattern', 'anahata'),
                'parent'      => $boxed_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'boxed_background_image_attachment',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label'         => esc_html__('Background Image Attachment', 'anahata'),
                'description'   => esc_html__('Choose background image attachment', 'anahata'),
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'  => 'Fixed',
                    'scroll' => 'Scroll'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'initial_content_width',
                'type'          => 'select',
                'default_value' => 'grid-1300',
                'label'         => esc_html__('Initial Width of Content', 'anahata'),
                'description'   => esc_html__('Choose the initial width of content which is in grid. Applies to pages set to "Default Template" and rows set to "In Grid"', 'anahata'),
                'parent'        => $panel_design_style,
                'options'       => array(
                    "grid-1300" => esc_html__("1300px - default", 'anahata'),
                    "grid-1200" => "1200px",
                    ""          => "1100px",
                    "grid-1000" => "1000px",
                    "grid-800"  => "800px"
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'        => 'preload_pattern_image',
                'type'        => 'image',
                'label'       => esc_html__('Preload Pattern Image', 'anahata'),
                'description' => esc_html__('Choose preload pattern image to be displayed until images are loaded', 'anahata'),
                'parent'      => $panel_design_style
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'        => 'element_appear_amount',
                'type'        => 'text',
                'label'       => esc_html__('Element Appearance', 'anahata'),
                'description' => esc_html__('For animated elements, set distance (related to browser bottom) to start the animation', 'anahata'),
                'parent'      => $panel_design_style,
                'args'        => array(
                    'col_width' => 2,
                    'suffix'    => 'px'
                )
            )
        );

        $panel_settings = anahata_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_settings',
                'title' => esc_html__('Behavior', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'smooth_scroll',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Smooth Scroll', 'anahata'),
                'description'   => esc_html__('Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'anahata'),
                'parent'        => $panel_settings
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'smooth_page_transitions',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Smooth Page Transitions', 'anahata'),
                'description'   => esc_html__('Enabling this option will perform a smooth transition between pages when clicking on links.', 'anahata'),
                'parent'        => $panel_settings,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_page_transitions_container"
                )
            )
        );

        $page_transitions_container = anahata_mikado_add_admin_container(
            array(
                'parent'          => $panel_settings,
                'name'            => 'page_transitions_container',
                'hidden_property' => 'smooth_page_transitions',
                'hidden_value'    => 'no'
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'page_transition_preloader',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Enable Preloading Animation', 'anahata'),
                'description'   => esc_html__('Enabling this option will display an animated preloader while the page content is loading', 'anahata'),
                'parent'        => $page_transitions_container,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_page_transition_preloader_container"
                )
            )
        );

        $page_transition_preloader_container = anahata_mikado_add_admin_container(
            array(
                'parent'          => $page_transitions_container,
                'name'            => 'page_transition_preloader_container',
                'hidden_property' => 'page_transition_preloader',
                'hidden_value'    => 'no'
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'   => 'smooth_pt_bgnd_color',
                'type'   => 'color',
                'label'  => esc_html__('Page Loader Background Color', 'anahata'),
                'parent' => $page_transition_preloader_container
            )
        );

        $group_pt_spinner_animation = anahata_mikado_add_admin_group(array(
            'name'        => 'group_pt_spinner_animation',
            'title'       => esc_html__('Loader Style', 'anahata'),
            'description' => esc_html__('Define styles for loader spinner animation', 'anahata'),
            'parent'      => $page_transition_preloader_container
        ));

        $row_pt_spinner_animation = anahata_mikado_add_admin_row(array(
            'name'   => 'row_pt_spinner_animation',
            'parent' => $group_pt_spinner_animation
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectsimple',
            'name'          => 'smooth_pt_spinner_type',
            'default_value' => 'cube',
            'label'         => esc_html__('Spinner Type', 'anahata'),
            'parent'        => $row_pt_spinner_animation,
            'options'       => array(
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
                'pulse_circles'         => esc_html__('Pulse Circles', 'anahata'),
            )
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'smooth_pt_spinner_color',
            'default_value' => '',
            'label'         => esc_html__('Spinner Color', 'anahata'),
            'parent'        => $row_pt_spinner_animation
        ));

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'page_transition_fadeout',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Enable Fade Out Animation', 'anahata'),
                'description'   => esc_html__('Enabling this option will turn on fade out animation when leaving page', 'anahata'),
                'parent'        => $page_transitions_container
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'elements_animation_on_touch',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Elements Animation on Mobile/Touch Devices', 'anahata'),
                'description'   => esc_html__('Enabling this option will allow elements (shortcodes) to animate on mobile / touch devices', 'anahata'),
                'parent'        => $panel_settings
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'show_back_button',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Show "Back To Top Button"', 'anahata'),
                'description'   => esc_html__('Enabling this option will display a Back to Top button on every page', 'anahata'),
                'parent'        => $panel_settings
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'          => 'responsiveness',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Responsiveness', 'anahata'),
                'description'   => esc_html__('Enabling this option will make all pages responsive', 'anahata'),
                'parent'        => $panel_settings
            )
        );

        $panel_custom_code = anahata_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_custom_code',
                'title' => esc_html__('Custom Code', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'        => 'custom_css',
                'type'        => 'textarea',
                'label'       => esc_html__('Custom CSS', 'anahata'),
                'description' => esc_html__('Enter your custom CSS here', 'anahata'),
                'parent'      => $panel_custom_code
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'        => 'custom_js',
                'type'        => 'textarea',
                'label'       => esc_html__('Custom JS', 'anahata'),
                'description' => esc_html__('Enter your custom Javascript here', 'anahata'),
                'parent'      => $panel_custom_code
            )
        );

        $panel_google_api = anahata_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_google_api',
                'title' => esc_html__('Google API', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'name'        => 'google_maps_api_key',
                'type'        => 'text',
                'label'       => esc_html__('Google Maps Api Key', 'anahata'),
                'description' => esc_html__('Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'anahata'),
                'parent'      => $panel_google_api
            )
        );
    }

    add_action('anahata_mikado_options_map', 'anahata_mikado_general_options_map', 1);

}