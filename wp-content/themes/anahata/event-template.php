<?php $sidebar = anahata_mikado_sidebar_layout(); ?>

<?php get_header(); ?>
<?php anahata_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>
    <div class="mkd-container <?php if($sidebar !== '' && $sidebar !== 'default') {
        echo 'mkd-container-with-sidebar';
    } ?>">
        <?php do_action('anahata_mikado_after_container_open'); ?>
        <div class="mkd-container-inner clearfix">

            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                <?php if(($sidebar == 'default') || ($sidebar == '')) : ?>
                    <?php anahata_mikado_tt_event_single_content(); ?>
                    <?php do_action('anahata_mikado_page_after_content'); ?>
                <?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
                    <div <?php echo anahata_mikado_sidebar_columns_class(); ?>>
                        <div class="mkd-column1 mkd-content-left-from-sidebar">
                            <div class="mkd-column-inner">
                                <?php anahata_mikado_tt_event_single_content(); ?>
                                <?php do_action('anahata_mikado_page_after_content'); ?>
                            </div>
                        </div>
                        <div class="mkd-column2">
                            <?php get_sidebar(); ?>
                        </div>
                    </div>
                <?php elseif($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
                    <div <?php echo anahata_mikado_sidebar_columns_class(); ?>>
                        <div class="mkd-column1">
                            <?php get_sidebar(); ?>
                        </div>
                        <div class="mkd-column2 mkd-content-right-from-sidebar">
                            <div class="mkd-column-inner">
                                <?php anahata_mikado_tt_event_single_content(); ?>
                                <?php do_action('anahata_mikado_page_after_content'); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <?php do_action('anahata_mikado_before_container_close'); ?>
    </div>
<?php get_footer(); ?>