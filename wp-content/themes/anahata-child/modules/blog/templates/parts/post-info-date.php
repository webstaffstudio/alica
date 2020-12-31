<div class="mkd-post-info-date">
    <?php if(!anahata_mikado_post_has_title()) { ?>
    <a href="<?php the_permalink() ?>">
        <?php } ?>
        <span class="mkd-blog-date-icon">
		    <?php echo anahata_mikado_icon_collections()->renderIcon('lnr-calendar-full', 'linear_icons'); ?>
	    </span>
        <span><?php the_time(get_option('date_format')); ?></span>
        <?php if(!anahata_mikado_post_has_title()) { ?>
    </a>
<?php } ?>
</div>