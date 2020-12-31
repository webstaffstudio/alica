<?php if($lightbox) : ?>
	<a title="<?php echo esc_attr($video_title); ?>" href="<?php echo esc_url('https://www.youtube.com/watch?v='.$media['video_id']); ?>" data-rel="prettyPhoto[single_pretty_photo]" class="mkd-portfolio-video-lightbox">
		<div class="mkd-portfolio-overlay">
			<i class="mkd-portfolio-play-icon fa fa-play"></i>
		</div>
		<img width="100%" src="<?php echo esc_url($lightbox_thumb); ?>" alt="<?php echo esc_attr($video_title); ?>"/>
	</a>

<?php else: ?>
	<div class="mkd-iframe-video-holder">
		<iframe class="mkd-iframe-video" src="<?php echo esc_url($media['video_url']); ?>" width="500" height="281" wmode="Opaque" frameborder="0" allowfullscreen></iframe>
	</div>
<?php endif; ?>
