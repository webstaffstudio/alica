<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
    <div class="mkd-masonry-gallery-quote-holder" style="background-image:url('<?php the_post_thumbnail_url(); ?>')">
        <div class="mkd-masonry-gallery-quote-author">
            <div class="mkd-masonry-gallery-quote-author-inner">
                <h4 class="mkd-masonry-gallery-quote">
                    <span>"</span>
                    <?php echo esc_html(get_post_meta(get_the_ID(), "mkd_post_quote_text_meta", true)); ?>
                    <span>"</span>
                </h4>
                <h3 class="mkd-masonry-gallery-author">&mdash; <?php the_title(); ?></h3>
            </div>
        </div>
        <div class="mkd-post-mark">
            <span aria-hidden="true" class="icon_quotations"></span>
        </div>
        <div class="mkd-masonry-gallery-quote-holder-bgrnd"></div>
    </div>
</article>