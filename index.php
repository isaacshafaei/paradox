<?php get_header(); 
$categories = get_the_category();
$archive_post_sidebar_position = '';
$choose_header = '';
if(class_exists('Redux')){
    $choose_header = paradox_settings('header_elementor');
    $archive_post_sidebar_position = paradox_settings('archive_post_sidebar_position');
}
?>
    <section class="blog_inner">
        <div class="container">
            <?php if($choose_header != 'no-header'){ ?>
            <h1 class="archive_title"><?php esc_html( wp_title('') ); ?></h1>
            <?php } ?>
            <div class="blog_wrapper <?php echo ($archive_post_sidebar_position=='none') ? 'full-width':$archive_post_sidebar_position; ?>">
                <div class="archive_loop">
                <?php while(have_posts( )): the_post(  ); ?>
                        <article class="inner_archive_item">
                            <div class="pos_thumbnail">
                                <?php the_post_thumbnail('paradox-370x270'); ?>
                            </div>
                <div class="post-content">
                                <a href="<?php the_permalink(); ?>"><h4 class="archive_item_title"><?php echo the_title(); ?></h4></a>
                                <div class="the-excerpt">
                                    <?php 
                                        if( has_excerpt() ){
                                            the_excerpt();
                                        } else {
                                            echo wp_trim_words( get_the_content(), 25, '...' );
                                        }
                                    ?>
                                </div>
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
                </div>
                        </article>
                    <?php endwhile;
                   echo paginate_links( array(
                    'type'      => 'list',
                    'prev_text' => '<i class="fa fa-angle-left"></i>',
                    'next_text' => '<i class="fa fa-angle-right"></i>',
                ) ); 
                     ?>
                </div>
                <?php 
                if($archive_post_sidebar_position != 'none'){
                    get_sidebar(); 
                }
                ?>
            </div>
        </div>
    </section>
<?php get_footer(); ?>