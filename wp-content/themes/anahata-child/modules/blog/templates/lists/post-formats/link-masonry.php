<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <div class="mkd-post-text">
            <div class="mkd-post-text-inner">
                <div class="mkd-post-mark">
                    <?php echo anahata_mikado_icon_collections()->renderIcon('icon_link', 'font_elegant'); ?>
                </div>
                <?php anahata_mikado_get_module_template_part('templates/lists/parts/title', 'blog', '', array('title_tag' => 'h2')); ?>
                <div class="mkd-post-info">
                    <?php anahata_mikado_post_info(array(
                        'date' => 'yes',
                    )) ?>
                </div>
            </div>
        </div>
        <div class="mkd-post-content-background" style="background-image:url('<?php the_post_thumbnail_url(); ?>')"></div>
    </div>
</article>