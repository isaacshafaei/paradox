<?php
// Enqueue styles
function paradox_product_page_scripts() {
    $choose_product_page = paradox_settings('choose_product_page');
    if($choose_product_page=='rocket'){
        global $theme_version;
        $theme_obj = wp_get_theme();
        $theme_version = $theme_obj->get('Version');
        
        wp_enqueue_style( 'rocket', get_template_directory_uri().'/assets/css/rocket.css' );

        wp_enqueue_script( 'rocket', get_template_directory_uri() . '/assets/js/rocket.js', array("jquery"), $theme_version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'paradox_product_page_scripts' );