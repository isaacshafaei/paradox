<?php 
global $product;
$prefix = 'paradox_';
$course_sessions_group = get_post_meta( get_the_ID(), $prefix.'course_sessions_group', true );
$current_user = wp_get_current_user();
if($course_sessions_group): 
?>
<div id="course_sessions" class="course_sessions rcontent_course_box dot">
    <h4 class="guranty">جلسات دوره</h4>
    <?php 
            $sec_counter = 1;
            foreach($course_sessions_group as $course_sessions): ?>
    <!--Start course Section -->
    <div class="rsession_item accordion_item">
        <div class="click_accordion">
            <div class="head_inner_accordion sec_head">
                <span class="title_icon">
                    <span class="sec_title">بخش <?php echo esc_html($sec_counter); ?></span>
                    <h3 class="accordion_items_title"><?php echo esc_html($course_sessions['paradox_part_title']); ?></h3>
                </span>
                <i class="fa fa-caret-left"></i>
            </div>
        </div>
        <div class="accordion_content box_content">
        <?php $myindex = 0;
              $counter = 1;
            $new_course_sessions = $course_sessions;
            foreach($course_sessions['menu_lessons'] as $course_sessions_info): 
                if(wc_customer_bought_product( $current_user->user_email, $current_user->ID,$product->get_id())){
                     $buy_session_link = $new_course_sessions['link_lessons'][$myindex];
                     $see_video = '<a class="rsee_video play_btn" href="'.esc_url($buy_session_link).'">مشاهده<i class="fad fa-eye"></i></a>';
                }else{
                    $buy_session_link = '#';
                    $see_video = '<span class="not_buy_yet" data-tooltip="هنوز دوره رو خریداری نکردید :("><i class="fad fa-lock"></i></span>';
                }
            ?>
            <!--Start course sessions -->
            <div class="course_sessions_item">
                <div class="click_accordion">
                    <div class="head_inner_accordion">
                        <span class="title_icon">
                            <span class="sec_number"><?php echo esc_html($counter); ?></span>
                            <a href="<?php echo esc_url($buy_session_link); ?>">
                                 <h3 class="accordion_items_title"><?php echo esc_html($new_course_sessions['menu_lessons'][$myindex]); ?></h3>
                            </a>
                        </span>
                        <span class="rcourse_time"><?php echo esc_html($new_course_sessions['duration_time_lessons'][$myindex]); ?>
                            <i class="far fa-clock"></i>
                        </span>
                        <a class="rdownload_video" href="<?php echo esc_url($buy_session_link); ?>">دانلود ویدیو
                            <i class="fal fa-download"></i>
                        </a>
                        <?php echo $see_video; ?>
                    </div>
                </div>
            </div>
            <!--End course sessions -->
            <?php
         $counter++;
         $myindex++;
         endforeach; ?>
        </div>
    </div>
    <!--End course Section -->
    <?php 
    $sec_counter++;
        endforeach; ?>
</div>
<?php endif; ?>