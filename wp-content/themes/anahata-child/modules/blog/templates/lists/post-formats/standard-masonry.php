<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <?php
        if(anahata_mikado_masonry_no_image_template()) {
            anahata_mikado_get_module_template_part('templates/lists/parts/image', 'blog', '', array('image_size' => 'full'));
        }
        ?>
        <div class="mkd-post-text">
            <div class="mkd-author-desc clearfix">
                <div class="mkd-image-name clearfix">
                </div>
            </div>
            <div class="mkd-post-text-inner">
                <?php anahata_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
                <div class="mkd-post-info">
                    <?php
                    anahata_mikado_post_info(array(
                        'date'   => 'yes',
                        'author' => 'yes'
                    )); ?>
                </div>
                <?php
                anahata_mikado_excerpt($excerpt_length);
                $args_pages = array(
                    'before'      => '<div class="mkd-single-links-pages"><div class="mkd-single-links-pages-inner">',
                    'after'       => '</div></div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '%'
                );

                wp_link_pages($args_pages);
                ?>
            </div>
            <div class="mkd-categories-date clearfix">
                <div class="mkd-categories-list">
                    <?php anahata_mikado_get_module_template_part('templates/parts/post-info-category', 'blog'); ?>
                </div>
            </div>
        </div>
    </div>
</article>