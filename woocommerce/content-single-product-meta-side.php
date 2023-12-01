<?php
global $product,$post;
$prefix = 'paradox_';
$extra_content = get_post_meta(get_the_ID(),$prefix.'extra_content',true);

// Product Meta
$duration = get_post_meta(get_the_ID(), $prefix . 'course_duration', true);
$lessons = get_post_meta(get_the_ID(), $prefix . 'course_lesseons', true);
$skill_level = get_post_meta(get_the_ID(), $prefix . 'course_level', true);
$certificate = get_post_meta(get_the_ID(), $prefix . 'course_certificate', true);
$course_language = get_post_meta(get_the_ID(), $prefix . 'course_language', true);
$course_type = get_post_meta(get_the_ID(), $prefix . 'course_type', true);
$course_prerequisite = get_post_meta(get_the_ID(), $prefix . 'course_prerequisite', true);
$course_start_date = get_post_meta(get_the_ID(), $prefix . 'course_start_date', true);
$course_update_date = get_post_meta(get_the_ID(), $prefix . 'course_update_date', true);
$course_file_size = get_post_meta(get_the_ID(), $prefix . 'course_file_size', true);
$course_support = get_post_meta(get_the_ID(), $prefix . 'course_support', true);
$course_receive_type = get_post_meta(get_the_ID(), $prefix . 'course_receive_type', true);
$course_percent = get_post_meta(get_the_ID(), $prefix . 'course_percent', true);
$teacher1 = get_post_meta(get_the_ID(  ),$prefix . 'course_teacher',true);

$feture_group = get_post_meta( get_the_ID(), $prefix.'feture_group', true );

if(class_exists('Redux')){
    $after_bought_text =  paradox_settings('course_student_text');
    $course_downloads =  paradox_settings('course_downloads');
    $course_students =  paradox_settings('course_students');
    $course_counters =  paradox_settings('course_counters');
    $course_share_story =  paradox_settings('course_share_story');
}

