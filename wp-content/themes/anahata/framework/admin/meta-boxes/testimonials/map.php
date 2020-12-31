<?php

//Testimonials

$testimonial_meta_box = anahata_mikado_create_meta_box(
    array(
        'scope' => array('testimonials'),
        'title' => esc_html__('Testimonial', 'anahata'),
        'name'  => 'testimonial_meta'
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_testimonial_title',
        'type'        => 'text',
        'label'       => esc_html__('Title', 'anahata'),
        'description' => esc_html__('Enter testimonial title', 'anahata'),
        'parent'      => $testimonial_meta_box,
    )
);


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_testimonial_author',
        'type'        => 'text',
        'label'       => esc_html__('Author', 'anahata'),
        'description' => esc_html__('Enter author name', 'anahata'),
        'parent'      => $testimonial_meta_box,
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_testimonial_author_position',
        'type'        => 'text',
        'label'       => esc_html__('Job Position', 'anahata'),
        'description' => esc_html__('Enter job position', 'anahata'),
        'parent'      => $testimonial_meta_box,
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_testimonial_text',
        'type'        => 'text',
        'label'       => esc_html__('Text', 'anahata'),
        'description' => esc_html__('Enter testimonial text', 'anahata'),
        'parent'      => $testimonial_meta_box,
    )
);