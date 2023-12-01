<?php 
global $product;
$perfix = 'paradox_';
$teacher1 = get_post_meta(get_the_ID(  ),$perfix . 'course_teacher',true);
$course_time = get_post_meta(get_the_ID(  ),$perfix . 'course_duration',true);
$course_session = get_post_meta(get_the_ID(  ),$perfix . 'course_session_number',true);
$course_file_size = get_post_meta(get_the_ID(  ),$perfix . 'course_file_size',true);
$course_update_date = get_post_meta(get_the_ID(), $perfix . 'course_update_date', true);
$course_support = get_post_meta(get_the_ID(), $perfix . 'course_support', true);
$course_status = get_post_meta(get_the_ID(), $perfix . 'course_status', true);
$vip_active = get_post_meta(get_the_ID(), $perfix . 'vip_active', true);

$teacher_post = get_post($teacher1);
if(class_exists('Redux')){
    $vip_text =  paradox_settings('vip_text');
    $link_text =  paradox_settings('link_text');
    $vip_link =  paradox_settings('vip_link');
}

?>
<aside class="rside sticky-sidebar">
    <div class="theiaStickySidebar">
        <div class="rside_box review_box">
            <span class="rtitle_review">امتیاز دوره :</span>
            <div class="product_rating">
                <div class="average-rating-number">
                    <div class="schema-stars">
                    <span><?php echo esc_attr($product->get_average_rating()); ?></span>
                    <span class="title-rate">از</span>
                    <span><?php echo esc_attr($product->get_rating_count()); ?></span>
                    <span class="title-rate">رأی</span>
                    </div>
                </div>
                <div class="average_stars_rating">
                    <?php woocommerce_template_loop_rating(); ?>
                </div>
            </div>
        </div>
        <?php if($course_session || $course_session || $course_file_size || $course_update_date || $course_support || $course_status): ?>
            <div class="rinfo_icon_container">
                <?php if($course_time){ ?>
                <div class="ricon_item">
                    <i class="fas fa-hourglass-end"></i>
                    <span class="label">زمان دوره :</span>
                    <span class="value"><?php echo esc_html($course_time); ?></span>
                </div>
                <?php } ?>
                <?php if($course_session){ ?>
                <div class="ricon_item">
                    <i class="fas fa-th-list"></i>
                    <span class="label">تعداد جلسات :</span>
                    <span class="value"><?php echo esc_html($course_session); ?></span>
                </div>
                <?php } ?>               
                 <?php if($course_file_size){ ?>
                <div class="ricon_item">
                    <i class="fas fa-hdd"></i>
                    <span class="label">حجم دوره :</span>
                    <span class="value"><?php echo esc_html($course_file_size); ?></span>
                </div>
                <?php } ?>
                <?php if($course_update_date){ ?>
                <div class="ricon_item">
                    <i class="fas fa-calendar-edit"></i>
                    <span class="label">آخرین بروزرسانی :</span>
                    <span class="value"><?php echo esc_html($course_update_date); ?></span>
                </div>
                <?php } ?>
                <?php if($course_support){ ?>
                <div class="ricon_item">
                    <i class="fas fa-user-headset"></i>
                    <span class="label">پشتیبانی دوره :</span>
                    <span class="value"><?php echo esc_html($course_support); ?></span>
                </div>
                <?php } ?>
                <?php if($course_status){ ?>
                <div class="ricon_item">
                    <i class="fas fa-battery-half"></i>
                    <span class="label">وضعیت دوره :</span>
                    <span class="value"><?php echo esc_html($course_status); ?></span>
                </div>
                <?php } ?>
        </div>
        <?php endif; ?>
        <?php if($vip_active){ ?>
        <div class="rside_box vip_text position_relative">
            <div class="vip_text">
                <span class="icon">
                    <img src="<?php echo bloginfo('template_url' ); ?>/assets/img/star-fill.svg" alt="عضویت ویژه">
                </span>
                <div class="text">
                    <p><?php echo esc_html($vip_text); ?></p>
                    <a id="vip_link" href="<?php echo esc_url($vip_link); ?>">
                       <?php echo esc_html($link_text); ?>
                        <i class="fas fa-long-arrow-alt-left"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if($teacher1 !='no-teacher'): ?>
        <div class="rside_box margin_top20">
            <div class="rcourse_mentor">
            <?php 
            $teacher_image = wp_get_attachment_image_src(get_post_thumbnail_id($teacher1),'paradox-120x120',true);
            if($teacher_image): ?>
                <a href="<?php echo esc_url(get_permalink($teacher_post)); ?>"><img src="<?php echo esc_url($teacher_image[0]); ?>" alt=""></a>
            <?php endif; ?>
                <a class="rmentor_name" href="<?php echo esc_url(get_permalink($teacher_post)); ?>"><?php echo esc_html(get_the_title($teacher1) ); ?>
                    <i class="fas fa-badge-check"></i>
            </a>
                <span>مدرس دوره</span>
                <p><?php echo esc_html($teacher_post->post_excerpt); ?></p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</aside>