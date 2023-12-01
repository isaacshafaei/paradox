<?php
$stickey_header_class='';
$full_width_class = '';
$logo_image = '';
$header_height = (paradox_settings('header_height_size'))?paradox_settings('header_height_size'):'80';
if(class_exists('Redux')){
    if(paradox_settings('sticky_header') == true){
        $stickey_header_class = 'stickey_header';
    }

    $full_width_header = paradox_settings('header_fullwidth');
    if($full_width_header==true){
        $full_width_class = 'header_full_width';
    }
$logo_image = (paradox_settings('logo_image')['url'])?paradox_settings('logo_image')['url']:'';
$logo_width = (paradox_settings('logo_image_width_size'))?paradox_settings('logo_image_width_size'):'170';
$logo_padding = (paradox_settings('logo_image_padding'))?paradox_settings('logo_image_padding'):'0';
$enable_button_hedaer = (paradox_settings('button_on_header')==true)?true:false;
$enable_basket = paradox_settings('enable_basket');
$enable_basket_on_mobile = paradox_settings('basket_mobile');
}
 ?>
<header style="height:<?php echo $header_height; ?>px" class="header <?php echo $stickey_header_class; ?>">
        <div class="container <?php echo $full_width_class; ?>">
            <div class="row">
                <div class="column">
                    <div class="logo">
                        <a href="<?php echo home_url(); ?>">
                            <img style="width:<?php echo $logo_width; ?>px;padding:<?php echo $logo_padding['padding-top'].' '.$logo_padding['padding-right'].' '.$logo_padding['padding-bottom'].' '.$logo_padding['padding-left'];?>" src="<?php echo ($logo_image)?$logo_image: '';?>" alt="">
                        </a>
                    </div>
                    <?php get_template_part('/inc/templates/header/main-menu'); ?>
                </div>
                <div class="column">
                    <?php 
                     if(function_exists('WC') && $enable_basket==true): ?>
                        <div class="mini_cart <?php echo ($enable_basket_on_mobile)?'':'hide_on_mobile'; ?>">
                            <a href="javascript:void(0)">
                                <i class="fal fa-shopping-bag"></i>
                                <span class="basket_number"><?php paradox_cart_count(); ?></span>    
                            </a>
                        </div>
                  <?php endif; ?>
                  <?php if($enable_button_hedaer==true){ ?>
                    <div class="button_link">
                    <?php
                    if(is_plugin_active('digits/digit.php')){
                        if(is_user_logged_in()){
                            get_template_part('/inc/templates/header/user-menu'); 
                        }else{
                            echo do_shortcode('[dm-modal]'); 
                        }    
                    }else{
                        if(is_user_logged_in()){
                            get_template_part('/inc/templates/header/user-menu'); 
                        }else{
                            get_template_part('/inc/templates/header/header-button'); 
                        }    
                    }
                     ?>
                    </div>
                    <?php } ?>
                    <a href="#" class="mobile-nav-toggle">
                        <span class="the-icon"></span>
                    </a>
                </div>
            </div> 
            <div class="search_wrapper">
                <form class="search-form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                    <input data-swplive="true" type="search" name="s" id="" placeholder="هرچیزی می خواید جستجو کنید...">
                    <button class="submit" type="submit">
                        <i class="fa fa-search"></i>
                    </button>   
                </form>
            </div>
        </div>
    </header>