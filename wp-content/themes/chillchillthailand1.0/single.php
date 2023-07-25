<?php get_header(); ?>

<?php
	$archive_name = 'category';

	$PostIDCheck =get_the_ID();
	$posttags=get_the_tags($PostIDCheck);
	if ($posttags) {
	  	foreach($posttags as $tag) {
	      $TagsNameCheck[] = $tag->name;
	  	}
	}
?>

	<!-- BreadcrumbsCCT -->
    <div class="BreadcrumbsCCT">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	</div>
	<!-- End BreadcrumbsCCT -->

	<nav aria-label="breadcrumbs" class="rank-math-breadcrumb"><p><a href="<?php echo get_bloginfo("url"); ?>">หน้าแรก</a><span class="separator"> - </span><a href="<?php echo get_bloginfo("url"); ?>/xxxxx">cat</a><span class="separator"> - </span><a href="<?php echo get_bloginfo("url"); ?>/xxxxx">sub-cat</a><span class="separator"> - </span><span class="last"><?php the_title(); ?></span></p></nav>
	
	<h1>Single post : <?php the_title(); ?></h1>

<?php get_footer(); ?>