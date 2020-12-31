<div class="mkd-message  <?php echo esc_attr($message_classes) ?>" <?php echo anahata_mikado_get_inline_style($message_styles) ?>>
	<div class="mkd-message-inner">
		<?php
		if($type == 'with_icon') {
			$icon_html = mikado_core_get_core_shortcode_template_part('templates/'.$type, 'message', '', $params);
			echo anahata_mikado_get_module_part($icon_html);
		}
		?>
		<a href="#" class="mkd-close">
			<i class="q_font_elegant_icon icon_close" <?php anahata_mikado_inline_style($close_icon_style); ?>></i>
		</a>

		<div class="mkd-message-text-holder">
			<div class="mkd-message-text">
				<div class="mkd-message-text-inner">
					<?php echo anahata_mikado_remove_auto_ptag($content, true) ?>
				</div>
			</div>
		</div>
	</div>
</div>
