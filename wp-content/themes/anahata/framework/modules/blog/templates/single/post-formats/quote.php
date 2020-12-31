<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <div class="mkd-post-text" style="background-image:url('<?php the_post_thumbnail_url(); ?>')">
            <div class="mkd-post-text-inner clearfix">
                <div class="mkd-post-mark">
                    <span aria-hidden="true" class="icon_quotations"></span>
                </div>
                <div class="mkd-post-title">
                    <h1>
                        <span>"</span><span><?php echo esc_html(get_post_meta(get_the_ID(), "mkd_post_quote_text_meta", true)); ?></span><span>"</span>
                    </h1>
                    <span class="mkd-quote_author">&mdash; <?php the_title(); ?></span>
                </div>
            </div>
        </div>
        <div class="mkd-content-category-share-holder">
            <div class="mkd-content-holder">
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