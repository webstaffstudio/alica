<?php

/*** Link Post Format ***/

$link_post_format_meta_box = anahata_mikado_create_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Link Post Format', 'anahata'),
        'name'  => 'post_format_link_meta'
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_post_link_link_meta',
        'type'        => 'text',
        'label'       => esc_html__('Link', 'anahata'),
        'description' => esc_html__('Enter link', 'anahata'),
        'parent'      => $link_post_format_meta_box,

    )
);

