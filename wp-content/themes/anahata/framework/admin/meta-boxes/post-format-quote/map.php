<?php

/*** Quote Post Format ***/

$quote_post_format_meta_box = anahata_mikado_create_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Quote Post Format', 'anahata'),
        'name'  => 'post_format_quote_meta'
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_post_quote_text_meta',
        'type'        => 'text',
        'label'       => esc_html__('Quote Text', 'anahata'),
        'description' => esc_html__('Enter Quote text', 'anahata'),
        'parent'      => $quote_post_format_meta_box,

    )
);
