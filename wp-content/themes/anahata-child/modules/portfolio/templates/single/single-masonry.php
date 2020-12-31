<div class="mkd-two-columns-66-33 clearfix">
    <div class="mkd-column1">
        <div class="mkd-column-inner">
            <?php
            echo anahata_mikado_get_ptf_masonry_layout();
            ?>
        </div>
    </div>
    <div class="mkd-column2">
        <div class="mkd-column-inner">
            <div class="mkd-portfolio-info-holder">
                <?php
                //get portfolio content section
                anahata_mikado_portfolio_get_info_part('content');

                //get portfolio custom fields section
                anahata_mikado_portfolio_get_info_part('custom-fields');

                //get portfolio author section
                anahata_mikado_portfolio_get_info_part('author');

                //get portfolio date section
                anahata_mikado_portfolio_get_info_part('date');

                //get portfolio tags section
                anahata_mikado_portfolio_get_info_part('tags');

                //get portfolio share section
                anahata_mikado_portfolio_get_info_part('social');
                ?>
            </div>
        </div>
    </div>
</div>