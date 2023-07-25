<?php get_header(); ?>

    <!-- BreadcrumbsCCT -->
    <div class="BreadcrumbsCCT">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	</div>
	<!-- End BreadcrumbsCCT -->

    <?php echo do_shortcode('[ultimatemember_account]'); ?>

<?php get_footer(); ?>