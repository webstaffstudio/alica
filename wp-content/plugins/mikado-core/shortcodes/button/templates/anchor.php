<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php anahata_mikado_class_attribute($button_classes); ?> <?php echo anahata_mikado_get_inline_attrs($button_data); ?> <?php anahata_mikado_inline_style($button_styles); ?> <?php echo anahata_mikado_get_inline_attrs($button_custom_attrs); ?>>
	<span class="mkd-btn-text"><?php echo esc_html($text); ?></span>
	<span class="mkd-btn-overlay" <?php anahata_mikado_inline_style($button_styles); ?>></span>
	<?php if($show_icon) : ?>
		<span class="mkd-btn-icon-holder">
			<?php echo anahata_mikado_icon_collections()->renderIcon($icon, $icon_pack, array(
				'icon_attributes' => array(
					'class' => 'mkd-btn-icon-elem'
				)
			)); ?>
		</span>
	<?php endif; ?>
</a>