<?php do_action('anahata_mikado_before_site_logo'); ?>

	<div class="mkd-logo-wrapper">
		<a href="<?php echo esc_url(home_url('/')); ?>" <?php anahata_mikado_inline_style($logo_styles); ?>>
			<img <?php echo anahata_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkd-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_attr_e('logo', 'anahata'); ?>"/>
			<?php if(!empty($logo_image_dark)) { ?>
				<img <?php echo anahata_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkd-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="<?php esc_attr_e('dark logo', 'anahata'); ?>"/><?php } ?>
			<?php if(!empty($logo_image_light)) { ?>
				<img <?php echo anahata_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkd-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="<?php esc_attr_e('light logo', 'anahata'); ?>"/><?php } ?>
		</a>
	</div>

<?php do_action('anahata_mikado_after_site_logo'); ?>