<div class="mkd-pie-chart-pie-holder">
	<div class="mkd-pie-chart-pie">
		<canvas id="pie<?php echo esc_attr($id); ?>" class="mkd-pie" height="<?php echo esc_attr($height); ?>" width="<?php echo esc_attr($width); ?>" <?php echo anahata_mikado_get_inline_attrs($pie_chart_data)?>></canvas>
	</div>
	<div class="mkd-pie-legend">
		<ul>
			<?php foreach ($legend_data as $legend_data_item) { ?>
			<li>
				<div class="mkd-pie-color-holder" <?php anahata_mikado_inline_style($legend_data_item['color'])?> ></div>
				<p><?php echo esc_html($legend_data_item['legend']); ?></p>
				<?php } ?>
			</li>
		</ul>
	</div>
</div>