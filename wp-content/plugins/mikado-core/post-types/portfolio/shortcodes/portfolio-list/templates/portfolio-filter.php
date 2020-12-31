<div class="mkd-portfolio-filter-holder <?php echo esc_attr($masonry_filter) ?>" <?php anahata_mikado_inline_style($filter_styles)?>>
	<div class="mkd-portfolio-filter-holder-inner<?php echo esc_attr($filter_pos_info) ?><?php echo esc_attr($style_fil) ?>">
		<?php
		$rand_number = rand();
		if(is_array($filter_categories) && count($filter_categories)) { ?>
			<ul >
				<?php if($type == 'masonry' || $type == 'pinterest') { ?>
					<li class="filter" data-filter="*"><span><?php print esc_html__('All', 'mikado-core') ?></span></li>
				<?php } else { ?>
					<li data-class="filter_<?php echo esc_attr($rand_number); ?>" class="filter_<?php echo esc_attr($rand_number); ?>" data-filter="all">
						<span><?php print esc_html__('All', 'mikado-core') ?></span></li>
				<?php } ?>
				<?php foreach($filter_categories as $cat) {
					if($type == 'masonry' || $type == 'pinterest') {
						?>
						<li data-class="filter" class="filter" data-filter=".portfolio_category_<?php echo esc_attr($cat->term_id); ?>">
						<span>
							<?php echo esc_html($cat->name); ?>
						</span>
						</li>
					<?php } else { ?>
						<li data-class="filter_<?php echo esc_attr($rand_number); ?>" class="filter_<?php echo esc_attr($rand_number); ?>" data-filter=".portfolio_category_<?php echo esc_attr($cat->term_id); ?>">
					<span>
						<?php echo esc_html($cat->name); ?>
					</span>
						</li>
					<?php }
				} ?>
			</ul>
		<?php } ?>
	</div>
</div>