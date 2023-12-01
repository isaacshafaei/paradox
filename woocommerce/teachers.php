<?php 
$perfix = 'paradox_';
$teacher1 = get_post_meta(get_the_ID(  ),$perfix . 'course_teacher',true);
$teacher2 = get_post_meta(get_the_ID(  ),$perfix . 'course_teacher_2',true);
$teacher_job = get_post_meta($teacher1,$perfix . 'job_text',true);
$teacher_post = get_post($teacher1);
?>
<div class="product_sidebar_box mentor_box">
    <div class="course_mentor">
        <?php 
        $teacher_image = wp_get_attachment_image_src(get_post_thumbnail_id($teacher1),'paradox-120x120',true);
        if($teacher_image): ?>
        <a href="<?php echo esc_url(get_permalink($teacher_post)); ?>"><img src="<?php echo esc_url($teacher_image[0]); ?>" alt=""></a>
        <?php endif; ?>
        <div class="mentor_name">
            <a href="<?php echo esc_url(get_permalink($teacher_post)); ?>"><?php echo esc_html(get_the_title($teacher1) ); ?></a>
            <span><?php echo esc_html($teacher_job ); ?></span>
        </div>
    </div>
    <div class="content">
        <p>
            <?php echo esc_html($teacher_post->post_excerpt); ?>
        </p>
    </div>

    <?php if($teacher2 && $teacher2 != 'no-teacher'): 
        $teacher_job = get_post_meta($teacher2,$perfix . 'job_text',true);
        $teacher_post = get_post($teacher2);
        ?>
<!-- second mentor -->
    <div class="course_mentor">
        <?php 
        $teacher_image = wp_get_attachment_image_src(get_post_thumbnail_id($teacher2 ),'paradox-120x120',false);
        if($teacher_image): ?>
        <a href="<?php echo esc_url(get_permalink($teacher_post)); ?>"><img src="<?php echo esc_url($teacher_image[0]); ?>" alt=""></a>
        <?php endif; ?>
        <div class="mentor_name">
            <a href="<?php echo esc_url(get_permalink($teacher_post)); ?>"><?php echo esc_html(get_the_title($teacher2 ) ); ?></a>
            <span><?php echo esc_html($teacher_job ); ?></span>
        </div>
    </div>
    <div class="content">
        <p>
            <?php echo esc_html($teacher_post->post_excerpt); ?>
        </p>
    </div>
<?php endif; ?>
</div>