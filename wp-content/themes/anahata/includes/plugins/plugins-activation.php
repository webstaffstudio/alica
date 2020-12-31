<?php

if(!function_exists('anahata_mikado_register_required_plugins')) {
    /**
     * Registers Visual Composer, Layer Slider, Revolution Slider, Mikado Core, Mikado Instagram Feed, Mikado Twitter Feed  as required plugins. Hooks to tgmpa_register hook
     */
    function anahata_mikado_register_required_plugins() {
        $plugins = array(
            array(
                'name'               => esc_html__('WPBakery Visual Composer', 'anahata'),
                'slug'               => 'js_composer',
                'source'             => get_template_directory().'/includes/plugins/js_composer.zip',
                'required'           => true,
                'version'            => '6.4.1',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
            array(
                'name'               => esc_html__('Revolution Slider', 'anahata'),
                'slug'               => 'revslider',
                'source'             => get_template_directory().'/includes/plugins/revslider.zip',
				'version'            => '6.2.23',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
            array(
                'name'               => esc_html__('Mikado Core', 'anahata'),
                'slug'               => 'mikado-core',
                'source'             => get_template_directory().'/includes/plugins/mikado-core.zip',
                'required'           => true,
                'version'            => '1.0.6',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
            array(
                'name'               => esc_html__('Mikado Instagram Feed', 'anahata'),
                'slug'               => 'mikado-instagram-feed',
                'source'             => get_template_directory().'/includes/plugins/mikado-instagram-feed.zip',
                'required'           => true,
                'version'            => '2.0',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
            array(
                'name'               => esc_html__('Mikado Twitter Feed', 'anahata'),
                'slug'               => 'mikado-twitter-feed',
                'source'             => get_template_directory().'/includes/plugins/mikado-twitter-feed.zip',
                'required'           => true,
                'version'            => '1.0.2',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
			array(
                'name'               => esc_html__('Timetable', 'anahata'),
                'slug'               => 'timetable',
                'source'             => get_template_directory().'/includes/plugins/timetable.zip',
                'required'           => true,
                'version'            => '6.3',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
            array(
                'name'                  => esc_html__( 'WooCommerce', 'anahata' ),
                'slug'                  => 'woocommerce',
                'external_url'          => 'https://wordpress.org/plugins/woocommerce/',
                'required'              => false
            ),
            array(
                'name'                  => esc_html__( 'Contact Form 7', 'anahata' ),
                'slug'                  => 'contact-form-7',
                'external_url'          => 'https://wordpress.org/plugins/contact-form-7/',
                'required'              => false
            ),
            array(
                'name'                  => esc_html__( 'The Events Calendar', 'anahata' ),
                'slug'                  => 'the-events-calendar',
                'external_url'          => 'https://wordpress.org/plugins/the-events-calendar/',
                'required'              => false
            ),
			array(
				'name'     => esc_html__( 'Envato Market', 'anahata' ),
				'slug'     => 'envato-market',
				'source'   => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
				'required' => false
			)
		);

        $config = array(
            'domain'       => 'anahata',
            'default_path' => '',
            'parent_slug'  => 'themes.php',
            'capability'   => 'edit_theme_options',
            'menu'         => 'install-required-plugins',
            'has_notices'  => true,
            'is_automatic' => false,
            'message'      => '',
            'strings'      => array(
                'page_title'                      => esc_html__('Install Required Plugins', 'anahata'),
                'menu_title'                      => esc_html__('Install Plugins', 'anahata'),
                'installing'                      => esc_html__('Installing Plugin: %s', 'anahata'),
                'oops'                            => esc_html__('Something went wrong with the plugin API.', 'anahata'),
                'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'anahata'),
                'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'anahata'),
                'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'anahata'),
                'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'anahata'),
                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'anahata'),
                'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'anahata'),
                'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'anahata'),
                'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'anahata'),
                'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins', 'anahata'),
                'activate_link'                   => _n_noop('Activate installed plugin', 'Activate installed plugins', 'anahata'),
                'return'                          => esc_html__('Return to Required Plugins Installer', 'anahata'),
                'plugin_activated'                => esc_html__('Plugin activated successfully.', 'anahata'),
                'complete'                        => esc_html__('All plugins installed and activated successfully. %s', 'anahata'),
                'nag_type'                        => 'updated'
            )
        );

        tgmpa($plugins, $config);
    }

    add_action('tgmpa_register', 'anahata_mikado_register_required_plugins');
}