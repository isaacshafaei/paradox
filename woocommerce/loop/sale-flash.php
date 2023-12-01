<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<?php 
					if ( $product->is_on_sale()) {

						if ( ! $product->is_type( 'variable' ) ) {
	
						$max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
	
						} else {
	
							$max_percentage = 0;
	
							foreach ( $product->get_children() as $child_id ) {
							$variation = wc_get_product( $child_id );
							$price = $variation->get_regular_price();
							$sale = $variation->get_sale_price();
							if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
							if ( $percentage > $max_percentage ) {
							$max_percentage = $percentage;
							}
							}
	
						}
						echo "<div class='onsale_price'>";
						echo "<span class='onsale_perc'>" . round($max_percentage) . "% </span>";
						echo "<span class='sale_text'>تخفیف</span>";
						echo "</div>";
						}