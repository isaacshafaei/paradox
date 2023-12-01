<?php

global $product;
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

//custom metaboxes
$prefix = 'paradox_';
$course_image_disable = get_post_meta( get_the_ID(  ),$prefix.'course_disable_image', true );
$course_video_url = get_post_meta( get_the_ID(  ),$prefix.'course_video', true );
$course_poster_url = get_post_meta( get_the_ID(  ),$prefix.'poster_video_coures', true );
$google_map = get_post_meta( get_the_ID(  ),$prefix . 'location_google_map', true );

if(class_exists('Redux')){
    $after_bought_text =  paradox_settings('course_single_sidebar_position');
    $content_review_rules =  paradox_settings('content_review_rules');
    $course_detail_reviews =  paradox_settings('course_detail_reviews');
    $related_courses_display =  paradox_settings('related_courses_display');
    $course_advice =  paradox_settings('course_advice');
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<?php
	?>
    <section class="product_page">
        <div class="container">
            <div class="product_wrapper <?php echo esc_attr($after_bought_text ); ?>">
                <div class="main_product_content">
                    <div class="product_top_section">
                        <div class="product_thumbnail">
                            <?php 
                            if($course_image_disable){
                                $attr = array(
                                    'src' => $course_video_url,
                                    'poster' => $course_poster_url,
                                );
                                echo wp_video_shortcode($attr);
                            }else{
		                        do_action( 'woocommerce_before_single_product_summary' );
                            }
                             ?>
                        </div>
                    </div>
                    <div class="inner_content product_content">
                        <?php the_content(); ?>
                    </div>
                    <?php
                    $tags_list = wc_get_product_tag_list( $product->get_id()); 
                    if($tags_list && !is_wp_error( $tags_list )) {?>
                        <div class="inner_content post-tags">
                            <span><i class="fal fa-tags"></i>برچسب ها :</span>
                        <?php echo wp_kses_post($tags_list); ?>
                        </div>
                    <?php } ?>
                    <div class="inner_content">
                        <div class="title_review">
                            <i class="fas fa-map-marker-alt"></i>
                            <h3>محل برگذاری دوره</h3>
                        </div>
                        <?php echo $google_map; ?>
                    </div>
                    <?php 
                    if($course_advice){
                        wc_get_template_part('counseling'); 
                    }
                    ?>
                    <?php
                    if($related_courses_display){
                        wc_get_template_part('course-related');
                    }
                      ?>
                    <?php 
                    if($course_detail_reviews){
                        wc_get_template_part('product-review');
                    }
                     ?>
                    <?php if(comments_open( )): ?>
                    <div class="inner_content">
                        <div class="title_review">
                            <i class="fal fa-comment-alt-dots"></i>
                            <h3>نظرات</h3>
                        </div>
                        <?php echo $content_review_rules; ?>
                        <?php comments_template(); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php wc_get_template_part('content-single-product-meta-side'); ?>
            </div>
        </div>
    </section>
	<?php
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
