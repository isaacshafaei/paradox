<?php
$related = get_posts( 
    array(
         'category__in' => wp_get_post_categories($post->ID), 
         'numberposts' => 6, 
          ) 
        );
 if($related): ?>
<div class="inner_content">
    <div class="post_reviews">
        <div class="title_review">
            <i class="fal fa-folders"></i>
            <h3>مطالب زیر را حتما مطالعه کنید</h3>
        </div>
        <div class="content_review">
            <div class="owl-carousel owl-theme post_related_carousel">
            <?php
                if( $related ) foreach( $related as $post ) {
                setup_postdata($post); ?>
                <div class="item">
                    <article class="related_post">
                        <div class="post_thumbnail">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('paradox-420x294'); ?></a>
                        </div>
                        <div class="post_content">
                            <a href="<?php the_permalink(); ?>"><h3 class="entry_title"><?php the_title(); ?></h3></a>
                            <p class="post_excerpt">
                                <?php
                                if( has_excerpt() ){
                                     the_excerpt();
                                } else {
                                     echo wp_trim_words( get_the_content(), 12, '...' );
                                }
                            ?>
                            </p>
                        </div>
                    </article>        
                </div>
                <?php } wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
    </div>
<?php endif; ?>