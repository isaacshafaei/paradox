<?php
//Theme Translation
  load_theme_textdomain('paradox', get_template_directory() . '/languages');
  $locale = get_locale();
  $locale_file = TEMPLATEPATH . '/languages/' . $locale . '.php';
  if(is_readable($locale_file)) {
  require_once($locale_file);
  }

// Get Elementor Footer
if ( ! function_exists( 'paradox_get_footer_list' ) ) {
	function paradox_get_footer_list() {
  
	  $footers = array(
		'no-footer' => esc_html__( 'فوتر پیش فرض قالب', 'paradox' ),
	  );
  
	  $footers_args = array(
		'post_type'     => 'footer',
		'post_status'   => 'publish',
		'posts_per_page'=> -1,
	  );
  
	  $footers_query = new WP_Query( $footers_args );
  
	  foreach( $footers_query->posts as $footer ){
		$footers[$footer->ID] = $footer->post_title;
	  }
  
	  return $footers;
	}
  }

// Get Elementor Header
if ( ! function_exists( 'paradox_get_header_list' ) ) {
	function paradox_get_header_list() {
  
	  $headers = array(
		'no-header' => esc_html__( 'هدر پیش فرض قالب', 'paradox' ),
	  );
  
	  $header_args = array(
		'post_type'     => 'header',
		'post_status'   => 'publish',
		'posts_per_page'=> -1,
	  );
  
	  $header_query = new WP_Query( $header_args );
  
	  foreach( $header_query->posts as $header ){
		$headers[$header->ID] = $header->post_title;
	  }
  
	  return $headers;
	}
  }

require_once get_template_directory().'/inc/plugins/TGM-plugin/class-tgm-plugin-activation.php';

