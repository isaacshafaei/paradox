<?php
defined( 'ABSPATH' ) || exit;

$prefix = 'paradox_';
$course_video = get_post_meta(get_the_ID(),$prefix.'course_video',true); ?>
<div class="item">
	<article class="related_post course_item">
		<div class="post_thumbnail">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('paradox-420x294'); ?></a>
			<?php
				 global $product;

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
				?>
			<?php if($course_video): ?>
					<div class="play_video">
						<a href="<?php echo esc_url($course_video); ?>" class="play_btn"><i class="fal fa-play"></i></a>
					</div>
			<?php endif; ?>
		</div>
		<div class="post_content">
			<h3 class="entry_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="course_content_bottom">
				<div class="course_student">
					<i class="fal fa-users"></i>
					<span><?php echo get_post_meta(get_the_ID(),'total_sales', true); ?></span>
				</div>
				<div class="course_price">
					<?php woocommerce_template_loop_price(); ?>
				</div>
			</div>
		</div>
	</article>        
</div>
