<?php

//enqueue scripts and styles
function enqueue_scripts_and_stylesheets() {
  //bootstrap node module
  wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
  wp_enqueue_style('swiperjs-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
  wp_enqueue_script('swiperjs', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');

  //my css and js
  wp_enqueue_style('stylesheet', get_template_directory_uri() . '/stylesheets/css/general.css');
  wp_enqueue_script('scripts', get_template_directory_uri() . '/js/general.min.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts_and_stylesheets');

add_action( 'wp', 'my_remove_lightbox', 99 );
function my_remove_lightbox() {
   remove_theme_support( 'wc-product-gallery-lightbox' );
}

//remove wc lightbox

//make post editor classic editor
add_filter('use_block_editor_for_post', '__return_false', 10);

//enable featured image for posts
add_theme_support('post-thumbnails');

//enable woocommerce support
add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support() {
  add_theme_support('woocommerce');
}

//remove single product review
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
function wcs_woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']);
    return $tabs;
}

//hide sku in single product
// add_filter( 'wc_product_sku_enabled', '__return_false' );

//hide categories in single product
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

//hide stock except for admin
add_filter( 'woocommerce_get_stock_html', 'hide_stock_except_admin', 10, 2 );
function hide_stock_except_admin( $html, $product ) {
    if ( ! current_user_can( 'manage_options' ) ) {
        return '';
    }
    return $html;
}

function before_shop_loop_search() {
    echo do_shortcode('[aws_search_form]');
}
add_action( 'woocommerce_before_shop_loop', 'before_shop_loop_search' );

