<div class="mkd-portfolio-item-social">
    <?php if(anahata_mikado_is_plugin_installed('core') && anahata_mikado_options()->getOptionValue('enable_social_share') == 'yes'
             && anahata_mikado_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes'
    ) : ?>
        <div class="mkd-portfolio-single-share-holder">
            <?php echo anahata_mikado_get_social_share_html() ?>
        </div>
    <?php endif; ?>
    <div class="mkd-portfolio-single-likes">
        <?php echo anahata_mikado_like_portfolio_list(get_the_ID()); ?>
    </div>
</div>
