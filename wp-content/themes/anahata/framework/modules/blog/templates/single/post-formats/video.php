<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <div class="mkd-post-image">
            <?php anahata_mikado_get_module_template_part('templates/parts/video', 'blog'); ?>
        </div>
        <div class="mkd-post-text">
            <div class="mkd-post-text-inner clearfix">
                <?php anahata_mikado_get_module_template_part('templates/single/parts/title', 'blog'); ?>
                <div class="mkd-post-info">
                    <?php
                    anahata_mikado_post_info(array(
                        'date'     => 'yes',
                        'author'   => 'yes',
                        'like'     => anahata_mikado_show_likes() ? 'yes' : 'no',
                        'comments' => (anahata_mikado_options()->getOptionValue('blog_single_comments') == 'yes') ? 'yes' : 'no'
                    ))
                    ?>
                </div>
                <?php the_content(); ?>
            </div>
            <div class="mkd-category-share-holder clearfix">
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
    <?php do_action('anahata_mikado_before_blog_article_closed_tag'); ?>
</article>