<?php
/**
 * Video Button shortcode template
 */
?>

<div class="mkd-video-button <?php echo esc_attr($button_light);?>">
	<a class="mkd-video-button-play" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto" <?php echo anahata_mikado_inline_style($button_style);?>>
		<span class="mkd-video-button-wrapper">
			<span class="arrow_triangle-right_alt"></span>
		</span>
	</a>
	<?php if ($title !== ''){?>
		<<?php echo esc_attr($title_tag);?> class="mkd-video-button-title">
			<?php echo esc_html($title); ?>
		</<?php echo esc_attr($title_tag);?>>
	<?php } ?>
</div>