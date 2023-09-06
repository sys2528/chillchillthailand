<?php get_header(); ?>

	<!-- BreadcrumbsCCT -->
	<div class="BreadcrumbsCCT">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	</div>
	<!-- End BreadcrumbsCCT -->

	<!-- HeaderPage -->
	<div class="HeaderPage clr">
        <div class="HeaderPageBox">
            <h1>ค้นหาสถานที่เที่ยวและข่าวสาร</h1>
        </div>
    </div>
    <!-- HeaderPage -->

	<?php
		if (isset($_GET['s'])) { $s=$_GET['s']; }else{ $s=''; }
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$wp_query = null;
		$wp_query = new WP_Query( array('post_type' => array('post','blog'), 'posts_per_page' => get_option('posts_per_page'),'orderby' => 'date','order'=>'DESC','post_status'=>'publish','s' => $s,'paged' => $paged,));

		if ($wp_query->have_posts()) {
	?>
	<div class="PageSearch">
		<div class="PageSearchBox">
			<ul>
				<?php
					while ( $wp_query->have_posts() ) : $wp_query->the_post();

						$image_id = get_post_thumbnail_id(get_the_ID());
						$image_url = wp_get_attachment_image_src($image_id, 'large', true);
						if(empty($image_id)){ $image_url[0] = get_bloginfo('template_directory').'/assets/images/no-photo.jpg'; }

						if (has_excerpt()) {
							$ExerptDisplay = wp_strip_all_tags(get_the_excerpt());
						}else{
							$ExerptDisplay = '';
						}

						$category_parent_display = get_the_category(); 
						$parent_display = get_category($category_parent_display[0]->category_parent);
						$parent_display->name;

						if ( get_post_type( get_the_ID() ) == 'post' ) {
							$postType = $parent_display->name;
						}else{
							$postType = 'บทความและข่าวสาร';
						}

				?>
				<li>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">
						<div class="Picture"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></div> 
						<div class="Descriptions">
							<p class="Title"><?php the_title(); ?></p>
							<p class="Captions"><?php echo $ExerptDisplay; ?></p>
							<p class="Date"><?php echo $postType; ?> / โพสต์เมื่อ : <?php $PostDate = get_the_date( 'd.m.Y' ); echo $PostDate; ?></p>
						</div>
					</a>
				</li>
				<?php endwhile;  ?>
			</ul>

		</div>
	</div>

	<div class="clr">
		<?php pagination(); ?>
		<?php wp_reset_postdata(); ?>
	</div>

	<?php }else{ ?>
		<p class="EmptyData Padding40">ไม่มีข้อมูลที่ท่านค้นหา "<?php if($_GET['s']!=""){ echo $_GET['s']; }else{ echo '-'; } ?>"<br>หรือ<br><br>ลองดูสถานที่แนะนำจากเราด้านล่างนี้ได้เลย!</p>
		<?php
			$wp_query = null;
			$wp_query = new WP_Query( array('post_type'=>'post','showposts'=>'6','orderby'=>'rand','post_status'=>'publish','meta_query'=>array( array( 'key' => 'post_recommend', 'value' => 'recommend', 'compare' => 'LIKE' ) )));
			if ($wp_query->have_posts()) {
		?>
		<!-- SinglePostReccommend -->
		<div class="SinglePostReccommend">
			<div class="SinglePostReccommendBox">
				<div class="Header">
					<h2><i class="fa-regular fa-thumbs-up"></i> สถานที่แนะนำ [Recommend]</h2>
				</div>
				<ul>
					<?php
						while ( $wp_query->have_posts() ) : $wp_query->the_post();
							$image_id = get_post_thumbnail_id(get_the_ID());
							$image_url = wp_get_attachment_image_src($image_id, 'large', true);
							if(empty($image_id)){$image_url[0] = get_bloginfo('template_directory').'/assets/images/no-photo.jpg';}	

							$first_category_recommend = wp_get_post_terms( get_the_ID(), 'category' )[0]->name;

							if (has_excerpt()) {
								$ExerptDisplay = wp_strip_all_tags(get_the_excerpt());
							}else{
								$ExerptDisplay = '';
							}
							$count = strlen($ExerptDisplay);

							$posts_opening_hours = get_field('posts_opening_hours',get_the_ID());
					?>
					<li>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">
						<p class="Picture"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></p>
						<p class="Title"><?php the_title(); ?></p>
						<?php if($ExerptDisplay!=""){ ?><p class="Captions"><?php if($count>365){ echo mb_substr(strip_tags($ExerptDisplay),0, 100,).' ..'; }else{ echo $ExerptDisplay; } ?><?php //echo $ExerptDisplay; ?></p><?php } ?>
						<?php if($parent_display->slug=='eat' && $posts_opening_hours!=""){ ?><p class="DateOpen">เวลาเปิด-ปิด : <?php echo $posts_opening_hours; ?></p><?php } ?>
						<p class="DateTime"><!--<span><i class="fa-regular fa-clock"></i> <?php //the_modified_date('d.m.Y'); ?></span> --><span class="TypeShow"><?php echo $first_category_recommend; ?> <i class="fa-solid fa-minus"></i> <?php $posttags = get_the_tags(); if ($posttags) { foreach($posttags as $tag) { echo $tag->name.' '; } } ?></span></p>
						</a>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
		<!-- End SinglePostReccommend -->
		<?php } ?>
		<?php wp_reset_postdata(); ?>
	<?php } ?>

<?php get_footer(); ?>