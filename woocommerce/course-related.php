<?php 

if(class_exists('Redux')){
    $course_related_post_per_page =  paradox_settings('course_per_page');
}
global $product;
$related = wc_get_related_products($product->get_id(),6);
$args = array(
    'post_type' =>'product',
    'posts_per_page'=>($course_related_post_per_page)?$course_related_post_per_page:3,
    'post_in'=>$related,
);
$my_query = new WP_Query($args);
if($my_query->have_posts()):
?>
<div class="inner_content">
    <div class="title_review">
        <i class="fas fa-video"></i>
        <h3>دوره های مرتبط</h3>
    </div>
    <div class="product_list">
    <?php while($my_query->have_posts()): $my_query->the_post(); ?>
        <div class="course-item">
            <div class="course-item-inner">
                <div class="course_thumbnail_holder">
                    <?php the_post_thumbnail('paradox-370x270'); ?>
                </div>
                <div class="course_content_holder">
                    <h4><a href="<?php the_permalink( ); ?>"><?php the_title(); ?></a></h4>
                    <div class="course-description">
	                  <p><?php the_excerpt( ); ?></p>
                    </div>
                </div>
            </div>
        </div>
<?php endwhile; ?>
    </div>
</div>
<?php endif;
wp_reset_postdata();