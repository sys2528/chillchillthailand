<?php get_header(); ?>

    <!-- BreadcrumbsCCT -->
    <div class="BreadcrumbsCCT">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	</div>
	<!-- End BreadcrumbsCCT -->

	<!-- HeaderPage -->
	<div class="HeaderPage clr">
        <div class="HeaderPageBox">
            <h1>Contact ติดต่อเรา</h1>
            <p class="Descriptions">xxxx xxx xx</p>
        </div>
    </div>
    <!-- HeaderPage -->

	<?php //echo do_shortcode('[contact-form-7 id="5" title="Contact to CCT"]'); ?>
	<?php the_content('Read the rest of this entry &raquo;'); ?>

<?php get_footer(); ?>