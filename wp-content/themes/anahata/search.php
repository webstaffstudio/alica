<?php
$sidebar              = anahata_mikado_sidebar_layout();
$excerpt_length_array = anahata_mikado_blog_lists_number_of_chars();

$excerpt_length = 0;
if(is_array($excerpt_length_array) && array_key_exists('standard', $excerpt_length_array)) {
    $excerpt_length = $excerpt_length_array['standard'];
}

?>

<?php get_header(); ?>
<?php
global $wp_query;

if(get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif(get_query_var('page')) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

if(anahata_mikado_options()->getOptionValue('blog_page_range') != "") {
    $blog_page_range = esc_attr(anahata_mikado_options()->getOptionValue('blog_page_range'));
} else {
    $blog_page_range = $wp_query->max_num_pages;
}
?>
<?php anahata_mikado_get_title(); ?>
    <div class="mkd-container">
        <?php do_action('anahata_mikado_action_after_container_open'); ?>
        <div class="mkd-container-inner clearfix">
            <div class="mkd-blog-holder mkd-blog-type-standard">

                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="mkd-post-content">
                            <?php anahata_mikado_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
                            <div class="mkd-post-text">
                                <div class="mkd-post-text-inner">
                                    <?php anahata_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
                                    <div class="mkd-post-info">
                                        <?php
                                        anahata_mikado_post_info(array(
                                            'date'     => 'yes',
                                            'author'   => 'yes',
                                            'category' => 'no',
                                            'comments' => anahata_mikado_show_comments() ? 'yes' : 'no',
                                            'like'     => anahata_mikado_show_likes() ? 'yes' : 'no'
                                        )); ?>
                                    </div>
                                    <?php $my_excerpt = get_the_excerpt();
                                    if($my_excerpt != '') { ?>
                                        <p class="mkd-post-excerpt"><?php echo esc_html($my_excerpt); ?></p>
                                    <?php }
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
                    </article>
                   <?php
                    endwhile;
                        if (anahata_mikado_options()->getOptionValue('pagination') == 'yes') :
                            anahata_mikado_pagination($wp_query->max_num_pages, $blog_page_range, $paged);
                        endif;
                    else:
                        anahata_mikado_get_module_template_part('templates/parts/no-posts', 'blog');
                    endif;
                    ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>