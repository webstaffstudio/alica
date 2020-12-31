<?php

if(!function_exists('anahata_mikado_map_portfolio_settings')) {
    function anahata_mikado_map_portfolio_settings() {
        $meta_box = anahata_mikado_create_meta_box(array(
            'scope' => 'portfolio-item',
            'title' => esc_html__('Portfolio Settings', 'anahata'),
            'name'  => 'portfolio_settings_meta_box'
        ));

        anahata_mikado_create_meta_box_field(array(
            'name'        => 'mkd_portfolio_single_template_meta',
            'type'        => 'select',
            'label'       => esc_html__('Portfolio Type', 'anahata'),
            'description' => esc_html__('Choose a default type for Single Project pages', 'anahata'),
            'parent'      => $meta_box,
            'options'     => array(
                ''                  => esc_html__('Default', 'anahata'),
                'small-images'      => esc_html__('Portfolio small images', 'anahata'),
                'small-slider'      => esc_html__('Portfolio small slider', 'anahata'),
                'big-images'        => esc_html__('Portfolio big images', 'anahata'),
                'big-slider'        => esc_html__('Portfolio big slider', 'anahata'),
                'custom'            => esc_html__('Portfolio custom', 'anahata'),
                'full-width-custom' => esc_html__('Portfolio full width custom', 'anahata'),
                'masonry'           => esc_html__('Portfolio masonry', 'anahata'),
                'gallery'           => esc_html__('Portfolio gallery', 'anahata')
            )
        ));

        $all_pages = array();
        $pages     = get_pages();
        foreach($pages as $page) {
            $all_pages[$page->ID] = $page->post_title;
        }

        anahata_mikado_create_meta_box_field(array(
            'name'        => 'portfolio_single_back_to_link',
            'type'        => 'select',
            'label'       => esc_html__('"Back To" Link', 'anahata'),
            'description' => esc_html__('Choose "Back To" page to link from portfolio Single Project page', 'anahata'),
            'parent'      => $meta_box,
            'options'     => $all_pages
        ));

        $group_portfolio_external_link = anahata_mikado_add_admin_group(array(
            'name'        => 'group_portfolio_external_link',
            'title'       => esc_html__('Portfolio External Link', 'anahata'),
            'description' => esc_html__('Enter URL to link from Portfolio List page', 'anahata'),
            'parent'      => $meta_box
        ));

        $row_portfolio_external_link = anahata_mikado_add_admin_row(array(
            'name'   => 'row_gradient_overlay',
            'parent' => $group_portfolio_external_link
        ));

        anahata_mikado_create_meta_box_field(array(
            'name'        => 'portfolio_external_link',
            'type'        => 'textsimple',
            'label'       => esc_html__('Link', 'anahata'),
            'description' => '',
            'parent'      => $row_portfolio_external_link,
            'args'        => array(
                'col_width' => 3
            )
        ));

        anahata_mikado_create_meta_box_field(array(
            'name'        => 'portfolio_external_link_target',
            'type'        => 'selectsimple',
            'label'       => esc_html__('Target', 'anahata'),
            'description' => '',
            'parent'      => $row_portfolio_external_link,
            'options'     => array(
                '_self'  => esc_html__('Same Window', 'anahata'),
                '_blank' => esc_html__('New Window', 'anahata')
            )
        ));


        anahata_mikado_create_meta_box_field(array(
            'name'        => 'portfolio_masonry_dimenisions',
            'type'        => 'select',
            'label'       => esc_html__('Dimensions for Masonry', 'anahata'),
            'description' => esc_html__('Choose image layout when it appears in Masonry type portfolio lists', 'anahata'),
            'parent'      => $meta_box,
            'options'     => array(
                'default'            => esc_html__('Default', 'anahata'),
                'large_width'        => esc_html__('Large width', 'anahata'),
                'large_height'       => esc_html__('Large height', 'anahata'),
                'large_width_height' => esc_html__('Large width/height', 'anahata')
            )
        ));

        anahata_mikado_create_meta_box_field(
            array(
                'name'        => 'portfolio_background_color',
                'type'        => 'color',
                'label'       => esc_html__('Portfolio Background Color', 'anahata'),
                'description' => esc_html__('Portfolio background color used for some portfolio list hover animations', 'anahata'),
                'parent'      => $meta_box,
            )
        );
    }

    add_action('anahata_mikado_meta_boxes_map', 'anahata_mikado_map_portfolio_settings');
}