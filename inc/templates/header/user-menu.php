<?php 
$after_text_button = 'ورود و ثبت نام';
if(class_exists('Redux')){
    $button_link = paradox_settings('button_link');
    if($button_link=='custom_link'){
        $after_text_button = (paradox_settings('custom_button_text_after_login'))?paradox_settings('custom_button_text_after_login'):'ورود و ثبت نام';
        $after_link_button = (paradox_settings('custom_button_link_after_login'))?paradox_settings('custom_button_link_after_login'):'#';
    }
}
if($button_link=='custom_link'){ ?>
<a href="<?php echo esc_url($after_link_button); ?>" class="register-modal-opener login-button btn btn-filled">
    <i class="fal fa-user-lock"></i>
    <p class="login-btn-txt"><?php echo esc_html($after_text_button ); ?></p>
</a>
<?php
}else{
    if(class_exists('WooCommerce')){
        echo get_avatar(get_current_user_id(), 40 );
        ?>
       <span class="username">
          <?php
          global $current_user;
          echo $current_user->display_name
          ?>
       </span>
       <i class="fal fa-chevron-down"></i>
       <div class="user-menu__list">
           <ul>
              <?php
              if(is_plugin_active('woo-wallet/woo-wallet.php')){
                  echo '<li><a href="'.esc_url(wc_get_account_endpoint_url(get_option('woocommerce_woo_walet_endpoint','woo-wallet'))).'">';
                      echo 'اعتبار : '.woo_wallet()->wallet->get_wallet_balance(get_current_user_id());
                  echo '</li></a>';
              }
               ?>
               <li>
                   <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="">پنل کاربری</a>
               </li>
               <li>
                   <a href="<?php echo esc_url(wc_get_account_endpoint_url('downloads')); ?>">دانلودها</a>
               </li>
               <li class="log-out">
                   <a href="<?php echo esc_url(wc_get_account_endpoint_url('customer-logout')); ?>"> <i class="fal fa-sign-out"></i> خروج از حساب</a>
               </li>
           </ul>
       </div>
  
       <?php }
}