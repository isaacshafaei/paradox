<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://devs.redux.io/
 *
 * @package Redux Framework
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = 'redux_demo';  // YOU MUST CHANGE THIS.  DO NOT USE 'redux_demo' IN YOUR PROJECT!!!

// Uncomment to disable demo mode.
/* Redux::disable_demo(); */  // phpcs:ignore Squiz.PHP.CommentedOutCode

$dir = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;

/*
 * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
 */

// Background Patterns Reader.
$sample_patterns_path = Redux_Core::$dir . '../sample/patterns/';
$sample_patterns_url  = Redux_Core::$url . '../sample/patterns/';
$sample_patterns      = array();

if ( is_dir( $sample_patterns_path ) ) {
	$sample_patterns_dir = opendir( $sample_patterns_path );

	if ( $sample_patterns_dir ) {

		// phpcs:ignore WordPress.CodeAnalysis.AssignmentInCondition
		while ( false !== ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) ) {
			if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
				$name              = explode( '.', $sample_patterns_file );
				$name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
				$sample_patterns[] = array(
					'alt' => $name,
					'img' => $sample_patterns_url . $sample_patterns_file,
				);
			}
		}
	}
}

// Used to except HTML tags in description arguments where esc_html would remove.
$kses_exceptions = array(
	'a'      => array(
		'href' => array(),
	),
	'strong' => array(),
	'br'     => array(),
	'code'   => array(),
);

/*
 * ---> BEGIN ARGUMENTS
 */

/**
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://devs.redux.io/core/arguments/
 */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

// TYPICAL -> Change these values as you need/desire.
$args = array(
	// This is where your data is stored in the database and also becomes your global variable name.
	'opt_name'                  => $opt_name,

	// Name that appears at the top of your panel.
	'display_name'              => $theme->get( 'Name' ),

	// Version that appears at the top of your panel.
	'display_version'           => $theme->get( 'Version' ),

	// Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
	'menu_type'                 => 'menu',

	// Show the sections below the admin menu item or not.
	'allow_sub_menu'            => true,

	// The text to appear in the admin menu.
	'menu_title'                => esc_html__( 'تنظیمات پارادوکس', 'paradox' ),

	// The text to appear on the page title.
	'page_title'                => esc_html__( 'تنظیمات پارادوکس', 'paradox' ),

	// Disable to create your own Google fonts loader.
	'disable_google_fonts_link' => false,

	// Show the panel pages on the admin bar.
	'admin_bar'                 => true,

	// Icon for the admin bar menu.
	'admin_bar_icon'            => 'dashicons-portfolio',

	// Priority for the admin bar menu.
	'admin_bar_priority'        => 50,

	// Sets a different name for your global variable other than the opt_name.
	'global_variable'           => $opt_name,

	// Show the time the page took to load, etc. (forced on while on localhost or when WP_DEBUG is enabled).
	'dev_mode'                  => false,

	// Enable basic customizer support.
	'customizer'                => true,

	// Allow the panel to open expanded.
	'open_expanded'             => false,

	// Disable the save warning when a user changes a field.
	'disable_save_warn'         => false,

	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_priority'             => 10,

	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
	'page_parent'               => 'themes.php',

	// Permissions needed to access the options panel.
	'page_permissions'          => 'manage_options',

	// Specify a custom URL to an icon.
	'menu_icon'                 => '',

	// Force your panel to always open to a specific tab (by id).
	'last_tab'                  => '',

	// Icon displayed in the admin panel next to your menu_title.
	'page_icon'                 => 'icon-themes',

	// Page slug used to denote the panel, will be based off page title, then menu title, then opt_name if not provided.
	'page_slug'                 => $opt_name,

	// On load save the defaults to DB before user clicks save.
	'save_defaults'             => true,

	// Display the default value next to each field when not set to the default value.
	'default_show'              => false,

	// What to print by the field's title if the value shown is default.
	'default_mark'              => '*',

	// Shows the Import/Export panel when not used as a field.
	'show_import_export'        => true,

	// The time transients will expire when the 'database' arg is set.
	'transient_time'            => 60 * MINUTE_IN_SECONDS,

	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
	'output'                    => true,

	// Allows dynamic CSS to be generated for customizer and google fonts,
	// but stops the dynamic CSS from going to the page head.
	'output_tag'                => true,

	// Disable the footer credit of Redux. Please leave if you can help it.
	'footer_credit'             => '',

	// If you prefer not to use the CDN for ACE Editor.
	// You may download the Redux Vendor Support plugin to run locally or embed it in your code.
	'use_cdn'                   => true,

	// Set the theme of the option panel.  Use 'wp' to use a more modern style, default is classic.
	'admin_theme'               => 'wp',

	// Enable or disable flyout menus when hovering over a menu with submenus.
	'flyout_submenus'           => true,

	// Mode to display fonts (auto|block|swap|fallback|optional)
	// See: https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display.
	'font_display'              => 'swap',

	// HINTS.
	'hints'                     => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	),

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'database'                  => '',
	'network_admin'             => true,
	'search'                    => true,
);


Redux::set_args( $opt_name, $args );
/*
 * ---> START HELP TABS
 */
$help_tabs = array(
	array(
		'id'      => 'redux-help-tab-1',
		'title'   => esc_html__( 'Theme Information 1', 'paradox' ),
		'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'paradox' ) . '</p>',
	),
	array(
		'id'      => 'redux-help-tab-2',
		'title'   => esc_html__( 'Theme Information 2', 'paradox' ),
		'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'paradox' ) . '</p>',
	),
);
Redux::set_help_tab( $opt_name, $help_tabs );

// Set the help sidebar.
$content = '<p>' . esc_html__( 'This is the sidebar content, HTML is allowed.', 'paradox' ) . '</p>';

Redux::set_help_sidebar( $opt_name, $content );

/*
 * <--- END HELP TABS
 */

/*
 * ---> START SECTIONS
 */

// -> START General
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'عمومی', 'paradox' ),
		'id'               => 'general',
		'customizer_width' => '400px',
		'icon'             => 'el el-home',
		'fields' =>array(
			array(
				'id' => 'choose_product_page',
				'type' => 'select',
				'title' => __( 'انتخاب صفحه محصول' , 'paradox' ),
				'subtitle' => __( 'ما برای صفحه محصول قالب پارادوکس استایل های مختلفی رو در نظر گرفتیم که شما می تونید یکی از آنها رو انتخاب کنید.' , 'paradox' ),
				'options' => array(
						'rocket' => 'راکت', 
						'ostad' => 'استاد', 
					), 
				'default' =>'rocket',
	
				),
			array(
				'id' => 'favie_icon',
				'type' => 'media',
				'title' => __( 'تصویر فایو آیکون' , 'paradox' ),
				'desc' => __( 'آپلود تصویر png,jpg' , 'paradox' ),
				'url'      => false,			
			),
			array(
				'id' => 'favie_icon_retina',
				'type' => 'media',
				'title' => __( 'تصویر رتینا فایو آیکون' , 'paradox' ),
				'desc' => __( 'آپلود تصویر png,jpg' , 'paradox' ),
				'url'      => false,			
			),
			array(
				'type' => 'switch',
				'id' => 'enable_loading_page',
				'title' => __( 'فعال کردن لودینگ صفحه' , 'paradox' ),
			),
			array(
				'id' => 'loading_page',
				'type' => 'select',
				'title' => __( 'انتخاب لودینگ' , 'paradox' ),
				'options'  => array(
					'kebrit' => 'کبریت در تاریکی',
					'cicle' => 'چرخش رنگارنگ',
				),
				'default'  => 'kebrit',
				'required' => array( 'enable_loading_page', '=', true )
			),
		)
	)
);

