<?php

if(!function_exists('anahata_mikado_fonts_options_map')) {
    /**
     * Font options page
     */
    function anahata_mikado_fonts_options_map() {

        anahata_mikado_add_admin_page(
            array(
                'slug'  => '_fonts_page',
                'title' => esc_html__('Fonts', 'anahata'),
                'icon'  => 'icon_pencil-edit_alt'
            )
        );

        /**
         * Headings
         */
        $panel_headings = anahata_mikado_add_admin_panel(
            array(
                'page'  => '_fonts_page',
                'name'  => 'panel_headings',
                'title' => esc_html__('Headings', 'anahata')
            )
        );

        //H1
        $group_heading_h1 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_heading_h1',
            'title'       => esc_html__('H1 Style', 'anahata'),
            'description' => esc_html__('Define styles for H1 heading', 'anahata'),
            'parent'      => $panel_headings
        ));

        $row_heading_h1_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_heading_h1_1',
            'parent' => $group_heading_h1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'h1_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'anahata'),
            'parent'        => $row_heading_h1_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h1_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h1_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h1_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h1_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h1_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'anahata'),
            'options'       => anahata_mikado_get_text_transform_array(),
            'parent'        => $row_heading_h1_1
        ));

        $row_heading_h1_2 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_heading_h1_2',
            'parent' => $group_heading_h1,
            'next'   => true
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'h1_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'anahata'),
            'parent'        => $row_heading_h1_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h1_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'anahata'),
            'options'       => anahata_mikado_get_font_style_array(),
            'parent'        => $row_heading_h1_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h1_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'anahata'),
            'options'       => anahata_mikado_get_font_weight_array(),
            'parent'        => $row_heading_h1_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h1_letterspacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h1_2
        ));

        //H2
        $group_heading_h2 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_heading_h2',
            'title'       => esc_html__('H2 Style', 'anahata'),
            'description' => esc_html__('Define styles for H2 heading', 'anahata'),
            'parent'      => $panel_headings
        ));

        $row_heading_h2_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_heading_h2_1',
            'parent' => $group_heading_h2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'h2_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'anahata'),
            'parent'        => $row_heading_h2_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h2_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h2_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h2_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h2_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h2_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'anahata'),
            'options'       => anahata_mikado_get_text_transform_array(),
            'parent'        => $row_heading_h2_1
        ));

        $row_heading_h2_2 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_heading_h2_2',
            'parent' => $group_heading_h2,
            'next'   => true
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'h2_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'anahata'),
            'parent'        => $row_heading_h2_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h2_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'anahata'),
            'options'       => anahata_mikado_get_font_style_array(),
            'parent'        => $row_heading_h2_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h2_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'anahata'),
            'options'       => anahata_mikado_get_font_weight_array(),
            'parent'        => $row_heading_h2_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h2_letterspacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h2_2
        ));

        //H3
        $group_heading_h3 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_heading_h3',
            'title'       => esc_html__('H3 Style', 'anahata'),
            'description' => esc_html__('Define styles for H3 heading', 'anahata'),
            'parent'      => $panel_headings
        ));

        $row_heading_h3_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_heading_h3_1',
            'parent' => $group_heading_h3
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'h3_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'anahata'),
            'parent'        => $row_heading_h3_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h3_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h3_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h3_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h3_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h3_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'anahata'),
            'options'       => anahata_mikado_get_text_transform_array(),
            'parent'        => $row_heading_h3_1
        ));

        $row_heading_h3_2 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_heading_h3_2',
            'parent' => $group_heading_h3,
            'next'   => true
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'h3_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'anahata'),
            'parent'        => $row_heading_h3_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h3_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'anahata'),
            'options'       => anahata_mikado_get_font_style_array(),
            'parent'        => $row_heading_h3_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h3_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'anahata'),
            'options'       => anahata_mikado_get_font_weight_array(),
            'parent'        => $row_heading_h3_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h3_letterspacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h3_2
        ));

        //H4
        $group_heading_h4 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_heading_h4',
            'title'       => esc_html__('H4 Style', 'anahata'),
            'description' => esc_html__('Define styles for H4 heading', 'anahata'),
            'parent'      => $panel_headings
        ));

        $row_heading_h4_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_heading_h4_1',
            'parent' => $group_heading_h4
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'h4_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'anahata'),
            'parent'        => $row_heading_h4_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h4_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h4_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h4_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h4_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h4_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'anahata'),
            'options'       => anahata_mikado_get_text_transform_array(),
            'parent'        => $row_heading_h4_1
        ));

        $row_heading_h4_2 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_heading_h4_2',
            'parent' => $group_heading_h4,
            'next'   => true
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'h4_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'anahata'),
            'parent'        => $row_heading_h4_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h4_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'anahata'),
            'options'       => anahata_mikado_get_font_style_array(),
            'parent'        => $row_heading_h4_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h4_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'anahata'),
            'options'       => anahata_mikado_get_font_weight_array(),
            'parent'        => $row_heading_h4_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h4_letterspacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h4_2
        ));

        //H5
        $group_heading_h5 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_heading_h5',
            'title'       => esc_html__('H5 Style', 'anahata'),
            'description' => esc_html__('Define styles for H5 heading', 'anahata'),
            'parent'      => $panel_headings
        ));

        $row_heading_h5_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_heading_h5_1',
            'parent' => $group_heading_h5
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'h5_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'anahata'),
            'parent'        => $row_heading_h5_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h5_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h5_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h5_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h5_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h5_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'anahata'),
            'options'       => anahata_mikado_get_text_transform_array(),
            'parent'        => $row_heading_h5_1
        ));

        $row_heading_h5_2 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_heading_h5_2',
            'parent' => $group_heading_h5,
            'next'   => true
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'h5_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'anahata'),
            'parent'        => $row_heading_h5_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h5_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'anahata'),
            'options'       => anahata_mikado_get_font_style_array(),
            'parent'        => $row_heading_h5_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h5_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'anahata'),
            'options'       => anahata_mikado_get_font_weight_array(),
            'parent'        => $row_heading_h5_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h5_letterspacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h5_2
        ));

        //H6
        $group_heading_h6 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_heading_h6',
            'title'       => esc_html__('H6 Style', 'anahata'),
            'description' => esc_html__('Define styles for h6 heading', 'anahata'),
            'parent'      => $panel_headings
        ));

        $row_heading_h6_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_heading_h6_1',
            'parent' => $group_heading_h6
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'h6_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'anahata'),
            'parent'        => $row_heading_h6_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h6_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h6_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h6_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h6_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h6_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'anahata'),
            'options'       => anahata_mikado_get_text_transform_array(),
            'parent'        => $row_heading_h6_1
        ));

        $row_heading_h6_2 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_heading_h6_2',
            'parent' => $group_heading_h6,
            'next'   => true
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'h6_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'anahata'),
            'parent'        => $row_heading_h6_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h6_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'anahata'),
            'options'       => anahata_mikado_get_font_style_array(),
            'parent'        => $row_heading_h6_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'h6_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'anahata'),
            'options'       => anahata_mikado_get_font_weight_array(),
            'parent'        => $row_heading_h6_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h6_letterspacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_heading_h6_2
        ));

        /**
         * Headings Responsive (Tablet Portrait View)
         */
        $panel_responsive_headings = anahata_mikado_add_admin_panel(
            array(
                'page'  => '_fonts_page',
                'name'  => 'panel_responsive_headings',
                'title' => esc_html__('Headings Responsive (Tablet Portrait View)', 'anahata')
            )
        );

        //H1
        $group_responsive_heading_h1 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_responsive_heading_h1',
            'title'       => esc_html__('H1 Responsive Style', 'anahata'),
            'description' => esc_html__('Define responsive styles for H1 heading', 'anahata'),
            'parent'      => $panel_responsive_headings
        ));

        $row_responsive_heading_h1_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_responsive_heading_h1_1',
            'parent' => $group_responsive_heading_h1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h1_responsive_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive_heading_h1_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h1_responsive_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive_heading_h1_1
        ));

        //H2
        $group_responsive_heading_h2 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_responsive_heading_h2',
            'title'       => esc_html__('H2 Responsive Style', 'anahata'),
            'description' => esc_html__('Define responsive styles for H2 heading', 'anahata'),
            'parent'      => $panel_responsive_headings
        ));

        $row_responsive_heading_h2_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_responsive_heading_h2_1',
            'parent' => $group_responsive_heading_h2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h2_responsive_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive_heading_h2_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h2_responsive_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive_heading_h2_1
        ));

        //H3
        $group_responsive_heading_h3 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_responsive_heading_h3',
            'title'       => esc_html__('H3 Responsive Style', 'anahata'),
            'description' => esc_html__('Define responsive styles for H3 heading', 'anahata'),
            'parent'      => $panel_responsive_headings
        ));

        $row_responsive_heading_h3_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_responsive_heading_h3_1',
            'parent' => $group_responsive_heading_h3
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h3_responsive_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive_heading_h3_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h3_responsive_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive_heading_h3_1
        ));

        //H4
        $group_responsive_heading_h4 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_responsive_heading_h4',
            'title'       => esc_html__('H4 Responsive Style', 'anahata'),
            'description' => esc_html__('Define responsive styles for H4 heading', 'anahata'),
            'parent'      => $panel_responsive_headings
        ));

        $row_responsive_heading_h4_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_responsive_heading_h4_1',
            'parent' => $group_responsive_heading_h4
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h4_responsive_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive_heading_h4_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h4_responsive_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive_heading_h4_1
        ));

        //H5
        $group_responsive_heading_h5 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_responsive_heading_h5',
            'title'       => esc_html__('H5 Responsive Style', 'anahata'),
            'description' => esc_html__('Define responsive styles for H5 heading', 'anahata'),
            'parent'      => $panel_responsive_headings
        ));

        $row_responsive_heading_h5_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_responsive_heading_h5_1',
            'parent' => $group_responsive_heading_h5
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h5_responsive_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive_heading_h5_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h5_responsive_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive_heading_h5_1
        ));

        //H6
        $group_responsive_heading_h6 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_responsive_heading_h6',
            'title'       => esc_html__('H6 Responsive Style', 'anahata'),
            'description' => esc_html__('Define responsive styles for h6 heading', 'anahata'),
            'parent'      => $panel_responsive_headings
        ));

        $row_responsive_heading_h6_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_responsive_heading_h6_1',
            'parent' => $group_responsive_heading_h6
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h6_responsive_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive_heading_h6_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h6_responsive_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive_heading_h6_1
        ));

        /**
         * Headings Responsive (Mobile Devices)
         */
        $panel_responsive_headings2 = anahata_mikado_add_admin_panel(
            array(
                'page'  => '_fonts_page',
                'name'  => 'panel_responsive_headings2',
                'title' => esc_html__('Headings Responsive (Mobile Devices)', 'anahata')
            )
        );

        //H1
        $group_responsive2_heading_h1 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_responsive2_heading_h1',
            'title'       => esc_html__('H1 Responsive Style', 'anahata'),
            'description' => esc_html__('Define responsive styles for H1 heading', 'anahata'),
            'parent'      => $panel_responsive_headings2
        ));

        $row_responsive2_heading_h1_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_responsive2_heading_h1_1',
            'parent' => $group_responsive2_heading_h1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h1_responsive_fontsize2',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive2_heading_h1_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h1_responsive_lineheight2',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive2_heading_h1_1
        ));

        //H2
        $group_responsive2_heading_h2 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_responsive2_heading_h2',
            'title'       => esc_html__('H2 Responsive Style', 'anahata'),
            'description' => esc_html__('Define responsive styles for H2 heading', 'anahata'),
            'parent'      => $panel_responsive_headings2
        ));

        $row_responsive2_heading_h2_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_responsive2_heading_h2_1',
            'parent' => $group_responsive2_heading_h2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h2_responsive_fontsize2',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive2_heading_h2_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h2_responsive_lineheight2',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive2_heading_h2_1
        ));

        //H3
        $group_responsive2_heading_h3 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_responsive2_heading_h3',
            'title'       => esc_html__('H3 Responsive Style', 'anahata'),
            'description' => esc_html__('Define responsive styles for H3 heading', 'anahata'),
            'parent'      => $panel_responsive_headings2
        ));

        $row_responsive2_heading_h3_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_responsive2_heading_h3_1',
            'parent' => $group_responsive2_heading_h3
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h3_responsive_fontsize2',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive2_heading_h3_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h3_responsive_lineheight2',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive2_heading_h3_1
        ));

        //H4
        $group_responsive2_heading_h4 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_responsive2_heading_h4',
            'title'       => esc_html__('H4 Responsive Style', 'anahata'),
            'description' => esc_html__('Define responsive styles for H4 heading', 'anahata'),
            'parent'      => $panel_responsive_headings2
        ));

        $row_responsive2_heading_h4_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_responsive2_heading_h4_1',
            'parent' => $group_responsive2_heading_h4
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h4_responsive_fontsize2',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive2_heading_h4_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h4_responsive_lineheight2',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive2_heading_h4_1
        ));

        //H5
        $group_responsive2_heading_h5 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_responsive2_heading_h5',
            'title'       => esc_html__('H5 Responsive Style', 'anahata'),
            'description' => esc_html__('Define responsive styles for H5 heading', 'anahata'),
            'parent'      => $panel_responsive_headings2
        ));

        $row_responsive2_heading_h5_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_responsive2_heading_h5_1',
            'parent' => $group_responsive2_heading_h5
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h5_responsive_fontsize2',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive2_heading_h5_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h5_responsive_lineheight2',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive2_heading_h5_1
        ));

        //H6
        $group_responsive2_heading_h6 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_responsive2_heading_h6',
            'title'       => esc_html__('H6 Responsive Style', 'anahata'),
            'description' => esc_html__('Define responsive styles for h6 heading', 'anahata'),
            'parent'      => $panel_responsive_headings2
        ));

        $row_responsive2_heading_h6_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_responsive2_heading_h6_1',
            'parent' => $group_responsive2_heading_h6
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h6_responsive_fontsize2',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive2_heading_h6_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'h6_responsive_lineheight2',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_responsive2_heading_h6_1
        ));

        /**
         * Text
         */
        $panel_text = anahata_mikado_add_admin_panel(
            array(
                'page'  => '_fonts_page',
                'name'  => 'panel_text',
                'title' => esc_html__('Text', 'anahata')
            )
        );

        $group_text = anahata_mikado_add_admin_group(array(
            'name'        => 'group_text',
            'title'       => esc_html__('Paragraph', 'anahata'),
            'description' => esc_html__('Define styles for paragraph text', 'anahata'),
            'parent'      => $panel_text
        ));

        $row_text_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_text_1',
            'parent' => $group_text
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'text_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'anahata'),
            'parent'        => $row_text_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'text_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_text_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'text_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_text_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'text_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'anahata'),
            'options'       => anahata_mikado_get_text_transform_array(),
            'parent'        => $row_text_1
        ));

        $group_text_res1 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_text_res1',
            'title'       => esc_html__('Paragraph Responsive (Table Portrait View)', 'anahata'),
            'description' => esc_html__('Define responsive styles for paragraph text for table devices - portrait view', 'anahata'),
            'parent'      => $panel_text
        ));

        $row_res_text_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_text_1',
            'parent' => $group_text_res1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'text_fontsize_res1',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_res_text_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'text_lineheight_res1',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_res_text_1
        ));

        $group_text_res2 = anahata_mikado_add_admin_group(array(
            'name'        => 'group_text_res2',
            'title'       => esc_html__('Paragraph Responsive (Mobile Devices)', 'anahata'),
            'description' => esc_html__('Define responsive styles for paragraph text for mobile devices', 'anahata'),
            'parent'      => $panel_text
        ));

        $row_res_text_2 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_res_text_2',
            'parent' => $group_text_res2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'text_fontsize_res2',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_res_text_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'text_lineheight_res2',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_res_text_2
        ));

        $row_text_2 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_text_2',
            'parent' => $group_text,
            'next'   => true
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'text_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'anahata'),
            'parent'        => $row_text_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'text_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'anahata'),
            'options'       => anahata_mikado_get_font_style_array(),
            'parent'        => $row_text_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'text_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'anahata'),
            'options'       => anahata_mikado_get_font_weight_array(),
            'parent'        => $row_text_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'text_letterspacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'anahata'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_text_2
        ));

        $group_link = anahata_mikado_add_admin_group(array(
            'name'        => 'group_link',
            'title'       => esc_html__('Links', 'anahata'),
            'description' => esc_html__('Define styles for link text', 'anahata'),
            'parent'      => $panel_text
        ));

        $row_link_1 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_link_1',
            'parent' => $group_link
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'link_color',
            'default_value' => '',
            'label'         => esc_html__('Link Color', 'anahata'),
            'parent'        => $row_link_1
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'link_hovercolor',
            'default_value' => '',
            'label'         => esc_html__('Hover Link Color', 'anahata'),
            'parent'        => $row_link_1
        ));

        $row_link_2 = anahata_mikado_add_admin_row(array(
            'name'   => 'row_link_2',
            'parent' => $group_link,
            'next'   => true
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'link_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'anahata'),
            'options'       => anahata_mikado_get_font_style_array(),
            'parent'        => $row_link_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'link_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'anahata'),
            'options'       => anahata_mikado_get_font_weight_array(),
            'parent'        => $row_link_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'link_fontdecoration',
            'default_value' => '',
            'label'         => esc_html__('Link Decoration', 'anahata'),
            'options'       => anahata_mikado_get_text_decorations(),
            'parent'        => $row_link_2
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'link_hover_fontdecoration',
            'default_value' => '',
            'label'         => esc_html__('Hover Link Decoration', 'anahata'),
            'options'       => anahata_mikado_get_text_decorations(),
            'parent'        => $row_link_2
        ));

    }

    add_action('anahata_mikado_options_map', 'anahata_mikado_fonts_options_map', 2);
}