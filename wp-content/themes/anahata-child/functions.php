<?php

/*** Child Theme Function  ***/

if (!function_exists('mkd_child_theme_enqueue_scripts')) {
    function mkd_child_theme_enqueue_scripts()
    {
        $parent_style = 'anahata-mikado-default-style';

        wp_enqueue_style('anahata-mikado-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
        wp_enqueue_script('child-scripts', get_stylesheet_directory_uri() . '/js/child-theme-script.js');
    }

    add_action('wp_enqueue_scripts', 'mkd_child_theme_enqueue_scripts', 11);
}
// new tab in my account with courses

// ------------------
// 1. Register new endpoint to use for My Account page
// Note: Resave Permalinks or it will give 404 error

function bbloomer_add_premium_support_endpoint()
{
    add_rewrite_endpoint('premium-support', EP_ROOT | EP_PAGES);
}

add_action('init', 'bbloomer_add_premium_support_endpoint');


// ------------------
// 2. Add new query var

function bbloomer_premium_support_query_vars($vars)
{
    $vars[] = 'premium-support';
    return $vars;
}

add_filter('query_vars', 'bbloomer_premium_support_query_vars', 0);


// ------------------
// 3. Insert the new endpoint into the My Account menu

function bbloomer_add_premium_support_link_my_account($items)
{
    $items['premium-support'] = __('Курсы', 'wss_dev');
    return $items;
}

add_filter('woocommerce_account_menu_items', 'bbloomer_add_premium_support_link_my_account');


// ------------------
// 4. Add content to the new endpoint

function bbloomer_premium_support_content()
{
    courses_html();

}

add_action('woocommerce_account_premium-support_endpoint', 'bbloomer_premium_support_content');
// Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format

function courses_html()
{
    $user_id = get_current_user_id();
    $courses = get_field('available_courses', 'user_' . $user_id);
    if ($courses) { ?>
        <div class="courses-container row">
            <?php foreach ($courses as $cours):
                $id = $cours->ID;
                $title = get_the_title($id);
                $link = get_the_permalink($id);
                $thumbnail = get_the_post_thumbnail($id);
                ?>
                <a class="cours-post col-lg-4" href="<?= $link; ?>">
                    <?php if ($thumbnail): ?>
                        <?= $thumbnail; ?>
                    <?php else: ?>
                        <img src="<?= get_stylesheet_directory_uri() . '/images/preview-poster.jpg'; ?>" alt="course">
                    <?php endif; ?>
                    <h5 class="post-title"><?= $title; ?></h5>
                </a>
            <?php
            endforeach; ?>
        </div>
    <?php }
}

function is_available_course()
{
    $user_id = get_current_user_id();
    $courses = get_field('available_courses', 'user_' . $user_id);
    $is_available = false;
    foreach ($courses as $cours):
        $id = $cours->ID;
        $current_cours = get_the_ID();
        if ($id === $current_cours) {
            $is_available = true;
        }
    endforeach;
    return $is_available;
}

function get_course_content()
{
    $courses = get_field('courses_content');
    if ($courses): ?>
        <?php foreach ($courses as $cours): ?>

        <?php endforeach; ?>
    <?php endif; ?>

    <?php
}