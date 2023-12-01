<?php
/**
 * Template file for mobile navigation
 */

$off_canvas_footer = '';
$off_canvas_cart = true;
$off_canvas_search = true;

if ( class_exists('Redux' ) ) {
    $off_canvas_footer = paradox_settings('text_on_mobile');
    $off_canvas_cart = paradox_settings('basket_mobile');
    $off_canvas_search = paradox_settings('search_mobile');
}

$nav_id = 'main-menu';

if(has_nav_menu('mobile-menu')) {
	$nav_id = 'mobile-menu';
}

$menu = wp_nav_menu(
	array(
		'theme_location'    => $nav_id,
		'container'         => 'nav',
		'menu_class'        => 'mobile-menu',
		'echo'				=> false
	)
);

?>
<div class="off-canvas-navigation">
<div class="close_btn">
    <i class="fa fa-close"></i>
</div>
    <?php if ( $off_canvas_search ) : ?>
        <div class="search-form-wrapper">
            <form class="search-form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                <input data-swplive="true" type="search" name="s" id="" placeholder="هرچیزی می خواید جستجو کنید...">
                <button class="submit" type="submit">
                    <i class="fa fa-search"></i>
                </button>   
            </form>
        </div>
    <?php endif; ?>


	<div class="off-canvas-main">
		<?php echo wp_kses_post($menu); ?>
	</div>

	<?php if ( $off_canvas_footer != '' ) : ?>
        <footer class="off-canvas-footer">
            <?php echo do_shortcode( $off_canvas_footer ); ?>
        </footer>
    <?php endif; ?>
</div>


<div class="header-cart">
<div class="dropdown-cart">
<?php

// Insert cart widget placeholder - code in woocommerce.js will update this on page load
echo '<div class="widget woocommerce widget_shopping_cart"><div class="widget_shopping_cart_content"></div></div>';

?>
</div>
</div>
