<?php

if(!function_exists('anahata_mikado_sidearea_options_map')) {

    function anahata_mikado_sidearea_options_map() {

        anahata_mikado_add_admin_page(
            array(
                'slug'  => '_side_area_page',
                'title' => esc_html__('Side Area', 'anahata'),
                'icon'  => 'icon_menu'
            )
        );

        $side_area_panel = anahata_mikado_add_admin_panel(
            array(
                'title' => esc_html__('Side Area', 'anahata'),
                'name'  => 'side_area',
                'page'  => '_side_area_page'
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_type',
                'default_value' => 'side-menu-slide-from-right',
                'label'         => esc_html__('Side Area Type', 'anahata'),
                'description'   => esc_html__('Choose a type of Side Area', 'anahata'),
                'options'       => array(
                    'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'anahata'),
                    'side-menu-slide-with-content'     => esc_html__('Slide from Right With Content', 'anahata'),
                    'side-area-uncovered-from-content' => esc_html__('Side Area Uncovered from Content', 'anahata')
                ),
                'args'          => array(
                    'dependence' => true,
                    'hide'       => array(
                        'side-menu-slide-from-right'       => '#mkd_side_area_slide_with_content_container',
                        'side-menu-slide-with-content'     => '#mkd_side_area_width_container',
                        'side-area-uncovered-from-content' => '#mkd_side_area_width_container, #mkd_side_area_slide_with_content_container'
                    ),
                    'show'       => array(
                        'side-menu-slide-from-right'       => '#mkd_side_area_width_container',
                        'side-menu-slide-with-content'     => '#mkd_side_area_slide_with_content_container',
                        'side-area-uncovered-from-content' => ''
                    )
                )
            )
        );

        $side_area_width_container = anahata_mikado_add_admin_container(
            array(
                'parent'          => $side_area_panel,
                'name'            => 'side_area_width_container',
                'hidden_property' => 'side_area_type',
                'hidden_value'    => '',
                'hidden_values'   => array(
                    'side-menu-slide-with-content',
                    'side-area-uncovered-from-content'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_width',
                'default_value' => '',
                'label'         => esc_html__('Side Area Width', 'anahata'),
                'description'   => esc_html__('Enter a width for Side Area (in percentages, enter more than 30)', 'anahata'),
                'args'          => array(
                    'col_width' => 3,
                    'suffix'    => '%'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'color',
                'name'          => 'side_area_content_overlay_color',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Color', 'anahata'),
                'description'   => esc_html__('Choose a background color for a content overlay', 'anahata'),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_content_overlay_opacity',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Transparency', 'anahata'),
                'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'anahata'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        $side_area_slide_with_content_container = anahata_mikado_add_admin_container(
            array(
                'parent'          => $side_area_panel,
                'name'            => 'side_area_slide_with_content_container',
                'hidden_property' => 'side_area_type',
                'hidden_value'    => '',
                'hidden_values'   => array(
                    'side-menu-slide-from-right',
                    'side-area-uncovered-from-content'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_slide_with_content_container,
                'type'          => 'select',
                'name'          => 'side_area_slide_with_content_width',
                'default_value' => 'width-470',
                'label'         => esc_html__('Side Area Width', 'anahata'),
                'description'   => esc_html__('Choose width for Side Area', 'anahata'),
                'options'       => array(
                    'width-270' => '270px',
                    'width-370' => '370px',
                    'width-470' => '470px'
                )
            )
        );

        anahata_mikado_add_admin_field(array(
                'parent'      => $side_area_panel,
                'type'        => 'image',
                'name'        => 'side_area_bakground_image',
                'label'       => esc_html__('Side Area Background Image', 'anahata'),
                'description' => esc_html__('Choose background image for Side Area', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'yesno',
                'name'          => 'side_area_enable_default_opener',
                'default_value' => 'yes',
                'label'         => esc_html__('Enable Default Side Area Opener Icon', 'anahata'),
                'description'   => esc_html__('Enabling this option will enable default side area opener icon', 'anahata'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_show_on_yes' => '',
                    'dependence_hide_on_yes' => '#mkd_side_area_opener_icon_container_no_style'
                )
            )
        );

//init icon pack hide and show array. It will be populated dinamically from collections array
        $side_area_icon_pack_hide_array = array();
        $side_area_icon_pack_show_array = array();

//do we have some collection added in collections array?
        if(is_array(anahata_mikado_icon_collections()->iconCollections) && count(anahata_mikado_icon_collections()->iconCollections)) {
            //get collections params array. It will contain values of 'param' property for each collection
            $side_area_icon_collections_params = anahata_mikado_icon_collections()->getIconCollectionsParams();

            //foreach collection generate hide and show array
            foreach(anahata_mikado_icon_collections()->iconCollections as $dep_collection_key => $dep_collection_object) {
                $side_area_icon_pack_hide_array[$dep_collection_key] = '';

                //we need to include only current collection in show string as it is the only one that needs to show
                $side_area_icon_pack_show_array[$dep_collection_key] = '#mkd_side_area_icon_'.$dep_collection_object->param.'_container';

                //for all collections param generate hide string
                foreach($side_area_icon_collections_params as $side_area_icon_collections_param) {
                    //we don't need to include current one, because it needs to be shown, not hidden
                    if($side_area_icon_collections_param !== $dep_collection_object->param) {
                        $side_area_icon_pack_hide_array[$dep_collection_key] .= '#mkd_side_area_icon_'.$side_area_icon_collections_param.'_container,';
                    }
                }

                //remove remaining ',' character
                $side_area_icon_pack_hide_array[$dep_collection_key] = rtrim($side_area_icon_pack_hide_array[$dep_collection_key], ',');
            }

        }

        $side_area_opener_icon_container_no_style = anahata_mikado_add_admin_container_no_style(array(
            'name'            => 'side_area_opener_icon_container_no_style',
            'parent'          => $side_area_panel,
            'hidden_property' => 'side_area_enable_default_opener',
            'hidden_value'    => 'yes'
        ));

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_opener_icon_container_no_style,
                'type'          => 'select',
                'name'          => 'side_area_button_icon_pack',
                'default_value' => 'font_awesome',
                'label'         => esc_html__('Side Area Button Icon Pack', 'anahata'),
                'description'   => esc_html__('Choose icon pack for side area button', 'anahata'),
                'options'       => anahata_mikado_icon_collections()->getIconCollections(),
                'args'          => array(
                    'dependence' => true,
                    'hide'       => $side_area_icon_pack_hide_array,
                    'show'       => $side_area_icon_pack_show_array
                )
            )
        );

        if(is_array(anahata_mikado_icon_collections()->iconCollections) && count(anahata_mikado_icon_collections()->iconCollections)) {
            //foreach icon collection we need to generate separate container that will have dependency set
            //it will have one field inside with icons dropdown
            foreach(anahata_mikado_icon_collections()->iconCollections as $collection_key => $collection_object) {
                $icons_array = $collection_object->getIconsArray();

                //get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
                $icon_collections_keys = anahata_mikado_icon_collections()->getIconCollectionsKeys();

                //unset current one, because it doesn't have to be included in dependency that hides icon container
                unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

                $side_area_icon_hide_values = $icon_collections_keys;

                $side_area_icon_container = anahata_mikado_add_admin_container(
                    array(
                        'parent'          => $side_area_opener_icon_container_no_style,
                        'name'            => 'side_area_icon_'.$collection_object->param.'_container',
                        'hidden_property' => 'side_area_button_icon_pack',
                        'hidden_value'    => '',
                        'hidden_values'   => $side_area_icon_hide_values
                    )
                );

                anahata_mikado_add_admin_field(
                    array(
                        'parent'        => $side_area_icon_container,
                        'type'          => 'select',
                        'name'          => 'side_area_icon_'.$collection_object->param,
                        'default_value' => 'fa-bars',
                        'label'         => esc_html__('Side Area Icon', 'anahata'),
                        'description'   => esc_html__('Choose Side Area Icon', 'anahata'),
                        'options'       => $icons_array,
                    )
                );

            }

        }

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_opener_icon_container_no_style,
                'type'          => 'text',
                'name'          => 'side_area_icon_font_size',
                'default_value' => '',
                'label'         => esc_html__('Side Area Icon Size', 'anahata'),
                'description'   => esc_html__('Choose a size for Side Area (px)', 'anahata'),
                'args'          => array(
                    'col_width' => 3,
                    'suffix'    => 'px'
                ),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_opener_icon_container_no_style,
                'type'          => 'select',
                'name'          => 'side_area_predefined_icon_size',
                'default_value' => 'normal',
                'label'         => esc_html__('Predefined Side Area Icon Size', 'anahata'),
                'description'   => esc_html__('Choose predefined size for Side Area icons', 'anahata'),
                'options'       => array(
                    'normal' => esc_html__('Normal', 'anahata'),
                    'medium' => esc_html__('Medium', 'anahata'),
                    'large'  => esc_html__('Large', 'anahata')
                ),
            )
        );

        $side_area_icon_style_group = anahata_mikado_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'side_area_icon_style_group',
                'title'       => esc_html__('Side Area Icon Style', 'anahata'),
                'description' => esc_html__('Define styles for Side Area icon', 'anahata')
            )
        );

        $side_area_icon_style_row1 = anahata_mikado_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row1'
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_icon_style_row1,
                'type'          => 'colorsimple',
                'name'          => 'side_area_icon_color',
                'default_value' => '',
                'label'         => esc_html__('Color', 'anahata'),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_icon_style_row1,
                'type'          => 'colorsimple',
                'name'          => 'side_area_icon_hover_color',
                'default_value' => '',
                'label'         => esc_html__('Hover Color', 'anahata'),
            )
        );

        $side_area_icon_style_row2 = anahata_mikado_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row2',
                'next'   => true
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_icon_style_row2,
                'type'          => 'colorsimple',
                'name'          => 'side_area_light_icon_color',
                'default_value' => '',
                'label'         => esc_html__('Light Menu Icon Color', 'anahata'),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_icon_style_row2,
                'type'          => 'colorsimple',
                'name'          => 'side_area_light_icon_hover_color',
                'default_value' => '',
                'label'         => esc_html__('Light Menu Icon Hover Color', 'anahata'),
            )
        );

        $side_area_icon_style_row3 = anahata_mikado_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row3',
                'next'   => true
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_icon_style_row3,
                'type'          => 'colorsimple',
                'name'          => 'side_area_dark_icon_color',
                'default_value' => '',
                'label'         => esc_html__('Dark Menu Icon Color', 'anahata'),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_icon_style_row3,
                'type'          => 'colorsimple',
                'name'          => 'side_area_dark_icon_hover_color',
                'default_value' => '',
                'label'         => esc_html__('Dark Menu Icon Hover Color', 'anahata'),
            )
        );

        $icon_spacing_group = anahata_mikado_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'icon_spacing_group',
                'title'       => esc_html__('Side Area Icon Spacing', 'anahata'),
                'description' => esc_html__('Define padding and margin for side area icon', 'anahata')
            )
        );

        $icon_spacing_row = anahata_mikado_add_admin_row(
            array(
                'parent' => $icon_spacing_group,
                'name'   => 'icon_spancing_row',
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $icon_spacing_row,
                'type'          => 'textsimple',
                'name'          => 'side_area_icon_padding_left',
                'default_value' => '',
                'label'         => esc_html__('Padding Left', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $icon_spacing_row,
                'type'          => 'textsimple',
                'name'          => 'side_area_icon_padding_right',
                'default_value' => '',
                'label'         => esc_html__('Padding Right', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $icon_spacing_row,
                'type'          => 'textsimple',
                'name'          => 'side_area_icon_margin_left',
                'default_value' => '',
                'label'         => esc_html__('Margin Left', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $icon_spacing_row,
                'type'          => 'textsimple',
                'name'          => 'side_area_icon_margin_right',
                'default_value' => '',
                'label'         => esc_html__('Margin Right', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'yesno',
                'name'          => 'side_area_icon_border_yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Icon Border', 'anahata'),
                'descritption'  => esc_html__('Enable border around icon', 'anahata'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_side_area_icon_border_container'
                )
            )
        );

        $side_area_icon_border_container = anahata_mikado_add_admin_container(
            array(
                'parent'          => $side_area_panel,
                'name'            => 'side_area_icon_border_container',
                'hidden_property' => 'side_area_icon_border_yesno',
                'hidden_value'    => 'no'
            )
        );

        $border_style_group = anahata_mikado_add_admin_group(
            array(
                'parent'      => $side_area_icon_border_container,
                'name'        => 'border_style_group',
                'title'       => esc_html__('Border Style', 'anahata'),
                'description' => esc_html__('Define styling for border around icon', 'anahata')
            )
        );

        $border_style_row_1 = anahata_mikado_add_admin_row(
            array(
                'parent' => $border_style_group,
                'name'   => 'border_style_row_1',
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $border_style_row_1,
                'type'          => 'colorsimple',
                'name'          => 'side_area_icon_border_color',
                'default_value' => '',
                'label'         => esc_html__('Color', 'anahata'),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $border_style_row_1,
                'type'          => 'colorsimple',
                'name'          => 'side_area_icon_border_hover_color',
                'default_value' => '',
                'label'         => esc_html__('Hover Color', 'anahata'),
            )
        );

        $border_style_row_2 = anahata_mikado_add_admin_row(
            array(
                'parent' => $border_style_group,
                'name'   => 'border_style_row_2',
                'next'   => true
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $border_style_row_2,
                'type'          => 'textsimple',
                'name'          => 'side_area_icon_border_width',
                'default_value' => '',
                'label'         => esc_html__('Width', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $border_style_row_2,
                'type'          => 'textsimple',
                'name'          => 'side_area_icon_border_radius',
                'default_value' => '',
                'label'         => esc_html__('Radius', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $border_style_row_2,
                'type'          => 'selectsimple',
                'name'          => 'side_area_icon_border_style',
                'default_value' => '',
                'label'         => esc_html__('Style', 'anahata'),
                'options'       => array(
                    'solid'  => esc_html__('Solid', 'anahata'),
                    'dashed' => esc_html__('Dashed', 'anahata'),
                    'dotted' => esc_html__('Dotted', 'anahata')
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'selectblank',
                'name'          => 'side_area_aligment',
                'default_value' => '',
                'label'         => esc_html__('Text Aligment', 'anahata'),
                'description'   => esc_html__('Choose text aligment for side area', 'anahata'),
                'options'       => array(
                    'center' => esc_html__('Center', 'anahata'),
                    'left'   => esc_html__('Left', 'anahata'),
                    'right'  => esc_html__('Right', 'anahata')
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_title',
                'default_value' => '',
                'label'         => esc_html__('Side Area Title', 'anahata'),
                'description'   => esc_html__('Enter a title to appear in Side Area', 'anahata'),
                'args'          => array(
                    'col_width' => 3,
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'color',
                'name'          => 'side_area_background_color',
                'default_value' => '',
                'label'         => esc_html__('Background Color', 'anahata'),
                'description'   => esc_html__('Choose a background color for Side Area', 'anahata'),
            )
        );

        $padding_group = anahata_mikado_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'padding_group',
                'title'       => esc_html__('Padding', 'anahata'),
                'description' => esc_html__('Define padding for Side Area', 'anahata')
            )
        );

        $padding_row = anahata_mikado_add_admin_row(
            array(
                'parent' => $padding_group,
                'name'   => 'padding_row',
                'next'   => true
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $padding_row,
                'type'          => 'textsimple',
                'name'          => 'side_area_padding_top',
                'default_value' => '',
                'label'         => esc_html__('Top Padding', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $padding_row,
                'type'          => 'textsimple',
                'name'          => 'side_area_padding_right',
                'default_value' => '',
                'label'         => esc_html__('Right Padding', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $padding_row,
                'type'          => 'textsimple',
                'name'          => 'side_area_padding_bottom',
                'default_value' => '',
                'label'         => esc_html__('Bottom Padding', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $padding_row,
                'type'          => 'textsimple',
                'name'          => 'side_area_padding_left',
                'default_value' => '',
                'label'         => esc_html__('Left Padding', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_close_icon',
                'default_value' => 'light',
                'label'         => esc_html__('Close Icon Style', 'anahata'),
                'description'   => esc_html__('Choose a type of close icon', 'anahata'),
                'options'       => array(
                    'light' => 'Light',
                    'dark'  => 'Dark'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_close_icon_size',
                'default_value' => '',
                'label'         => esc_html__('Close Icon Size', 'anahata'),
                'description'   => esc_html__('Define close icon size', 'anahata'),
                'args'          => array(
                    'col_width' => 3,
                    'suffix'    => 'px'
                )
            )
        );

        $title_group = anahata_mikado_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'title_group',
                'title'       => esc_html__('Title', 'anahata'),
                'description' => esc_html__('Define Style for Side Area title', 'anahata')
            )
        );

        $title_row_1 = anahata_mikado_add_admin_row(
            array(
                'parent' => $title_group,
                'name'   => 'title_row_1',
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $title_row_1,
                'type'          => 'colorsimple',
                'name'          => 'side_area_title_color',
                'default_value' => '',
                'label'         => esc_html__('Text Color', 'anahata'),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $title_row_1,
                'type'          => 'textsimple',
                'name'          => 'side_area_title_fontsize',
                'default_value' => '',
                'label'         => esc_html__('Font Size', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $title_row_1,
                'type'          => 'textsimple',
                'name'          => 'side_area_title_lineheight',
                'default_value' => '',
                'label'         => esc_html__('Line Height', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $title_row_1,
                'type'          => 'selectblanksimple',
                'name'          => 'side_area_title_texttransform',
                'default_value' => '',
                'label'         => esc_html__('Text Transform', 'anahata'),
                'options'       => anahata_mikado_get_text_transform_array()
            )
        );

        $title_row_2 = anahata_mikado_add_admin_row(
            array(
                'parent' => $title_group,
                'name'   => 'title_row_2',
                'next'   => true
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $title_row_2,
                'type'          => 'fontsimple',
                'name'          => 'side_area_title_google_fonts',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'anahata'),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $title_row_2,
                'type'          => 'selectblanksimple',
                'name'          => 'side_area_title_fontstyle',
                'default_value' => '',
                'label'         => esc_html__('Font Style', 'anahata'),
                'options'       => anahata_mikado_get_font_style_array()
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $title_row_2,
                'type'          => 'selectblanksimple',
                'name'          => 'side_area_title_fontweight',
                'default_value' => '',
                'label'         => esc_html__('Font Weight', 'anahata'),
                'options'       => anahata_mikado_get_font_weight_array()
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $title_row_2,
                'type'          => 'textsimple',
                'name'          => 'side_area_title_letterspacing',
                'default_value' => '',
                'label'         => esc_html__('Letter Spacing', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );


        $text_group = anahata_mikado_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'text_group',
                'title'       => esc_html__('Text', 'anahata'),
                'description' => esc_html__('Define Style for Side Area text', 'anahata')
            )
        );

        $text_row_1 = anahata_mikado_add_admin_row(
            array(
                'parent' => $text_group,
                'name'   => 'text_row_1',
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $text_row_1,
                'type'          => 'colorsimple',
                'name'          => 'side_area_text_color',
                'default_value' => '',
                'label'         => esc_html__('Text Color', 'anahata'),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $text_row_1,
                'type'          => 'textsimple',
                'name'          => 'side_area_text_fontsize',
                'default_value' => '',
                'label'         => esc_html__('Font Size', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $text_row_1,
                'type'          => 'textsimple',
                'name'          => 'side_area_text_lineheight',
                'default_value' => '',
                'label'         => esc_html__('Line Height', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $text_row_1,
                'type'          => 'selectblanksimple',
                'name'          => 'side_area_text_texttransform',
                'default_value' => '',
                'label'         => esc_html__('Text Transform', 'anahata'),
                'options'       => anahata_mikado_get_text_transform_array()
            )
        );

        $text_row_2 = anahata_mikado_add_admin_row(
            array(
                'parent' => $text_group,
                'name'   => 'text_row_2',
                'next'   => true
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $text_row_2,
                'type'          => 'fontsimple',
                'name'          => 'side_area_text_google_fonts',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'anahata'),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $text_row_2,
                'type'          => 'fontsimple',
                'name'          => 'side_area_text_google_fonts',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'anahata'),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $text_row_2,
                'type'          => 'selectblanksimple',
                'name'          => 'side_area_text_fontstyle',
                'default_value' => '',
                'label'         => esc_html__('Font Style', 'anahata'),
                'options'       => anahata_mikado_get_font_style_array()
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $text_row_2,
                'type'          => 'selectblanksimple',
                'name'          => 'side_area_text_fontweight',
                'default_value' => '',
                'label'         => esc_html__('Font Weight', 'anahata'),
                'options'       => anahata_mikado_get_font_weight_array()
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $text_row_2,
                'type'          => 'textsimple',
                'name'          => 'side_area_text_letterspacing',
                'default_value' => '',
                'label'         => esc_html__('Letter Spacing', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        $widget_links_group = anahata_mikado_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'widget_links_group',
                'title'       => esc_html__('Link Style', 'anahata'),
                'description' => esc_html__('Define styles for Side Area widget links', 'anahata')
            )
        );

        $widget_links_row_1 = anahata_mikado_add_admin_row(
            array(
                'parent' => $widget_links_group,
                'name'   => 'widget_links_row_1',
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $widget_links_row_1,
                'type'          => 'colorsimple',
                'name'          => 'sidearea_link_color',
                'default_value' => '',
                'label'         => esc_html__('Text Color', 'anahata'),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $widget_links_row_1,
                'type'          => 'textsimple',
                'name'          => 'sidearea_link_font_size',
                'default_value' => '',
                'label'         => esc_html__('Font Size', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $widget_links_row_1,
                'type'          => 'textsimple',
                'name'          => 'sidearea_link_line_height',
                'default_value' => '',
                'label'         => esc_html__('Line Height', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $widget_links_row_1,
                'type'          => 'selectblanksimple',
                'name'          => 'sidearea_link_text_transform',
                'default_value' => '',
                'label'         => esc_html__('Text Transform', 'anahata'),
                'options'       => anahata_mikado_get_text_transform_array()
            )
        );

        $widget_links_row_2 = anahata_mikado_add_admin_row(
            array(
                'parent' => $widget_links_group,
                'name'   => 'widget_links_row_2',
                'next'   => true
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $widget_links_row_2,
                'type'          => 'fontsimple',
                'name'          => 'sidearea_link_font_family',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'anahata'),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $widget_links_row_2,
                'type'          => 'selectblanksimple',
                'name'          => 'sidearea_link_font_style',
                'default_value' => '',
                'label'         => esc_html__('Font Style', 'anahata'),
                'options'       => anahata_mikado_get_font_style_array()
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $widget_links_row_2,
                'type'          => 'selectblanksimple',
                'name'          => 'sidearea_link_font_weight',
                'default_value' => '',
                'label'         => esc_html__('Font Weight', 'anahata'),
                'options'       => anahata_mikado_get_font_weight_array()
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $widget_links_row_2,
                'type'          => 'textsimple',
                'name'          => 'sidearea_link_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__('Letter Spacing', 'anahata'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        $widget_links_row_3 = anahata_mikado_add_admin_row(
            array(
                'parent' => $widget_links_group,
                'name'   => 'widget_links_row_3',
                'next'   => true
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $widget_links_row_3,
                'type'          => 'colorsimple',
                'name'          => 'sidearea_link_hover_color',
                'default_value' => '',
                'label'         => esc_html__('Hover Color', 'anahata'),
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'yesno',
                'name'          => 'side_area_enable_bottom_border',
                'default_value' => 'no',
                'label'         => esc_html__('Border Bottom on Elements', 'anahata'),
                'description'   => esc_html__('Enable border bottom on elements in side area', 'anahata'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_side_area_bottom_border_container'
                )
            )
        );

        $side_area_bottom_border_container = anahata_mikado_add_admin_container(
            array(
                'parent'          => $side_area_panel,
                'name'            => 'side_area_bottom_border_container',
                'hidden_property' => 'side_area_enable_bottom_border',
                'hidden_value'    => 'no'
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $side_area_bottom_border_container,
                'type'          => 'color',
                'name'          => 'side_area_bottom_border_color',
                'default_value' => '',
                'label'         => esc_html__('Border Bottom Color', 'anahata'),
                'description'   => esc_html__('Choose color for border bottom on elements in sidearea', 'anahata')
            )
        );

    }

    add_action('anahata_mikado_options_map', 'anahata_mikado_sidearea_options_map', 5);

}