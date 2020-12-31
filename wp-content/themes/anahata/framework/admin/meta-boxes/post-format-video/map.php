<?php

/*** Video Post Format ***/

$video_post_format_meta_box = anahata_mikado_create_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Video Post Format', 'anahata'),
        'name'  => 'post_format_video_meta'
    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'          => 'mkd_video_type_meta',
        'type'          => 'select',
        'label'         => esc_html__('Video Type', 'anahata'),
        'description'   => esc_html__('Choose video type', 'anahata'),
        'parent'        => $video_post_format_meta_box,
        'default_value' => 'youtube',
        'options'       => array(
            'youtube' => esc_html__('Youtube', 'anahata'),
            'vimeo'   => esc_html__('Vimeo', 'anahata'),
            'self'    => esc_html__('Self Hosted', 'anahata')
        ),
        'args'          => array(
            'dependence' => true,
            'hide'       => array(
                'youtube' => '#mkd_mkd_video_self_hosted_container',
                'vimeo'   => '#mkd_mkd_video_self_hosted_container',
                'self'    => '#mkd_mkd_video_embedded_container'
            ),
            'show'       => array(
                'youtube' => '#mkd_mkd_video_embedded_container',
                'vimeo'   => '#mkd_mkd_video_embedded_container',
                'self'    => '#mkd_mkd_video_self_hosted_container'
            )
        )
    )
);

$mkd_video_embedded_container = anahata_mikado_add_admin_container(
    array(
        'parent'          => $video_post_format_meta_box,
        'name'            => 'mkd_video_embedded_container',
        'hidden_property' => 'mkd_video_type_meta',
        'hidden_value'    => 'self'
    )
);

$mkd_video_self_hosted_container = anahata_mikado_add_admin_container(
    array(
        'parent'          => $video_post_format_meta_box,
        'name'            => 'mkd_video_self_hosted_container',
        'hidden_property' => 'mkd_video_type_meta',
        'hidden_values'   => array('youtube', 'vimeo')
    )
);


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_post_video_id_meta',
        'type'        => 'text',
        'label'       => esc_html__('Video ID', 'anahata'),
        'description' => esc_html__('Enter Video ID', 'anahata'),
        'parent'      => $mkd_video_embedded_container,

    )
);


anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_post_video_image_meta',
        'type'        => 'image',
        'label'       => esc_html__('Video Image', 'anahata'),
        'description' => esc_html__('Upload video image', 'anahata'),
        'parent'      => $mkd_video_self_hosted_container,

    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_post_video_webm_link_meta',
        'type'        => 'text',
        'label'       => esc_html__('Video WEBM', 'anahata'),
        'description' => esc_html__('Enter video URL for WEBM format', 'anahata'),
        'parent'      => $mkd_video_self_hosted_container,

    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_post_video_mp4_link_meta',
        'type'        => 'text',
        'label'       => esc_html__('Video MP4', 'anahata'),
        'description' => esc_html__('Enter video URL for MP4 format', 'anahata'),
        'parent'      => $mkd_video_self_hosted_container,

    )
);

anahata_mikado_create_meta_box_field(
    array(
        'name'        => 'mkd_post_video_ogv_link_meta',
        'type'        => 'text',
        'label'       => esc_html__('Video OGV', 'anahata'),
        'description' => esc_html__('Enter video URL for OGV format', 'anahata'),
        'parent'      => $mkd_video_self_hosted_container,

    )
);