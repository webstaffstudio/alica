<?php

if(!function_exists('anahata_mikado_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function anahata_mikado_register_sidebars() {

        register_sidebar(array(
            'name'          => esc_html__('Sidebar', 'anahata'),
            'id'            => 'sidebar',
            'description'   => esc_html__('Default Sidebar', 'anahata'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3><span class="mkd-sidearea-title">',
            'after_title'   => '</span></h3>'
        ));

    }

    add_action('widgets_init', 'anahata_mikado_register_sidebars');
}

if(!function_exists('anahata_mikado_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates AnahataMikadoSidebar object
     */
    function anahata_mikado_add_support_custom_sidebar() {
        add_theme_support('AnahataMikadoSidebar');
        if(get_theme_support('AnahataMikadoSidebar')) {
            new AnahataMikadoSidebar();
        }
    }

    add_action('after_setup_theme', 'anahata_mikado_add_support_custom_sidebar');
}
