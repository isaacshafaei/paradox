<?php
if(class_exists('Redux')){
	$regiter_content = paradox_settings('content_log_reg');
	$login_content = paradox_settings('content_log_login');
}
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} ?>
<a href="<?php echo esc_url(home_url('/')); ?>" class="link_back_home">برگشت به صفحه اصلی</a>
<div class="container">
<?php
do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<!-- Login/Register Container -->
<div class="container_register_login" id="container_register_login">

<div class="log_and_reg_container">
	<div class="log_regiter_wrapper">
		<!-- Login -->
		<div class="form-container sign-up-container">

			<?php endif; ?>

			<h2><?php esc_html_e( 'ورود', 'woocommerce' ); ?></h2>

			<form class="woocommerce-form woocommerce-form-login login" method="post">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="نام کاربری" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" placeholder="رمز عبور" name="password" id="password" autocomplete="current-password" />
				</p>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<p class="form-row">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
					</label>
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
				</p>
				<p class="woocommerce-LostPassword lost_password">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
				</p>

				<?php do_action( 'woocommerce_login_form_end' ); ?>
			</form>
			<a href="#" class="register_for_mobile">ثبت نام</a>
			<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
		</div>
		<!-- Resgister -->
		<div class="form-container sign-in-container">

			<h2><?php esc_html_e( 'ثبت نام', 'woocommerce' ); ?></h2>

			<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="نام کاربری" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</p>

				<?php endif; ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="آدرس ایمیل" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="رمز عبور" name="password" id="reg_password" autocomplete="new-password" />
					</p>

				<?php else : ?>

					<p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>

				<?php endif; ?>

				<?php do_action( 'woocommerce_register_form' ); ?>

				<p class="woocommerce-form-row form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>
			<a href="#" class="login_for_mobile">ورود</a>
		</div>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
			 <div class="extra_login_form">
				 <?php echo do_shortcode($login_content); ?>
			 </div>
				<button class="ghost" id="signIn">ثبت نام</button>
			</div>
			<div class="overlay-panel overlay-right">
			<div class="extra_login_form">
			 <?php echo do_shortcode($regiter_content); ?>
			 </div>
				<button class="ghost" id="signUp">ورود</button>
			</div>
		</div>
	</div>
</div>

</div>
<?php endif; ?>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
</div>