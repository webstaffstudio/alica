<div class="mkd-ttevents-single">
    <?php if(has_post_thumbnail()) : ?>
        <div class="mkd-ttevents-single-image-holder">
            <?php the_post_thumbnail('full'); ?>
        </div>
    <?php endif; ?>

    <div class="mkd-ttevents-single-holder">
        <h2 class="mkd-ttevents-single-title"><?php the_title(); ?></h2>

        <?php if($subtitle !== '') : ?>
            <span class="mkd-event-single-icon"><?php echo anahata_mikado_icon_collections()->renderIcon('lnr lnr-user', 'linear_icons'); ?></span>
            <p class="mkd-ttevents-single-subtitle"><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>

        <div class="mkd-ttevents-single-content">
            <?php the_content(); ?>
        </div>
    </div>
</div>