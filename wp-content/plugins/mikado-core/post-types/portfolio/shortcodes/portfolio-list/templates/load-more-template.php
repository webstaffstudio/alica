<?php if($query_results->max_num_pages > 1) { ?>
    <div class="mkd-ptf-list-paging">
		<span class="mkd-ptf-list-load-more">
			<?php if(mkd_core_theme_installed()) : ?>
                <?php
                echo anahata_mikado_get_button_html(array(
                    'link'       => 'javascript: void(0)',
                    'type'       => 'solid',
                    'hover_type' => 'outline',
                    'size'       => 'medium'
                ));
                ?>
            <?php else: ?>
                <a href="javascript: void(0)"><?php esc_html_e('Load More', 'mikado-core'); ?></a>
            <?php endif; ?>
		</span>
    </div>
<?php }