function paradox_register_required_plugins() {
	$plugins = array(

	array(
		'name'               => esc_html__('paradox Core','paradox' ), // The plugin name.
		'slug'               => 'paradox-core', // The plugin slug (typically the folder name).
		'source'             => get_template_directory() . '/inc/plugins/paradox-core.zip', // The plugin source.
		'required'           => true, // If false, the plugin is only 'recommended' instead of required.
		'version'            => $theme_version, // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
	),
	array(
		'name'               => esc_html__('Redux Framework','paradox' ), 
		'slug'               => 'redux-framework', 
		'required'           => true, 
	),
    array(
			'name'               => esc_html__('Elementor','paradox' ), 
			'slug'               => 'elementor', 
			'required'           => true, 
		),
		array(
			'name'               => esc_html__('تکه‌مسیر NavXT','paradox' ), 
			'slug'               => 'breadcrumb-navxt', 
			'required'           => true, 
		),
    array(
			'name'               => esc_html__('Mailchimp','paradox' ), 
			'slug'               => 'mailchimp-for-wp', 
			'required'           => false, 
		),
    array(
			'name'               => esc_html__('Woocommerce','paradox' ), 
			'slug'               => 'woocommerce', 
			'required'           => true, 
		),
    array(
			'name'               => esc_html__('Woo Wallet','paradox' ),
			'slug'               => 'woo-wallet-settings', 
			'required'           => false, 
		),


	);

	$config = array(
		'id'           => 'paradox',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'paradox_register_required_plugins' );

//redux
if ( !class_exists( 'ReduxFramework' ) && file_exists( WP_PLUGIN_DIR.'/redux-framework/redux-core/framework.php' ) ) {
    require_once( WP_PLUGIN_DIR . '/redux-framework/redux-core/framework.php' );
}
if (class_exists( 'ReduxFramework' )) {
    require_once(get_parent_theme_file_path('/inc/panel-settings.php'));
    require_once(get_parent_theme_file_path('/inc/call_files.php'));
}


if (!function_exists('is_plugin_active')) {
  include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
//require files
require_once get_parent_theme_file_path('/inc/mega-menus.php');
require get_parent_theme_file_path('/inc/woocommerce_function.php');
require get_parent_theme_file_path('/inc/paradox_function.php');

//after setup theme
function daneshar_after_theme_setup(){
  add_theme_support( 'post-formats', array( 'audio', 'video' ) );
  //dynamic title
  add_theme_support('title-tag');
  add_theme_support('woocommerce');
  add_image_size('paradox-420x294', 420,294,true);
  add_image_size('paradox-120x120', 120,120,true);
  add_image_size('paradox-370x270', 370,270,true);
}
add_action( 'after_setup_theme','daneshar_after_theme_setup' );

  //top bar left menu
  function paradox_tob_bar_menu(){
    register_nav_menus(
        array(
            'main-menu' => esc_html__('Main Header Menu','paradox'),
			'mobile-menu' => esc_html__('Mobile Side Menu', 'paradox' ),
            'top-bar-menu' => esc_html__('Top Bar Menu','paradox')
        )
    );

    //add teacher post type
    register_post_type('teacher',
    array(
      'labels'  => array(
        'name' => __('مدرسین'),
        'singular_name' => __('مدرس'),
        'add_new'               => __( 'افزودن مدرس'),
        'add_new_item'          => __( 'افزودن مدرس'),
		'edit_item'           => __( 'ویرایش مدرس', 'paradox' ),
		'update_item'         => __( 'بروزرسانی مدرس', 'paradox' ),
      ),
      'menu_icon' =>'dashicons-businesswoman',
      'public'  => true,
      'has_archive' =>false,
      'supports'  => array('title','editor','thumbnail','link','excerpt'),
    ));
	//add header post type
	register_post_type('header',
	array(
		'labels'  => array(
		'name'                => _x( 'هدرها', 'Post Type General Name', 'paradox' ),
		'singular_name'       => _x( 'هدر', 'Post Type Singular Name', 'paradox' ),
		'menu_name'           => __( 'هدرها', 'paradox' ),
		'parent_item_colon'   => __( 'هدر والد:', 'paradox' ),
		'all_items'           => __( 'همه هدرها', 'paradox' ),
		'view_item'           => __( 'مشاهده هدر', 'paradox' ),
		'add_new_item'        => __( 'افزودن هدر جدید', 'paradox' ),
		'add_new'             => __( 'افزودن جدید', 'paradox' ),
		'edit_item'           => __( 'ویرایش هدر', 'paradox' ),
		'update_item'         => __( 'بروزرسانی هدر', 'paradox' ),
		'search_items'        => __( 'جستجوی هدر', 'paradox' ),
		'not_found'           => __( 'یافت نشد', 'paradox' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'paradox' ),
	),
		'public'  => true,
		'has_archive' =>false,
		'menu_icon' =>'dashicons-arrow-up-alt2',
		'supports'  => array('title','editor'),
		'description'         => __( 'نوشته نوع هدر', 'paradox' ),
	));
	//add footer post type
	register_post_type('footer',
	array(
		'labels'  => array(
		'name'                => _x( 'فوترها', 'Post Type General Name', 'paradox' ),
		'singular_name'       => _x( 'فوتر', 'Post Type Singular Name', 'paradox' ),
		'menu_name'           => __( 'فوترها', 'paradox' ),
		'parent_item_colon'   => __( 'فوتر والد:', 'paradox' ),
		'all_items'           => __( 'همه فوترها', 'paradox' ),
		'view_item'           => __( 'مشاهده فوتر', 'paradox' ),
		'add_new_item'        => __( 'افزودن فوتر جدید', 'paradox' ),
		'add_new'             => __( 'افزودن جدید', 'paradox' ),
		'edit_item'           => __( 'ویرایش فوتر', 'paradox' ),
		'update_item'         => __( 'بروزرسانی فوتر', 'paradox' ),
		'search_items'        => __( 'جستجوی فوتر', 'paradox' ),
		'not_found'           => __( 'یافت نشد', 'paradox' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'paradox' ),
	),
		'public'  => true,
		'has_archive' =>false,
		'menu_icon' =>'dashicons-arrow-down-alt2',
		'supports'  => array('title','editor'),
		'description'         => __( 'نوشته نوع فوتر', 'paradox' ),
	));

		//add notifications post type
		register_post_type('notifications',
		array(
			'labels'  => array(
			'name'                => _x( 'پیغام ها', 'Post Type General Name', 'paradox' ),
			'singular_name'       => _x( 'پیغام', 'Post Type Singular Name', 'paradox' ),
			'menu_name'           => __( 'پیغام ها', 'paradox' ),
			'parent_item_colon'   => __( 'پیغام والد:', 'paradox' ),
			'all_items'           => __( 'همه پیغام ها', 'paradox' ),
			'view_item'           => __( 'مشاهده پیغام', 'paradox' ),
			'add_new_item'        => __( 'افزودن پیغام جدید', 'paradox' ),
			'add_new'             => __( 'افزودن جدید', 'paradox' ),
			'edit_item'           => __( 'ویرایش پیغام', 'paradox' ),
			'update_item'         => __( 'بروزرسانی پیغام', 'paradox' ),
			'search_items'        => __( 'جستجوی پیغام', 'paradox' ),
			'not_found'           => __( 'یافت نشد', 'paradox' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'paradox' ),
		),
			'public'  => true,
			'has_archive' =>false,
			'menu_icon' =>'dashicons-email-alt2',
			'supports'  => array('title','editor'),
			'description'         => __( 'نوشته نوع پیغام', 'paradox' ),
		));	
  }
  add_action('init','paradox_tob_bar_menu');

  # Mobile Navigation
if ( ! function_exists( 'paradox_mobile_nav' ) ) {
    function paradox_mobile_nav() {
        get_template_part( 'inc/templates/mobile-nav' );
    }

    add_action( 'paradox_before_body', 'paradox_mobile_nav', 20 );
}

// Enqueue styles
function paradox_theme_scripts() {
	global $theme_version;
	$theme_obj = wp_get_theme();
	$theme_version = $theme_obj->get('Version');

    wp_enqueue_style( 'main-style', get_stylesheet_uri() );
    wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/assets/css/fontawesome.min.css' );
    wp_enqueue_style( 'fontawesome2', get_template_directory_uri().'/assets/css/font-awesome.min.css' );
    wp_enqueue_style( 'paradox', get_template_directory_uri().'/assets/css/paradox.css' );
    wp_enqueue_style( 'carousel', get_template_directory_uri().'/assets/css/owl.carousel.min.css' );
    wp_enqueue_style( 'theme_carousel', get_template_directory_uri().'/assets/css/owl.theme.default.min.css' );
	
    wp_enqueue_script( 'carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array("jquery"), $theme_version, true );
    wp_enqueue_script( 'paradox', get_template_directory_uri() . '/assets/js/paradox.js', array("jquery"), $theme_version, true );
    wp_enqueue_script( 'sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.min.js', array("jquery"), $theme_version, true );
    wp_enqueue_script( 'countdown', get_template_directory_uri() . '/assets/js/countdown.min.js', array("jquery"), $theme_version, true );
    wp_enqueue_script( 'accordion-lib', get_template_directory_uri() . '/assets/js/jquery-ui.min.js', array("jquery"), $theme_version, true );
}
add_action( 'wp_enqueue_scripts', 'paradox_theme_scripts' );

# Enqueue admin styles
function paradox_enqueue_admin_styles() {

	if ( is_admin() ) {
		wp_enqueue_style( 'admin-style', get_theme_file_uri('/assets/css/theme-admin.css' ));
	}
}
add_action( 'admin_enqueue_scripts', 'paradox_enqueue_admin_styles' );

//breadcrumb
if(! function_exists('denshyar_breadcrumb')){
  function denshyar_breadcrumb(){
    if(function_exists('bcn_display')){ ?>
      <div class="breadcrumb">
        <?php bcn_display(); ?>
      </div>
    <?php
    }
  }
}

//post view count
  function denshyar_post_view_counter(){
    if(is_single( )){
      global $post;
      $count_post = esc_attr(get_post_meta($post->ID,'_post_view_count',true));
      if($count_post == ''){
        $count_post = 1;
        add_post_meta( $post->ID,'_post_view_count',$count_post );
      }else{
        $count_post = (int)$count_post+1;
        update_post_meta($post->ID,'_post_view_count',$count_post);
      }

    }
  }
add_action( 'wp_head', 'denshyar_post_view_counter');

if(! function_exists('denshyar_post_view_count')){
  function denshyar_post_view_count(){
    global $post;
    $visitor_count = get_post_meta($post->ID,'_post_view_count',true);
    if($visitor_count == ''){$visitor_count = 0;}
    if($visitor_count>= 1000){
      $visitor_count = round(($visitor_count/1000),2);
      $visitor_count = $visitor_count.'k';
    }
    echo esc_attr( $visitor_count ).' بازدید ';

  }
}

//Register widgets
add_action( 'widgets_init', 'paradox_widgets_init' );

function paradox_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__( 'Blog Sidebar', 'paradox' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'paradox' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

  register_sidebar(
		array(
			'name'          => esc_html__( 'فوتر 1', 'paradox' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'paradox' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
    ),
	);
   register_sidebar( 
    array(
			'name'          => esc_html__( 'فوتر 2', 'paradox' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'paradox' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		),
  );
  register_sidebar( 
    array(
			'name'          => esc_html__( 'فوتر 3', 'paradox' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'paradox' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		),
  );
  register_sidebar( 
    array(
			'name'          => esc_html__( 'فوتر 4', 'paradox' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'paradox' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		),
  );
  register_sidebar( 
    array(
			'name'          => esc_html__( 'صفحات دوره ها', 'paradox' ),
			'id'            => 'course_page',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'paradox' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		),
  );
}

if(class_exists('Redux')){

	function shortcode_social_networks(){

		$facebook = paradox_settings('social_network_link_fb');
		$telegram = paradox_settings('social_network_link_tlg');
		$whatsapp = paradox_settings('social_network_link_wpp');
		$twitter = paradox_settings('social_network_link_tw');
		$linkedin = paradox_settings('social_network_link_lin');
		$youtube = paradox_settings('social_network_link_yt');
		$vimeo = paradox_settings('social_network_link_vm');
		$dribbble = paradox_settings('social_network_link_drb');
		$dribbble = paradox_settings('social_network_link_drb');
		$instagram = paradox_settings('social_network_link_ig');
		$pinterest = paradox_settings('social_network_link_pi');
		$VKontakte = paradox_settings('social_network_link_vk');
		$flickr = paradox_settings('social_network_link_fl');
		$behance = paradox_settings('social_network_link_be');
		$foursquare = paradox_settings('social_network_link_fs');
		$skype = paradox_settings('social_network_link_sk');
		$tumblr = paradox_settings('social_network_link_tu');
		$deviantart = paradox_settings('social_network_link_da');
		$github = paradox_settings('social_network_link_gh');
		$houzz = paradox_settings('social_network_link_hz');
		$px500 = paradox_settings('social_network_link_px');
		$xing = paradox_settings('social_network_link_xing');
		$vine = paradox_settings('social_network_link_vi');
		$snapchat = paradox_settings('social_network_link_sn');
		$email = paradox_settings('social_network_link_em');
		$yelp = paradox_settings('social_network_link_yp');
		$tripadvisor = paradox_settings('social_network_link_ta');

		$social_order_list  =  array(
			'fb'      => array(
				'title'  => 'Facebook',
				'icon'   => 'fa fa-facebook-f',
				'href'	 =>$facebook,
			),
			'tlg'      => array(
				'title'  => 'Telegram',
				'icon'   => 'fa fa-telegram',
				'href'	 =>$telegram,
			),
			'wpp'      => array(
				'title'  => 'Whatsapp',
				'icon'   => 'fa fa-whatsapp',
				'href'	 =>$whatsapp,
			),
			'tw'      => array(
				'title'  => 'Twitter',
				'icon'   => 'fa fa-twitter',
				'href'	 =>$twitter,
			),
			'lin'     => array(
				'title'  => 'LinkedIn',
				'icon'   => 'fa fa-linkedin',
				'href'	 =>$linkedin,
			),
			'yt'      => array(
				'title'  => 'YouTube',
				'icon'   => 'fa fa-youtube-play',
				'href'	 =>$youtube,
			),
			'vm'      => array(
				'title'  => 'Vimeo',
				'icon'   => 'fa fa-vimeo',
				'href'	 =>$vimeo,
			),
			'drb'     => array(
				'title'  => 'Dribbble',
				'icon'   => 'fa fa-dribbble',
				'href'	 =>$dribbble,
			),
			'ig'      => array(
				'title'  => 'Instagram',
				'icon'   => 'fa fa-instagram',
				'href'	 =>$instagram,
			),
			'pi'      => array(
				'title'  => 'Pinterest',
				'icon'   => 'fa fa-pinterest',
				'href'	 =>$pinterest,
			),
			'vk'      => array(
				'title'  => 'VKontakte',
				'icon'   => 'fa fa-vk',
				'href'	 =>$VKontakte,
			),
			'fl'      => array(
				'title'  => 'Flickr',
				'icon'   => 'fa fa-flickr',
				'href'	 =>$flickr,
			),
			'be'      => array(
				'title'  => 'Behance',
				'icon'   => 'fa fa-behance',
				'href'	 =>$behance,
			),
			'fs'      => array(
				'title'  => 'Foursquare',
				'icon'   => 'fa fa-foursquare',
				'href'	 =>$foursquare,
			),
			'sk'      => array(
				'title'  => 'Skype',
				'icon'   => 'fa fa-skype',
				'href'	 =>$skype,
			),
			'tu'      => array(
				'title'  => 'Tumblr',
				'icon'   => 'fa fa-tumblr',
				'href'	 =>$tumblr,
			),
			'da'      => array(
				'title'  => 'DeviantArt',
				'icon'   => 'fa fa-deviantart',
				'href'	 =>$deviantart,
			),
			'gh'      => array(
				'title'  => 'GitHub',
				'icon'   => 'fa fa-github',
				'href'	 =>$github,
			),
			'hz'      => array(
				'title'  => 'Houzz',
				'icon'   => 'fa fa-houzz',
				'href'	 =>$houzz,
			),
			'px'      => array(
				'title'  => '500px',
				'icon'   => 'fa fa-500px',
				'href'	 =>$px500,
			),
			'xi'      => array(
				'title'  => 'Xing',
				'icon'   => 'fa fa-xing',
				'href'	 =>$xing,
			),
			'vi'      => array(
				'title'  => 'Vine',
				'icon'   => 'fa fa-vine',
				'href'	 =>$vine,
			),
			'sn'      => array(
				'title'  => 'Snapchat',
				'icon'   => 'fa fa-snapchat-ghost',
				'href'	 =>$snapchat,
			),
			'em'      => array(
				'title'  => esc_html__( 'Email', 'paradox' ),
				'icon'   => 'fa fa-envelope',
				'href'	 =>'mailto:'.$email,
			),
			'yp'      => array(
				'title'  => 'Yelp',
				'icon'   => 'fa fa-yelp',
				'href'	 =>$yelp,
			),
			'ta'      => array(
				'title'  => 'TripAdvisor',
				'icon'   => 'fa fa-tripadvisor',
				'href'	 =>$tripadvisor,
			),
			'custom'  => array(
				'title'  => paradox_settings( 'social_network_custom_link_title' ),
				'href'   => paradox_settings( 'social_network_custom_link_link' ),
				'icon'   => paradox_settings( 'social_network_custom_link_icon' ),
			),
			'aparat'  => array(
				'title'   => 'Aparat',
				'href'   => paradox_settings( 'social_network_link_aparat' ),
				'icon'   => paradox_settings('social_network_aparat_link_icon'),
			),
		);

		$social_order = paradox_settings('social_order')['enabled'];
		$link_target = paradox_settings('social_networks_target_attr');
		 ?>
		<ul> 
			<?php foreach($social_order as $key => $social){ ?>
				<li><a target="<?php echo esc_attr($link_target ); ?>" href="<?php echo esc_url($social_order_list[$key]['href']); ?>" title="<?php echo esc_attr($social_order_list[$key]['title'] ); ?>"><i class="<?php echo esc_attr( $social_order_list[$key]['icon']); ?>"></i></a></li>
			<?php } ?>
		</ul>
	<?php }
	add_shortcode('social_networks','shortcode_social_networks');
}