#Header Setting
Redux::set_section( $opt_name, array(
   'id' => 'header_section',
   'title' => esc_html__('تنظیمات عمومی هدر', 'paradox'),
   'icon' => 'el-icon-wrench'
));

Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'تنظیمات هدر عمومی', 'paradox' ),
		'id'               => 'header',
		'customizer_width' => '400px',
		'subsection' => true,
		'fields' =>array(
			array(
				'id'       => 'header_elementor',
				'type'     => 'select',
				'title' => __( 'انتخاب هدر المنتوری' , 'paradox' ),
				'options'  => paradox_get_header_list(),
				'default' 	=> 'no-header'
			),
			array(
				'id' => 'header_info',
				'type' => 'info',
 				'desc' => esc_html__('شما برای اینکه تنظیمات این بخش رو مشاهده کنید باید از بخش "تنظیمات هدر عمومی" هدر پیش فرض قالب رو انتخاب کنید', 'paradox'),
				'required' => array( 'header_elementor', '!=', 'no-footer'),
			),
			array(
				'id' => 'header_fullwidth',
				'type' => 'switch',
				'title' => __( 'سربرگ را تمام عرض کنید' , 'paradox' ),
				'required' => array( 'header_elementor', '=', 'no-header' )
			),
			array(
				'id' => 'sticky_header',
				'type' => 'switch',
				'title' => __( 'منوی چسپان' , 'paradox' ),
				'required' => array( 'header_elementor', '=', 'no-header' )
			),
			array(
				'id' => 'logo_image',
				'type' => 'media',
				'title' => __( 'تصویر لوگو' , 'paradox' ),
				'desc' => __( 'آپلود تصویر png,jpg' , 'paradox' ),
				'url'      => false,
				'required' => array( 'header_elementor', '=', 'no-header' )			
			),
			array(
				'id' => 'logo_image_width_size',
				'type' => 'slider',
				'title' => __( 'پهنای تصویر لوگو' , 'paradox' ),
				"default"   => 250,
				"min"       => 1,
				"step"      => 1,
				"max"       => 800,
				'required' => array( 'header_elementor', '=', 'no-header' )
			),
			array(
				'id' => 'logo_image_padding',
				'type' => 'spacing',
				'title' => __( 'فاصله خارجی لوگو*' , 'paradox' ),
				'desc' => __( 'اضافه کردن مقدای فاصله به اطراف تصویر لوگوی شما' , 'paradox' ),
				'mode'           => 'padding',
				'required' => array( 'header_elementor', '=', 'no-header' ),
				'units'          => array('em', 'px','%'),
			    'default'            => array(
						'margin-top'     => '10px', 
						'margin-right'   => '20px', 
						'margin-bottom'  => '10px', 
						'margin-left'    => '0px',
						'units'          => 'px', 
					)
			),
		)
	)
);
// -> Header Layout
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'طرح بندی سربرگ', 'paradox' ),
		'id'               => 'header_layout',
		'customizer_width' => '400px',
		'subsection' => true,
		'fields' =>array(
			array(
				'id' => 'layout_info',
				'type' => 'info',
 				'desc' => esc_html__('شما برای اینکه تنظیمات این بخش رو مشاهده کنید باید از بخش "تنظیمات هدر عمومی" هدر پیش فرض قالب رو انتخاب کنید', 'paradox'),
				'required' => array( 'header_elementor', '!=', 'no-header' ),
			),
			array(
				'id' => 'header_height_size',
				'type' => 'slider',
				'title' => __( 'ارتفاع سربرگ*' , 'paradox' ),
				"default"   => 80,
				"min"       => 1,
				"step"      => 1,
				"max"       => 800,
				'required' => array( 'header_elementor', '=', 'no-header' ),
			),
			array(
				'id' => 'button_on_header',
				'type' => 'switch',
				'title' => __( 'دکمه روی سربرگ' , 'paradox' ),
				'required' => array( 'header_elementor', '=', 'no-header' ),
			),
			array(
				'id' => 'button_link',
				'type' => 'select',
				'title' => __( 'لینک دکمه' , 'paradox' ),
				'options'  => array(
					'my_account' => 'لینک به حساب کاربری',
					'custom_link' => 'لینک دلخواه',
				),
				'default'  => 'my_account',
				'required' => array( 'button_on_header', '=', true)
			),
			array(
				'id' => 'custom_button_text',
				'type' => 'text',
				'title' => __( 'متن دکمه دلخواه*' , 'paradox' ),
				'required' => array( 'button_link', '=', 'custom_link' ),
				'default' => 'حساب کاربری'
			),
			array(
				'id' => 'custom_button_link',
				'type' => 'text',
				'title' => __( 'لینک سفارشی دکمه*' , 'paradox' ),
				'required' => array( 'button_link', '=', 'custom_link' ),
				'default' => '#'
			),
			array(
				'id' => 'custom_button_text_after_login',
				'type' => 'text',
				'title' => __( 'متن دکمه سربرگ بعد از لاگین *' , 'paradox' ),
				'required' => array( 'button_link', '=', 'custom_link' ),
				'default' => 'حساب کاربری'
			),
			array(
				'id' => 'custom_button_link_after_login',
				'type' => 'text',
				'title' => __( 'لینک دکمه سربرگ بعد از لاگین کاربر' , 'paradox' ),
				'required' => array( 'button_link', '=', 'custom_link' ),
				'default' => '#'
			),
			array(
				'id'       => 'main_header_text_color',
				'type'     => 'color',
				'title'    => esc_html__('رنگ متن ناحیه سربرگ*', 'paradox'), 
				'default'  => '#FFFFFF',
				'validate' => 'color',	
				'transparent' => false,		
				'output'    => array('color' => '.paradox-navigation ul.menu>li>a,.mini_cart i,.button_link'),
				'required' => array( 'header_elementor', '=', 'no-header' ),
			),
			array(
				'id'       => 'main_header_bg_color',
				'type'     => 'background',
				'title'    => esc_html__('پس زمینه ناحیه سربرگ *', 'paradox'), 
				'output' => '.header,.stickey_header.scrolled',
				'required' => array( 'header_elementor', '=', 'no-header' ),
			),
		)
	)
);
#Page title
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'ناحیه عنوان صفحات', 'paradox' ),
		'id'               => 'page_title_section',
		'customizer_width' => '400px',
		'required' => array( 'header_elementor', '=', 'no-header' ),
		'subsection' => true,
		'fields' =>array(
			array(
				'id' => 'page-title_info',
				'type' => 'info',
 				'desc' => esc_html__('شما برای اینکه تنظیمات این بخش رو مشاهده کنید باید از بخش "تنظیمات هدر عمومی" هدر پیش فرض قالب رو انتخاب کنید', 'paradox'),
				'required' => array( 'header_elementor', '!=', 'no-header' ),
			),
			array(
				'id'       => 'headre_text_color',
				'type'     => 'color',
				'title'    => esc_html__('رنگ متن ناحیه عنوان سربرگ*', 'paradox'), 
				'default'  => '#FFFFFF',
				'validate' => 'color',	
				'transparent' => false,		
				'output' => '.page_title',
				'required' => array( 'header_elementor', '=', 'no-header' ),		
			),
			array(
				'id'       => 'page_title_background',
				'type'     => 'background',
				'title'    => esc_html__('رنگ پس زمینه ناحیه عنوان صفحات*', 'paradox'),
				'output' => '.page_title',
				'required' => array( 'header_elementor', '=', 'no-header' ),				
				'default'  => array(
				'background-color' => '#1e73be',
			),
			)
		)
	)
);
#top bar
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'نوار بالا سربرگ', 'paradox' ),
		'id'               => 'top_bar_sectoion',
		'customizer_width' => '400px',
		'subsection' => true,
		'required' => array( 'header_elementor', '=', 'no-header' ),
		'fields' =>array(
			array(
				'id' => 'top_bar_info',
				'type' => 'info',
 				'desc' => esc_html__('شما برای اینکه تنظیمات این بخش رو مشاهده کنید باید از بخش "تنظیمات هدر عمومی" هدر پیش فرض قالب رو انتخاب کنید', 'paradox'),
				'required' => array( 'header_elementor', '!=', 'no-header' ),
			),
			array(
				'id' => 'top_bar_check',
				'type' => 'switch',
				'title' => __( 'نوار بالای سربرگ' , 'paradox' ),
				'required' => array( 'header_elementor', '=', 'no-header' ),
			),
			array(
				'id' => 'top_bar_color_text',
				'type' => 'select',
				'title' => __( 'رنگ متن نوار بالای سربرگ *' , 'paradox' ),
				'options'  => array(
					'dark' => 'تیره',
					'white' => 'روشن',
				),
				'default'  => 'dark',
				'required' => array( 'top_bar_check', '=', true,'header_elementor', '=', 'no-header' )
			),
			array(
				'id'       => 'top_bar_bgcolor',
				'type'     => 'background',
				'title'    => esc_html__('پس زمینه نوار بالایی *', 'paradox'), 
				'output' => '.top-bar,.top-bar.white,.top-bar.dark',
				'required' => array( 'top_bar_check', '=', true,'header_elementor', '=', 'no-header' )	
			),
			array(
				'id' => 'mobile_number',
				'type' => 'text',
				'title' => __( 'شماره تلفن' , 'paradox' ),
				'required' => array( 'header_elementor', '=', 'no-header' ),
			),
			array(
				'id' => 'emali_address',
				'type' => 'text',
				'title' => __( 'آدرس ایمیل' , 'paradox' ),
				'required' => array( 'header_elementor', '=', 'no-header' ),
			),
			array(
				'id' => 'enable_search',
				'type' => 'switch',
				'title' => __( 'نمایش/مخفی کردن جستجو' , 'paradox' ),
				'required' => array( 'header_elementor', '=', 'no-header' ),
			),
			array(
				'id' => 'enable_basket',
				'type' => 'switch',
				'title' => __( 'نمایش/مخفی کردن سبد خرید' , 'paradox' ),
				'required' => array( 'header_elementor', '=', 'no-header' ),
			),
		)
	)
);
#Menu mobile
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'منو موبایل', 'paradox' ),
		'id'               => 'mobile_menu',
		'customizer_width' => '400px',
		'subsection' => true,
		'fields' =>array(
			array(
				'id' => 'search_mobile',
				'type' => 'switch',
				'title' => __( 'جستجو در موبایل' , 'paradox' ),
				'subtitle' => __('نمایش/مخفی کردن فرم جستجو در منوی موبایل','paradox'),
			),
			array(
				'id' => 'basket_mobile',
				'type' => 'switch',
				'title' => __( 'سبد خرید در موبایل' , 'paradox' ),
				'subtitle' => __('نمایش/مخفی کردن سبد خرید در منوی موبایل','paradox'),
			),
			array(
				'id'               => 'text_on_mobile',
				'type'             => 'editor',
				'title'            => esc_html__('متن یا شرتکد در موبایل', 'paradox'), 
				'subtitle'         => esc_html__('در این بخش می تونید متن یا شورتکدهای دلخواه برای منو موبایل اضافه کنید.', 'paradox'),
			),
		)
	)
);
//-> Style
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'استایل', 'paradox' ),
		'id'               => 'style',
		'customizer_width' => '400px',
		'icon'	=> 'el el-adjust-alt',
		'fields' =>array(
			array(
				'id'       => 'body_bg_color',
				'type'     => 'background',
				'title'    => esc_html__( 'پس زمینه بدنه سایت', 'paradox' ),
				'output'   => 'body,.blog_inner',
				'default'  => array(
					'background-color' => '#1B314C'
				)
			),
		)
	)
);
#blog style
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'استایل وبلاگ', 'paradox' ),
		'id'               => 'blog_style_color',
		'subsection' => true,
		'fields' =>array(
			array(
				'id'       => 'blog_content_bg_color',
				'type'     => 'background',
				'title'    => esc_html__( 'پس زمینه محتوا و سایدبار صفحه وبلاگ', 'paradox' ),
				'output'   => '.inner_content,div#respond,.sidebar .widget,.wp-block-search__button,
				.wp-block-search__input,.comment-body,.woocommerce-cart-form,.cart-collaterals,
				.checkout_wrapper_paradox #customer_details,.checkout_wrapper_paradox #order_review,
				.woocommerce-checkout-payment .payment_methods .payment_box,.page_thank,.woocommerce .woocommerce-order table.shop_table,
				.notifications-box,.status-user-widget ul li.all_course .key_wrapper,.link_report_content',
				'default'  => array(
					'background-color' => '#1b344d'
				)
			),
			array(
				'id'       => 'blog_border_color',
				'type'     => 'border',
				'title'    => esc_html__('رنگ مرز باکس های وبلاگ و صفحات آرشیو', 'paradox'), 
				'output'    => array('.inner_content,.sidebar .widget,div#respond,.product_categorypage #main li.product.type-product,
				.product_categorypage .term-description,.woocommerce-cart-form,.cart-collaterals,
				.checkout_wrapper_paradox #customer_details,.checkout_wrapper_paradox #order_review,.link_report_content'),
				'default'   => array(
					'border-color'  => '#1c4f83', 
					'border-style'  => 'solid', 
					'border-top'    => '1px', 
					'border-right'  => '1px', 
					'border-bottom' => '1px', 
					'border-left'   => '1px'
				)
			),
			array(
				'id'       => 'accent_color',
				'type'     => 'color',
				'title'    => esc_html__('رنگ های جانبی', 'paradox'), 
				'subtitle' => esc_html__('شامل رنگ های بعضی از آیکون ها', 'paradox'),
				'default'  => '#FFFFFF',
				'validate' => 'color',
				'output'    => array('color' => '.title_review i'),
			),
		)
	)
);
//Typography
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'تایپوگرافی', 'paradox' ),
		'id'               => 'typography_option',
		'customizer_width' => '400px',
		'icon'	=> 'el el-fontsize',
		'fields' =>array(
			array(
				'id' => 'typography_body',
				'type' => 'typography',
				'title' => __( 'بدنه سایت' , 'paradox' ),
				'subtitle' => __( 'فونت دلخواه برای متن بدنه اصلی سایت انتخاب کنید.' , 'paradox' ),
				'output'      => array('body'),
				'google'      => false,
				'font-weight' => false,
			),
			array(
				'id' => 'typography_menu',
				'type' => 'typography',
				'title' => __( 'منو' , 'paradox' ),
				'subtitle' => __( 'فونت دلخواه برای منو انتخاب کنید' , 'paradox' ),
				'output'      => array('.paradox-navigation a'),
				'google'      => false,

			),
			array(
				'id' => 'typography_sub_menu',
				'type' => 'typography',
				'title' => __( 'لینک ها' , 'paradox' ),
				'subtitle' => __( 'فونت دلخواه برای لینک ها انتخاب کنید' , 'paradox' ),
				'output'      => array('a,.box_content a'),
				'google'      => false,
				

			),
			array(
				'id' => 'typography_h1',
				'type' => 'typography',
				'title' => __( 'H1' , 'paradox' ),
				'output'      => array('body .blog_header h1,.product_categorypage .woocommerce-products-header__title.page-title'),
				'google'      => false,

			),
			array(
				'id' => 'typography_h2',
				'type' => 'typography',
				'title' => __( 'H2' , 'paradox' ),
				'output'      => array('body h2,.entry_content_single h2, .product_content h2'),
				'google'      => false,

			),
			array(
				'id' => 'typography_h3',
				'type' => 'typography',
				'title' => __( 'H3' , 'paradox' ),
				'output'      => array('body h3,.title_review h3,.entry_content_single h3,h3.comment-reply-title'),
				'google'      => false,

			),
			array(
				'id' => 'typography_h4',
				'type' => 'typography',
				'title' => __( 'H4' , 'paradox' ),
				'output'      => array('body h4'),
				'google'      => false,

			),
			array(
				'id' => 'typography_h5',
				'type' => 'typography',
				'title' => __( 'H5' , 'paradox' ),
				'output'      => array('body h5,.content_author h5'),
				'google'      => false,

			),
			array(
				'id' => 'typography_h6',
				'type' => 'typography',
				'title' => __( 'H6' , 'paradox' ),
				'output'      => array('body h6'),
				'google'      => false,

			),
			array(
				'id' => 'typography_h6',
				'type' => 'typography',
				'title' => __( 'تگ های p' , 'paradox' ),
				'output'      => array('.entry_content_single p, .product_content p, .extra_text p,.blog_content .entry_content_single ul,
				.content_author .bio,.product_categorypage .term-description p,.required-field-message'),
				'google'      => false,
				'default' => '#fff',
			),
		)
	)
);
// -> START Blog
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'وبلاگ', 'paradox' ),
		'id'               => 'blog_option',
		'customizer_width' => '100%',
		'icon'             => 'el el-pencil',
		'fields'           =>	array(
			array(
				'id' => 'custom_page_title_text',
				'type' => 'text',
				'title' => __( 'عنوان سفارشی نوشته های تکی' , 'paradox' ),
				'default' =>'بلاگ',
			),
					array(
						'id' => 'single_post_sidebar_position',
						'type' => 'image_select',
						'title' => __( 'موقعیت سایدبار نوشته های تکی' , 'paradox' ),
						'subtitle' => __( 'موقعیت سایدبار بلاگ را تنظیم یا مخفی کنید' , 'paradox' ),
						'default'   => 'right',
						'options'  => array(
							'none'      => array(
								'alt'   => esc_html__( 'No Sidebar', 'paradox' ),
								'img'   => ReduxFramework::$_url.'assets/img/1col.png'
							),
							'left'      => array(
								'alt'   => esc_html__( 'Sidebar Left', 'paradox' ),
								'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
							),
							'right'      => array(
								'alt'   => esc_html__( 'Sidebar Right', 'paradox' ),
								'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
							),
			
							),
						),
						array(
							'id'        => 'article_author',
							'type'      => 'switch',
							'title'     => esc_html__( 'نمایش اطلاعات نویسنده', 'paradox' ),
							'subtitle'  => esc_html__( 'Displays author information at the bottom. Will only be displayed if the author description is filled.', 'paradox' ),
							'default'   => true,
						),
						array(
							'id'        => 'blog_related',
							'type'      => 'switch',
							'title'     => esc_html__( 'نمایش نوشته های مرتبط؟', 'paradox' ),
							'subtitle'  => esc_html__( 'انتخاب کنید که آیا نوشته های مرتبط بعد از محتوای نوشته نمایش داده شود؟', 'paradox' ),
							'default'   => true,
						),
				
						array(
							'id'        => 'blog_meta_data',
							'type'      => 'switch',
							'title'     => esc_html__( 'نمایش اطلاعات نوشته تکی؟', 'paradox' ),
							'subtitle'  => esc_html__( 'انتخاب کنید که آیا اطلاعات نوشته مثل تاریخ و دسته بندی و آماز بازدید نمایش داده شود یا خیر', 'paradox' ),
							'default'   => true,
						),
				
						array(
							'id'        => 'blog_featured_img',
							'type'      => 'switch',
							'title'     => esc_html__( 'نمایش تصویر شاخص نوشته های بلاگ؟', 'paradox' ),
							'subtitle'  => esc_html__( 'انتخاب کنید که می خواهید تصویر شاخص نوشته های بلاگ در صفحه نوشته تکی نمایش داده شود یا خیر؟', 'paradox' ),
							'default'   => true,
						),
				
						array(
							'id'      => 'report_form',
							'type'    => 'text',
							'title'   => esc_html__( 'شرتکد فرم گزارش مشکل دانلود', 'paradox' ),
							'subtitle' => esc_html__( 'یک فرم با فرم ساز دلخواه خود بسازید و شرتکد آن را جهت نمایش در اینجا قرار دهید.', 'paradox' ),
						),            
			
		),
	)
);
#blog Archive setting
Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'آرشیو بلاگ', 'paradox' ),
	'id'               => 'archive_blog_settings',
	'subsection'       => true,
	'fields'           => array(
		array(
			'id' => 'archive_post_sidebar_position',
			'type' => 'image_select',
			'title' => __( 'موقعیت سایدبار آرشیو نوشته ها' , 'paradox' ),
			'subtitle' => __( 'موقعیت سایدبار بلاگ را تنظیم یا مخفی کنید' , 'paradox' ),
			'default'   => 'right',
			'options'  => array(
				'none'      => array(
					'alt'   => esc_html__( 'No Sidebar', 'paradox' ),
					'img'   => ReduxFramework::$_url.'assets/img/1col.png'
				),
				'left'      => array(
					'alt'   => esc_html__( 'Sidebar Left', 'paradox' ),
					'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
				),
				'right'      => array(
					'alt'   => esc_html__( 'Sidebar Right', 'paradox' ),
					'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
				),

				),
			),
			array(
				'id'       => 'blog_archive_item_bg_color',
				'type'     => 'background',
				'title'    => esc_html__( 'پس زمینه آیتم های مقالات', 'paradox' ),
				'output'   => '.inner_archive_item,.product_categorypage .term-description',
				'default'  => array(
					'background-color' => '#1b344d'
				)
			),
			array(
				'id'       => 'archive_item_color',
				'type'     => 'color',
				'title'    => esc_html__('رنگ متن آیتم ها ', 'paradox'), 
				'default'  => '#FFFFFF',
				'validate' => 'color',
				'output'    => array('color' => '.inner_archive_item .the-excerpt,.inner_archive_item .post-content h4,.wp-block-search__input '),
			),

	)
) );
#share setting
Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'تنظیمات اشتراک گذاری', 'paradox' ),
	'id'               => 'sharing_settings',
	'subsection'       => true,
	'fields'           => array(
		array(
			'id'       => 'blog_share_story',
			'title'    => esc_html__( 'اشتراک استوری', 'paradox' ),
			'subtitle' => esc_html__( 'فعال یا غیرفعال کردن اشتراک گذاری نوشته های بلاگ' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'اجازه اشتراک گذاری', 'paradox' ),
			'off'      => esc_html__( 'خیر', 'paradox' ),
		),

	)
) );
// -> START Footer
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'پاورقی', 'paradox' ),
		'id'               => 'footer_option',
		'customizer_width' => '100%',
		'icon'             => 'el el-photo',
		'fields'		   => array(
			array(
				'id'       => 'footer_elementor',
				'type'     => 'select',
				'title' => __( 'انتخاب فوتر المنتوری' , 'paradox' ),
				'options'  => paradox_get_footer_list(),
				'default' 	=> 'no-footer'
			),
			array(
				'id'        => 'footer_visibility',
				'type'      => 'switch',
				'title'     => esc_html__( 'قابلیت مشاهده فوتر', 'paradox' ),
				'subtitle'  => esc_html__( 'نمایش یا مخفی کردن فوتر', 'paradox' ),
				'default'   => true,
				'required' => array( 'footer_elementor', '=', 'no-footer' ),
			),
			array(
				'id'        => 'footer_waves_visiblity',
				'type'      => 'switch',
				'title'     => esc_html__( 'موج های بالای فوتر', 'paradox' ),
				'subtitle'  => esc_html__( 'نمایش یا مخفی کردن موج های بالای فوتر', 'paradox' ),
				'default'   => true,
				'required' => array( 'footer_elementor', '=', 'no-footer' ),
			),
			array(
				'id'       => 'footer_waves_color',
				'type'     => 'color',
				'title'    => esc_html__('رنگ موج فوتر ', 'paradox'), 
				'default'  => '#0dceda',
				'validate' => 'color',
				'required' => array( 'footer_elementor', '=', 'no-footer' ),
				'output'    => array('background-color' => '.top_footer_wave, .bottom_footer_wave'),
			),
			array(
				'id'       => 'footer_text_color',
				'type'     => 'color',
				'title'    => esc_html__('رنگ متن فوتر ', 'paradox'), 
				'default'  => '#FFFFFF',
				'validate' => 'color',
				'required' => array( 'footer_elementor', '=', 'no-footer' ),
				'output'    => array('color' => '.column_footer_item p,
				.column_footer_item li a,.column_footer_item h5,footer div,.copyright_cell ul>li a'),
			),
			array(
				'id'       => 'footer-widgets-bg',
				'type'     => 'background',
				'title'    => esc_html__( 'پس زمینه فوتر', 'paradox' ),
				'output'   => '.footer.dabeshyar_footer,.bottom_footer_wave',
				'default'  => array(
					'background-color' => '#2e3e77'
				),
				'required' => array( 'footer_elementor', '=', 'no-footer' ),
			),
			array(
				'id'        => 'footer_widgets',
				'type'      => 'switch',
				'required'  => array('footer_visibility', '=' , '1','footer_elementor', '=', 'no-footer' ),
				'title'     => esc_html__( 'ابزارک های فوتر', 'paradox' ),
				'subtitle'  => esc_html__( 'نمایش یا غیرفعال کردن ابزارک های فوتر', 'paradox' ),
				'default'   => true,
			),
			array(
				'id'        => 'footer_columns',
				'type'      => 'image_select',
				'required'  => array('footer_widgets', '=', '1','footer_elementor', '=', 'no-footer' ),
				'title'     => esc_html__( 'ستون های فوتر', 'paradox' ),
				'subtitle'  => esc_html__( 'مشخص کردن چینش ستون های فوتر', 'paradox' ),
				'default'   => 'three',
				'options'   => array(
					'four'   => array(
						'alt'   => '4 Columns',
						'img' => get_parent_theme_file_uri('assets/img/admin/footer-4.png' ),
					),
					'three'  => array(
						'alt'   => '3 Columns',
						'img' => get_parent_theme_file_uri('assets/img/admin/footer-3.png' ),
					),
					'two'    => array(
						'alt'   => '2 Columns',
						'img' => get_parent_theme_file_uri('assets/img/admin/footer-2.png' ),
					),
					'doubleleft'    => array(
						'alt'   => 'Double Left',
						'img' => get_parent_theme_file_uri('assets/img/admin/footer-double-left.png'),
					),
					'doubleright'   => array(
						'alt'   => 'Double Right',
						'img' => get_parent_theme_file_uri('assets/img/admin/footer-double-right.png'),
					),
					'one'     => array(
						'alt'   => '1 Column',
						'img' => get_parent_theme_file_uri('assets/img/admin/footer-1.png'),
					),
				),
			),
			array(
				'id'       => 'disable_copyrights',
				'type'     => 'switch',
				'title'    => esc_html__('کپی رایت', 'paradox'),
				'default' => true,
				'required' => array( 'footer_elementor', '=', 'no-footer'),
			),
			array(
				'id'       => 'copyrights-layout',
				'type'     => 'select',
				'title'    => esc_html__('طرح کپی رایت', 'paradox'),
				'options'  => array(
					'default' => esc_html__('2 ستونه', 'paradox'),
					'centered' => esc_html__('مرکز', 'paradox'),
				),
				'default' => 'default',
				'select2'   => array('allowClear' => false),
				'required' => array( 'disable_copyrights', '=', true),
			),
			array(
				'id'       => 'copyrights',
				'type'     => 'text',
				'title'    => esc_html__('متن کپی رایت', 'paradox'),
				'required' => array( 'disable_copyrights', '=', true),
				'subtitle' => esc_html__('اینجا متن کپی رایت خودتون رو اضافه کنید.','paradox'),
			),
			array(
				'id'       => 'copyrights2',
				'type'     => 'text',
				'title'    => esc_html__('متن کنار کپی رایت', 'paradox'),
				'subtitle' => esc_html__('اینجا متن سمت چپی کپی رایت رو می تونید وارد کنید از شورتکد هم می تونید استفاده کنید [social_networks]', 'paradox'),
				'required' => array( 'disable_copyrights', '=', true),
			),
			array(
				'id'       => 'scroll_top_btn',
				'type'     => 'switch',
				'title'    => esc_html__( 'دکمه اسکرول به بالا', 'paradox' ),
				'default' => true,
			),
			array(
				'id' => 'footer_info',
				'type' => 'info',
 				'desc' => esc_html__('شما برای اینکه تنظیمات این بخش رو مشاهده کنید باید از بخش "پاورقی" فوتر پیش فرض قالب رو انتخاب کنید', 'paradox'),
				'required' => array( 'footer_elementor', '!=', 'no-footer','footer_elementor', '=', 'no-footer'  ),
			),
		),
	)
);
//START Register/Login
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'ثبت نام و ورود', 'paradox' ),
	'id' => 'log_reg',
	'icon' => 'el el-user',

) );
#registre/login 
Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'تنظیمات عضویت و ورود', 'paradox' ),
	'id'               => 'register_login',
	'subsection'       => true,
	'fields' => array(
		array(
			'id' => 'content_log_reg',
			'type' => 'editor',
			'title' => esc_html__( 'محتوای کنار فرم عضویت', 'paradox' ),
		),
		array(
			'id' => 'content_log_login',
			'type' => 'editor',
			'title' => esc_html__( 'محتوای کنار فرم ورود', 'paradox' ),
		)
	)
) );

