<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <div class="mkd-post-text">
            <div class="mkd-post-text-inner">
                <div class="mkd-post-mark">
                    <span aria-hidden="true" class="icon_quotations"></span>
                </div>
                <div class="mkd-post-title">
                    <h2>
                        <span>"</span><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "mkd_post_quote_text_meta", true)); ?></a><span>"</span>
                    </h2>
                    <span class="mkd-quote_author">&mdash; <?php the_title(); ?></span>
                </div>
            </div>
        </div>
        <div class="mkd-post-content-background" style="background-image:url('<?php the_post_thumbnail_url(); ?>')"></div>
    </div>
</article>