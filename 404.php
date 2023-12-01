<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

	<div class="container">
    <section class="page_404">
		<div class="four_zero_four_bg">
			<h1 class="text-center ">404</h1>
		</div>
		
		<div class="contant_box_404">
            <h3 class="h2">
            مثل اینکه گُم شدی!
            </h3>
            <p>صفحه ای که به دنبال اون هستید فعلاً در سایت قابل دسترس نیست.</p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="link_404">بریم صفحه اصلی</a>
	    </div>
    </section>
	</div>
<?php get_footer();