#acoount 
Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'تنظیمات حساب کاربری', 'paradox' ),
	'id'               => 'account_settings',
	'subsection'       => true,
	'fields' => array(
		array(
			'id'       => 'user_account-bg',
			'type'     => 'color_gradient',
			'title'    => esc_html__( 'پس زمینه پنل کاربری', 'paradox' ),
			'output'         => '.account_page_after_login .woocommerce-MyAccount-navigation,
			.account_page_after_login .notifications-box,.account_page_after_login .notifications-box .notifications-icon i,
			.account_page_after_login .status-user-widget ul li.all_course .key_wrapper',
			'gradient-type'  => true,
			'gradient-reach' => true,
			'gradient-angle' => true,
			'default'        => array(
				'from'           => '#301c6c',
				'to'             => '#2e1a40',
				'gradient-reach' => array(
					'to'   => 50,
					'from' => 0,
				),
			),
		),
		array(
			'id' => 'instagram_link',
			'type' => 'text',
			'title' => esc_html__( 'لینک اینستاگرام شما', 'paradox' ),
		),

		array(
			'id' => 'telegram_link',
			'type' => 'text',
			'title' => esc_html__( 'لینک کانال تلگرام شما', 'paradox' ),
		),

		array(
			'id' => 'youtube_link',
			'type' => 'text',
			'title' => esc_html__( 'لینک چنل یوتوب شما', 'paradox' ),
		),

		array(
			'id' => 'aparat_link',
			'type' => 'text',
			'title' => esc_html__( 'لینک کانال آپارات شما', 'paradox' ),
		),

	)

) );
# Courses Settings
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'دوره ها', 'paradox' ),
	'id' => 'courses',
	'icon' => 'el-icon-shopping-cart',

) );
Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'تنظیمات آرشیو دوره ها', 'paradox' ),
	'id'               => 'course_settings',
	'subsection'       => true,
	'fields' => array(
		array(
			'id'        => 'shop_sidebar',
			'type'      => 'image_select',
			'title'     => esc_html__( 'موقعیت سایدبار', 'paradox' ),
			'subtitle'  => esc_html__( 'از اینجا موقعیت سایدبار فروشگاه رو تنظیم کنید', 'paradox' ),
			'default'   => 'right',
			'options'   => array(
				'none'      => array(
					'alt'   => esc_html__( 'No Sidebar', 'paradox' ),
					'img'   => ReduxFramework::$_url.'assets/img/1col.png'
				),
				'left'      => array(
					'alt'   => esc_html__( 'Sidebar Left', 'paradox' ),
					'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
				),
				'right'      => array(
					'alt'   => esc_html__( 'Sidebar Right', 'paradox' ),
					'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
				),
			)
		),
		array(
			'id'        => 'courses_columns',
			'type'      => 'select',
			'title'     => esc_html__( 'ستون های دوره ها', 'paradox' ),
			'subtitle'  => esc_html__( 'تعداد ستون های دوره ها در صفحات آرشیو رو از اینجا مشخص کنید', 'paradox' ),
			'options'   => array(
				'2' => esc_html__( '2 ستونه', 'paradox' ),
				'3' => esc_html__( '3 ستونه', 'paradox' ),
				'4' => esc_html__( '4 ستونه', 'paradox' ),
			),
			'default'   => '3',
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'       => 'shop_per_page',
			'type'     => 'text',
			'title'    => esc_html__( 'تعداد دوره ها در هر صفحه', 'paradox' ),
			'subtitle' => esc_html__( 'تعداد آیتم هایی که در صفحات آرشیو باید نمایش داده شود را مشخص کنید.', 'paradox' ),
			'default'  => '9',
			'min'      => '1',
			'max'      => '50',
		),
	)
) );
Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'صفحه دوره', 'paradox' ),
	'id'               => 'course_page_settings',
	'subsection'       => true,
	'fields' => array(


		array(
			'id'      => 'add_to_cart_text',
			'type'    => 'text',
			'default'  => 'ثبت نام دوره',
			'title'   => esc_html__( 'متن دکمه ثبت نام دوره', 'paradox' ),
		),

		array(
			'id' => 'garanty_text',
			'type' => 'editor',
			'required' => array( 'choose_product_page', '=', 'rocket' ),
			'title'   => esc_html__( 'متن باکس گارانتی بازگشت وجه', 'paradox' ),
		),

		array(
			'id'      => 'garanty_link',
			'type'    => 'text',
			'title'   => esc_html__( 'لینک صفحه توضیحات گارانتی', 'paradox' ),
			'default'  => '#',
			'subtitle'   => esc_html__( 'لینک توضیحات صفحه بازگشت وجه و گارانتی را اینجا قرار دهید اگر نمی خواهید نمایش داده شود اینجا را خالی بزارید.', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'rocket' ),
		),

		array(
			'id'      => 'vip_text',
			'type'    => 'text',
			'title'   => esc_html__( 'متن عضویت ویژه', 'paradox' ),
			'default'  => 'این دوره برای اعضای ویژه بصورت رایگان قابل مشاهده است.',
			'subtitle'   => esc_html__( 'از اینجا می تونید متن باکس عضویت ویژه ای که در سایدبار دوره ها قرار دارد را مشخص کنید', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'rocket' ),
		),

		array(
			'id'      => 'link_text',
			'type'    => 'text',
			'title'   => esc_html__( 'متن لینک عضویت ویژه', 'paradox' ),
			'default'  => 'عضویت ویژه',
			'subtitle'   => esc_html__( 'از اینجا می تونید متن لینک عضویت ویژه رو قرار دهید.', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'rocket' ),
		),
		array(
			'id'      => 'vip_link',
			'type'    => 'text',
			'title'   => esc_html__( 'لینک باکس عضویت ویژه', 'paradox' ),
			'default'  => '#',
			'subtitle'   => esc_html__( 'از اینجا می تونید لینک صفحه ثبت نام یا توضیحات عضویت ویژه رو در صورت وجود قرار دهید.', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'rocket' ),
		),
		
		array(
			'id'      => 'course_student_text',
			'type'    => 'text',
			'default'  => 'دانشجوی دوره هستید',
			'title'   => esc_html__( 'متن دانشجوی دوره هستید بعد از ثبت نام دانشجو', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'ostad' ),
		),

		array(
			'id'        => 'course_single_sidebar_position',
			'type'      => 'image_select',
			'title'     => esc_html__( 'موقعیت سایدبار صفحه دوره تکی', 'paradox' ),
			'subtitle'  => esc_html__( 'موقعیت سایدبار برگه دوره تکی را انتخاب کنید.', 'paradox' ),
			'default'   => 'right',
			'required' => array( 'choose_product_page', '=', 'ostad' ),
			'options'   => array(
				'left'      => array(
					'alt'   => esc_html__( 'Sidebar Left', 'paradox' ),
					'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
				),
				'right'      => array(
					'alt'   => esc_html__( 'Sidebar Right', 'paradox' ),
					'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
				),
			)
		),

		array(
			'id'       => 'course_downloads',
			'title'    => esc_html__( 'دریافت فایل های دوره', 'paradox' ),
			'subtitle' => esc_html__( 'نمایش و مخفی کردن بخش دریافت فایل های دوره', 'paradox' ),
			'type'     => 'switch',
			'default'  => false,
			'on'       => esc_html__( 'نمایش', 'paradox' ),
			'off'      => esc_html__( 'مخفی', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'ostad' ),
		),

		array(
			'id'       => 'course_students',
			'title'    => esc_html__( 'تعداد دانشجویان دوره', 'paradox' ),
			'subtitle' => esc_html__( 'نمایش یا مخفی کردن تعداد دانشجویان دوره', 'paradox' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'نمایش', 'paradox' ),
			'off'      => esc_html__( 'مخفی', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'ostad' ),
		),
		array(
			'id'       => 'course_counters',
			'title'    => esc_html__( 'آمار بازدید و تعداد نظرات', 'paradox' ),
			'subtitle' => esc_html__( 'نمایش و مخفی کردن بخش تعداد بازدید و نظرات دوره', 'paradox' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'نمایش', 'paradox' ),
			'off'      => esc_html__( 'مخفی', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'ostad' ),
		),

		array(
			'id'       => 'course_detail_reviews',
			'title'    => esc_html__( 'آمار خلاصه امتیاز دانشجویان', 'paradox' ),
			'subtitle' => esc_html__( 'نمایش و مخفی کردن باکس خلاصه امتیازات دانشجویان', 'paradox' ),
			'type'     => 'switch',
			'default'  => false,
			'on'       => esc_html__( 'نمایش', 'paradox' ),
			'off'      => esc_html__( 'مخفی', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'ostad' ),
		),
		array(
			'id'       => 'related_courses_display',
			'title'    => esc_html__( 'نمایش / مخی کردن دوره های مرتبط', 'paradox' ),
			'subtitle' => esc_html__( 'با استفاده از این گزینه می توانید دروه های مرتبط در برگه دوره ها را خاموش و روشن کنید.', 'paradox' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'نمایش', 'paradox' ),
			'off'      => esc_html__( 'مخفی', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'ostad' ),
		),
		array(
			'id'       => 'course_per_page',
			'type'     => 'text',
			'title'    => esc_html__( 'تعداد دوره های مرتبط', 'paradox' ),
			'subtitle' => esc_html__( 'تعداد دوره های مرتبط در صفحه دوره', 'paradox' ),
			'default'  => '6',
			'min'      => '1',
			'max'      => '10',
			'required' => array( 'choose_product_page', '=', 'ostad' ),
		),

		array(
			'id' => 'content_review_rules',
			'type' => 'editor',
			'title' => esc_html__( 'محتوای بلوک قوانین ثبت نظر در برگه دوره', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'ostad' ),
		)

	)
) );
Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'پاپ آپ مشاوره', 'paradox' ),
	'id'               => 'course_page_advice',
	'subsection'       => true,
	'fields' => array(

		array(
			'id'       => 'course_advice',
			'title'    => esc_html__( 'بخش درخواست مشاوره', 'paradox' ),
			'subtitle' => esc_html__( 'فعال یا غیر فعال کردن بخش درخواست مشاوره در صفحه دوره', 'paradox' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'نمایش', 'paradox' ),
			'off'      => esc_html__( 'مخفی', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'ostad' ),
		),
		array(
			'id'      => 'advice_phone',
			'type'    => 'text',
			'title'   => esc_html__( 'شماره تلفن داخل پاپ آپ', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'ostad' ),
		),
		array(
			'id'      => 'advice_form',
			'type'    => 'text',
			'title'   => esc_html__( 'شرتکد فرم درخواست تماس', 'paradox' ),
			'subtitle' => esc_html__( 'شما می توانید هر فرم دلخواهی که ساخته اید را در این بخش وارد کنید', 'paradox' ),
			'required' => array( 'choose_product_page', '=', 'ostad' ),
		),

		array(
			'id'       => 'advice_bg',
			'type'     => 'background',
			'title'    => esc_html__( 'تصویر پس زمینه بلوک درخواست مشاوره', 'paradox' ),
			'output'   => '.or_middle',
			'required' => array( 'choose_product_page', '=', 'ostad' ),
			'default'  => array(
				'background-color' => '#fff'
			)
		),
		array(
			'id' => 'counsoling_info',
			'type' => 'info',
			 'desc' => esc_html__('شما برای اینکه تنظیمات این بخش رو مشاهده کنید باید از بخش "عمومی" گزینه استاد رو برای صفحه محصول انتخاب کنید', 'paradox'),
			'required' => array( 'choose_product_page', '!=', 'ostad' ),
		),

	)
) );
Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'تنظیمات اشتراک گذاری', 'paradox' ),
	'id'               => 'course_sharing_settings',
	'subsection'       => true,
	'fields'           => array(
		array(
			'id'       => 'course_share_story',
			'title'    => esc_html__( 'اشتراک گذاری محصول', 'paradox' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'فعال', 'paradox' ),
			'off'      => esc_html__( 'غیرفعال', 'paradox' )
		)
	)
) );

