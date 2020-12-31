<div class="mkd-pie-chart-with-icon-holder" <?php echo anahata_mikado_get_inline_attrs($data_attr); ?>>
	<div class="mkd-percentage-with-icon" <?php echo anahata_mikado_get_inline_attrs($pie_chart_data); ?>>
		<?php echo anahata_mikado_get_module_part($icon); ?>
	</div>
	<div class="mkd-pie-chart-text" <?php anahata_mikado_inline_style($pie_chart_style)?>>
		<<?php echo esc_html($title_tag)?> class="mkd-pie-title">
			<?php echo esc_html($title); ?>
		</<?php echo esc_html($title_tag)?>>
		<p><?php echo esc_html($text); ?></p>
	</div>
</div>