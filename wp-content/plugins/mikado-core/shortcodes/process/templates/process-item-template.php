<div class="mkd-process-item-holder">
    <div class="mkd-pi-holder-inner">
        <div class="mkd-number-holder-inner">
            <div class="mkd-border" <?php echo anahata_mikado_get_inline_style($image_url_style); ?> ></div>
        </div>
        <div class="mkd-pi-content-holder">
            <?php if(!empty($title)) : ?>
                <div class="mkd-pi-title-holder">
                    <h3 class="mkd-pi-title"><?php echo esc_html($title); ?></h3>
                </div>
            <?php endif; ?>

            <?php if(!empty($text)) : ?>
                <div class="mkd-pi-text-holder">
                    <p><?php echo esc_html($text); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>