<?php get_header(); 
$register_login_class ='login_page_class';
if(!is_account_page() && !is_user_logged_in( ) || !is_account_page() &&
 is_user_logged_in( ) || is_account_page() && is_user_logged_in( )){
    $register_login_class = '';
 }
$account_page_after_login = '';
if(is_account_page() && is_user_logged_in()){
    $account_page_after_login = 'account_page_after_login';
}
?>
    <section class="page_inner <?php echo esc_attr($account_page_after_login); ?> <?php echo esc_attr($register_login_class); ?>">
        <div class="container page">
            <div class="blog_wrapper">
                <article class="blog_content full-width">
                    <?php while(have_posts(  )): the_post(  ); ?>
                    <div class="inner_content">
                        <div class="post_thumbnail_image">
                            <?php 
                                if(has_post_thumbnail()){
                                    the_post_thumbnail('full');
                                }    
                             ?>
                        </div>
                        <div class="entry_content_single">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </article> 
            </div>
        </div>
    </section>
<?php get_footer(); ?>