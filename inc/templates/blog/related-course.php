<?php 
$product_cats = get_post_meta(get_the_ID(),'paradox_related_course_post', true);

if ( !empty($product_cats) ) :
?>
<div class="inner_content">
    <div class="post_reviews">
        <div class="title_review">
            <i class="fal fa-user-graduate"></i>
            <h3>دوره های آموزشی مرتبط</h3>
        </div>
        <div class="content_review">
            <div class="owl-carousel owl-theme post_related_carousel">
            <?php 
            $related_product_post = new WP_Query(
                array(
                    'post_type' => 'product',
                    'posts_per_page' => 6,
                    'product_cat' => $product_cats
                ));
            while ( $related_product_post->have_posts() ) : $related_product_post->the_post();
            get_template_part( 'woocommerce/content-product-carousel');
             ?>
     <?php endwhile; // end of the loop.
            wp_reset_postdata();
            ?>
            </div>
        </div>
    </div>
</div>
<?php endif;