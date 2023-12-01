<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $wpdb;

if ( class_exists( 'Redux' ) ) {
 	$instagram_link = paradox_settings('instagram_link');
	$telegram_link = paradox_settings('telegram_link');
    $youtube_link = paradox_settings('youtube_link');
    $aparat_link = paradox_settings('aparat_link');
 }

?>
<div class="status-user-widget">
    <ul>
        <li class="all_course">
            <div class="key_wrapper">
                <span class="icon"><i class="fal fa-university"></i></span>
                <span class="wc-amount">
				<?php

				function product_count_shortcode( ) {
				$count_posts = wp_count_posts( 'product' );
				return $count_posts->publish;
				}
					add_shortcode( 'product_count', 'product_count_shortcode' );
					echo do_shortcode('[product_count]');
					?>
				<span class="woocommerce-Price-currencySymbol">دوره</span></span><span class="title">در سایت وجود دارد</span>
            </div>
        </li>
        <li class="all_course">
            <div class="key_wrapper">
                <span class="icon"><i class="fal fa-user-graduate"></i></span>
                <span class="wc-amount">

	<?php
    // GET USER ORDERS (COMPLETED + PROCESSING)
    $customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $current_user->ID,
        'post_type'   => wc_get_order_types(),
		'post_status' => array('wc-completed'),
    ) );


    // LOOP THROUGH ORDERS AND GET PRODUCT IDS
    $product_ids = array();
    foreach ( $customer_orders as $customer_order ) {
        $order = new WC_Order( $customer_order->ID );
        $items = $order->get_items();
        foreach ( $items as $item ) {
            $product_id = $item->get_product_id();
            $product_ids[] = $product_id;
        }
    }
    $product_ids = array_unique( $product_ids );

    // QUERY PRODUCTS
    $args = array(
       'post_type' => 'product',
       'post__in' => $product_ids,
    );

		echo count( $product_ids );
	?>

				<span class="wc-Symbol">دوره</span></span><span class="title">ثبت نام کرده اید</span>
            </div>
        </li>
        <li class="all_course">
            <div class="key_wrapper">
                <span class="icon"><i class="fal fa-shopping-bag"></i></span>
                <span class="wc-amount">
				<?php echo WC()->cart->get_cart_contents_count(); ?>
				<span class="woocommerce-Price-currencySymbol">دوره</span></span><span class="title">در انتظار پرداخت</span>
            </div>
        </li>

        <li class="all_course">
            <div class="key_wrapper">
                <span class="icon"><i class="fal fa-wallet"></i></span>
                <span class="wc-amount">
				<?php


				if ( is_plugin_active( 'woo-wallet/woo-wallet.php' ) ) {

					$title  = __( 'Current wallet balance', 'woo-wallet' );
					$menu_item  = '<a class="woo-wallet-menu-contents" href="' . esc_url( wc_get_account_endpoint_url( get_option( 'woocommerce_woo_wallet_endpoint', 'woo-wallet' ) ) ) . '" title="' . $title . '">';
					$menu_item .= woo_wallet()->wallet->get_wallet_balance( get_current_user_id() );
					$menu_item .= '</a>';

					echo $menu_item;
					} else {
						echo '<span class="wc-Symbol">0 تومان</span>';
					}


				?>


				</span><span class="title">موجودی شما</span>
            </div>
        </li>
    </ul>
</div>

<div class="notifications-box">
	<span class="notifications-icon"><i class="fal fa-bell"></i></span>
<h4 class="notifications">جدیدترین اطلاعیه ها</h4>

<?php
	$args = array(
	'post_type'         => 'notifications',
	'posts_per_page' =>3,
	);
	$my_query = new WP_Query($args);
	while( $my_query->have_posts() ) : $my_query->the_post();
?>

		<ul class="list-unstyled p-0 mt-4">
          <li class="announce-read mx-2">

						<div class="notif-row">
								<div class="notif-title">
                  <h3><?php the_title(); ?></h3>
                </div>
								<span class="notif-date">
									در تاریخ: <?php echo get_the_date(); ?>
								</span>
						</div>

              <div class="notif-content deactive">
                <div class="card">
                    <?php the_content('', TRUE, '', 40); ?>
                </div>
              </div>
        </li>
				<?php endwhile; wp_reset_postdata(); ?>
    </ul>







