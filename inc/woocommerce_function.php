<?php
if (!function_exists('paradox_cart_count')) {
    function paradox_cart_count(){
        $count = WC()->cart->cart_contents_count;
		?>
		<span class="cart-number"><?php echo esc_html($count); ?></span>
		<?php
    }
}

/**
 * Render custom price html
 */
function paradox_custom_get_price_html( $price, $product ) {
	if ( $product->get_price() == 0 ) {
		if ( $product->is_on_sale() && $product->get_regular_price() ) {
			$regular_price = '<del class="amount-free">' . wc_get_price_to_display( $product, array( 'qty' => 1, 'price' => $product->get_regular_price() ) ) . '</del>';

			$price = wc_format_price_range( $regular_price, esc_html__( 'رایگان!', 'paradox' ) );
		} else {
			$price = '<span class="amount">' . esc_html__( 'رایگان!', 'paradox' ) . '</span>';
		}
	}

	return $price;
}

add_filter( 'woocommerce_get_price_html', 'paradox_custom_get_price_html', 10, 2 );

//get teachers list
if(!function_exists('paradox_get_teachers_list')){
	function paradox_get_teachers_list(){
		$teachers = array(
			'no-teacher'   => __( 'یک استاد را انتخاب کنید', 'paradox' ),
		);

		$teachers_arg = array(
			'post_type' => 'teacher',
			'post_status' =>'publish',
			'post_per_page' =>-1,
		);

		$teachers_query = new WP_Query($teachers_arg);

		foreach($teachers_query->posts as $teacher){
			$teachers[$teacher->ID] = $teacher->post_title;
		}

		return $teachers;
	}
}

//remove woocommerce breadcrumb
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Remove Woo Styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
// Remove result count and catalog ordering
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Remove Cross-Sells from the shopping cart page
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
// Remove tabs & upsell display
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

// Remove functions before single product summary
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_custom_meta', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// Remove thumbnails from product single
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

/**
 * Remove sidebar from single product
 */
function remove_sidebar_shop() {
	if ( is_singular('product') ) {
		remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
	}
}
add_action('template_redirect', 'remove_sidebar_shop');

function custom_remove_all_quantity_fields( $return, $product ) {return true;}
add_filter( 'woocommerce_is_sold_individually','custom_remove_all_quantity_fields', 10, 2 );


/*  Sale Product Countdown
/* --------------------------------------------------------------------- */
if( ! function_exists( 'paradox_sale_product_countdown' ) ) {
	function paradox_sale_product_countdown() {
		global $product;

		if ( $product->is_on_sale() ) :
			$time_sale_end = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
		endif;

		?>

		<?php if( $product->is_on_sale() && $time_sale_end ) :?>
			<div class="discount_countdown">
				<div class="counter_text">
					<i class="fal fa-clock"></i>
					پیشنهاد
					<span>شگفت انگیز</span>
				</div>
				<div class="counter_number" data-date="<?php echo date('Y-m-d 00:00:00',$time_sale_end); ?>"></div>
			</div>
		<?php endif;?>

	<?php }
}

add_action( 'woocommerce_single_product_countdown', 'paradox_sale_product_countdown', 14 );

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
	$prefix = 'paradox_';
	$add_to_cart_text= get_post_meta(get_the_ID(  ),$prefix . 'course_add_to_cart_text',true );
	if(class_exists('Redux')){
		$add_to_cart_text_from_setting =  paradox_settings('add_to_cart_text');
	}
	if($add_to_cart_text){
		return __( $add_to_cart_text, 'paradox' ); 
	}elseif($add_to_cart_text_from_setting){
		return __( $add_to_cart_text_from_setting, 'paradox' ); 
	}else{
		return __( 'ثبت نام در دوره', 'paradox' ); 
	}
}

add_filter( 'woocommerce_loop_add_to_cart_link', 'ts_replace_add_to_cart_button', 10, 2 );
function ts_replace_add_to_cart_button( $button, $product ) {
if (is_product_category() || is_shop()) {
$button_text = __("شرکت در دوره", "woocommerce");
$button_link = $product->get_permalink();
$button = '<a class="button product_type_simple add_to_cart_button ajax_add_to_cart" href="' . $button_link . '">' . $button_text . '</a>';
return $button;
}
}

