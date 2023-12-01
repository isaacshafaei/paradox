<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
<?php
			$max_depth = get_option('thread_comments_depth');
			$args = array(
				'depth' =>2,
				'reply_text' =>__('Reply'),
				'resond_id'=>'respond',
				'before'=>'<div class="comment_reply_btn">',
				'after'=>'</div>',
				'max_depth'=>$max_depth
			);
			 comment_reply_link($args,get_comment_ID()); ?>
	<div id="comment-<?php comment_ID(); ?>" class="comment_container">
		<?php
		/**
		 * The woocommerce_review_before hook
		 *
		 * @hooked woocommerce_review_display_gravatar - 10
		 */
		do_action( 'woocommerce_review_before', $comment );
		?>

		<div class="comment-text">

			<?php
			/**
			 * The woocommerce_review_before_comment_meta hook.
			 *
			 * @hooked woocommerce_review_display_rating - 10
			 */
			do_action( 'woocommerce_review_before_comment_meta', $comment ); ?>

			<div class="comment-header">
				<h5 class="comment-author"><?php comment_author( ); ?></h5>
				<?php if(user_can($comment->user_id,'administrator')){ ?>
						<em class="admin-label">مدیریت</em>
					<?php }else{
							if(wc_customer_bought_product($comment->comment_author_email,$comment->user_id,$comment->comment_post_ID)){ ?>
								<em class="verified">دانشجوی دوره</em>
					<?php }
						} ?>
						<time class="woocommerce-review__published-date" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>"><?php echo esc_html(get_comment_date(wc_date_format()) ); ?></time>
			</div>

	<?php		do_action( 'woocommerce_review_before_comment_text', $comment );

			/**
			 * The woocommerce_review_comment_text hook
			 *
			 * @hooked woocommerce_review_display_comment_text - 10
			 */
			do_action( 'woocommerce_review_comment_text', $comment );

			do_action( 'woocommerce_review_after_comment_text', $comment );
			?>

		</div>
	</div>
