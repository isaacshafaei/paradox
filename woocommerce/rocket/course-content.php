<?php
$prefix = 'paradox_';
$faq_question_group = get_post_meta( get_the_ID(), $prefix.'faq_question_group', true );

 ?>
<div id="rcourse_description" class="rinner_content rcontent_course_box">
    <div class="rcourse_main_content">
            <?php the_content(); ?>
    </div>
    <div class="rmore_btn">
        <span class="cirlce_more"></span>
        <button class="rmore_content">
            ادامه مطلب
            <i class="fad fa-eye"></i>
        </button>
    </div>
    <?php if($faq_question_group):  ?>
    <div class="rfaq">
        <h3>سوالات متداول</h3>
        <div class="acardion accordion_item">
        <?php 
                foreach($faq_question_group as $faq_question): ?>
            <div class="question click_accordion">
                <div class="head_inner_accordion">
                <span class="title_icon"><i class="fa fa-question"></i>
                    <h3 class="faq_title accordion_items_title"><?php echo esc_html($faq_question[$prefix . 'faq_title']); ?></h3>
                </span>
                <i class="fa fa-caret-left"></i>
                </div>
            </div>
            <div class="box_content accordion_content">
                    <p>
                     <?php echo esc_html($faq_question[$prefix . 'answer_faq']); ?>
                    </p>
            </div>
            <?php 
                endforeach; ?>
        </div>
    </div>
<?php endif; ?>
</div>