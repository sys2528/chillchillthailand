<?php get_header(); ?>

<?php
	$Category_name = 'blog_category';
	$act_category= get_the_terms(get_the_ID(), $Category_name);
	foreach($act_category as $act_category_value){
		$act_parent_name = $act_category_value->name;
		$act_parent_slug = $act_category_value->slug;
		$act_parent_term_id = $act_category_value->term_id;
	}
?>

	<!-- BreadcrumbsCCT -->
    <div class="BreadcrumbsCCT clr">
		<nav aria-label="breadcrumbs" class="rank-math-breadcrumb"><p><a href="<?php echo get_bloginfo("url"); ?>">หน้าแรก</a><span class="separator"> - </span><a href="<?php echo get_bloginfo("url"); ?>/blog">บทความและข่าวสาร</a><span class="separator"> - </span><span class="last"><?php the_title(); ?></span></p></nav>
	</div>
	<!-- End BreadcrumbsCCT -->

	<!-- HeaderPage -->
    <div class="HeaderPage clr">
        <div class="HeaderPageBox">
            <h1><?php the_title(); ?></h1>
            <p class="DateCategory"><i class="fa-regular fa-calendar-days"></i> อัพเดทเมื่อ : <?php the_modified_date('d.m.Y'); ?> | หมวด : <?php echo $act_parent_name; ?></p>
			<p><?php if(function_exists('seed_social')) { seed_social(); } ?></p>
        </div>
    </div>
    <!-- HeaderPage -->

	<?php 
		if (have_posts()) {
			while (have_posts()) { the_post();					
				$image_id = get_post_thumbnail_id();
				$image_url = wp_get_attachment_image_src($image_id, 'full', true);
				if(empty($image_id)){$image_url[0] = get_bloginfo('template_directory').'/assets/images/no-photo.jpg';}
	?>

	<!-- BlogDetail -->
	<div class="BlogDetail clr">
		<!-- BlogDetailBox -->
		<div class="BlogDetailBox clr">

			<!-- LeftBlog -->
			<div class="LeftBlog">

				<!-- FeatureImageBlog -->
				<div class="FeatureImageBlog clr"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></div>
				<!-- End FeatureImageBlog -->

				<div class="DetailBlog">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>

			</div>
			<!-- End LeftBlog -->

			<!-- RightBlog -->
			<div class="RightBlog">
				<!-- RightInfo -->
				<div class="RightInfo">
					<div class="Title">โดยนักเขียน <i class="fa-solid fa-pen-nib"></i></div>
					<div class="Detail">
					<?php 
						$author_id = get_the_author_meta( 'ID' );
						$face = get_field('blogger_photo', 'user_'.$author_id);
						$author_badge = get_field('blogger_photo', 'user_'. $author_id );
						$size = 'thumbnail';
						$thumb = $author_badge['sizes'][ $size ];
						$width = $author_badge['sizes'][ $size . '-width' ];
						$height = $author_badge['sizes'][ $size . '-height' ];
					?>
					<p class="AuthorBadge"><img src="<?php echo $author_badge['url']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></p>
					<p class="Center">ชื่อ : <?php the_author_meta('nickname'); ?></p>
					<p>Bio : <?php the_author_meta('description'); ?></p>
					<?php
						$wp_queryCount = null;
						$wp_queryCount = new WP_Query( array('post_type' => array('post','blog'), 'author'=> $author_id));
						$countPost = $wp_queryCount->found_posts;
					?>
					<p>เขียนมาแล้วทั้งหมด : <a href="<?php bloginfo('url'); ?>/blogger/<?php the_author_meta('user_nicename'); ?>"><?php echo number_format($countPost,0); ?></a> โพสต์</p>
					</div>

				</div>

				<!-- RightInfo -->
				<div class="RightInfo">

					<div class="TitleIn">ข้อมูลที่น่าสนใจ <i class="fa-solid fa-circle-info"></i></div>
					<div class="Detail">
						<ul>
							<li>ช่วงไหนที่มีฟูลมูนปาร์ตี้ คือช่วงพีคของเกาะพะงัน</li>
							<li>นักท่องเที่ยวจากทั่วทุกสารทิศจะเดินทางมาร่วมสนุกกับปาร์ตี้ริมทะเลสุดมันส์นี้กันอย่างเนืองแน่น</li>
						</ul>
					</div>
					<div class="TitleIn">บทความและข่าวสารแนะนำ <i class="fa-regular fa-thumbs-up"></i></div>
					<div class="DetailIn">
						<?php
							$wp_query_news = null;
							$wp_query_news = new WP_Query( array('post_type' => 'blog', 'showposts' => 3,'orderby' => 'date','order'=>'DESC','post_status'=>'publish','post__not_in' => array( $post->ID )));
							if ($wp_query_news->have_posts()) {
						?>
						<ul>
							<?php
								while ( $wp_query_news->have_posts() ) : $wp_query_news->the_post();
								$image_ID_news = get_post_thumbnail_id();
								$image_URL_news = wp_get_attachment_image_src($image_ID_news, 'medium', true);
								if(empty($image_ID_news)){$image_URL_news[0] = get_bloginfo('template_directory').'/assets/images/no-photo.jpg';}	
							?>
							<li><p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image_URL_news[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_URL_news[1]; ?>" height="<?php echo $image_URL_news[2]; ?>"></a></p><p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p></li>
							<?php endwhile;  ?>
						</ul>
						<?php wp_reset_postdata(); ?>
						<?php }else{ ?>
							<p class="EmptyData">ยังไม่มีข้อมูลสื่อประชาสัมพันธ์</p>
						<?php } ?>
					</div>
				</div>

			</div>
			<!-- End RightBlog -->

		</div>
		<!-- End BlogDetailBox -->

	</div>
	<!-- End BlogDetail -->

		<?php } ?>
	<?php } ?>

<?php get_footer(); ?>