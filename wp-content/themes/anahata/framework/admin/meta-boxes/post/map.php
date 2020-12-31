<?php

/*** Post Options ***/

$post_meta_box = anahata_mikado_create_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Post', 'anahata'),
        'name'  => 'post-meta'
    )
);

$all_pages = array(
    '' => 'Default'
);

$pages = get_pages();
foreach($pages as $page) {
    $all_pages[$page->ID] = $page->post_title;
}

anahata_mikado_create_meta_box_field(array(
    'name'          => 'mkd_blog_masonry_gallery_dimensions',
    'type'          => 'select',
    'label'         => esc_html__('Dimensions for Masonry Gallery', 'anahata'),
    'description'   => esc_html__('Choose image layout when it appears in Masonry Gallery list', 'anahata'),
    'parent'        => $post_meta_box,
    'options'       => array(
        'square'             => esc_html__('Square', 'anahata'),
        'large-width'        => esc_html__('Large width', 'anahata'),
        'large-height'       => esc_html__('Large height', 'anahata'),
        'large-width-height' => esc_html__('Large width/height', 'anahata')
    ),
    'default_value' => 'square'
));
