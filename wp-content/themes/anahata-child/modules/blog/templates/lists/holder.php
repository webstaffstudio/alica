<div class="mkd-grid-row">
    <div <?php echo anahata_mikado_get_content_sidebar_class(); ?>>
        <?php anahata_mikado_get_blog_type($blog_type); ?>
    </div>

    <?php if(!in_array($sidebar, array('default', ''))) : ?>
        <div <?php echo anahata_mikado_get_sidebar_holder_class(); ?>>
            <?php get_sidebar(); ?>
        </div>
    <?php endif; ?>
</div>