$paradox_social_networks_shortcode = "
<code style='font-size: 10px; display: inline-block;'>[social_networks]</code><br>";
// Social Networks Ordering
Redux::setSection( $opt_name, array(
	'title'             => esc_html__( 'شبکه های اجتماعی', 'paradox' ),
	'id'                => 'social_networks',
	'customizer_width'  => '400px',
	'submenu'           => true,
	'icon'              => 'el el-share-alt',
	'fields'            => array(
		array(
			'id'        => 'social_order',
			'type'      => 'sorter',
			'title'     => esc_html__( 'Social Networks Ordering', 'paradox' ),
			'subtitle'  => "برای اینکه بتونید شبکه های اجتماعی که تنظیم کردید رو مشاهده کنید کافیه شورتکد زیر رو کپی کنید و در محل موردنظر قرار بدید." . $paradox_social_networks_shortcode,
			'options'   => array(
				'enabled' => array (
					'tw'   	 	=> 'Twitter',
					'ig'        => 'Instagram',
					'tlg'		=> 'Telegram',
					'wpp'		=> 'Whatsapp',
					'custom'    => 'Custom Link',
					'yt'        => 'YouTube',
					'aparat'    => 'آپارات',
				),
				'disabled' => array (
					'vm'        => 'Vimeo',
					'fb'   	 	=> 'Facebook',
					'placebo'	=> 'placebo',
					'be'        => 'Behance',
					'fs'        => 'Foursquare',
					'lin'       => 'LinkedIn',
					'drb'       => 'Dribbble',
					'pi'        => 'Pinterest',
					'vk'        => 'VKontakte',
					'da'        => 'DeviantArt',
					'fl'        => 'Flickr',
					'vi'        => 'Vine',
					'tu'        => 'Tumblr',
					'sk'        => 'Skype',
					'gh'        => 'GitHub',
					'hz'        => 'Houzz',
					'px'        => '500px',
					'xi'        => 'Xing',
					'sn'        => 'Snapchat',
					'em'        => 'Email',
					'yp'        => 'Yelp',
					'ta'        => 'TripAdvisor',
				),
			),
		),
		array(
			'id'        => 'social_networks_target_attr',
			'type'      => 'select',
			'title'     => esc_html__( 'بازشدن لینک', 'paradox' ),
			'subtitle'  => esc_html__( 'مشخص کنید که کاربر بعد از کلیک کردن روی لینک های شبکه اجتماعی در همان تب به لینک هدایت شوند یا به تب جدید بروند.', 'paradox' ),
			'default'   => '_blank',
			'options'   => array(
				'_self' => esc_html__( 'تب فعلی مرورگر', 'paradox' ),
				'_blank' => esc_html__( 'بازکردن تب جدید', 'paradox' ),
			),
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'       => 'social_network_link_aparat',
			'type'     => 'text',
			'title'    => 'آپارات',
			'placeholder' => 'https://www.aparat.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_aparat_link_icon',
			'type'     => 'text',
			'title'    => 'نام آیکون آپارات',
			'desc'     => 'بنویسید: aparat',
			'placeholder' => 'مثلا: aparat',
			'default'  => 'aparat',
		),

		array(
			'id'       => 'social_network_link_fb',
			'type'     => 'text',
			'title'    => 'Facebook',
			'placeholder' => 'https://facebook.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_tlg',
			'type'     => 'text',
			'title'    => 'Telegram',
			'placeholder' => 'https://t.me/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_wpp',
			'type'     => 'text',
			'title'    => 'whatsapp',
			'placeholder' => 'لینک واتساپ',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_tw',
			'type'     => 'text',
			'title'    => 'Twitter',
			'placeholder' => 'https://twitter.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_lin',
			'type'     => 'text',
			'title'    => 'Linkedin',
			'placeholder' => 'https://linkedin.com/in/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_yt',
			'type'     => 'text',
			'title'    => 'YouTube',
			'placeholder' => 'https://youtube.com/user/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_vm',
			'type'     => 'text',
			'title'    => 'Vimeo',
			'placeholder' => 'https://vimeo.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_drb',
			'type'     => 'text',
			'title'    => 'Dribbble',
			'placeholder' => 'https://dribbble.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_ig',
			'type'     => 'text',
			'title'    => 'Instagram',
			'placeholder' => 'https://instagram.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_pi',
			'type'     => 'text',
			'title'    => 'Pinterest',
			'placeholder' => 'https://pinterest.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_vk',
			'type'     => 'text',
			'title'    => 'VKontakte',
			'placeholder' => 'https://vk.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_da',
			'type'     => 'text',
			'title'    => 'DeviantArt',
			'placeholder' => 'https://username.deviantart.com/',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_tu',
			'type'     => 'text',
			'title'    => 'Tumblr',
			'placeholder' => 'https://username.tumblr.com/',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_vi',
			'type'     => 'text',
			'title'    => 'Vine',
			'placeholder' => 'https://vine.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_be',
			'type'     => 'text',
			'title'    => 'Behance',
			'placeholder' => 'https://behance.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_fl',
			'type'     => 'text',
			'title'    => 'Flickr',
			'placeholder' => 'https://flickr.com/photos/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_fs',
			'type'     => 'text',
			'title'    => 'Foursquare',
			'placeholder' => 'https://foursquare.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_sk',
			'type'     => 'text',
			'title'    => 'Skype',
			'placeholder' => 'skype:username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_gh',
			'type'     => 'text',
			'title'    => 'GitHub',
			'placeholder' => 'https://github.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_hz',
			'type'     => 'text',
			'title'    => 'Houzz',
			'placeholder' => 'https://houzz.com/user/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_px',
			'type'     => 'text',
			'title'    => '500px',
			'placeholder' => 'https://500px.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_xing',
			'type'     => 'text',
			'title'    => 'Xing',
			'placeholder' => 'https://xing.com/profile/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_sn',
			'type'     => 'text',
			'title'    => 'Snapchat',
			'placeholder' => 'https://snapchat.com/add/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_yp',
			'type'     => 'text',
			'title'    => 'Yelp',
			'placeholder' => 'https://yelp.com/biz/alias',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_ta',
			'type'     => 'text',
			'title'    => 'Trip Advisor',
			'placeholder' => 'https://tripadvisor.com',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_em',
			'type'     => 'text',
			'title'    => 'آدرس ایمیل',
			'placeholder' => 'info@kitwp.com',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_em_subject',
			'type'     => 'text',
			'title'    => 'موضوع ارتباط',
			'placeholder' => 'سلام من اسحاق شفایی هستم :)',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_custom_link_title',
			'type'     => 'text',
			'title'    => 'عنوان لینک دلخواه',
			'placeholder' => 'Custom Link Title',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_custom_link_link',
			'type'     => 'text',
			'title'    => 'آدرس لینک دلخواه',
			'placeholder' => 'https://www.mywebsite.com/',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_custom_link_icon',
			'type'     => 'text',
			'title'    => 'آیکون لینک دلخواه',
			'desc'     => 'آیکون (دلخواه)<br><small>نکته: اگر می خواهید از فونت استفاده کنید پیشنهاد میشه به سایت <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome</a> بروید و لینک دلخواهتون رو پیدا کنید و کلاس آن را در این بخش قرار دهید.</small>
							<br>می تونید از <a href="https://kitwp.com/font-awesome-6/" target="_blank">آموزش استفاده از Fontawesome</a> استفاده کنید.',
			'placeholder' => 'Example: bookmark',
			'default'  => '',
		),

	)
) );

