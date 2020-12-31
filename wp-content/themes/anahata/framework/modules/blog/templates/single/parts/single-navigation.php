<?php if(anahata_mikado_options()->getOptionValue('blog_single_navigation') == 'yes') { ?>
    <?php $navigation_blog_through_category = anahata_mikado_options()->getOptionValue('blog_navigation_through_same_category') ?>
    <div class="mkd-blog-single-navigation clearfix">
        <div class="mkd-blog-single-navigation-inner clearfix">
            <?php if($has_prev_post) : ?>
                <div class="mkd-blog-single-prev clearfix">
                    <div class="mkd-single-nav-content-holder clearfix">
                        <div class="mkd-single-nav-text">
                            <h3 class="mkd-single-nav-post-title">
                                <a href="<?php echo esc_url($prev_post['link']); ?>">
                                    <?php echo esc_html($prev_post['title']); ?>
                                </a>
                            </h3>
                            <a href="<?php echo esc_url($prev_post['link']) ?>">
                                <span class="mkd-single-nav-post-sub"><?php esc_html_e('Previous post', 'anahata') ?></span>
                            </a>
                            <div class="mkd-single-nav-arrow">
                                <a href="<?php echo esc_url($prev_post['link']) ?>"><?php echo anahata_mikado_icon_collections()->renderIcon('lnr-chevron-left', 'linear_icons') ?></a>
                            </div>
                        </div>
                    </div>
                </div> <!-- close div.blog_prev -->
            <?php endif; ?>
            <?php if($has_next_post) : ?>
                <div class="mkd-blog-single-next clearfix">
                    <div class="mkd-single-nav-content-holder clearfix">
                        <div class="mkd-single-nav-text">
                            <h3 class="mkd-single-nav-post-title">
                                <a href="<?php echo esc_url($next_post['link']); ?>">
                                    <?php echo esc_html($next_post['title']); ?>
                                </a>
                            </h3>
                            <a href="<?php echo esc_url($next_post['link']) ?>">
                                <span class="mkd-single-nav-post-sub"><?php esc_html_e('Next post', 'anahata') ?></span>
                            </a>
                            <div class="mkd-single-nav-arrow">
                                <a href="<?php echo esc_url($next_post['link']) ?>"><?php echo anahata_mikado_icon_collections()->renderIcon('lnr-chevron-right', 'linear_icons') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($has_prev_post || $has_next_post) : ?>
                <div class="mkd-single-nav-separator"></div>
            <?php endif; ?>
        </div>
    </div>
<?php } ?>