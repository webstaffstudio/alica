<?php
/*
Template Name: Blog: Masonry
*/
?>
<?php get_header(); ?>
<?php anahata_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>
	<div class="mkd-container">
		<?php do_action('anahata_mikado_after_container_open'); ?>
		<div class="mkd-container-inner">
			<?php the_content(); ?>
			<?php do_action('anahata_mikado_page_after_content'); ?>
			<?php anahata_mikado_get_blog('masonry'); ?>
		</div>
		<?php do_action('anahata_mikado_before_container_close'); ?>
	</div>
<?php get_footer(); ?>