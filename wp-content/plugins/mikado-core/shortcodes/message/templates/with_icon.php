<?php
$icon_html = anahata_mikado_icon_collections()->renderIcon($icon, $icon_pack);
?>

<div class="mkd-message-icon-holder">
	<div class="mkd-message-icon" <?php anahata_mikado_inline_style($icon_attributes); ?>>
		<div class="mkd-message-icon-inner">
			<?php
			echo anahata_mikado_get_module_part($icon_html);
			?>
		</div>
	</div>
</div>

