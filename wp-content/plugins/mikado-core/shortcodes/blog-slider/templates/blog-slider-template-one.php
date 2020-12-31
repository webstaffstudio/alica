<div class='mkd-blog-slider-holder mkd-blog-slider-one <?php echo esc_attr($additional_classes) ?>' <?php echo anahata_mikado_get_module_part($data_attribute); ?>>
    <?php if($query->have_posts()) : ?>
        <?php while($query->have_posts()) : $query->the_post(); ?>
            <div class="item">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="mkd-post-content">
                        <div class="mkd-post-image-with-author">
                            <?php
                            if(anahata_mikado_masonry_no_image_template()) {
                                anahata_mikado_get_module_template_part('templates/lists/parts/image', 'blog', '', array('image_size' => 'anahata_mikado_masonry'));
                            }
                            ?>
                        </div>
                        <div class="mkd-post-text">
                            <div class="mkd-post-text-inner">
                                <h3 class="mkd-post-title">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php
                                        if($title_length != '') {
                                            echo anahata_mikado_get_title_substring(get_the_title(), intval($title_length));
                                        } else {
                                            the_title();
                                        }
                                        ?>
                                    </a>
                                </h3>
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
                                <?php if(anahata_mikado_is_plugin_installed('core')) { ?>
                                    <div class="mkd-share-icons">
                                        <?php $post_info_array['share'] = anahata_mikado_options()->getOptionValue('enable_social_share') == 'yes'; ?>
                                        <?php echo anahata_mikado_get_social_share_html(array(
                                            'type'      => 'list',
                                            'icon_type' => 'normal'
                                        )); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else: ?>
        <p><?php esc_html_e('No posts were found.', 'mikado-core'); ?></p>
    <?php endif; ?>
</div>