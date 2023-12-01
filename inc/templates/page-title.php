<?php
if(class_exists('Redux')){
    $page_title_text_color = paradox_settings('headre_text_color');
    $page_title_text = (paradox_settings('custom_page_title_text'))?paradox_settings('custom_page_title_text'):'وبلاگ';
}
 $perfix = 'paradox_';
$bg_img = get_post_meta(get_the_ID(  ), $perfix.'header_bg_img',true);
$bg_color = get_post_meta(get_the_ID(  ), $perfix.'header_bg_color',true);
$disable_page_title = get_post_meta(get_the_ID(  ), $perfix.'disable_page_title',true);
$disable_bredacrumb_page = get_post_meta(get_the_ID(  ), $perfix.'disable_bredacrumb_page',true);
if(!$disable_page_title || !$disable_bredacrumb_page){
$style = '';
if($bg_color){
    $style .= 'background-color:'.$bg_color.';';
}
if($bg_img){
    $style .= 'background-image:url('.$bg_img.');';
}
?>
<section class="page_title" style ="<?php echo esc_attr( $style ); ?>">
    <div class="container">
            <?php 
            if(!$disable_page_title){
            if(is_singular('post')){
            echo esc_html($page_title_text);
            }else{ ?>
                <h1 class="blog_title"><?php esc_html( wp_title('') ); ?></h1>
   <?php         }
        }
            ?>
        <?php
        if(!$disable_bredacrumb_page){
            esc_html( denshyar_breadcrumb() ); 
        }
         ?>
    </div>
</section>
<style>
    .breadcrumb span{
        color:<?php echo $page_title_text_color; ?> !important;
    }
</style>
<?php }//end if both is disable ?>