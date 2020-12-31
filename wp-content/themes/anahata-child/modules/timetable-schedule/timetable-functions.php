<?php

//if(!function_exists('anahata_mikado_timetable_assets')) {
//    /**
//     * Loads all assets for timetable plugin
//     */
//    function anahata_mikado_timetable_assets() {
//        wp_enqueue_style('anahata_mikado_timetable', MIKADO_ASSETS_ROOT.'/css/timetable-schedule.min.css');
//
//        if(anahata_mikado_is_responsive_on()) {
//            wp_enqueue_style('anahata_mikado_timetable_responsive', MIKADO_ASSETS_ROOT.'/css/timetable-schedule-responsive.min.css');
//        }
//    }
//
//    add_action('wp_enqueue_scripts', 'anahata_mikado_timetable_assets', 20);
//}

if(!function_exists('anahata_mikado_timetable_style_dynamic_deps')) {
    /**
     * Adds dependency for style dynamic css file
     *
     * @param $deps
     *
     * @return array
     */
    function anahata_mikado_timetable_style_dynamic_deps($deps) {
        $deps[] = 'anahata_mikado_timetable';

        return $deps;
    }

    add_filter('anahata_mikado_style_dynamic_dependencies', 'anahata_mikado_timetable_style_dynamic_deps');
}

if(!function_exists('anahata_mikado_tt_event_single_content')) {
    /**
     * Loads timetable single event page
     */
    function anahata_mikado_tt_event_single_content() {
        $id = get_the_ID();

        $subtitle = get_post_meta($id, 'timetable_subtitle', true);

        $params = array(
            'subtitle' => $subtitle
        );

        anahata_mikado_get_module_template_part('templates/events-single', 'timetable-schedule', '', $params);
    }
}

if(!function_exists('anahata_mikado_tt_events_single_default_sidebar')) {
    /**
     * Sets default sidebar for timetable single event event
     *
     * @param $sidebar
     *
     * @return string
     */
    function anahata_mikado_tt_events_single_default_sidebar($sidebar) {
        $id = anahata_mikado_get_page_id();

        if(get_post_type($id) === 'tt-events') {
            $sidebar = 'sidebar-event';

            if(get_post_meta($id, 'mkd_custom_sidebar_meta', true) != '') {
                $sidebar = get_post_meta($id, 'mkd_custom_sidebar_meta', true);
            }
        }

        return $sidebar;
    }

    add_filter('anahata_mikado_sidebar', 'anahata_mikado_tt_events_single_default_sidebar');
}