</div>


<div class="row">
	<?php if ( !empty($telegram_link) ) : ?>
<div class="col-xs-12 col-md-6 col-sm-12">
                            <a href="<?php echo ($telegram_link); ?>" class="blog-single-social-box blog-single-social-box-telegram" data-wpel-link="external" target="_blank" rel="nofollow external noopener">
                                <div class="blog-single-social-box-icon">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M385.268 121.919l-210.569 129.69c-11.916 7.356-17.555 21.885-13.716 35.323l22.768 80c1.945 6.821 8.015 11.355 14.999 11.355.389 0 .782-.014 1.176-.043 7.466-.542 13.374-6.103 14.367-13.515l5.92-43.866a25.915 25.915 0 018.001-15.45l173.765-161.524a13.817 13.817 0 001.618-18.545 13.836 13.836 0 00-18.329-3.425zM214.32 290.478a46.364 46.364 0 00-14.323 27.655l-2.871 21.278-16.527-58.072c-1.343-4.704.635-9.791 4.805-12.365l154.258-95.007L214.32 290.478z"></path>
                                        <path d="M503.67 37.382a23.52 23.52 0 00-23.698-4.005L15.08 212.719C5.873 216.27-.047 224.939 0 234.804c.048 9.874 6.055 18.495 15.316 21.965l108.59 40.529 42.359 136.225a23.517 23.517 0 0015.703 15.566 23.49 23.49 0 0021.66-4.31l63.14-51.473a8.642 8.642 0 0110.528-.295l113.883 82.681a23.476 23.476 0 0013.823 4.511 23.6 23.6 0 008.517-1.596c7.486-2.895 12.93-9.312 14.56-17.163l83.429-401.309a23.547 23.547 0 00-7.838-22.753zM491.536 55.99l-83.428 401.308c-.302 1.45-1.346 2.053-1.942 2.284-.6.232-1.785.489-2.997-.393l-113.887-82.685a28.982 28.982 0 00-17.052-5.531 29.013 29.013 0 00-18.347 6.519l-63.154 51.485c-1.124.92-2.291.756-2.885.577-.598-.18-1.665-.69-2.099-2.086L141.9 286.462a10.203 10.203 0 00-6.173-6.527L22.462 237.662c-1.696-.635-2.057-1.958-2.062-2.957-.005-.99.343-2.307 2.023-2.955L487.316 52.409l.008-.003c1.51-.583 2.627.087 3.159.537.534.455 1.384 1.455 1.053 3.047z"></path>
                                        <path d="M427.481 252.142c-5.506-1.196-10.936 2.299-12.131 7.804l-1.55 7.14c-1.195 5.505 2.299 10.936 7.804 12.131a10.25 10.25 0 002.174.234c4.695 0 8.92-3.262 9.958-8.037l1.55-7.14c1.194-5.505-2.301-10.936-7.805-12.132zm-10.2 46.98c-5.512-1.195-10.938 2.299-12.132 7.804L381.69 414.977c-1.195 5.505 2.299 10.936 7.803 12.131.73.158 1.457.234 2.174.234 4.696 0 8.92-3.262 9.958-8.037l23.459-108.052c1.195-5.505-2.299-10.936-7.803-12.131z"></path>
                                    </svg>
                                </div>
                                <div class="blog-single-social-box-text">
                                    در <b>تلگرام</b><br>
                                  کانال ما را دنبال کنید!
                                </div>
                            </a>
</div>

<?php endif; ?>

