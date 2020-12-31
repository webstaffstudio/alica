<div class="mkd-anchor-holder">
    <?php if(is_array($page->layout) && count($page->layout)) { ?>
        <span><?php esc_html_e('Scroll To:', 'anahata'); ?></span>
        <select class="nav-select mkd-selectpicker" data-width="315px" data-hide-disabled="true" data-live-search="true" id="mkd-select-anchor">
            <option value="" disabled selected></option>
            <?php foreach ($page->layout as $panel) { ?>
                <option data-anchor="#mkd_<?php echo esc_attr($panel->name); ?>"><?php echo esc_attr($panel->title); ?></option>
            <?php } ?>
        </select>

    <?php } ?>
</div>