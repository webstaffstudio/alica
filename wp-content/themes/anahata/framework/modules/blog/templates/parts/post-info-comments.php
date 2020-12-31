<div class="mkd-post-info-comments-holder mkd-post-info-item">
	<a class="mkd-post-info-comments" href="<?php comments_link(); ?>">
		<span class="mkd-post-info-comments-icon">
			<?php echo anahata_mikado_icon_collections()->renderIcon('lnr-bubble', 'linear_icons'); ?>
		</span>
		<span class="mkd-comment-number"><?php comments_number('0', '1', '%'); ?></span>
		<span><?php comments_number(esc_html__('Comments','anahata'), esc_html__('Comment','anahata'), esc_html__('Comments','anahata')); ?></span>
	</a>
</div>