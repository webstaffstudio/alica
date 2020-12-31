<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <div class="mkd-post-link-content-holder">
            <div class="mkd-post-image-text-holder" style="background-image:url('<?php the_post_thumbnail_url(); ?>')">
                <div class="mkd-post-text">
                    <div class="mkd-post-text-inner">
                        <div class="mkd-post-mark">
                            <?php echo anahata_mikado_icon_collections()->renderIcon('icon_link', 'font_elegant'); ?>
                        </div>
                        <h1 class="mkd-post-title">
                            <a href="<?php echo esc_url(get_post_meta(get_the_ID(), "mkd_post_link_link_meta", true)); ?>"
                                title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </h1>
                        <div class="mkd-post-info">
                            <?php anahata_mikado_post_info(array(
                                'date'     => 'yes',
                                'category' => 'no',
                                'comments' => 'no',
                                'like'     => 'no'
                            )) ?>
                        </div>
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
    </div>
    <?php do_action('anahata_mikado_before_blog_article_closed_tag'); ?>
</article>