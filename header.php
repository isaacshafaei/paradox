<?php																			
$perfix = 'paradox_';
$faive_icon = '';
$faive_icon_retina = '';
$header_layout ='';
if(class_exists('Redux')){
    $header_layout =  paradox_settings('header_elementor');
    $faive_icon = isset(paradox_settings('favie_icon')['url']);
    $faive_icon_retina = isset(paradox_settings('favie_icon_retina')['url']);
} ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php if($faive_icon){ ?>
    <link rel="shortcut icon" href="<?php echo esc_url($faive_icon); ?>">
    <?php } ?>
    <?php if($faive_icon_retina){ ?>
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo esc_url($faive_icon_retina); ?>">
    <?php } ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
if(!get_post_meta(get_the_ID( ), $perfix.'disable_header',true)){ 
    if(!is_account_page() && !is_user_logged_in( ) || !is_account_page() && is_user_logged_in( ) || is_account_page() && is_user_logged_in( )):
 get_template_part('/inc/templates/header/loadings'); 
  do_action( 'paradox_before_body' ); ?>
<div class="video_popup_wrrapper">
    <div class="video_popup_overlay"></div>
    <div class="video_popup_inner"></div>
</div>
<?php
if($header_layout != 'no-header' && is_plugin_active( 'elementor/elementor.php' )){ 
    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($header_layout);
    if(!get_post_meta(get_the_ID(  ), $perfix.'disable_bredacrumb_page',true) && !is_front_page( ) && !is_account_page()){
        echo '<div class="container">';
             esc_html( denshyar_breadcrumb() ); 
        echo "</div>";
    }

}else{
 get_template_part('/inc/templates/header/box-cart'); 
 get_template_part('/inc/templates/header/top-bar'); 
 get_template_part('/inc/templates/header/header'); 
        if(!is_front_page( )){
            get_template_part('/inc/templates/page-title'); 
        }
    }
endif;//end account page and user_loges_in
}//end disable sidebar

 ?>
