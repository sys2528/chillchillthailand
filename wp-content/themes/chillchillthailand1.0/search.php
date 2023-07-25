<?php get_header(); ?>

	<!-- BreadcrumbsCCT -->
	<div class="BreadcrumbsCCT">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	</div>
	<!-- End BreadcrumbsCCT -->


		<div class="Topic">
			<h1>ผลการค้นหา : <?php echo $s; ?></h1>
		</div>

		<?php
			if (isset($_GET['s'])) { $s=$_GET['s']; }else{ $s=''; }
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$wp_query = null;
			$wp_query = new WP_Query( array('post_type' => array('post'), 'posts_per_page' => get_option('posts_per_page'),'orderby' => 'date','order'=>'DESC','post_status'=>'publish','s' => $s,'paged' => $paged,));

			if ($wp_query->have_posts()) {
		?>
		<div class="Page-Search">
			<ul>
				<?php
					while ( $wp_query->have_posts() ) : $wp_query->the_post();

						$image_ID = get_post_thumbnail_id();
						$image_URL = wp_get_attachment_image_src($image_ID, 'medium', true);
						if(empty($image_ID)){ $image_URL[0] = get_bloginfo('template_directory').'/img/comon/no-img.png'; }

						$Category_name = 'news_category';
						$act_category= get_the_terms(get_the_ID(), $Category_name);
						foreach($act_category as $act_category_value){
							$act_parent_name = $act_category_value->name;
							$act_parent_slug = $act_category_value->slug;
						}

						$ExerptDisplay = wp_strip_all_tags(get_the_excerpt());
				?>
				<li> 
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>
				<?php endwhile;  ?>
			</ul>

		</div>

		<div class="clr">
			<?php pagination(); ?>
			<?php wp_reset_postdata(); ?>
		</div>

		<?php }else{ ?>
			<p class="RedCenter">ไม่มีข้อมูลที่ต้องการค้นหา</p>
		<?php } ?>

<?php get_footer(); ?>