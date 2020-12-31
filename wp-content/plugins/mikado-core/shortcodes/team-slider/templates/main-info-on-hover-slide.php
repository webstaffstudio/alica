<?php
/**
 * Team info on hover slide template
 */
global $anahata_IconCollections;
$number_of_social_icons = 5;
?>

<div class="mkd-team <?php echo esc_attr($team_type) ?>">
    <div class="mkd-team-inner">
        <?php if($team_image !== '') { ?>
        <div class="mkd-team-image">
            <img src="<?php echo esc_url($team_image_src); ?>" alt="<?php esc_attr_e('team image', 'mikado-core'); ?>"/>
            <div class="mkd-team-hover"></div>
            <div class="mkd-team-social-holder">
                <div class="mkd-team-social">
                    <div class="mkd-team-social-inner">
                        <div class="mkd-team-title-holder">
                            <?php if($team_name !== '') { ?>
                            <<?php echo esc_attr($team_name_tag); ?> class="mkd-team-name">
                            <?php echo esc_attr($team_name); ?>
                        </<?php echo esc_attr($team_name_tag); ?>>
                        <?php }
                        if($team_position !== '') { ?>
                            <h6 class="mkd-team-position">
                                <?php echo esc_attr($team_position); ?>
                            </h6>
                        <?php } ?>
                    </div>
                    <?php if($team_description !== '') { ?>
                    <div class="mkd-team-text">
                        <div class="mkd-team-text-inner">
                            <div class="mkd-team-description">
                                <p><?php echo esc_attr($team_description); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="mkd-team-social-wrapp">
                        <?php foreach($team_social_icons as $team_social_icon) {
							echo anahata_mikado_get_module_part($team_social_icon);
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

</div>
</div>