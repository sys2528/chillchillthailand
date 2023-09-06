<?php get_header(); ?>
	<?php
		if(is_category()){
			$archive_name = 'category';
		}

		$taxonomy_info = $wp_query->get_queried_object();
		$taxonomy_name = $taxonomy_info->name;
		$taxonomy_slug = $taxonomy_info->slug;
		$taxonomy_id = get_queried_object()->term_taxonomy_id;
		$tax_parent_id = get_queried_object()->parent;

		if($tax_parent_id !=0){
			$isRoot = false;
			$tax_parent = get_term($tax_parent_id, $archive_name);
			$tax_parent_slug = $tax_parent->slug;
		}else{
			$isRoot = true;
			$tax_parent_slug = $taxonomy_slug;
			$tax_parent_id = $taxonomy_id;
		}

		$captionsCategory = category_description($taxonomy_id);

		/* DisplayCategory */
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			$cateConnect = esc_html( $categories[0]->slug );
			$cateConnectName = esc_html( $categories[0]->name );  
		}

		$iconTP = get_field('icon', 'category_'.$taxonomy_id);
	?>

	<!-- BreadcrumbsCCT -->
	<div class="BreadcrumbsCCT">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	</div>
	<!-- End BreadcrumbsCCT -->

	<!-- All header -->
	<div class="CategoryHeader">
		<div class="CategoryHeaderInner">
			<h1><?php echo $iconTP; ?> <?php echo $taxonomy_name; ?></h1>
			<?php if($captionsCategory!=""){ ?><div class="Captions"><?php echo category_description($taxonomy_id); ?></div><?php } ?>
		</div>
	</div>
	<!-- End All header -->

	<!-- TravelType2 -->
	<div class="TravelType2">
		<!-- TravelCategoryList -->
		<div class="TravelCategoryList">
			<div class="OpenCategory"><h2> เลือกตามหมวดหมู่ <span><!--<i class="fa-solid fa-arrow-pointer"></i>--></span><br><i class="fa fa-chevron-right" aria-hidden="true"></i></h2></div>
			<div class="CategoryList">
				<ul>
					<?php
						$SubcategoriesTP = get_categories( array(
							'orderby'       => 'name', 
							'order'   		=> 'ASC',
							'parent'        => $tax_parent_id,
							'hide_empty'    => false
						) );
						foreach ( $SubcategoriesTP as $SubcategoryTP ) {
							$SubiconTP = get_field('icon', 'category_'.$SubcategoryTP->term_id);
					?>
					<li>
						<a href="<?php echo esc_url( get_category_link( $SubcategoryTP->term_id ) ); ?>" title="<?php echo esc_html( $SubcategoryTP->name ); ?>">
						<p class="Title"><?php echo esc_html( $SubcategoryTP->name ); ?></p>
						<p class="Icon"><?php echo$SubiconTP; ?></p>
						</a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<!-- End TravelCategoryList -->
	</div>
	<!-- EndTravelType2 -->

	<?php if($tax_parent_slug=='travel'){ ?>
	<!-- Travel -->
	<?php
		$wp_query_Check = null;
		$wp_query_Check = new WP_Query( array('post_type' => 'post', 'showposts' => '1','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'travel'));
		if ($wp_query_Check->have_posts()) :
	?>
	<!-- TravelHighlight -->
    <div class="TravelHighlight TravelAllArchrive">
        <div class="TravelHighlightBox">
            <?php
                $wp_query = null;
                $wp_query = new WP_Query( array('post_type' => 'post', 'showposts' => '5','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'travel','meta_query'=>array( array( 'key' => 'post_recommend', 'value' => 'recommend', 'compare' => 'LIKE' ) )));
                if ($wp_query->have_posts()) :
            ?>
            <h2><i class="fa-regular fa-thumbs-up"></i> ที่เที่ยวแนะนำ [Recommend]</h2>
            <div class="TravelHighlightList">
                <ul class="TravelSlide">
                    <?php
                        while ( $wp_query->have_posts() ) : $wp_query->the_post();
                            $image_id = get_post_thumbnail_id();
                            $image_url = wp_get_attachment_image_src($image_id, 'large', true);
                            if(empty($image_id)){$image_url[0] = get_bloginfo('template_directory').'/assets/images/no-img.jpg';}

                            if (has_excerpt()) {
                                $ExerptDisplay = wp_strip_all_tags(get_the_excerpt());
                            }else{
                                $ExerptDisplay = '';
                            }
                            $first_category = get_the_category( get_the_ID(), 'category' )[0]->name;
                    ?>
                    <li>
                        <div class="Picture"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></a></div>
                        <div class="Descriptoin">
                            <div class="DescriptoinBox">
                            <p class="Type"><?php echo $first_category; ?> <i class="fa-solid fa-minus"></i>  
                            <?php
                                $posttags = get_the_tags();
                                if ($posttags) {
                                    foreach($posttags as $tag) {
                                        echo $tag->name.' '; 
                                    }
                                }
                            ?>
                            </p>
                            <p class="Title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></p>
                            <?php if($ExerptDisplay!=""){ ?><p class="Caption"><?php echo $ExerptDisplay; ?></p><?php } ?>
                            <p class="Links"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
                            </div>
                        </div>
                    </li>
                    <?php endwhile;  ?>
                </ul>
            </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
		</div>
    </div>
    <!-- TravelHighlight -->

	<!-- TravelHighlight -->
    <div class="TravelHighlight TravelAllArchriveList">
        <div class="TravelHighlightBox">
			<?php
				$wp_query = null;
				$wp_query = new WP_Query( array('post_type' => 'post','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=> $taxonomy_slug,'paged'=>$paged));
				if ($wp_query->have_posts()) {
			?>
			<div class="TravelOthersList" style="margin-top:0px;">
				<div class="Header">
					<h2><i class="fa-solid fa-location-dot"></i> ที่เที่ยวอัพเดทล่าสุด</h2>
				</div>
				<ul>
					<?php
						while ( $wp_query->have_posts() ) : $wp_query->the_post();
							$image_id = get_post_thumbnail_id();
							$image_url = wp_get_attachment_image_src($image_id, 'large', true);
							if(empty($image_id)){$image_url[0] = get_bloginfo('template_directory').'/assets/images/no-img.jpg';}

							if (has_excerpt()) {
								$ExerptDisplay = wp_strip_all_tags(get_the_excerpt());
							}else{
								$ExerptDisplay = '';
							}
							$first_category = get_the_category( get_the_ID(), 'category' )[0]->name;
					?>
					<li>
						<div class="Picture"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></a></div>
						<div class="Descriptoin">
							<div class="DescriptoinBox">
							<p class="Type"><?php echo $first_category; ?> <i class="fa-solid fa-minus"></i>  
							<?php
								$posttags = get_the_tags();
								if ($posttags) {
									foreach($posttags as $tag) {
										echo $tag->name.' '; 
									}
								}
							?>
							</p>
							<p class="Title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></p>
							<?php if($ExerptDisplay!=""){ ?><p class="Caption"><?php echo $ExerptDisplay; ?></p><?php } ?>
							<p class="DateTime"><span><i class="fa-regular fa-clock"></i> <?php $PostDate = get_the_date( 'd.m.Y' ); echo $PostDate; ?></span></p>
							<p class="Links"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
							</div>
						</div>
					</li>
					<?php endwhile;  ?>
				</ul>
			</div>
			<div class="pagination"><?php pagination(); ?></div>
			<?php }else{ ?>
				<p class="EmptyData">ยังไม่มีข้อมูล "<?php echo $taxonomy_name; ?>".</p>
			<?php } ?>
			<?php wp_reset_postdata(); ?>

		</div>
    </div>
    <!-- TravelHighlight -->
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
	<!-- End Travel -->



	<?php }else if($tax_parent_slug=='eat'){ ?>
	<!-- Eat -->
	<?php
		$wp_query_Check = null;
		$wp_query_Check = new WP_Query( array('post_type' => 'post', 'showposts' => '1','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'eat'));
		if ($wp_query_Check->have_posts()) :
	?>
	<!-- EatRecommend -->
    <div class="EatRecommend TravelAllArchrive">
        <!-- EatRecommendBox -->
        <div class="EatRecommendBox">
            <?php
                $wp_query = null;
                $wp_query = new WP_Query( array('post_type' => 'post', 'showposts' => '3','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'eat','meta_query'=>array( array( 'key' => 'post_recommend', 'value' => 'recommend', 'compare' => 'LIKE' ) )));
                if ($wp_query->have_posts()) :
            ?>
            <h2><i class="fa-regular fa-thumbs-up"></i> ที่กินแนะนำ [Recommend]</h2>
            <!-- EatRecommendHighlight -->
            <div class="EatRecommendHighlight" style="margin-bottom:0;">
                <?php
                    $i=1;
                    while ( $wp_query->have_posts() ) : $wp_query->the_post();
                        $image_id = get_post_thumbnail_id();
                        $image_url = wp_get_attachment_image_src($image_id, 'large', true);
                        if(empty($image_id)){$image_url[0] = get_bloginfo('template_directory').'/assets/images/no-img.jpg';}

                        $first_category = get_the_category( get_the_ID(), 'category' )[0]->name; 
                        $posts_opening_hours = get_field('posts_opening_hours',get_the_ID());
                        if($i==1){ $StyleBpx = 'large'; }else{ $StyleBpx = 'small'; }
                ?>
                <div class="<?php echo $StyleBpx; ?>">
                    <div class="Pic"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></a></div>
                    <div class="Detail">
                        <p class="Type">
                            <?php echo $first_category; ?> <i class="fa-solid fa-minus"></i>  
                            <?php
                                $posttags = get_the_tags();
                                if ($posttags) {
                                    foreach($posttags as $tag) {
                                        echo $tag->name.' '; 
                                    }
                                }
                            ?>
                        </p>
                        <p class="Title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></p>
                        <?php if($posts_opening_hours!=""){ ?><p class="DateTime"><i class="fa-regular fa-clock"></i> <?php echo $posts_opening_hours; ?></p><?php } ?>
                        <p class="Links"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
                    </div>
                </div> 
                <?php $i++; endwhile;  ?>
            </div>
            <!-- End EatRecommendHighlight -->
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
		</div>
        <!-- End EatRecommendBox -->
    </div>
    <!-- EatRecommend -->
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

	<?php
		$wp_query = null;
		$wp_query = new WP_Query( array('post_type' => 'post','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=> $taxonomy_slug,'paged'=>$paged));
		
	?>
	<!-- EatRecommend -->
    <div class="EatRecommend TravelAllArchriveList">
        <!-- EatRecommendBox -->
        <div class="EatRecommendBox">
			<?php if ($wp_query->have_posts()) { ?>
			<!-- EatRecommendList -->
			<div class="EatRecommendList clr" style="margin-top:0;">
				<div class="Header">
					<h2><i class="fa-solid fa-utensils"></i> ที่กินอัพเดทล่าสุด</h2>
				</div>
				<ul>
					<?php
						while ( $wp_query->have_posts() ) : $wp_query->the_post();
							$image_id = get_post_thumbnail_id();
							$image_url = wp_get_attachment_image_src($image_id, 'large', true);
							if(empty($image_id)){$image_url[0] = get_bloginfo('template_directory').'/assets/images/no-img.jpg';}

							$first_category = get_the_category( get_the_ID(), 'category' )[0]->name;
							$posts_opening_hours = get_field('posts_opening_hours',get_the_ID());
					?>
					<li>
						<div class="EatListBox">
							<div class="Pic"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></a></div>
							<div class="Detail">
								<p class="Type">
								<?php echo $first_category; ?> <i class="fa-solid fa-minus"></i>  
								<?php
									$posttags = get_the_tags();
									if ($posttags) {
										foreach($posttags as $tag) {
											echo $tag->name.' '; 
										}
									}
								?>
								</p>
								<p class="Title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></p>
								<?php if($posts_opening_hours!=""){ ?><p class="DateTime"><i class="fa-regular fa-clock"></i> <?php echo $posts_opening_hours; ?></p><?php } ?>
							</div>
						</div> 
						<p class="Links"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<!-- End EatRecommendList -->
			<div class="pagination"><?php pagination(); ?></div>
			<?php }else{ ?>
				<p class="EmptyData">ยังไม่มีข้อมูล "<?php echo $taxonomy_name; ?>".</p>
			<?php } ?>
			<?php wp_reset_postdata(); ?>
			<!-- End Eat -->
		</div>
        <!-- End EatRecommendBox -->
    </div>
    <!-- EatRecommend -->



	<?php }else if($tax_parent_slug=='hotel'){ ?>
	<!-- Hotel -->
	<?php
		$wp_query_Check = null;
		$wp_query_Check = new WP_Query( array('post_type' => 'post', 'showposts' => '1','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'hotel'));
		if ($wp_query_Check->have_posts()) :
	?>
		<?php
			$wp_query = null;
			$wp_query = new WP_Query( array('post_type' => 'post', 'showposts' => '1','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'hotel','meta_query'=>array( array( 'key' => 'post_recommend', 'value' => 'recommend', 'compare' => 'LIKE' ) )));
			if ($wp_query->have_posts()) :
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$image_id = get_post_thumbnail_id();
					$image_url = wp_get_attachment_image_src($image_id, 'large', true);
					if(empty($image_id)){$image_url[0] = get_bloginfo('template_directory').'/assets/images/no-img.jpg';}

					if (has_excerpt()) {
						$ExerptDisplay = wp_strip_all_tags(get_the_excerpt());
					}else{
						$ExerptDisplay = '';
					}

					$first_category = get_the_category( get_the_ID(), 'category' )[0]->name; 
					$posts_opening_hours = get_field('posts_opening_hours',get_the_ID());   
					$booking_affiliate_url = get_field('booking_affiliate_url',get_the_ID());   
					$agoda_affiliate_url = get_field('agoda_affiliate_url',get_the_ID());                
		?>
		<!-- HotelReccommend -->
		<div class="HotelReccommend TravelAllArchrive">
			<div class="HotelReccommendBox">
				<h2><i class="fa-regular fa-thumbs-up"></i> ที่พักแนะนำ [Recommend]</h2>
				<div class="HotelReccommendBoxLR">
					<div class="BoxLeft">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">
						<div class="large"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></div> 
						<?php
							for ($x=1;$x<=2;$x++) {
								$hotels_picture = get_field('hotels_picture_'.$x,get_the_ID());
								if(!empty($hotels_picture)){
									echo '<div class="small"><img src="'.$hotels_picture['sizes']['large'].'" alt="'.get_the_title().' รูปที่ '.$x.'"  width="'.$hotels_picture['sizes']['large-width'].'" height="'.$hotels_picture['sizes']['large-height'].'"></div>';
								}
							}
						?>
						</a>
					</div>
					<div class="BoxRight">
						<p class="Type">
						<?php echo $first_category; ?> <i class="fa-solid fa-minus"></i> 
						<?php
							$posttags = get_the_tags();
							if ($posttags) {
								foreach($posttags as $tag) {
									echo $tag->name.' '; 
								}
							}
						?>
						</p>
						<p class="Title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></p>
						<?php if($ExerptDisplay!=""){ ?><p class="Description"><?php echo $ExerptDisplay; ?></p><?php } ?>
						<p class="TypeandFacilities"><?php echo GetFacilities(get_the_ID()); ?></p>
						<div class="Links">
							<?php if($booking_affiliate_url!="" || $agoda_affiliate_url!=""){ ?>
							<div class="AffPartners">
								<?php if($booking_affiliate_url!=""){ ?><a href="<?php echo $booking_affiliate_url; ?>" target="_blank" title="จอง <?php the_title(); ?> ผ่าน Booking.com" class="Booking">จองผ่าน <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon/booking-logo.svg" alt="จอง <?php the_title(); ?> ผ่าน Booking.com" width="80" height="14"></a><?php } ?>
								<?php if($agoda_affiliate_url!=""){ ?><a href="<?php echo $agoda_affiliate_url; ?>" target="_blank" title="จอง <?php the_title(); ?> ผ่าน Agoda.com">จองผ่าน <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon/agoda-logo.svg" alt="จอง <?php the_title(); ?> ผ่าน Agoda.com" width="43" height="22"></a><?php } ?>
							</div>
							<?php }else{ ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- HotelReccommend -->
		<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

	<?php
        $wp_query = null;
        $wp_query = new WP_Query( array('post_type' => 'post','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=> $taxonomy_slug,'paged' => $paged));
    ?>
    <!-- HotelList -->
    <div class="HotelList" style="padding-bottom:40px!important;">
        <div class="HotelListBox">
			<?php if ($wp_query->have_posts()) { ?>
            <div class="HotelListBoxLR">
                <div class="BoxLeft">
                    <p class="HotelTitleOthers"><i class="fa-solid fa-bed"></i> ที่พักอัพเดทล่าสุด</p>
                    <ul>
                        <?php
                            while ( $wp_query->have_posts() ) : $wp_query->the_post();
                            $image_id = get_post_thumbnail_id();
                            $image_url = wp_get_attachment_image_src($image_id, 'large', true);
                            if(empty($image_id)){$image_url[0] = get_bloginfo('template_directory').'/assets/images/no-img.jpg';}
            
                            if (has_excerpt()) {
                                $ExerptDisplay = wp_strip_all_tags(get_the_excerpt());
                            }else{
                                $ExerptDisplay = '';
                            }
            
                            $first_category = get_the_category( get_the_ID(), 'category' )[0]->name; 
                            $posts_opening_hours = get_field('posts_opening_hours',get_the_ID());
                            $booking_affiliate_url = get_field('booking_affiliate_url',get_the_ID());   
                            $agoda_affiliate_url = get_field('agoda_affiliate_url',get_the_ID()); 
                        ?>
                        <li>
                            <div class="Picture"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></a></div>
                            <div class="Descriptions">
                                <p class="Title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></p>
                                <?php if($ExerptDisplay!=""){ ?><p class="Caption"><?php echo $ExerptDisplay; ?></p><?php } ?>
                                <p class="TypeandFacilities">
                                <?php echo $first_category; ?> - 
                                <?php
                                    $posttags = get_the_tags();
                                    if ($posttags) {
                                        foreach($posttags as $tag) {
                                            echo $tag->name.' '; 
                                        }
                                    }
                                ?>
                                <span> - </span> <?php echo GetFacilities(get_the_ID()); ?></p>
                                <div class="Links">
                                    <?php if($booking_affiliate_url!="" || $agoda_affiliate_url!=""){ ?>
                                    <div class="AffPartners">
                                        <?php if($booking_affiliate_url!=""){ ?><a href="<?php echo $booking_affiliate_url; ?>" target="_blank" title="จอง <?php the_title(); ?> ผ่าน Booking.com">จองผ่าน <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon/booking-logo.svg" alt="จอง <?php the_title(); ?> ผ่าน Booking.com" width="80" height="14"></a><?php } ?>
                                        <?php if($agoda_affiliate_url!=""){ ?><a href="<?php echo $agoda_affiliate_url; ?>" target="_blank" title="จอง <?php the_title(); ?> ผ่าน Agoda.com">จองผ่าน <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon/agoda-logo.svg" alt="จอง <?php the_title(); ?> ผ่าน Agoda.com" width="43" height="22"></a><?php } ?>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </li>
                        <?php endwhile; ?>
                    </ul>
					<div class="pagination"><?php pagination(); ?></div>
                </div>
                <?php wp_reset_postdata(); ?>

                <?php
                    $ADSSetting = get_page('198');
                    if($ADSSetting->booking_ads!='' || $ADSSetting->agoda_ads!='' || $ADSSetting->banner_image!='' || $ADSSetting->banner_url!=''){
                ?>
                <div class="BoxRight">
                    <div class="BoxRightInner">
                        <?php if($ADSSetting->booking_ads!=''){ ?><div class="BookingADS"><?php echo $ADSSetting->booking_ads; ?></div><?php } ?>
                        <?php if($ADSSetting->agoda_ads!=''){ ?><div class="AgodaADS"><?php echo $ADSSetting->agoda_ads; ?></div><?php } ?>
                        <?php
                            if($ADSSetting->banner_image!='' && $ADSSetting->banner_url!=""){
                            $banner_image_picture = get_field('banner_image',$ADSSetting);
                            if(!empty($banner_image_picture)){                        
                        ?>
                            <div class="BannerADS"><a href="<?php echo $ADSSetting->banner_url; ?>" target="_blank"><img src="<?php echo $banner_image_picture['sizes']['large']; ?>" alt="<?php echo esc_attr($banner_image_picture['alt']); ?>" width="<?php echo $banner_image_picture['sizes']['large-width']; ?>" height="<?php echo $banner_image_picture['sizes']['large-height']; ?>"></a></div>
                        <?php }} ?>
                    </div>
                </div>
                <?php } ?>
            </div>
			<?php }else{ ?>
				<p class="EmptyData">ยังไม่มีข้อมูล "<?php echo $taxonomy_name; ?>".</p>
			<?php } ?>
			<?php wp_reset_postdata(); ?>
        </div>
    </div>
    <!-- HotelList -->
	<!-- End Hotel -->
	<?php } ?>

	
<?php get_footer(); ?>