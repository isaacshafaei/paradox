<div class="inner_content">
    <div class="author_box">
    <?php echo get_avatar( get_the_author_meta( 'user_email' ), 110 ); ?>       
     <div class="content_author">
            <h5>درباره <?php the_author(); ?></h5>
            <p class="bio"><?php the_author_meta( 'description' ); ?></p>
            <a class="more_author_post" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">نوشته های بیشتر از <?php the_author(); ?></a>    
        </div>
    </div>
</div>