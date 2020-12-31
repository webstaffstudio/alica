<?php
/*
Template Name: Blog: Masonry Gallery
*/
?>
<?php get_header(); ?>

<?php anahata_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>

	<div class="mkd-full-width">
		<div class="mkd-full-width-inner clearfix">
			<?php the_content(); ?>
			<?php do_action('anahata_mikado_page_after_content'); ?>
			<?php anahata_mikado_get_blog('masonry-gallery'); ?>
		</div>
	</div>
<?php get_footer(); ?>