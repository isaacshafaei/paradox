<?php 

if(class_exists('Redux')){
    $report_problem = paradox_settings('report_form');
}
$perfix = 'paradox_';
if(!empty(get_post_meta(get_the_ID(  ), $perfix.'download_box_text',true))):
                    ?>
                    <div class="inner_content">
                        <div class="box_download">
                            <div class="help_download">
                                <?php echo get_post_meta(get_the_ID(  ), $perfix.'download_box_text',true); ?>
                            </div>
                            <div class="box_button_holder">
                                <span><i class="fa fa-folder-open-o"></i>دانلود فایل</span>
                                <div class="box_content">
                                    <?php if(is_user_logged_in(  )){ 
                                    get_template_part('/inc/templates/blog/download-links'); 
                                     }else{?>
                                       <div class="message_box_content">برای مشاهده لینک دانلود ها لطفا وارد سایت شوید</div>
                                  <?php  
                                   if(is_plugin_active('digits/digit.php')){
                                        echo do_shortcode('[dm-modal]'); 
  
                                }else{ ?>
                                    <a href="#" class="register-modal-opener login-button btn btn-filled">
                                        <i class="fal fa-user-lock"></i>
                                        <p class="login-btn-txt">ورود و ثبت نام</p>
                                    </a>
                               <?php  }
                                } ?>
                                </div>
                            </div>
                            <div class="button_download">
                                <?php if(!empty(get_post_meta(get_the_ID(  ), $perfix.'zip_password',true))){ ?>
                                    <span class="pass">پسورد فایل : <?php echo get_post_meta(get_the_ID(  ), $perfix.'zip_password',true); } ?></span>
                                    <span class="link_report">گزارش خرابی لینک</span>
                            </div>
                            <div class="link_report_content">
                                <p>
                                 <?php echo (do_shortcode($report_problem))?do_shortcode($report_problem):"محل نمایش فرم گزارش مشکل دانلود شما."; ?>
                                </p>
                            </div>
                        </div>  
                    </div>
                    <?php endif; ?>