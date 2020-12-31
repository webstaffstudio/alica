<?php

/*** Audio Post Format ***/

$audio_post_format_meta_box = anahata_mikado_create_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Audio Post Format', 'anahata'),
        'name'  => 'post_format_audio_meta'
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_post_audio_link_meta',
        'type'        => 'text',
        'label'       => esc_html__('Link', 'anahata'),
        'description' => esc_html__('Enter audio link', 'anahata'),
        'parent'      => $audio_post_format_meta_box,

    )
);
