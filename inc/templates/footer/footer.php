<?php 
if(class_exists('Redux')){
    $footer_columns =  paradox_settings('footer_columns');
    $footer_copright_enable =  paradox_settings('disable_copyrights');
}
?>
<footer class="footer dabeshyar_footer">
        <div class="container">
             <div class="footer_column_wrapper">
                <?php if($footer_columns== 'three'){ ?>
            <div class="column_container three_column">
                <div class="column_footer_item">
                    <?php if(is_active_sidebar( 'footer-1' )){
                        dynamic_sidebar('footer-1');
                    } ?>
                </div>
                <div class="column_footer_item">
                <?php if(is_active_sidebar( 'footer-2' )){
                        dynamic_sidebar('footer-2');
                    } ?>
                </div>
                <div class="column_footer_item">
                <?php if(is_active_sidebar( 'footer-3' )){
                        dynamic_sidebar('footer-3');
                    } ?>
                </div>
            </div>   
            <?php
                }elseif($footer_columns== 'doubleleft'){ ?>
                <div class="column_container doubleleft_column">
                    <div class="column_footer_item width25_percent">
                        <?php if(is_active_sidebar( 'footer-1' )){
                            dynamic_sidebar('footer-1');
                        } ?>
                    </div>
                    <div class="column_footer_item width25_percent">
                    <?php if(is_active_sidebar( 'footer-2' )){
                            dynamic_sidebar('footer-2');
                        } ?>
                    </div>
                    <div class="column_footer_item width50_percent">
                    <?php if(is_active_sidebar( 'footer-3' )){
                            dynamic_sidebar('footer-3');
                        } ?>
                    </div>
                </div>
          <?php }elseif($footer_columns== 'doubleright'){ ?>
                <div class="column_container doubleleft_column">
                    <div class="column_footer_item width50_percent">
                        <?php if(is_active_sidebar( 'footer-1' )){
                            dynamic_sidebar('footer-1');
                        } ?>
                    </div>
                    <div class="column_footer_item width25_percent">
                    <?php if(is_active_sidebar( 'footer-2' )){
                            dynamic_sidebar('footer-2');
                        } ?>
                    </div>
                    <div class="column_footer_item width25_percent">
                    <?php if(is_active_sidebar( 'footer-3' )){
                            dynamic_sidebar('footer-3');
                        } ?>
                    </div>
                </div>
          <?php }elseif($footer_columns== 'four'){ ?>
                <div class="column_footer_item">
                    <?php if(is_active_sidebar( 'footer-1' )){
                        dynamic_sidebar('footer-1');
                    } ?>
                </div>
                <div class="column_footer_item">
                <?php if(is_active_sidebar( 'footer-2' )){
                        dynamic_sidebar('footer-2');
                    } ?>
                </div>
                <div class="column_footer_item">
                <?php if(is_active_sidebar( 'footer-3' )){
                        dynamic_sidebar('footer-3');
                    } ?>
                </div>
                <div class="column_footer_item">
                <?php if(is_active_sidebar( 'footer-4' )){
                        dynamic_sidebar('footer-4');
                    } ?>
                </div>
          <?php      }elseif($footer_columns== 'two'){ ?>
            <div class="column_footer_item">
                    <?php if(is_active_sidebar( 'footer-1' )){
                        dynamic_sidebar('footer-1');
                    } ?>
                </div>
                <div class="column_footer_item">
                <?php if(is_active_sidebar( 'footer-2' )){
                        dynamic_sidebar('footer-2');
                    } ?>
                </div>
      <?php    }elseif($footer_columns== 'one'){ ?>
        <div class="column_footer_item">
                    <?php if(is_active_sidebar( 'footer-1' )){
                        dynamic_sidebar('footer-1');
                    } ?>
                </div>
    <?php  }
         ?>
         </div>
        </div>
        <?php if($footer_copright_enable){ 
            get_template_part('/inc/templates/footer/copyright');
             } ?>
</footer>