<?php if ( !empty($instagram_link) ) : ?>
<div class="col-xs-12 col-md-6 col-sm-12">
                            <a href="<?php echo ($instagram_link); ?>" class="blog-single-social-box blog-single-social-box-instagram" data-wpel-link="external" target="_blank" rel="nofollow external noopener">
                                <div class="blog-single-social-box-icon">
																	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
																			<path d="M362 44H150C91.551 44 44 91.551 44 150v212c0 58.449 47.551 106 106 106h61c5.523 0 10-4.477 10-10s-4.477-10-10-10h-61c-47.42 0-86-38.58-86-86V150c0-47.42 38.58-86 86-86h212c47.42 0 86 38.58 86 86v212c0 47.42-38.58 86-86 86h-60.333c-5.523 0-10 4.477-10 10s4.477 10 10 10H362c58.449 0 106-47.551 106-106V150c0-58.449-47.551-106-106-106z"></path>
																			<path d="M263.07 450.93c-1.86-1.86-4.44-2.93-7.07-2.93s-5.21 1.07-7.07 2.93S246 455.37 246 458s1.07 5.21 2.93 7.07S253.37 468 256 468s5.21-1.07 7.07-2.93c1.86-1.86 2.93-4.44 2.93-7.07s-1.07-5.21-2.93-7.07zm-87.24-295.22c-3.777-4.03-10.104-4.236-14.135-.461l-.443.417c-4.017 3.79-4.201 10.119-.41 14.136a9.97 9.97 0 007.275 3.137 9.966 9.966 0 006.861-2.727l.391-.367c4.03-3.776 4.237-10.105.461-14.135z"></path>
																			<path d="M256 118c-21.964 0-43.824 5.291-63.217 15.301-4.907 2.533-6.832 8.565-4.299 13.473 2.534 4.907 8.566 6.831 13.473 4.299C218.762 142.398 236.945 138 256 138c65.065 0 118 52.935 118 118s-52.935 118-118 118-118-52.935-118-118c0-20.419 5.295-40.537 15.313-58.178 2.727-4.802 1.045-10.906-3.758-13.634-4.803-2.726-10.906-1.045-13.634 3.758C124.197 208.592 118 232.125 118 256c0 76.093 61.907 138 138 138s138-61.907 138-138-61.907-138-138-138z"></path>
																			<path d="M256 166c-49.626 0-90 40.374-90 90s40.374 90 90 90 90-40.374 90-90-40.374-90-90-90zm0 160c-38.598 0-70-31.402-70-70s31.402-70 70-70 70 31.402 70 70-31.402 70-70 70zM387.25 86.75c-20.953 0-38 17.047-38 38s17.047 38 38 38 38-17.047 38-38-17.047-38-38-38zm0 56c-9.925 0-18-8.075-18-18s8.075-18 18-18 18 8.075 18 18-8.075 18-18 18z"></path>
																	</svg>
                                </div>
                                <div class="blog-single-social-box-text">
                                    در <b>اینستاگرام</b><br>
                                  ما را دنبال کنید!
                                </div>
                            </a>
</div>
<?php endif; ?>


<?php if ( !empty($youtube_link) ) : ?>
<div class="col-xs-12 col-md-6 col-sm-12">
                            <a href="<?php echo ($youtube_link); ?>" class="blog-single-social-box blog-single-social-box-youtube" data-wpel-link="external" target="_blank" rel="nofollow external noopener">
                                <div class="blog-single-social-box-icon">
																	
<!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<g>
	<g>
		<path d="M435.574,59.858H76.426C34.285,59.858,0,94.143,0,136.284v171.023c0,4.427,3.589,8.017,8.017,8.017
			c4.427,0,8.017-3.589,8.017-8.017V136.284c0-33.3,27.092-60.393,60.393-60.393h359.148c33.3,0,60.393,27.092,60.393,60.393
			v239.432c0,33.3-27.092,60.393-60.393,60.393H76.426c-33.3,0-60.393-27.092-60.393-60.393v-34.205
			c0-4.427-3.589-8.017-8.017-8.017c-4.427,0-8.017,3.589-8.017,8.017v34.205c0,42.141,34.285,76.426,76.426,76.426h359.148
			c42.141,0,76.426-34.285,76.426-76.426V136.284C512,94.143,477.715,59.858,435.574,59.858z"/>
	</g>
</g>
<g>
	<g>
		<path d="M362.982,249.278l-34.205-22.233c-3.712-2.412-8.677-1.359-11.091,2.353c-2.412,3.712-1.36,8.677,2.353,11.091
			l23.864,15.511l-148.296,96.394V159.607l98.779,64.206c3.711,2.411,8.678,1.359,11.09-2.353c2.414-3.712,1.36-8.677-2.353-11.091
			l-111.165-72.256c-5.24-3.407-12.384,0.491-12.384,6.721v222.33c0,6.226,7.142,10.131,12.385,6.721l171.023-111.165
			C367.761,259.615,367.76,252.385,362.982,249.278z"/>
	</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>

                                </div>
                                <div class="blog-single-social-box-text">
                                    در <b>یوتوب</b><br>
                                  ما را دنبال کنید!
                                </div>
                            </a>
