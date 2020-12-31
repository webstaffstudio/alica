<?php

if(!function_exists('anahata_mikado_portfolio_options_map')) {

	function anahata_mikado_portfolio_options_map() {

		anahata_mikado_add_admin_page(array(
			'slug'  => '_portfolio',
			'title' => esc_html__('Portfolio', 'anahata'),
			'icon'  => 'icon_images'
		));

		$panel = anahata_mikado_add_admin_panel(array(
			'title' => esc_html__('Portfolio Single', 'anahata'),
			'name'  => 'panel_portfolio_single',
			'page'  => '_portfolio'
		));

		anahata_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_template',
			'type'          => 'select',
			'label'         => esc_html__('Portfolio Type', 'anahata'),
			'default_value' => 'small-images',
			'description'   => esc_html__('Choose a default type for Single Project pages', 'anahata'),
			'parent'        => $panel,
			'options'       => array(
				'small-images'      => esc_html__('Portfolio small images', 'anahata'),
				'small-slider'      => esc_html__('Portfolio small slider', 'anahata'),
				'big-images'        => esc_html__('Portfolio big images', 'anahata'),
				'big-slider'        => esc_html__('Portfolio big slider', 'anahata'),
				'custom'            => esc_html__('Portfolio custom', 'anahata'),
				'full-width-custom' => esc_html__('Portfolio full width custom', 'anahata'),
				'masonry'   => esc_html__('Portfolio masonry', 'anahata'),
				'gallery'           => esc_html__('Portfolio gallery', 'anahata')
			)
		));

		anahata_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_images',
			'type'          => 'yesno',
			'label'         => esc_html__('Lightbox for Images', 'anahata'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for projects with images.', 'anahata'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		anahata_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_videos',
			'type'          => 'yesno',
			'label'         => esc_html__('Lightbox for Videos', 'anahata'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects.', 'anahata'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		anahata_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_categories',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Categories', 'anahata'),
			'description'   => esc_html__('Enabling this option will disable category meta description on Single Projects.', 'anahata'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		anahata_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_date',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Date', 'anahata'),
			'description'   => esc_html__('Enabling this option will disable date meta on Single Projects.', 'anahata'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		anahata_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_likes',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Likes', 'anahata'),
			'description'   => esc_html__('Enabling this option will show likes on your page.', 'anahata'),
			'parent'        => $panel,
			'default_value' => 'no'
		));


		anahata_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments', 'anahata'),
			'description'   => esc_html__('Enabling this option will show comments on your page.', 'anahata'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		anahata_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_sticky_sidebar',
			'type'          => 'yesno',
			'label'         => esc_html__('Sticky Side Text', 'anahata'),
			'description'   => esc_html__('Enabling this option will make side text sticky on Single Project pages', 'anahata'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		anahata_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_pagination',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Pagination', 'anahata'),
			'description'   => esc_html__('Enabling this option will turn off portfolio pagination functionality.', 'anahata'),
			'parent'        => $panel,
			'default_value' => 'no',
			'args'          => array(
				'dependence'             => true,
				'dependence_hide_on_yes' => '#mkd_navigate_same_category_container'
			)
		));

		$container_navigate_category = anahata_mikado_add_admin_container(array(
			'name'            => 'navigate_same_category_container',
			'parent'          => $panel,
			'hidden_property' => 'portfolio_single_hide_pagination',
			'hidden_value'    => 'yes'
		));

		anahata_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_nav_same_category',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Pagination Through Same Category', 'anahata'),
			'description'   => esc_html__('Enabling this option will make portfolio pagination sort through current category.', 'anahata'),
			'parent'        => $container_navigate_category,
			'default_value' => 'no'
		));

		anahata_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_numb_columns',
			'type'          => 'select',
			'label'         => esc_html__('Number of Columns', 'anahata'),
			'default_value' => 'three-columns',
			'description'   => esc_html__('Enter the number of columns for Portfolio Gallery type', 'anahata'),
			'parent'        => $panel,
			'options'       => array(
				'two-columns'   => esc_html__('2 columns', 'anahata'),
				'three-columns' => esc_html__('3 columns', 'anahata'),
				'four-columns'  => esc_html__('4 columns', 'anahata')
			)
		));

		anahata_mikado_add_admin_field(array(
			'name'        => 'portfolio_single_slug',
			'type'        => 'text',
			'label'       => esc_html__('Portfolio Single Slug', 'anahata'),
			'description' => esc_html__('Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'anahata'),
			'parent'      => $panel,
			'args'        => array(
				'col_width' => 3
			)
		));

	}

	add_action('anahata_mikado_options_map', 'anahata_mikado_portfolio_options_map', 14);

}