add_filter( 'woocommerce_get_availability', 'paradox_change_out_of_stock_text_woocommerce', 1, 2);

function paradox_change_out_of_stock_text_woocommerce( $availability, $product_to_check ) {

// Change Out of Stock Text
if ( ! $product_to_check->is_in_stock() ) {
$availability['availability'] = 'این دوره فعلاً غیرفعال می باشد.';
}
return $availability;
}

/**
* Change number of products that are displayed per page (shop page)
*/
add_filter( 'loop_shop_per_page', 'paradox_loop_shop_per_page', 20 );
function paradox_loop_shop_per_page( $cols ) {
  $product_post_per_page =  paradox_settings('shop_per_page');
return $product_post_per_page;
}

/* Remove Woocommerce User Fields */
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
add_filter( 'woocommerce_billing_fields' , 'custom_override_billing_fields' );
add_filter( 'woocommerce_shipping_fields' , 'custom_override_shipping_fields' );
// Removes Order Notes Title
add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );
function custom_override_checkout_fields( $fields ) {
  unset($fields['order']['order_comments']);
  unset($fields['billing']['billing_state']);
  unset($fields['billing']['billing_country']);
  unset($fields['billing']['billing_company']);
  unset($fields['billing']['billing_address_1']);
  unset($fields['billing']['billing_address_2']);
  unset($fields['billing']['billing_postcode']);
  unset($fields['billing']['billing_city']);
  unset($fields['shipping']['shipping_state']);
  unset($fields['shipping']['shipping_country']);
  unset($fields['shipping']['shipping_company']);
  unset($fields['shipping']['shipping_address_1']);
  unset($fields['shipping']['shipping_address_2']);
  unset($fields['shipping']['shipping_postcode']);
  unset($fields['shipping']['shipping_city']);
  return $fields;
}
function custom_override_billing_fields( $fields ) {
  unset($fields['billing_state']);
  unset($fields['billing_country']);
  unset($fields['billing_company']);
  unset($fields['billing_address_1']);
  unset($fields['billing_address_2']);
  unset($fields['billing_postcode']);
  unset($fields['billing_city']);
  return $fields;
}
function custom_override_shipping_fields( $fields ) {
  unset($fields['shipping_state']);
  unset($fields['shipping_country']);
  unset($fields['shipping_company']);
  unset($fields['shipping_address_1']);
  unset($fields['shipping_address_2']);
  unset($fields['shipping_postcode']);
  unset($fields['shipping_city']);
  return $fields;
}
/* End - Remove Woocommerce User Fields */

/**
 * Remove the generated product schema markup from the Product Category and Shop pages.
 */
function wc_remove_product_schema_product_archive() {
    remove_action( 'woocommerce_shop_loop', array( WC()->structured_data, 'generate_product_data' ), 10, 0 );
}
add_action( 'woocommerce_init', 'wc_remove_product_schema_product_archive' );

