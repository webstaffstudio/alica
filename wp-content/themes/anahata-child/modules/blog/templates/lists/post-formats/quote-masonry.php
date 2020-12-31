<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <div class="mkd-post-text">
            <div class="mkd-post-text-inner">
                <div class="mkd-post-title">
                    <h4>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo '"'.esc_html(get_post_meta(get_the_ID(), "mkd_post_quote_text_meta", true)).'"'; ?></a>
                    </h4>
                    <h3 class="quote_author">&mdash; <?php the_title(); ?></h3>
                </div>
            </div>
        </div>
        <div class="mkd-post-mark">
            <span aria-hidden="true" class="icon_quotations"></span>
        </div>
        <div class="mkd-post-content-background" style="background-image:url('<?php the_post_thumbnail_url(); ?>')"></div>
    </div>
</article>