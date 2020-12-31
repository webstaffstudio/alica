<div <?php mkd_core_class_attribute($holder_classes); ?>>
    <?php if($query->have_posts()) : ?>
    <ul class="mkd-portfolio-slider-list" <?php echo mkd_core_get_inline_attrs($holder_data); ?>>
        <?php while($query->have_posts()) :
        $query->the_post(); ?>
        <li <?php post_class(); ?>>
            <div class="mkd-ptfs-item">
                <?php if(has_post_thumbnail()) : ?>
                <div class="mkd-ptfs-item-image">
                    <a href="<?php esc_url(the_permalink()); ?>">
                        <?php if($use_custom_image_size && (is_array($custom_image_sizes) && count($custom_image_sizes))) : ?>
                            <?php echo anahata_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $custom_image_sizes[0], $custom_image_sizes[1]); ?>
                        <?php else: ?>
                            <?php the_post_thumbnail($thumb_size); ?>
                        <?php endif; ?>
                    </a>
                </div>
                <div class="mkd-ptfs-item-content" <?php anahata_mikado_inline_style($bckg_color); ?>>
                    <<?php echo esc_attr($title_tag); ?> class="mkd-ptfs-item-title">
                    <a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a>
                </<?php echo esc_attr($title_tag); ?>>
                <div class="mkd-ptfs-item-excerpt-holder">
                    <p><?php echo esc_html($caller->itemExcerpt($excerpt_length)); ?></p>
                </div>
                <?php if($show_read_more_button == 'yes') { ?>
                    <div class="mkd-btn-holder">
                        <a href="<?php esc_url(the_permalink()); ?>" target="_self" class="mkd-btn mkd-btn-small mkd-btn-transparent mkd-btn-icon mkd-btn-hover-outline">
                            <span class="mkd-btn-text"><?php esc_html_e('Read More', 'mikado-core'); ?></span>
										<span class="mkd-btn-icon-holder">
											<span aria-hidden="true" class="mkd-icon-font-elegant arrow_triangle-right mkd-btn-icon-elem"></span>		
										</span>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <?php endif; ?>
</div>
</li>
<?php endwhile; ?>
</ul>
<?php wp_reset_postdata(); ?>
<?php else: ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'mikado-core'); ?></p>
<?php endif; ?>
</div>