/**
 * Raw README
 */
if ( file_exists( $dir . '/../README.md' ) ) {
	$section = array(
		'icon'   => 'el el-list-alt',
		'title'  => esc_html__( 'Documentation', 'paradox' ),
		'fields' => array(
			array(
				'id'           => 'opt-raw-documentation',
				'type'         => 'raw',
				'markdown'     => true,
				'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please.
			),
		),
	);

	Redux::set_section( $opt_name, $section );
}

Redux::set_section(
	$opt_name,
	array(
		'icon'            => 'el el-list-alt',
		'title'           => esc_html__( 'Customizer Only', 'paradox' ),
		'desc'            => '<p class="description">' . esc_html__( 'This Section should be visible only in Customizer', 'paradox' ) . '</p>',
		'customizer_only' => true,
		'fields'          => array(
			array(
				'id'              => 'opt-customizer-only',
				'type'            => 'select',
				'title'           => esc_html__( 'Customizer Only Option', 'paradox' ),
				'subtitle'        => esc_html__( 'The subtitle is NOT visible in customizer', 'paradox' ),
				'desc'            => esc_html__( 'The field desc is NOT visible in customizer.', 'paradox' ),
				'customizer_only' => true,
				'options'         => array(
					'1' => esc_html__( 'Opt 1', 'paradox' ),
					'2' => esc_html__( 'Opt 2', 'paradox' ),
					'3' => esc_html__( 'Opt 3', 'paradox' ),
				),
				'default'         => '2',
			),
		),
	)
);

