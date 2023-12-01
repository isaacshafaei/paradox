<?php 
global $product;
$average = round($product->get_average_rating(),1);
$rating_count = $product->get_rating_count();
?>
<div class="inner_content">
    <div class="title_review">
        <i class="fas fa-percent"></i>
        <h3>امتیاز دانشجویان دوره</h3>
    </div>
    <div class="product-review">
        <div class="product-reviews-inner">
            <div class="average-rating">
                <div class="avareage-rating-inner">
                    <div class="average-rating-number"><?php echo esc_attr($average);  ?></div>

                     <div class="average_stars_rating"><?php woocommerce_template_loop_rating(); ?></div>

                     <div class="average-rating-label"><?php echo esc_attr($rating_count); ?> رأی</div>
                </div>
            </div>
            <?php
                // WP_Comment_Query arguments
                $args = array (
                    'status'         => 'approve',
                    'type'           => 'review',
                    'post_id'        => get_the_id(),
                );
                // The Comment Query
                $woo_reviews = new WP_Comment_Query;
                $comments = $woo_reviews->query( $args );

                $rate1 = $rate2 = $rate3 = $rate4 = $rate5 = 0;
                // The Comment Loop
                if ( $comments ) {
                    foreach ( $comments as $comment ) {
                        $rate = get_comment_meta($comment->comment_ID, 'rating', true);
                        switch($rate) {
                            case 1:
                                $rate1++;
                                break;
                            case 2:
                                $rate2++;
                                break;
                            case 3:
                                $rate3++;
                                break;
                            case 4:
                                $rate4++;
                                break;
                            case 5:
                                $rate5++;
                                break;
                        } // switch
                    }
                }

                $rates = array('5'=>$rate5,'4'=>$rate4,'3'=>$rate3,'2'=>$rate2,'1'=>$rate1);
             ?>
            <div class="detailed-ratings">
                <div class="detailed-ratings-inner">
                <?php foreach($rates as $key=>$rate): 
                    if($rate !=0 or $rating_count !=0){
                        $fill_value = round($rate*100/$rating_count);
                    }else{
                        $fill_value=0;
                    }
            
                    ?>
                    <div class="course-rating">
                            <span class="number"><?php echo esc_attr($key ); ?> ستاره</span>
                                <div class="bar">
                                    <div class="bar-fill" style="width:<?php echo esc_attr( $fill_value); ?>%"></div>
                                </div>
                            <span class="counter"><?php echo esc_attr($rate ); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>                
            </div>
        </div>
    </div>
</div>