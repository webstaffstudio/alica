<?php if(anahata_mikado_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes') : ?>

    <?php
    $back_to_link      = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    $nav_same_category = anahata_mikado_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';
    ?>

    <div class="mkd-portfolio-single-nav clearfix">
        <?php if($has_prev_post) : ?>
            <div class="mkd-portfolio-single-prev clearfix">
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
            </div>

        <?php endif; ?>


        <?php if($back_to_link !== '') : ?>
            <div class="mkd-portfolio-back-btn">
                <a href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
                    <span class="icon_grid-2x2"></span>
                </a>
            </div>
        <?php endif; ?>




        <?php if($has_next_post) : ?>

            <div class="mkd-portfolio-single-next clearfix">
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

        <?php endif; ?>
    </div>

<?php endif; ?>