<div class='mkd-blog-slider-holder mkd-blog-slider-two <?php echo esc_attr($additional_classes) ?>' <?php echo anahata_mikado_get_module_part($data_attribute); ?>>
    <?php if($query->have_posts()) : ?>
        <?php while($query->have_posts()) : $query->the_post(); ?>
            <div class="item">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="mkd-post-content">
                        <div class="mkd-post-text">
                            <div class="mkd-post-text-inner">
                                <h2 class="mkd-post-title">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php
                                        if($title_length != '') {
                                            echo anahata_mikado_get_title_substring(get_the_title(), intval($title_length));
                                        } else {
                                            the_title();
                                        }
                                        ?>
                                    </a>
                                </h2>
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
                            <div class="mkd-post-info">
                                <?php anahata_mikado_post_info(array(
                                    'date'     => 'yes',
                                    'author'   => 'no',
                                    'category' => 'no',
                                    'comments' => anahata_mikado_options()->getOptionValue('blog_single_comments') == 'yes' ? 'yes' : 'no',
                                    'like'     => 'no'
                                )) ?>
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