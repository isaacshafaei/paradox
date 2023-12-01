<?php
if(class_exists('Redux')){
    $footer_layout =  paradox_settings('footer_elementor');
    $footer_enable =  paradox_settings('footer_visibility');
    $footer_wave_enable =  paradox_settings('footer_waves_visiblity');
    $footer_back_o_top =  paradox_settings('scroll_top_btn');
}
$perfix = 'paradox_';
$disable_footer = get_post_meta(get_the_ID(  ), $perfix.'disable_footer',true);
 ?>
<?php if($footer_back_o_top && !is_account_page()) { ?>
    <a id="back-to-top" class="back-to-top">
        <i class="fal fa-angle-up"></i>
    </a>
<?php } ?>
 <?php if($footer_enable):
        if(!$disable_footer):
     if(!is_account_page() && !is_user_logged_in( ) || !is_account_page() && is_user_logged_in( ) || is_account_page() && is_user_logged_in( )):
 if($footer_layout != 'no-footer'):
    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($footer_layout);
else:
   if($footer_wave_enable){ ?>
<div class="waves">
        <div class="top_footer_wave"></div>
        <div class="bottom_footer_wave"></div>
</div>
<?php } 
get_template_part('/inc/templates/footer/footer');
?>
    <?php endif;//End choose footer type 
         endif; //End if account pgae and is_user_login
        endif; //End footer disable in page
        endif;//End enable footer
     wp_footer(); ?>
</body>
</html>
