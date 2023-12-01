<?php																			
if(class_exists('Redux')){
    $enable_post_meta = paradox_settings('blog_meta_data');
}
 ?>
<header class="blog_header">
    <h1 class="post_title"><?php the_title(); ?></h1>
    <?php if($enable_post_meta ==true){ ?>
    <div class="data_meta">
        <span class="publish_date">
            <i class="fal fa-clock"></i>
            <?php echo get_the_date(); ?>
        </span>
        <span class="author">
            <i class="fal fa-user-alt"></i>
                ارسال شده توسط<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"> <?php echo get_the_author(); ?></a></span>
        <span class="categoey">
            <i class="fal fa-folders"></i>
            <?php echo wp_kses_post( get_the_category_list(' ,') ); ?>
            </span>
        <span class="visitors">
            <i class="fal fa-eye"></i> <?php denshyar_post_view_count(); ?></span>
    </div>
    <?php } ?>
</header>