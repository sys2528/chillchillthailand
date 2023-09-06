<?php get_header(); ?>

    <!-- BreadcrumbsCCT -->
    <div class="BreadcrumbsCCT">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	</div>
	<!-- End BreadcrumbsCCT -->

	<!-- HeaderPage -->
	<div class="HeaderPage clr">
        <div class="HeaderPageBox">
            <h1>ติดต่อเรา</h1>
        </div>
    </div>
    <!-- HeaderPage -->

	<!-- ContactUsBox -->
    <div class="ContactUsBox">
	    <?php the_content('Read the rest of this entry &raquo;'); ?>
    </div>
    <!-- End ContactUsBox -->

<?php get_footer(); ?>