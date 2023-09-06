<?php get_header(); ?>
<?php
	$category_parent_display = get_the_category(); 
	$parent_display = get_category($category_parent_display[0]->category_parent);
	// echo $parent_display->name;

	$PostID = get_the_ID();

	if (have_posts()){
		while (have_posts()) { the_post();					
			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src($image_id, 'full', true);
			$image_url_bg = wp_get_attachment_image_src($image_id, 'large', true);

			$first_category = get_the_category( get_the_ID(), 'category' )[0]->name;

			$booking_affiliate_url = get_field('booking_affiliate_url',get_the_ID());   
			$agoda_affiliate_url = get_field('agoda_affiliate_url',get_the_ID());
			
			$posts_address = get_field('posts_address',get_the_ID());
			$posts_mobile_telephone = get_field('posts_mobile_telephone',get_the_ID());
			$posts_email = get_field('posts_email',get_the_ID());
			$posts_map = get_field('posts_map',get_the_ID());
			$posts_website = get_field('posts_website',get_the_ID());
			$posts_opening_hours = get_field('posts_opening_hours',get_the_ID());

			$hotels_facilities = get_field('hotels_facilities',get_the_ID());
?>

	<!-- SinglePost -->
	<div class="SinglePost">

		<!-- SingleHeader -->
		<div class="SingleHeader">
			<div class="FeatureImage"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></div>
			<div class="SingleHeaderInner">
				<!-- BreadcrumbsCCT -->
				<div class="BreadcrumbsCCT">
					<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
				</div>
				<!-- End BreadcrumbsCCT -->
				<h1><?php the_title(); ?></h1>
				<?php if (has_excerpt() && !post_password_required()) { echo '<p class="Captions">'.wp_strip_all_tags(get_the_excerpt()).'</p>'; } ?>
				<p class="DateTime"><i class="fa-regular fa-clock"></i> <?php the_modified_date('d.m.Y'); ?> <i class="fa-solid fa-minus"></i> <?php echo $first_category; ?> <i class="fa-solid fa-minus"></i> <?php $posttags = get_the_tags(); if ($posttags) { foreach($posttags as $tag) { echo $tag->name.' '; } } ?></p>
				<?php 
					$author_id = get_the_author_meta( 'ID' );
					$face = get_field('blogger_photo', 'user_'.$author_id);
					$author_badge = get_field('blogger_photo', 'user_'. $author_id );
					$size = 'thumbnail';
				?>
				<p class="AuthorBadge"><img src="<?php echo $author_badge['url']; ?>" width="<?php echo $author_badge['sizes']['large-width']; ?>" height="<?php echo $author_badge['sizes']['large-height']; ?>" /></p>
				<p class="AuthorBadgeName">โดย <!--<a href="<?php bloginfo('url'); ?>/blogger/<?php the_author_meta('user_nicename'); ?>">--><?php the_author_meta('nickname'); ?><!--</a>--></p>

			</div>
		</div>
		<!-- End SingleHeader -->

		<!-- ####### if not Password ####### -->
		<?php if ( !post_password_required() ) { ?>

		<?php if($parent_display->slug=='hotel'){ ?>
		<?php if($booking_affiliate_url!="" || $agoda_affiliate_url!=""){ ?>
		<!-- AffPartnersSingle -->
		<div class="AffPartnersSingle">
			<div class="AffPartnersSingleBox">
				<p>จองที่พักนี้</p>
				<?php if($booking_affiliate_url!=""){ ?><a href="<?php echo $booking_affiliate_url; ?>" target="_blank" title="จอง <?php the_title(); ?> ผ่าน Booking.com" class="Booking">จองผ่าน <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon/booking-logo.svg" alt="จอง <?php the_title(); ?> ผ่าน Booking.com" width="80" height="14"></a><?php } ?>
				<?php if($agoda_affiliate_url!=""){ ?><a href="<?php echo $agoda_affiliate_url; ?>" target="_blank" title="จอง <?php the_title(); ?> ผ่าน Agoda.com">จองผ่าน <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon/agoda-logo.svg" alt="จอง <?php the_title(); ?> ผ่าน Agoda.com" width="43" height="22"></a><?php } ?>
			</div>
		</div>
		<!-- AffPartnersSingle -->
		<?php } ?>
		<?php } ?>

		<!-- SinglePostContent -->
		<div class="SinglePostContent"><?php echo $tax_parent_name; ?>
			<?php the_content('Read the rest of this entry &raquo;'); ?>
		</div>
		<!-- End SinglePostContent -->

		<?php if($parent_display->slug=='hotel'){ ?>
		<!-- ########### if Hotel ########### -->
		<?php if($booking_affiliate_url!="" || $agoda_affiliate_url!=""){ ?>
		<!-- AffPartnersSingle -->
		<div class="AffPartnersSingle">
			<div class="AffPartnersSingleBox">
				<p>จองที่พักนี้</p>
				<?php if($booking_affiliate_url!=""){ ?><a href="<?php echo $booking_affiliate_url; ?>" target="_blank" title="จอง <?php the_title(); ?> ผ่าน Booking.com" class="Booking">จองผ่าน <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon/booking-logo.svg" alt="จอง <?php the_title(); ?> ผ่าน Booking.com" width="80" height="14"></a><?php } ?>
				<?php if($agoda_affiliate_url!=""){ ?><a href="<?php echo $agoda_affiliate_url; ?>" target="_blank" title="จอง <?php the_title(); ?> ผ่าน Agoda.com">จองผ่าน <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon/agoda-logo.svg" alt="จอง <?php the_title(); ?> ผ่าน Agoda.com" width="43" height="22"></a><?php } ?>
			</div>
		</div>
		<!-- AffPartnersSingle -->
		<?php } ?>
		<?php if($hotels_facilities){ ?>
		<!-- Facilities -->
		<div class="Facilities">
			<div class="FacilitiesBox">
				<h2>สิ่งอำนวยความสะดวก</h2>
				<?php echo GetFacilitiesFull(get_the_ID()); ?>
			</div>
		</div>
		<!-- End FacilitiesBox -->
		<?php } ?>
		<!-- ########### if Hotel ########### -->
		<?php } ?>

		<?php if($posts_address!="" || $posts_mobile_telephone!="" || $posts_email!="" || $posts_map!="" || $posts_website!="" || $posts_opening_hours!=""){ ?>
		<!-- ContactinfoSingle -->
		<div class="ContactinfoSingle">
			<div class="ContactinfoSingleBox">
				<h2>ข้อมูลการติดต่อ</h2>
				<div class="ContactinfoSingleInner">
					<div class="Left">
						<ul>
							<?php if($posts_address!=""){ ?><li><p>ที่อยู่</p><p><?php echo $posts_address; ?></p></li><?php } ?>
							<?php if($posts_mobile_telephone!=""){ ?><li><p>เบอร์โทรศัพท์/มือถือ</p><p><?php echo $posts_mobile_telephone; ?></p></li><?php } ?>
							<?php if($posts_email!=""){ ?><li><p>อีเมล</p><p><?php echo $posts_email; ?></p></li><?php } ?>
							<?php if($posts_opening_hours!=""){ ?><li><p>เวลาเปิด-ปิด</p><p><?php echo $posts_opening_hours; ?></p></li><?php } ?>
							<?php if($posts_website!=""){ ?><li><p>เว็บไซต์</p><p><?php echo $posts_website; ?></p></li><?php } ?>
						</ul>
					</div>
					<?php if($posts_map!=""){ ?>
					<div class="Map">
						<div class="GoogleMapBox"><?php echo $posts_map; ?></div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<!-- End ContactinfoSingle -->
		<?php } ?>

		<?php }else{ echo get_the_password_form(); } ?>
		<!-- ####### end if not Password ####### -->

		<!--ShareANDBooking -->
		<div class="ShareANDBooking">
			<?php
			if($parent_display->slug=='hotel'){
				if($booking_affiliate_url!="" || $agoda_affiliate_url!=""){
			?>
			<div class="AffPartnersSingleBox">
				<p>จองที่พักนี้</p>
				<?php if($booking_affiliate_url!=""){ ?><a href="<?php echo $booking_affiliate_url; ?>" target="_blank" title="จอง <?php the_title(); ?> ผ่าน Booking.com" class="Booking">จองผ่าน <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon/booking-logo.svg" alt="จอง <?php the_title(); ?> ผ่าน Booking.com" width="80" height="14"></a><?php } ?>
				<?php if($agoda_affiliate_url!=""){ ?><a href="<?php echo $agoda_affiliate_url; ?>" target="_blank" title="จอง <?php the_title(); ?> ผ่าน Agoda.com">จองผ่าน <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon/agoda-logo.svg" alt="จอง <?php the_title(); ?> ผ่าน Agoda.com" width="43" height="22"></a><?php } ?>
			</div>
			<?php }} ?>
			<div class="SocialBox clr">
				<p>แชร์เก็บไว้ก่อน (เดี๋ยวไปทีหลัง)</p>
				<?php if(function_exists('seed_social')){ seed_social(); } ?>
			</div>
		</div>
		<!--End ShareANDBooking -->
<?php
		}
	}
	wp_reset_postdata();
?>
	</div>
	<!-- End SinglePost -->


	<?php
		$wp_query = null;
		$wp_query = new WP_Query( array('post_type'=>'post','showposts'=>'3','orderby'=>'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>$parent_display->slug/*,'meta_query'=>array( array( 'key' => 'post_recommend', 'value' => 'recommend', 'compare' => 'NOT LIKE' ) )*/,'post__not_in' => array( $PostID )));
		if ($wp_query->have_posts()) {
	?>
	<!-- RelatedNewPost -->
	<div class="RelatedNewPost">
		<h3><i class="fa-solid fa-arrows-rotate"></i> <?php echo $parent_display->name; ?>อัพเดทล่าสุด</h3>
		<ul>
			<?php
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$image_id = get_post_thumbnail_id(get_the_ID());
					$image_url = wp_get_attachment_image_src($image_id, 'medium', true);
					if(empty($image_id)){$image_url[0] = get_bloginfo('template_directory').'/assets/images/no-photo.jpg';}	

					$first_category = wp_get_post_terms( get_the_ID(), 'category' )[0]->name;

					if (has_excerpt()) {
						$ExerptDisplay = wp_strip_all_tags(get_the_excerpt());
					}else{
						$ExerptDisplay = '';
					}
					$posts_opening_hours = get_field('posts_opening_hours',get_the_ID());
			?>
			<li>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">
				<div class="Picture"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></div>
				<div class="Descriptions">
					<p class="Title"><?php the_title(); ?></p>
					<?php if($ExerptDisplay!=""){ ?><p class="Captions"><?php echo $ExerptDisplay; ?></p><?php } ?>
					<?php if($parent_display->slug=='eat' && $posts_opening_hours!=""){ ?><p class="DateOpen">เวลาเปิด-ปิด : <?php echo $posts_opening_hours; ?></p><?php } ?>
					<p class="DateTime"><span><?php echo $first_category; ?> <i class="fa-solid fa-minus"></i> <?php $posttags = get_the_tags(); if ($posttags) { foreach($posttags as $tag) { echo $tag->name.' '; } } ?></span> <span class="Newline">  <i class="fa-solid fa-minus"></i> <i class="fa-regular fa-clock"></i> <?php the_modified_date('d.m.Y'); ?></span></p>
				</div>
				</a>
			</li>
			<?php endwhile; ?>
		</ul>
	</div>
	<!-- RelatedNewPost -->
	<?php } ?>
	<?php wp_reset_postdata(); ?>


	<?php
		$wp_query = null;
		$wp_query = new WP_Query( array('post_type'=>'post','showposts'=>'6','orderby'=>'rand','post_status'=>'publish','taxonomy'=>'category','term'=>$parent_display->slug,'meta_query'=>array( array( 'key' => 'post_recommend', 'value' => 'recommend', 'compare' => 'LIKE' ) ),'post__not_in' => array( $PostID )));
		if ($wp_query->have_posts()) {
	?>
	<!-- SinglePostReccommend -->
	<div class="SinglePostReccommend">
		<div class="SinglePostReccommendBox">
			<div class="Header">
				<h2><i class="fa-regular fa-thumbs-up"></i> <?php echo $parent_display->name; ?>แนะนำ [Recommend]</h2>
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

<?php get_footer(); ?>