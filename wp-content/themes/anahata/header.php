<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * @see anahata_mikado_header_meta() - hooked with 10
	 * @see mkd_user_scalable - hooked with 10
	 */
	?>
	<?php if (!anahata_mikado_is_ajax_request()) do_action('anahata_mikado_header_meta'); ?>

	<?php if (!anahata_mikado_is_ajax_request()) wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if (!anahata_mikado_is_ajax_request()) anahata_mikado_get_side_area(); ?>
<?php
$id = anahata_mikado_get_page_id();

if(anahata_mikado_get_meta_field_intersect('smooth_page_transitions',$id) === 'yes' &&
   anahata_mikado_get_meta_field_intersect('page_transition_preloader',$id) === 'yes') { ?>
    <div class="mkd-smooth-transition-loader mkd-mimic-ajax ?>">
		<div class="mkd-st-loader">
			<div class="mkd-st-loader1">
				<?php anahata_mikado_loading_spinners(); ?>
			</div>
		</div>
	</div>
<?php } ?>

<div class="mkd-wrapper">
	<div class="mkd-wrapper-inner">
		<?php if (!anahata_mikado_is_ajax_request()) anahata_mikado_get_header(); ?>

		<?php if ((!anahata_mikado_is_ajax_request()) && anahata_mikado_options()->getOptionValue('show_back_button') == "yes") { ?>
			<a id='mkd-back-to-top' href='#'>
                <span class="mkd-icon-stack">
                     <?php echo anahata_mikado_icon_collections()->renderIcon('lnr-chevron-up', 'linear_icons'); ?>
                </span>
			</a>
		<?php } ?>
        <?php if (!anahata_mikado_is_ajax_request()) anahata_mikado_get_full_screen_menu(); ?>
		<div class="mkd-content" <?php anahata_mikado_content_elem_style_attr(); ?>>
			<?php if (anahata_mikado_is_ajax_enabled()) { ?>
				<div class="mkd-meta">
					<?php do_action('anahata_mikado_ajax_meta'); ?>
					<span id="mkd-page-id"><?php echo esc_html($wp_query->get_queried_object_id()); ?></span>

					<div class="mkd-body-classes"><?php echo esc_html(implode(',', get_body_class())); ?></div>
				</div>
			<?php } ?>
			<div class="mkd-content-inner">