/*
 * <--- END SECTIONS
 */

/*
 * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR OTHER CONFIGS MAY OVERRIDE YOUR CODE.
 */

/*
 * --> Action hook examples.
 */

// Function to test the compiler hook and demo CSS output.
// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
// add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);
//
// Change the arguments after they've been declared, but before the panel is created.
// add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );
//
// Change the default value of a field after it's been set, but before it's been used.
// add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );
//
// Dynamically add a section. Can be also used to modify sections/fields.
// add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');
// .
if ( ! function_exists( 'compiler_action' ) ) {
	/**
	 * This is a test function that will let you see when the compiler hook occurs.
	 * It only runs if a field's value has changed and compiler=>true is set.
	 *
	 * @param array  $options        Options values.
	 * @param string $css            Compiler selector CSS values  compiler => array( CSS SELECTORS ).
	 * @param array  $changed_values Any values changed since last save.
	 */
	function compiler_action( array $options, string $css, array $changed_values ) {
		echo '<h1>The compiler hook has run!</h1>';
		echo '<pre>';
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions
		print_r( $changed_values ); // Values that have changed since the last save.
		// echo '<br/>';
		// print_r($options); //Option values.
		// echo '<br/>';
		// print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS ).
		echo '</pre>';
	}
}

if ( ! function_exists( 'redux_validate_callback_function' ) ) {
	/**
	 * Custom function for the callback validation referenced above
	 *
	 * @param array $field          Field array.
	 * @param mixed $value          New value.
	 * @param mixed $existing_value Existing value.
	 *
	 * @return array
	 */
	function redux_validate_callback_function( array $field, $value, $existing_value ): array {
		$error   = false;
		$warning = false;

		// Do your validation.
		if ( 1 === (int) $value ) {
			$error = true;
			$value = $existing_value;
		} elseif ( 2 === (int) $value ) {
			$warning = true;
			$value   = $existing_value;
		}

		$return['value'] = $value;

		if ( true === $error ) {
			$field['msg']    = 'your custom error message';
			$return['error'] = $field;
		}

		if ( true === $warning ) {
			$field['msg']      = 'your custom warning message';
			$return['warning'] = $field;
		}

		return $return;
	}
}


