<?php

if(!function_exists('anahata_mikado_blog_options_map')) {

    function anahata_mikado_blog_options_map() {

        anahata_mikado_add_admin_page(
            array(
                'slug'  => '_blog_page',
                'title' => esc_html__('Blog', 'anahata'),
                'icon'  => 'icon_book_alt'
            )
        );

        /**
         * Blog Lists
         */

        $custom_sidebars = anahata_mikado_get_custom_sidebars();

        $panel_blog_lists = anahata_mikado_add_admin_panel(
            array(
                'page'  => '_blog_page',
                'name'  => 'panel_blog_lists',
                'title' => esc_html__('Blog Lists', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(array(
            'name'          => 'blog_list_type',
            'type'          => 'select',
            'label'         => esc_html__('Blog Layout for Archive Pages', 'anahata'),
            'description'   => esc_html__('Choose a default blog layout', 'anahata'),
            'default_value' => 'standard',
            'parent'        => $panel_blog_lists,
            'options'       => array(
                'standard'           => esc_html__(' Blog: Standard', 'anahata'),
                'simple'             => esc_html__('Blog: Simple', 'anahata'),
                'masonry'            => esc_html__('Blog: Masonry', 'anahata'),
                'masonry-full-width' => esc_html__('Blog: Masonry Full Width', 'anahata'),
                'masonry-no-image'   => esc_html__('Blog: Masonry No Image', 'anahata'),
                'masonry-simple'     => esc_html__('Blog: Masonry Simple', 'anahata'),
            )
        ));

        anahata_mikado_add_admin_field(array(
            'name'        => 'archive_sidebar_layout',
            'type'        => 'select',
            'label'       => esc_html__('Archive and Category Sidebar', 'anahata'),
            'description' => esc_html__('Choose a sidebar layout for archived Blog Post Lists and Category Blog Lists', 'anahata'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'default'          => esc_html__('No Sidebar', 'anahata'),
                'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'anahata'),
                'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'anahata'),
                'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'anahata'),
                'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'anahata'),
            )
        ));


        if(count($custom_sidebars) > 0) {
            anahata_mikado_add_admin_field(array(
                'name'        => 'blog_custom_sidebar',
                'type'        => 'selectblank',
                'label'       => esc_html__('Sidebar to Display', 'anahata'),
                'description' => esc_html__('Choose a sidebar to display on Blog Post Lists and Category Blog Lists. Default sidebar is "Sidebar Page"', 'anahata'),
                'parent'      => $panel_blog_lists,
                'options'     => anahata_mikado_get_custom_sidebars()
            ));
        }

        anahata_mikado_add_admin_field(array(
            'type'          => 'color',
            'name'          => 'blog_archive_background_color',
            'default_value' => '#fafafa',
            'label'         => esc_html__('Background color for Archive pages', 'anahata'),
            'description'   => esc_html__('Choose background color for blog archive pages', 'anahata'),
            'parent'        => $panel_blog_lists
        ));

        anahata_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'pagination',
                'default_value' => 'yes',
                'label'         => esc_html__('Pagination', 'anahata'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enabling this option will display pagination links on bottom of Blog Post List', 'anahata'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_pagination_container'
                )
            )
        );

        $pagination_container = anahata_mikado_add_admin_container(
            array(
                'name'            => 'mkd_pagination_container',
                'hidden_property' => 'pagination',
                'hidden_value'    => 'no',
                'parent'          => $panel_blog_lists,
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $pagination_container,
                'type'          => 'text',
                'name'          => 'blog_page_range',
                'default_value' => '',
                'label'         => esc_html__('Pagination Range limit', 'anahata'),
                'description'   => esc_html__('Enter a number that will limit pagination to a certain range of links', 'anahata'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        anahata_mikado_add_admin_field(array(
            'name'        => 'masonry_pagination',
            'type'        => 'select',
            'label'       => esc_html__('Pagination on Masonry', 'anahata'),
            'description' => esc_html__('Choose a pagination style for Masonry Blog List', 'anahata'),
            'parent'      => $pagination_container,
            'options'     => array(
                'no-pagination'   => esc_html__('No Pagination', 'anahata'),
                'standard'        => esc_html__('Standard', 'anahata'),
                'load-more'       => esc_html__('Load More', 'anahata'),
                'infinite-scroll' => esc_html__('Infinite Scroll', 'anahata')
            ),

        ));
        anahata_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'enable_load_more_pag',
                'default_value' => 'no',
                'label'         => esc_html__('Load More Pagination on Other Lists', 'anahata'),
                'parent'        => $pagination_container,
                'description'   => esc_html__('Enable Load More Pagination on other lists', 'anahata'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'masonry_filter',
                'default_value' => 'no',
                'label'         => esc_html__('Masonry Filter', 'anahata'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enabling this option will display category filter on Masonry and Masonry Full Width Templates', 'anahata'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_blog_filter_container'
                )
            )
        );

        $blog_filter_container = anahata_mikado_add_admin_container(
            array(
                'name'            => 'mkd_blog_filter_container',
                'hidden_property' => 'masonry_filter',
                'hidden_value'    => 'no',
                'parent'          => $panel_blog_lists,
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $blog_filter_container,
                'type'          => 'text',
                'name'          => 'blog_filter_margin',
                'default_value' => '0',
                'label'         => esc_html__('Masonry filter margin', 'anahata'),
                'description'   => esc_html__('Insert margin in format: 0px 0px 1px 0px', 'anahata'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $blog_filter_container,
                'type'          => 'text',
                'name'          => 'blog_filter_padding',
                'default_value' => '0',
                'label'         => esc_html__('Masonry filter padding', 'anahata'),
                'description'   => esc_html__('Insert padding in format: 0px 0px 1px 0px', 'anahata'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        anahata_mikado_add_admin_field(array(
            'name'          => 'blog_filter_position',
            'type'          => 'select',
            'label'         => esc_html__('Masonry filter position', 'anahata'),
            'description'   => esc_html__('Default value is center', 'anahata'),
            'parent'        => $blog_filter_container,
            'options'       => array(
                'center' => esc_html__('Center', 'anahata'),
                'left'   => esc_html__('Left', 'anahata'),
                'right'  => esc_html__('Right', 'anahata'),
            ),
            'default_value' => 'center'
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'color',
            'name'          => 'blog_filter_text_color',
            'default_value' => '#ffffff',
            'label'         => esc_html__('Masonry filter text color', 'anahata'),
            'description'   => esc_html__('Choose text color for masonry filter', 'anahata'),
            'parent'        => $blog_filter_container
        ));

        anahata_mikado_add_admin_field(array(
            'type'          => 'color',
            'name'          => 'blog_filter_background_color',
            'default_value' => '#ff4047',
            'label'         => esc_html__('Masonry filter background color', 'anahata'),
            'description'   => esc_html__('Choose background color for masonry filter', 'anahata'),
            'parent'        => $blog_filter_container
        ));

        anahata_mikado_add_admin_field(
            array(
                'parent'        => $blog_filter_container,
                'type'          => 'text',
                'name'          => 'blog_filter_background_transparency',
                'default_value' => '1',
                'label'         => esc_html__('Masonry filter background transparency', 'anahata'),
                'description'   => esc_html__('Choose a transparency for the masonry filter background color (0 = fully transparent, 1 = opaque)', 'anahata'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'type'          => 'text',
                'name'          => 'number_of_chars',
                'default_value' => '',
                'label'         => esc_html__('Number of Words in Excerpt', 'anahata'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'anahata'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );
        anahata_mikado_add_admin_field(
            array(
                'type'          => 'text',
                'name'          => 'standard_number_of_chars',
                'default_value' => '45',
                'label'         => esc_html__('Standard Type Number of Words in Excerpt', 'anahata'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'anahata'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );
        anahata_mikado_add_admin_field(
            array(
                'type'          => 'text',
                'name'          => 'masonry_number_of_chars',
                'default_value' => '45',
                'label'         => esc_html__('Masonry Type Number of Words in Excerpt', 'anahata'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'anahata'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );
        anahata_mikado_add_admin_field(
            array(
                'type'          => 'text',
                'name'          => 'split_column_number_of_chars',
                'default_value' => '45',
                'label'         => esc_html__('Split Column Type Number of Words in Excerpt', 'anahata'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'anahata'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        /**
         * Blog Single
         */
        $panel_blog_single = anahata_mikado_add_admin_panel(
            array(
                'page'  => '_blog_page',
                'name'  => 'panel_blog_single',
                'title' => esc_html__('Blog Single', 'anahata')
            )
        );

        anahata_mikado_add_admin_field(array(
            'name'          => 'blog_single_sidebar_layout',
            'type'          => 'select',
            'label'         => esc_html__('Sidebar Layout', 'anahata'),
            'description'   => esc_html__('Choose a sidebar layout for Blog Single pages', 'anahata'),
            'parent'        => $panel_blog_single,
            'options'       => array(
                'default'          => esc_html__('No Sidebar', 'anahata'),
                'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'anahata'),
                'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'anahata'),
                'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'anahata'),
                'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'anahata'),
            ),
            'default_value' => 'default'
        ));


        if(count($custom_sidebars) > 0) {
            anahata_mikado_add_admin_field(array(
                'name'        => 'blog_single_custom_sidebar',
                'type'        => 'selectblank',
                'label'       => esc_html__('Sidebar to Display', 'anahata'),
                'description' => esc_html__('Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'anahata'),
                'parent'      => $panel_blog_single,
                'options'     => anahata_mikado_get_custom_sidebars()
            ));
        }

        anahata_mikado_add_admin_field(array(
            'name'          => 'blog_single_title_in_title_area',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Post Title in Title Area', 'anahata'),
            'description'   => esc_html__('Enabling this option will show post title in title area on single post pages', 'anahata'),
            'parent'        => $panel_blog_single,
            'default_value' => 'no'
        ));

        anahata_mikado_add_admin_field(array(
            'name'          => 'blog_single_likes',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Likes', 'anahata'),
            'description'   => esc_html__('Enabling this option will show likes on your page.', 'anahata'),
            'parent'        => $panel_blog_single,
            'default_value' => 'yes'
        ));

        anahata_mikado_add_admin_field(array(
            'name'          => 'blog_single_comments',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Comments', 'anahata'),
            'description'   => esc_html__('Enabling this option will show comments on your page.', 'anahata'),
            'parent'        => $panel_blog_single,
            'default_value' => 'yes'
        ));

        anahata_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'blog_single_navigation',
                'default_value' => 'no',
                'label'         => esc_html__('Enable Prev/Next Single Post Navigation Links', 'anahata'),
                'parent'        => $panel_blog_single,
                'description'   => esc_html__('Enable navigation links through the blog posts (left and right arrows will appear)', 'anahata'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_blog_single_navigation_container'
                )
            )
        );

        $blog_single_navigation_container = anahata_mikado_add_admin_container(
            array(
                'name'            => 'mkd_blog_single_navigation_container',
                'hidden_property' => 'blog_single_navigation',
                'hidden_value'    => 'no',
                'parent'          => $panel_blog_single,
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'blog_navigation_through_same_category',
                'default_value' => 'no',
                'label'         => esc_html__('Enable Navigation Only in Current Category', 'anahata'),
                'description'   => esc_html__('Limit your navigation only through current category', 'anahata'),
                'parent'        => $blog_single_navigation_container,
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        anahata_mikado_add_admin_field(array(
            'type'          => 'yesno',
            'name'          => 'blog_enable_single_tags',
            'default_value' => 'yes',
            'label'         => esc_html__('Enable Tags on Single Post', 'anahata'),
            'description'   => esc_html__('Enabling this option will display posts\s tags on single post page', 'anahata'),
            'parent'        => $panel_blog_single
        ));


        anahata_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'blog_author_info',
                'default_value' => 'no',
                'label'         => esc_html__('Show Author Info Box', 'anahata'),
                'parent'        => $panel_blog_single,
                'description'   => esc_html__('Enabling this option will display author name and descriptions on Blog Single pages', 'anahata'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_blog_single_author_info_container'
                )
            )
        );

        $blog_single_author_info_container = anahata_mikado_add_admin_container(
            array(
                'name'            => 'mkd_blog_single_author_info_container',
                'hidden_property' => 'blog_author_info',
                'hidden_value'    => 'no',
                'parent'          => $panel_blog_single,
            )
        );

        anahata_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'blog_author_info_email',
                'default_value' => 'no',
                'label'         => esc_html__('Show Author Email', 'anahata'),
                'description'   => esc_html__('Enabling this option will show author email', 'anahata'),
                'parent'        => $blog_single_author_info_container,
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

    }

    add_action('anahata_mikado_options_map', 'anahata_mikado_blog_options_map', 12);

}











