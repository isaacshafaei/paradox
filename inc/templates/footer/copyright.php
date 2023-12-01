<?php 
    $copyrights =  paradox_settings('copyrights');
    $copyrights2 =  paradox_settings('copyrights2');
    $footer_copright_style =  paradox_settings('copyrights-layout');

 ?>
<div class="footer_copyright">
    <div class="container">
        <div class="inner_footer <?php echo esc_attr($footer_copright_style ); ?>">
            <div class="copyright_cell"><?php echo ($copyrights)?$copyrights:'تمامی حقوق برای سایت پارادوکس محفوظ می باشد.'; ?></div>
            <div class="copyright_cell"> 
                <?php if($copyrights2){
                    echo do_shortcode($copyrights2);
                }else{ ?>
                <ul>
                    <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                    <li><a href="#"><i class="fa fa-behance"></i></a></li>
                    <li><a href="#"><i class="fa fa-foursquare"></i></a></li>
                    <li><a href="#"><i class="aparat"></i></a></li>
                    <li><a href="#"><i class="fa fa-telegram"></i></a></li>
                </ul>
                <?php } ?>
            </div> 
        </div>
    </div>
</div>  