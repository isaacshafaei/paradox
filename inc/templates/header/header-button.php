<?php 
$before_text_button = 'ورود و ثبت نام';
$account_link = get_permalink( get_option('woocommerce_myaccount_page_id') );
if(class_exists('Redux')){
    $button_link = paradox_settings('button_link');
    if($button_link=='custom_link'){
        $before_text_button = (paradox_settings('custom_button_text'))?paradox_settings('custom_button_text'):'ورود و ثبت نام';
        $before_link_button = (paradox_settings('custom_button_link'))?paradox_settings('custom_button_link'):'#';
    }
}
?>
<a href="<?php echo esc_url($before_link_button); ?>" class="register-modal-opener login-button btn btn-filled">
    <i class="fal fa-user-lock"></i>
    <p class="login-btn-txt"><?php echo esc_html($before_text_button ); ?></p>
</a>
    <div class="modal">
        <div class="login-form-overlay"></div>
        <div class="login-form-modal">
            <div class="login-form-modal-inner">
                <div class="login-form-modal-box">
                    <a href="javascript:void(0)" class="close">
                        <?php get_template_part('/assets/img/close-icon.svg'); ?>
                    </a>
                    <div class="login-form-header">
                        <p class="login-title"><?php esc_html_e( 'ورود', 'paradox' ); ?></p>
                    </div>
                    <div class="login-form-content">
                        <?php get_template_part('/inc/templates/login-modal' ); ?>
                        <?php printf(
	                        esc_html__( 'هنوز عضو نشده اید؟ %1$sثبت نام%2$s', 'paradox' ),
	                        '<a href="' . esc_url( $account_link ) . '"><strong>',
                            '</strong></a>'
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

