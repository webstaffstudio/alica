<?php
/**
 * Team info below image slide template
 */
global $anahata_IconCollections;
$number_of_social_icons = 5;
?>

<div class="mkd-team-item-wrapper">
    <div class="mkd-team <?php echo esc_attr($team_type) ?><?php echo esc_attr($box_class) ?><?php echo esc_attr($flip_class) ?>" <?php if($flip_on_hover != 'yes') { anahata_mikado_inline_style($team_shadow_styles); } ?> >
        <?php if($flip_on_hover == 'yes') { ?>
            <div class="mkd-team-front" <?php anahata_mikado_inline_style($team_shadow_styles); ?> >
        <?php } ?>
            <div class="mkd-team-inner">

                <?php if($team_image !== '') { ?>
                    <div class="mkd-team-image">
                        <img src="<?php echo esc_url($team_image_src); ?>" alt="<?php esc_attr_e('team image', 'mikado-core'); ?>"/>
                    </div>
                <?php } ?>

                <?php if($team_name !== '' || $team_position !== '' || $team_description != "" || $show_skills == 'yes') { ?>
                <div class="mkd-team-info">

                    <?php if($team_name !== '' || $team_position !== '') { ?>
                        <div class="mkd-team-title-holder <?php echo esc_attr($team_social_icon_type) ?>">
                            <?php if($team_name !== '') { ?>
                                <<?php echo esc_attr($team_name_tag); ?> class="mkd-team-name <?php echo esc_attr($light_class); ?>">
                                <?php echo esc_attr($team_name); ?>
                                </<?php echo esc_attr($team_name_tag); ?>>
                            <?php } ?>
                            <?php if($team_position !== "") { ?>
                                <h6 class="mkd-team-position <?php echo esc_attr($light_class); ?>" <?php anahata_mikado_inline_style($background_styles); ?>><?php echo esc_attr($team_position) ?></h6>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if($team_description != "") { ?>
                        <div class='mkd-team-text'>
                            <div class='mkd-team-text-inner'>
                                <div class='mkd-team-description <?php echo esc_attr($light_class); ?>'>
                                    <p><?php echo esc_attr($team_description) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if($flip_on_hover != 'yes') { ?>
                        <div class="mkd-team-social-holder-between">
                            <div class="mkd-team-social <?php echo esc_attr($team_social_icon_type) ?>">
                                <div class="mkd-team-social-inner">
                                    <div class="mkd-team-social-wrapp">

                                        <?php foreach($team_social_icons as $team_social_icon) {
											echo anahata_mikado_get_module_part($team_social_icon);
                                        } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <?php } ?>

            </div>

            <?php if($flip_on_hover == 'yes') { ?>
                </div>
                <div class="mkd-team-back" <?php anahata_mikado_inline_style($team_back_side_styles); ?>>
                    <div class="mkd-team-back-table">
                        <div class="mkd-team-back-cell">
                            <div class="mkd-team-back-title">
                                <i class="icon-bubble icons"></i>
                                <h3><?php esc_html_e('Contact me', 'mikado-core') ?></h3>
                            </div>
                            <?php if ($phone_number != '') { ?>
                                <div class="mkd-team-phone">
                                    <a href="tel:<?php echo esc_url($phone_number) ?>"><?php echo esc_attr($phone_number) ?></a>
                                </div>
                            <?php } ?>
                            <?php if ($email_address != '') { ?>
                                <div class="mkd-team-mail">
                                    <a href="mailto:<?php echo esc_attr($email_address) ?>"><?php echo esc_attr($email_address) ?></a>
                                </div>
                            <?php } ?>
                            <div class="mkd-team-social-holder-between">
                                <div class="mkd-team-social <?php echo esc_attr($team_social_icon_type) ?>">
                                    <div class="mkd-team-social-inner">
                                        <div class="mkd-team-social-wrapp">

                                            <?php foreach($team_social_icons as $team_social_icon) {
												echo anahata_mikado_get_module_part($team_social_icon);
                                            } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

    </div>
</div>