if ( ! function_exists( 'dynamic_section' ) ) {
	/**
	 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
	 * Simply include this function in the child themes functions.php file.
	 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
	 * so you must use get_template_directory_uri() if you want to use any of the built-in icons.
	 *
	 * @param array $sections Section array.
	 *
	 * @return array
	 */
	function dynamic_section( array $sections ): array {
		$sections[] = array(
			'title'  => esc_html__( 'Section via hook', 'paradox' ),
			'desc'   => '<p class="description">' . esc_html__( 'This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.', 'paradox' ) . '</p>',
			'icon'   => 'el el-paper-clip',

			// Leave this as a blank section, no options just some intro text set above.
			'fields' => array(),
		);

		return $sections;
	}
}

if ( ! function_exists( 'change_arguments' ) ) {
	/**
	 * Filter hook for filtering the args.
	 * Good for child themes to override or add to the args array. Can also be used in other functions.
	 *
	 * @param array $args Global arguments array.
	 *
	 * @return array
	 */
	function change_arguments( array $args ): array {
		$args['dev_mode'] = true;

		return $args;
	}
}

if ( ! function_exists( 'change_defaults' ) ) {
	/**
	 * Filter hook for filtering the default value of any given field. Very useful in development mode.
	 *
	 * @param array $defaults Default value array.
	 *
	 * @return array
	 */
	function change_defaults( array $defaults ): array {
		$defaults['str_replace'] = esc_html__( 'Testing filter hook!', 'paradox' );

		return $defaults;
	}
}

if ( ! function_exists( 'redux_custom_sanitize' ) ) {
	/**
	 * Function to be used if the field sanitize argument.
	 * Return value MUST be the formatted or cleaned text to display.
	 *
	 * @param string $value Value to evaluate or clean.  Required.
	 *
	 * @return string
	 */
	function redux_custom_sanitize( string $value ): string {
		$return = '';

		foreach ( explode( ' ', $value ) as $w ) {
			foreach ( str_split( $w ) as $k => $v ) {
				if ( ( $k + 1 ) % 2 !== 0 && ctype_alpha( $v ) ) {
					$return .= mb_strtoupper( $v );
				} else {
					$return .= $v;
				}
			}

			$return .= ' ';
		}

		return $return;
	}
}
// Function used to retrieve theme option values
if ( ! function_exists( 'paradox_settings' ) ) {
	function paradox_settings( $id, $fallback = false, $param = false ) {
		global $redux_demo;
		if ( $fallback == false ) $fallback = '';
		$output = ( isset( $redux_demo[$id] ) && $redux_demo[$id] !== '' ) ? $redux_demo[$id] : $fallback;
		if ( !empty( $redux_demos[$id] ) && $param ) {
			$output = $redux_demos[$id][$param];
		}
		return $output;
	}
}