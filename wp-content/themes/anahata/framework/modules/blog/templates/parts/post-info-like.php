<?php if(anahata_mikado_core_installed()) { ?>
<div class="mkd-blog-like mkd-post-info-item">
    <?php if(function_exists('anahata_mikado_get_like')) {
		anahata_mikado_get_like();
	} ?>
</div>
<?php } ?>