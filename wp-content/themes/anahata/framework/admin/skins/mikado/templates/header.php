<div class="mkd-page-header page-header clearfix">

    <div class="mkd-theme-name pull-left">
        <img src="<?php echo esc_url(anahata_mikado_get_skin_uri().'/assets/img/logo.png'); ?>"
            alt="<?php esc_attr_e('logo', 'anahata'); ?>" class="mkd-header-logo pull-left"/>
        <h1 class="pull-left">
            <?php echo esc_html($themeName); ?>
            <small><?php echo esc_html($themeVersion); ?></small>
        </h1>
    </div>
    <div class="mkd-top-section-holder">
        <div class="mkd-top-section-holder-inner">
            <div class="mkd-notification-holder">
                <div class="mkd-input-change">
                    <i class="fa fa-exclamation-circle"></i><?php esc_html_e('You should save your changes', 'anahata') ?>
                </div>
                <div class="mkd-changes-saved">
                    <i class="fa fa-check-circle"></i><?php esc_html_e('All your changes are successfully saved', 'anahata') ?>
                </div>
            </div>
            <div class="mkd-top-buttons-holder">
                <?php if($showSaveButton) { ?>
                    <input type="button" id="mkd_top_save_button" class="btn btn-info btn-sm" value="<?php esc_attr_e('Save Changes', 'anahata'); ?>"/>
                <?php } ?>
            </div>
        </div>
    </div>

</div> <!-- close div.mkd-page-header -->