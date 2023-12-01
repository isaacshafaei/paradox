<?php 
if(class_exists('Redux')){
    $enable_loading = paradox_settings('enable_loading_page');
    $loading_page = paradox_settings('loading_page');
}
?>
<div class="loadings_container <?php echo ($loading_page=='kebrit')?'kebrit':'cycle_loading'; ?>">
    <?php if($enable_loading){ 
            if($loading_page=='kebrit'){ ?>
    <div class="paradox_loading">
        <div class="center">
            <div class="back_light_shadow"></div>
            <div class="load_l">
                <span>داره لود میشه...</span>
            </div>
            <div class="next_play">
                <div class="fire_f"></div>
                <div class="fire_f_1"></div>
                <div class="lighter_head"></div>
                <div class="lighter_body"></div>
                <div class="fire_hand"></div>
            </div>
        </div>
    </div>
    <?php }else{ ?>
    <!-- second loading -->
    <div class="second_loading">
        <div id="loader"></div>
    </div>
    <?php }
    } ?>
</div>