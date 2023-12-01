<?php 
if(class_exists('Redux')){
    $advice_phone =  paradox_settings('advice_phone');
    $advice_form =  paradox_settings('advice_form');
}
?>
<div class="counseling">
    <div class="col-md-4">
        <span class="consl-title">درخواست مشاوره</span>
        <p>برای کسب اطلاعات بیشتر درباره این دوره درخواست مشاوره خود را ارسال کنید و یا با ما در تماس باشید.</p>
        <a href="" class="advice-modal-opener">درخواست مشاوره</a>
    </div>
    <div class="col-md-60"></div>
    <div class="modal2">
        <div class="advice-form-overlay"></div>
        <div class="advice-modal-content">
            <span class="close"></span>
            <div class="row">
                <div class="col-md-6">
                <div class="tel"></div>
                <div class="tel-number">
                    <a href="tel:02188003433"><?php echo ($advice_phone)?$advice_phone:'03154743046'; ?></a>
                </div>
                <h3>نیاز به مشاوره دارید؟</h3>
                <p>در صورتی که نیاز به مشاوره دارید می توانید فرم را تکمیل نمایید و یا با ما در تماس باشید</p>
                </div>
                <div class="col-md-6 or_middle">
                    <h3>درخواست مشاوره رایگان</h3>
                    <p class="short_title"><?php echo ($advice_form)?do_shortcode($advice_form):'محل قرار دادن شرتکد فرم درخواست مشاوره شما'; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