// force to update woocommerce link files for old users
class WooCommerce_Legacy_Grant_Download_Permissions {
	protected static $instance = null;
	private function __construct() {
		if ( ! class_exists( 'WC_Admin_Post_Types', false ) ) {
			return;
		}
		remove_action( 'woocommerce_process_product_file_download_paths', array( 'WC_Admin_Post_Types', 'process_product_file_download_paths' ), 10, 3 );
		add_action( 'woocommerce_process_product_file_download_paths', array( $this, 'grant_download_permissions' ), 10, 3 );
	}
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	public function grant_download_permissions( $product_id, $variation_id, $downloadable_files ) {
		global $wpdb;

		if ( $variation_id ) {
			$product_id = $variation_id;
		}

		if ( ! $product = wc_get_product( $product_id ) ) {
			return;
		}

		$existing_download_ids = array_keys( (array) $product->get_downloads() );
		$updated_download_ids  = array_keys( (array) $downloadable_files );
		$new_download_ids      = array_filter( array_diff( $updated_download_ids, $existing_download_ids ) );
		$removed_download_ids  = array_filter( array_diff( $existing_download_ids, $updated_download_ids ) );

		if ( ! empty( $new_download_ids ) || ! empty( $removed_download_ids ) ) {
			$existing_orders = $wpdb->get_col( $wpdb->prepare( "SELECT order_id from {$wpdb->prefix}woocommerce_downloadable_product_permissions WHERE product_id = %d GROUP BY order_id", $product_id ) );

			foreach ( $existing_orders as $existing_order_id ) {
				$order = wc_get_order( $existing_order_id );

				if ( $order ) {
					if ( ! empty( $removed_download_ids ) ) {
						foreach ( $removed_download_ids as $download_id ) {
							if ( apply_filters( 'woocommerce_process_product_file_download_paths_remove_access_to_old_file', true, $download_id, $product_id, $order ) ) {
								$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}woocommerce_downloadable_product_permissions WHERE order_id = %d AND product_id = %d AND download_id = %s", $order->get_id(), $product_id, $download_id ) );
							}
						}
					}
					if ( ! empty( $new_download_ids ) ) {
						foreach ( $new_download_ids as $download_id ) {
							if ( apply_filters( 'woocommerce_process_product_file_download_paths_grant_access_to_new_file', true, $download_id, $product_id, $order ) ) {
								if ( ! $wpdb->get_var( $wpdb->prepare( "SELECT 1=1 FROM {$wpdb->prefix}woocommerce_downloadable_product_permissions WHERE order_id = %d AND product_id = %d AND download_id = %s", $order->get_id(), $product_id, $download_id ) ) ) {
									wc_downloadable_file_permission( $download_id, $product_id, $order );
								}
							}
						}
					}
				}
			}
		}
	}
}

add_action( 'admin_init', array( 'WooCommerce_Legacy_Grant_Download_Permissions', 'get_instance' ) );
// برای بالا بردن سرعت سایت
function dequeuePublicMy(){
	// اگر آیکن های سایت شما پرید این قسمت رو حذف کنید
	wp_dequeue_style('font-awesome-4-shim');
 	wp_deregister_style('font-awesome-4-shim');
	
	wp_dequeue_style('elementor-global');
	wp_deregister_style('elementor-global');

	wp_dequeue_style('font-awesome-5-all');
        wp_deregister_style('font-awesome-5-all');	
    // تا این قسمت
    

	wp_dequeue_script('contact-form-7');
        wp_deregister_script('contact-form-7');

	wp_dequeue_script('comment-reply');
        wp_deregister_script('comment-reply');

        wp_dequeue_script('wp-embed');
        wp_deregister_script('wp-embed');

        wp_dequeue_style('wp-block-library');
	wp_deregister_style('wp-block-library');

	wp_dequeue_style('wp-block-library-theme');
        wp_deregister_style('wp-block-library-theme');
    
        wp_dequeue_style('contact-form-7-rtl');
	wp_deregister_style('contact-form-7-rtl');

}


add_shortcode( 'my_products', 'paradox_user_products_bought' );

function paradox_user_products_bought() {

    global $product, $woocommerce, $woocommerce_loop;

    // GET USER
    $current_user = wp_get_current_user();

    // GET USER ORDERS (COMPLETED + PROCESSING)
    $customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $current_user->ID,
        'post_type'   => wc_get_order_types(),
		'post_status' => array('wc-completed'),
    ) );

    // LOOP THROUGH ORDERS AND GET PRODUCT IDS
    if (!$customer_orders) return;
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
	   'posts_per_page' => -1,
    );
    $loop = new WP_Query( $args );

    // GENERATE WC LOOP
    ob_start();
    echo '<div class="products_in_user_panel">';
    while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<div class="purchesed_product_item">
			<div class="thumbnail_item">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			</div>
			<div class="item_content">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<div class="course_price">
					<?php woocommerce_template_loop_price(); ?>
				</div>
			</div>
		</div>
    <?php 
    endwhile;
	echo '</div>';
    woocommerce_product_loop_end();
    woocommerce_reset_loop();
    wp_reset_postdata();
}
#purchsed items in my account

add_filter ( 'woocommerce_account_menu_items', 'paradox_purchased_products_link', 40 );
add_action( 'init', 'paradox_add_products_endpoint');
add_action( 'woocommerce_account_purchased-products_endpoint', 'paradox_populate_products_page' );

