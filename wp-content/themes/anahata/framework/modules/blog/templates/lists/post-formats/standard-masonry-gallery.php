<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
    <?php anahata_mikado_get_module_template_part('templates/lists/parts/image', 'blog', '', array('image_size' => $image_size)); ?>
    <div class="mkd-date-title">
        <?php anahata_mikado_post_info(array('date' => 'yes')) ?>
        <?php anahata_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
    </div>
</article>