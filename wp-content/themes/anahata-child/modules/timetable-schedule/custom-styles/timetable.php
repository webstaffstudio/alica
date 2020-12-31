<?php

if(!function_exists('anahata_mikado_timetable_custom_styles')) {
    /**
     * Outputs custom styles for timetable
     */
    function anahata_mikado_timetable_custom_styles() {
        if(anahata_mikado_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
                '.widget.upcoming_events_widget .tt_upcoming_event_controls a:hover'
            );

            $color_important_selector = array(
                'table.tt_timetable .event a:hover',
                'table.tt_timetable .event a.event_header:hover',
                '.tt_tabs .tt_tabs_navigation li a:hover',
                '.tt_tabs .tt_tabs_navigation .ui-tabs-active a',
                '.mkd-ttevents-single .tt_event_items_list li.type_info .tt_event_text',
                '.mkd-ttevents-single .tt_event_items_list li:not(.type_info):before'
            );

            $background_color_selector = array(
                '.events_filter.tt_tabs_navigation li a',
                '.tt_tabs .tt_tabs_navigation li a'
            );

            $background_color_important_selector = array();

            $border_color_selector = array(
                '.widget.upcoming_events_widget .tt_upcoming_event_controls a:hover'
            );

            $border_color_important_selector = array(
                '.tt_tabs .tt_tabs_navigation li a',
                '.tt_tabs .tt_tabs_navigation li a:hover',
                '.tt_tabs .tt_tabs_navigation .ui-tabs-active a'
            );

            echo anahata_mikado_dynamic_css($color_selector, array('color' => anahata_mikado_options()->getOptionValue('first_color')));
            echo anahata_mikado_dynamic_css($color_important_selector, array('color' => anahata_mikado_options()->getOptionValue('first_color').'!important'));
            echo anahata_mikado_dynamic_css('::selection', array('background' => anahata_mikado_options()->getOptionValue('first_color')));
            echo anahata_mikado_dynamic_css('::-moz-selection', array('background' => anahata_mikado_options()->getOptionValue('first_color')));
            echo anahata_mikado_dynamic_css($background_color_selector, array('background-color' => anahata_mikado_options()->getOptionValue('first_color')));
            echo anahata_mikado_dynamic_css($background_color_important_selector, array('background-color' => anahata_mikado_options()->getOptionValue('first_color').'!important'));
            echo anahata_mikado_dynamic_css($border_color_selector, array('border-color' => anahata_mikado_options()->getOptionValue('first_color')));

            if(is_array($border_color_important_selector) && count($border_color_important_selector)) {
                echo anahata_mikado_dynamic_css($border_color_important_selector, array('border-color' => anahata_mikado_options()->getOptionValue('first_color').'!important'));
            }


        }
    }

    add_action('anahata_mikado_style_dynamic', 'anahata_mikado_timetable_custom_styles');
}