// here we hook the My Account menu links and add our custom one
function paradox_purchased_products_link( $menu_links ){

	// we use array_slice() because we want our link to be on the 3rd position
	return array_slice( $menu_links, 0, 2, true )
	+ array( 'purchased-products' => 'دوره های خریداری شده' )
	+ array_slice( $menu_links, 2, NULL, true );

}

// here we register our rewrite rule
function paradox_add_products_endpoint() {
	add_rewrite_endpoint( 'purchased-products', EP_PAGES );
}

// here we populate the new page with the content
function paradox_populate_products_page() {

	global $wpdb;

	// this SQL query allows to get all the products purchased by the current user
	// in this example we sort products by date but you can reorder them another way
	$purchased_products_ids = $wpdb->get_col( $wpdb->prepare(
		"
		SELECT      itemmeta.meta_value
		FROM        " . $wpdb->prefix . "woocommerce_order_itemmeta itemmeta
		INNER JOIN  " . $wpdb->prefix . "woocommerce_order_items items
		            ON itemmeta.order_item_id = items.order_item_id
		INNER JOIN  $wpdb->posts orders
		            ON orders.ID = items.order_id
		INNER JOIN  $wpdb->postmeta ordermeta
		            ON orders.ID = ordermeta.post_id
		WHERE       itemmeta.meta_key = '_product_id'
		            AND ordermeta.meta_key = '_customer_user'
		            AND ordermeta.meta_value = %s
		ORDER BY    orders.post_date DESC
		",
		get_current_user_id()
	) );

	// some orders may contain the same product, but we do not need it twice
	$purchased_products_ids = array_unique( $purchased_products_ids );

	// if the customer purchased something
	if( !empty( $purchased_products_ids ) ) :

		echo do_shortcode('[my_products]');


	else:
		echo 'هنوز دوره ای خریداری نشده است.';
	endif;

}

if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) {
	/*
	 * کد افزودن لیست علاقه مندی به پیشخوان مشتریان
	 */
	add_filter ( 'woocommerce_account_menu_items', 'paradox_log_history_link', 40 );
	function paradox_log_history_link( $menu_links ){
	
		$menu_links = array_slice( $menu_links, 0, 3, true )
		+ array( 'mywishlist' => 'علاقه مندی ها' )
		+ array_slice( $menu_links, 3, NULL, true );
	
		return $menu_links;
	
	}
	/*
	 * Step 2. Register Permalink Endpoint
	 */
	add_action( 'init', 'paradox_add_endpoint' );
	function paradox_add_endpoint() {
	
		// WP_Rewrite is my Achilles' heel, so please do not ask me for detailed explanation
		add_rewrite_endpoint( 'mywishlist', EP_PAGES );
	}
	/*
	 * Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
	*/
	add_action( 'woocommerce_account_mywishlist_endpoint', 'paradox_my_account_endpoint_content' );
	function paradox_my_account_endpoint_content() {
	
		// of course you can print dynamic content here, one of the most useful functions here is get_current_user_id()
		echo do_shortcode('[yith_wcwl_wishlist]');
	
	}
	
}

//spotplayer
if(is_plugin_active( 'spotplayer/index.php')){

	if ( ! function_exists( 'paradox_spot_woo_shop_my_menu' ) ) {
		function paradox_spot_woo_shop_my_menu($links): array {
			return array_slice($links, 0, 1, true) + ['licenses' => 'لایسنس‌های من'] + array_slice($links, 1, NULL, true);
		}
		add_filter('woocommerce_account_menu_items', 'paradox_spot_woo_shop_my_menu', 50);
		
		function paradox_spot_woo_shop_my_licenses_init() {
			add_rewrite_endpoint('licenses', EP_PAGES);
			flush_rewrite_rules();
		}
		add_action('init', 'paradox_spot_woo_shop_my_licenses_init');
		
		function paradox_spot_woo_shop_my_licenses_content() {
				do_shortcode('[spotplayer_courses]');
		}
		add_action('woocommerce_account_licenses_endpoint', 'paradox_spot_woo_shop_my_licenses_content');
	}
}