</div>
<?php endif; ?>

<?php if ( !empty($aparat_link) ) : ?>
<div class="col-xs-12 col-md-6 col-sm-12">
                            <a href="<?php echo ($aparat_link); ?>" class="blog-single-social-box blog-single-social-box-aparat" data-wpel-link="external" target="_blank" rel="nofollow external noopener">
                                <div class="blog-single-social-box-icon">
																	

<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"
 preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
fill="#fff" stroke="none">
<path d="M1570 4615 c-30 -8 -93 -34 -140 -57 -115 -56 -230 -169 -283 -278
-30 -60 -95 -276 -140 -461 -5 -19 32 13 136 116 206 206 402 337 655 440 113
46 334 108 430 121 29 4 51 9 48 11 -2 2 -96 29 -208 60 -182 49 -216 55 -323
59 -86 3 -136 0 -175 -11z"/>
<path d="M2388 4349 c-208 -20 -413 -78 -608 -170 -550 -262 -925 -766 -1015
-1365 -19 -128 -19 -390 0 -518 90 -599 465 -1103 1015 -1365 585 -278 1266
-228 1805 134 406 272 672 676 772 1170 26 129 26 511 0 640 -100 494 -366
898 -772 1170 -353 237 -777 344 -1197 304z m-236 -490 c281 -58 464 -349 393
-624 -100 -384 -583 -515 -864 -234 -202 202 -201 511 3 715 129 128 295 179
468 143z m1321 -254 c232 -60 387 -256 387 -489 0 -151 -43 -259 -145 -361
-70 -70 -155 -118 -246 -140 -126 -29 -232 -16 -355 45 -200 98 -315 328 -271
541 23 112 61 183 142 265 105 105 213 151 360 153 39 1 97 -6 128 -14z m-816
-864 c76 -39 123 -112 123 -192 0 -173 -168 -279 -325 -205 -59 27 -77 46
-104 106 -88 193 118 388 306 291z m-776 -241 c30 -5 91 -28 135 -50 200 -98
315 -328 271 -541 -23 -112 -61 -183 -142 -265 -164 -165 -393 -201 -603 -95
-269 136 -358 489 -186 739 115 165 322 249 525 212z m1333 -256 c263 -68 430
-333 375 -596 -29 -137 -148 -293 -269 -351 -207 -100 -442 -63 -597 92 -203
202 -204 520 -3 721 128 127 319 179 494 134z"/>
<path d="M3770 4112 c0 -4 20 -22 45 -40 114 -86 289 -279 395 -438 145 -215
259 -502 300 -762 7 -40 14 -71 17 -69 2 3 33 114 69 248 56 214 64 255 64
334 0 177 -65 332 -190 456 -101 99 -191 144 -405 199 -88 23 -190 50 -227 60
-38 10 -68 16 -68 12z"/>
<path d="M580 2237 c0 -4 -25 -100 -55 -214 -47 -179 -55 -220 -55 -298 0
-177 65 -332 189 -455 107 -105 179 -140 443 -210 117 -31 215 -55 217 -54 2
2 -9 14 -25 26 -56 43 -237 224 -297 298 -183 225 -325 523 -387 806 -18 85
-30 124 -30 101z"/>
<path d="M4095 1319 c-22 -29 -81 -94 -131 -145 -272 -273 -629 -467 -1004
-544 -57 -11 -106 -23 -108 -25 -4 -4 -5 -4 228 -66 307 -82 431 -80 618 12
138 68 261 199 311 335 26 67 133 464 129 476 -2 5 -21 -15 -43 -43z"/>
</g>
</svg>

                                </div>
                                <div class="blog-single-social-box-text">
                                    در <b>آپارات</b><br>
                                  ما را دنبال کنید!
                                </div>
                            </a>
</div>
<?php endif; ?>


</div>




<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' ); ?>

