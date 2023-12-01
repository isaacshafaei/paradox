<?php
if ( post_password_required() ) {
	return;
}

$comments_number = get_comments_number();

?>

<?php if ( have_comments() ) : ?>

	<div class="comment-holder">
		<h2 class="comment-title"><?php echo sprintf( _n( '1 نظر', '%d نظر', $comments_number, 'paradox' ), $comments_number ); ?></h2>
		<p class="comment-subtitle"><?php $comments_number > 0 ? esc_html_e( 'بی صبرانه مشتاق نظرات شما هستیم.', 'paradox' ) : esc_html_e( 'اولین نفری باشید که نظر می دهد.', 'paradox' ); ?></p>

		<ul class="commentlist clearfix">
			<?php wp_list_comments(
				array(
					'type'		  => 'all',
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => 80
				)
			); ?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link(); ?></div>
				<div class="nav-next"><?php next_comments_link(); ?></div>
			</div><!-- .navigation -->
		<?php } ?>

	</div>
<?php else : if ( ! comments_open() ) : ?>
	<p class="nocomments"><?php esc_html_e("نظرات توسط مدیر سایت بسته شده", 'paradox'); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; ?>

<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
    <p class="no-comments"><?php esc_html_e( 'نظرات توسط مدیر سایت بسته شده است.', 'paradox' ); ?></p>
<?php } ?>

<?php comment_form( array(
	'comment_notes_before' => '',
	'comment_notes_after' => ''
) ); ?>
