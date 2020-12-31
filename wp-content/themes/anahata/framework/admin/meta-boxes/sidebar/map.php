<?php

$custom_sidebars = anahata_mikado_get_custom_sidebars();

$sidebar_meta_box = anahata_mikado_create_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => esc_html__('Sidebar', 'anahata'),
        'name'  => 'sidebar_meta'
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_sidebar_meta',
        'type'        => 'select',
        'label'       => esc_html__('Layout', 'anahata'),
        'description' => esc_html__('Choose the sidebar layout', 'anahata'),
        'parent'      => $sidebar_meta_box,
        'options'     => array(
            ''                 => esc_html__('Default', 'anahata'),
            'no-sidebar'       => esc_html__('No Sidebar', 'anahata'),
            'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'anahata'),
            'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'anahata'),
            'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'anahata'),
            'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'anahata'),
        )
    )
);

if(count($custom_sidebars) > 0) {
    anahata_mikado_create_meta_box_field(array(
        'name'        => 'mkd_custom_sidebar_meta',
        'type'        => 'selectblank',
        'label'       => esc_html__('Choose Widget Area in Sidebar', 'anahata'),
        'description' => esc_html__('Choose Custom Widget area to display in Sidebar"', 'anahata'),
        'parent'      => $sidebar_meta_box,
        'options'     => $custom_sidebars
    ));
}
