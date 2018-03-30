<?php

add_action('wp_ajax_porto_portfolio-like', 'porto_ajax_portfolio_like');
add_action('wp_ajax_nopriv_porto_portfolio-like', 'porto_ajax_portfolio_like');

function porto_ajax_portfolio_like() {
    if (isset($_POST['portfolio_id'])) {
        $portfolio_id = $_POST['portfolio_id'];
        $like_count = get_post_meta($portfolio_id, 'like_count', true);
        if (!isset($_COOKIE['porto_like_'. $portfolio_id]) || $like_count == 0) {
            $like_count++;
            setcookie('porto_like_'. $portfolio_id, $portfolio_id, time()*20, '/');
            update_post_meta($portfolio_id, 'like_count', $like_count);
        }
        echo '<span class="portfolio-liked linked" title="' . __('Already Liked', 'porto') . '" data-tooltip><i class="fa fa-heart"></i>'. $like_count . '</span>';
    }

    exit;
}

function porto_portfolio_like() {
    global $post;

    $portfolio_id = $post->ID;
    $like_count = get_post_meta($portfolio_id, 'like_count', true);

    if ($like_count && isset($_COOKIE['porto_like_'. $portfolio_id]) ) {
        $output = '<span class="portfolio-liked linked" title="' . __('Already liked', 'porto') . '" data-tooltip><i class="fa fa-heart"></i>'. $like_count . '</span>';
    } else {
        $output = '<span class="portfolio-like" title="' . __('Like', 'porto') . '" data-tooltip data-id="' . $portfolio_id . '"><i class="fa fa-heart"></i>'. ($like_count ? $like_count : '0') . '</span>';
    }

    return $output;
}
