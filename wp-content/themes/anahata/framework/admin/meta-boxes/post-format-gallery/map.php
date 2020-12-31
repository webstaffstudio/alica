<?php

/*** Gallery Post Format ***/

$gallery_post_format_meta_box = anahata_mikado_create_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Gallery Post Format', 'anahata'),
        'name'  => 'post_format_gallery_meta'
    )
);

anahata_mikado_add_multiple_images_field(
    array(
        'name'        => 'mkd_post_gallery_images_meta',
        'label'       => esc_html__('Gallery Images', 'anahata'),
        'description' => esc_html__('Choose your gallery images', 'anahata'),
        'parent'      => $gallery_post_format_meta_box,
    )
);
