<?php get_header(); ?>

	<!-- BreadcrumbsCCT -->
	<div class="BreadcrumbsCCT">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	</div>
	<!-- End BreadcrumbsCCT -->
	
	<div class="PageNotFound clr">
		<p class="Page404Picture"><img src="<?php bloginfo('template_directory'); ?>/assets/images/404.png"></p>
		<p class="Page404Title">OPPS! 404 Page not found</p>
		<p class="Page404Title">ไม่พบเว็บไซต์หน้านี้</p>
	</div>

<?php get_footer(); ?>