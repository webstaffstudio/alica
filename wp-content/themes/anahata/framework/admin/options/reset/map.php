<?php

if(!function_exists('anahata_mikado_reset_options_map')) {
    /**
     * Reset options panel
     */
    function anahata_mikado_reset_options_map() {

        anahata_mikado_add_admin_page(
            array(
                'slug'  => '_reset_page',
                'title' => esc_html__('Reset', 'anahata'),
                'icon'  => 'icon_refresh'
            )
        );

        $panel_reset = anahata_mikado_add_admin_panel(
            array(
                'page'  => '_reset_page',
                'name'  => 'panel_reset',
                'title' => esc_html__('Reset', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(array(
            'type'          => 'yesno',
            'name'          => 'reset_to_defaults',
            'default_value' => 'no',
            'label'         => esc_html__('Reset to Defaults', 'anahata'),
            'description'   => esc_html__('This option will reset all Mikado Options values to defaults', 'anahata'),
            'parent'        => $panel_reset
        ));

    }

    add_action('anahata_mikado_options_map', 'anahata_mikado_reset_options_map', 19);

}