//download link
$downloads = array();
if (is_user_logged_in()) {
    $user_id = get_current_user_id();
    $downloads = wc_get_customer_available_downloads($user_id);
}
?>
<aside class="product_sidebar sticky-sidebar">
    <div class="theiaStickySidebar">
        <div class="product_sidebar_box buy_product">
                            <?php 
                            $current_user = wp_get_current_user();
                            if(wc_customer_bought_product( $current_user->user_email, $current_user->ID,$product->get_id())){ ?>
                                     <button class="are-student button"><i class="fas fa-graduation-cap"></i>
                                        <?php echo ($after_bought_text)?$after_bought_text:'شما دانشجوی این دوره هستید' ?>
                                    </button> 
                             <?php   }else{
                                    do_action('woocommerce_single_product_countdown'); 
                                    do_action('woocommerce_single_product_summary');
                                    ?>
                                    <?php if($extra_content): ?>
                                    <div class="extra_text">
                                        <?php echo $extra_content; ?>
                                    </div>
                                    <?php endif;
                                }
                            ?>
                            <div class="product_rating">
                                <div class="average-rating-number"><span class="title-rate">امتیاز</span>
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
                        <?php if ( wc_customer_bought_product( $current_user->user_email, $current_user->ID, $product->get_id()) && $course_downloads) : ?>
                        <div class="product_sidebar_box">
                            <ul class="wcdlar_download_list produc-page">
                                <li>
                                <?php echo '<a href="#" class="title">دریافت فایل های دوره<i class="fal fa-chevron-down"></i></a>'; ?>
                                    <div class="sub_items">
                                        <table>
                                            <?php foreach ($downloads as $download) : ?>
                                                <?php if ($download['product_id'] === $product->get_id()) : ?>
                                                    <tr>
                                                        <td><?php echo '<a href="' . $download['download_url'] . '" class="download-btns-product-page"><i class="fal fa-download"></i> ' . $download ['file']['name'] .' </a>'; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </table>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <div class="product_sidebar_box">
                            <?php if($course_students){ ?>
                            <div class="total_sale">
                                <i class="fal fa-user-graduate"></i>تعداد دانشجو :
                                <span><?php echo get_post_meta(get_the_ID(),'total_sales', true); ?></span>
                            </div>
                            <?php } ?>
                            <div class="product_specification">
                                <?php if($course_type): ?>
                                <div class="product_info_item">
                                    <i class="fal fa-map-marker-alt"></i>
                                    <span class="value">نوع دوره : <?php echo esc_html($course_type); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($skill_level): ?>
                                <div class="product_info_item">
                                    <i class="fal fa-book-reader"></i>
                                    <span class="value">سطح دوره : <?php echo esc_html($skill_level ); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($course_prerequisite): ?>
                                <div class="product_info_item">
                                    <i class="fal fa-traffic-light-slow"></i>
                                    <span class="value">پیش نیاز : <?php echo esc_html( $course_prerequisite );?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($course_start_date): ?>
                                <div class="product_info_item">
                                    <i class="fal fa-calendar-day"></i>
                                    <span class="value">تاریخ شروع : <?php echo esc_html( $course_start_date );?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($course_update_date): ?>
                                <div class="product_info_item">
                                    <i class="fal fa-calendar-edit"></i>
                                    <span class="value">تاریخ بروزرسانی : <?php echo esc_html( $course_update_date ); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($course_language): ?>
                                <div class="product_info_item">
                                    <i class="fal fa-globe"></i>
                                    <span class="value">زبان دوره  : <?php echo esc_html( $course_language ); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($duration): ?>
                                <div class="product_info_item">
                                    <i class="fal fa-clock"></i>
                                    <span class="value">مدت زمان دوره  : <?php echo esc_html( $duration ); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($lessons): ?>
                                <div class="product_info_item">
                                    <i class="fal fa-list-alt"></i>
                                    <span class="value">تعداد سرفصل ها  : <?php echo esc_html( $lessons ); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($course_file_size): ?>
                                <div class="product_info_item">
                                    <i class="fal fa-hdd"></i>
                                    <span class="value">حجم دوره  : <?php echo esc_html( $course_file_size ); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($course_receive_type): ?>
                                <div class="product_info_item">
                                    <i class="fal fa-long-arrow-alt-down"></i>
                                    <span class="value">روش دریافت  : <?php echo esc_html( $course_receive_type ); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($course_support): ?>
                                <div class="product_info_item">
                                    <i class="fal fa-user-headset"></i>
                                    <span class="value">روش پشتیبانی  : <?php echo esc_html( $course_support ); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($certificate): ?>
                                <div class="product_info_item">
                                    <i class="fal fa-file-certificate"></i>
                                    <span class="value">مدرک دوره : <?php echo esc_html( $certificate ); ?></span>
                                </div>
                                <?php endif; ?>
                            <?php 
                            if($feture_group): 
                                    foreach($feture_group as $fe_group):
                                ?>
                                <div class="product_info_item">
                                    <i class="<?php echo esc_html($fe_group[$prefix . 'feture_icon']); ?>"></i>
                                    <span class="value"><?php echo esc_html( $fe_group[$prefix . 'feture_title'] ); ?> : <?php echo esc_html( $fe_group[$prefix . 'feture_input'] ); ?></span>
                                </div>
                            <?php 
                                        endforeach;
                                    endif; ?>
                            </div>
                            <?php if($course_percent): ?>
                            <div class="progress_bar">
                                <i class="fal fa-tasks"></i>
                                درصد پیشرفت دوره: %<?php echo esc_html($course_percent); ?>			
                                <div class="meter">
                                    <span style="width:<?php echo esc_html($course_percent); ?>%">
                                        <span></span>
                                    </span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php if($course_counters){ ?>
                        <div class="product_sidebar_box">
                            <div class="product_view">
                                <span class="view">
                                    <i class="fal fa-eye"></i>
                                    <?php denshyar_post_view_count(); ?>
                                </span>
                                <span class="comments_number">
                                    <i class="fal fa-comments-alt"></i>
                                    <?php echo esc_html( get_comments_number() ); ?> دیدگاه
                                </span>
                            </div>
                        </div>
                        <?php }
                        if($teacher1 && $teacher1 != 'no-teacher'):
                        wc_get_template_part('teachers'); 
                        endif; ?>
                        <div class="product_sidebar_box">
                            <?php $product_cats = wc_get_product_category_list($product->get_id()); 
                            if($product_cats):
                            ?>
                            <div class="course_category">
                                <i class="fal fa-list"></i>دسته بندی :
                                <?php echo $product_cats; ?>
                            </div>
                            <?php endif; ?>
                            <div class="short_link">
                                <input type="text" class="short-url-link" value="<?php echo get_bloginfo('url')."/?p=".$post->ID; ?>">
                            </div>
                                <?php 
                                if($course_share_story){
                                    get_template_part('/inc/templates/sharing');
                                }
                                 ?>
                        </div>
                        <div class="product_sidebar_box">
                            <?php dynamic_sidebar('course_page'); ?>
                        </div>
    </div>
</aside>
