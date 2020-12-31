<?php
/**
 * Counter type 1 shortcode template
 */
?>
<div class="mkd-countdown mkd-countdown-one" id="countdown<?php echo esc_attr($id); ?>" data-year="<?php echo esc_attr($year); ?>" data-month="<?php echo esc_attr($month); ?>" data-day="<?php echo esc_attr($day); ?>" data-hour="<?php echo esc_attr($hour); ?>" data-minute="<?php echo esc_attr($minute); ?>" data-timezone="<?php echo get_option('gmt_offset'); ?>" data-month-label="<?php echo esc_attr($month_label); ?>" data-day-label="<?php echo esc_attr($day_label); ?>" data-hour-label="<?php echo esc_attr($hour_label); ?>" data-minute-label="<?php echo esc_attr($minute_label); ?>" data-second-label="<?php echo esc_attr($second_label); ?>" data-digit-size="<?php echo esc_attr($digit_font_size); ?>" data-digit-color="<?php echo esc_attr($digit_color); ?>" data-label-size="<?php echo esc_attr($label_font_size); ?>" data-label-color="<?php echo esc_attr($label_color); ?>"></div>