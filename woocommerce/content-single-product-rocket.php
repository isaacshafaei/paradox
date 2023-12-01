<?php

global $product;
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

//custom metaboxes
$prefix = 'paradox_';
$course_image_disable = get_post_meta( get_the_ID(  ),$prefix.'rcourse_disable_image', true );
$course_video_url = get_post_meta( get_the_ID(  ),$prefix.'rcourse_video', true );
$course_poster_url = get_post_meta( get_the_ID(  ),$prefix.'rposter_video_coures', true );
$guarantee_active = get_post_meta( get_the_ID(  ),$prefix.'guarantee_active', true );
$course_sessions_group = get_post_meta( get_the_ID(), $prefix.'course_sessions_group', true );

if(class_exists('Redux')){
    $course_share_story =  paradox_settings('course_share_story');
    $garanty_text =  paradox_settings('garanty_text');
    $garanty_link =  paradox_settings('garanty_link');
    $vip_text =  paradox_settings('vip_text');
    $link_text =  paradox_settings('link_text');
    $vip_link =  paradox_settings('vip_link');
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<?php
	?>
    <section class="product__rpage">
        <div class="container">
            <section class="top_of_rocket">
                <div class="top_present_course">
                    <div class="rright">
                        <div class="rcourse_title">
                            <h1><?php the_title(); ?></h1>
                        </div>
                        <div class="rshort_desc">
                            <?php echo apply_filters( 'the_excerpt', $product->post->post_excerpt ); ?>
                        </div>
                        <div class="buy_btn">
                            <div class="shop_btn">
                                <?php do_action('woocommerce_single_product_summary'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="rleft">
                        <div class="rpost_thumbnail">
                        <?php 
                            if($course_image_disable){
                                $attr = array(
                                    'src' => $course_video_url,
                                    'poster' => $course_poster_url,
                                ); ?>
                               <div class="video_thumbnail"><?php echo wp_video_shortcode($attr); ?></div>
                                <?php
                            }else{
		                        do_action( 'woocommerce_before_single_product_summary' );
                            }
                             ?>
                        </div>
                    </div>
                </div>
                <div class="bottom_bar">
                    <div class="rght_bar">
                        <span class="comment_number">
                            <a href="#comment_section">
                                <i class="fas fa-comment-alt"></i>
                                <?php echo esc_html( get_comments_number() ); ?>
                            </a>
                        </span>
                        <span class="student_number">   
                        <i class="fas fa-user-graduate"></i>
                        <?php echo get_post_meta(get_the_ID(),'total_sales', true); ?>
                        </span>
                        <span class="publish_date">
                        <i class="fas fa-calendar-check"></i>
                        <?php echo get_the_date('Y/m/d', $product->get_id()); ?>
                        </span>
                    </div>
                    <div class="left_bar">
                    <?php 
                        if($course_share_story){
                            get_template_part('/inc/templates/sharing');
                        }
                        ?>
                    </div>
                </div>
            </section>
            <section class="bottom_sec_content">
                <div class="rcourse_content">
                    <div class="rcontent_header rcontent_course_box stickey_header ">
                        <ul>
                            <li><a href="#rcourse_description">توضیحات</a></li>
                            <?php if($guarantee_active && $garanty_text){ ?>
                            <li><a href="#guranty">گارانتی بازگشت وجه</a></li>
                            <?php } ?>
                            <?php if($course_sessions_group){ ?>
                            <li><a href="#course_sessions">جلسات دوره</a></li>
                            <?php } ?>
                            <li><a href="#comment_section">پرسش و پاسخ</a></li>
                        </ul>
                    </div>
                    <?php wc_get_template_part('rocket/course-content'); ?>
                    <?php if($guarantee_active && $garanty_text): ?>
                    <div id="guranty" class="rcontent_course_box dot padding_top0">
                        <h4 class="guranty">گارانتی بازگشت وجه</h4>
                        <div class="guranty_content">
                            <img src="<?php echo bloginfo('template_url' ); ?>/assets/img/security.png" alt="گارانتی بازگشت وجه">
                            <div class="guranty_text">
                                <p><?php echo esc_html($garanty_text); ?></p>
                                <?php if($garanty_link){ ?>
                                <a class="guranty_process" href="<?php echo esc_url($garanty_link); ?>">مراحل و فرایند گارانتی
                                     <i aria-hidden="true" class="fas fa-long-arrow-alt-left"></i>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php endif;
                    wc_get_template_part('rocket/course-sessions'); ?>
                    <?php if(comments_open( )): ?>
                        <span id="comment_section"></span>
                    <div class="rcontent_course_box dot padding_top0">
                        <h4 class="guranty">پرسش و پاسخ</h4>
                        <?php comments_template(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            <?php wc_get_template_part('rocket/course-sidebar'); ?>
            </section>
        </div>
    </section>
	<?php
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
