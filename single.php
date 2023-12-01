<?php get_header(); 
$perfix = 'paradox_';
$video_src = get_post_meta(get_the_id(),$perfix.'video_upload',true);
$video_cover = get_post_meta(get_the_id(),$perfix.'video_cover_upload',true);
$audio_src = get_post_meta(get_the_id(),$perfix.'sound_upload',true);
$disable_sidebar = get_post_meta(get_the_id(),$perfix.'disable_sidebar',true);

if(class_exists('Redux')){
    $page_title_text = paradox_settings('single_post_sidebar_position');
    $enable_author = paradox_settings('article_author');
    $enable_related_post = paradox_settings('blog_related');
    $enable_post_thumbnail = paradox_settings('blog_featured_img');
    $enable_social_share = paradox_settings('blog_share_story');
}
?>
    <section class="blog_inner">
        <div class="container">
            <div class="blog_wrapper <?php echo esc_attr($page_title_text ); ?>">
                <article class="blog_content single_post <?php echo ($disable_sidebar || $page_title_text=='none') ? 'full-width':''; ?>">
                    <?php while(have_posts(  )): the_post(  ); ?>
                    <div class="inner_content">
                        <?php get_template_part('/inc/templates/blog/post-header'); 
                        if($enable_post_thumbnail==true){
                        ?>
                        <div class="post_thumbnail_image">
                            <?php 
                            if(has_post_format( 'video' )){
                                $attr = array(
                                    'src' =>$video_src,
                                    'poster' =>$video_cover 
                                );
                               echo wp_video_shortcode($attr);
                            }elseif(has_post_format( 'audio' )){
                                $attr = array(
                                    'src' =>$audio_src,
                                );
                               echo wp_audio_shortcode($attr);
                            }else{
                                if(has_post_thumbnail()){
                                    the_post_thumbnail('full');
                                }    
                            }
                             ?>
                        </div>
                        <?php } ?>
                        <div class="entry_content_single">
                            <?php the_content(); ?>
                        </div>
                        <?php
                        if($enable_social_share == true){
                         get_template_part('/inc/templates/blog/social-share'); 
                        }
                         ?>
                    </div>
                    <?php
                    $tags_list = get_the_tag_list();
                     if($tags_list && !is_wp_error( $tags_list )) {?>
                    <div class="inner_content post-tags">
                    <span><i class="fal fa-tags"></i>برچسب ها :</span>
                    <?php echo wp_kses_post($tags_list); ?>
                    </div>
                    <?php } 
                    get_template_part('/inc/templates/blog/download-box'); 
                    if($enable_author==true){
                        get_template_part('/inc/templates/blog/author'); 
                    }
                    ?>
                    <div class="socila_image">
                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/assets/img/telg.png" alt=""></a>
                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/assets/img/ins.png" alt=""></a>
                    </div>
                    <?php if($enable_related_post==true) get_template_part('/inc/templates/blog/post-related');  ?>
                    <?php get_template_part('/inc/templates/blog/related-course');  ?>
				<?php if ( comments_open() || get_comments_number() ) : ?>
                    <!-- start #comments -->
					<?php comments_template('', true); ?>
                    <!-- end #comments -->
				<?php endif; ?>
                
                    <?php endwhile; ?>
                </article>
                <?php 
                if($page_title_text!='none' ){
                if(!$disable_sidebar){
                    get_sidebar(); 
                }
            }
                ?>
            </div>
        </div>
    </section>
<?php get_footer(); ?>