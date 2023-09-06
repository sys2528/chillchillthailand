<?php get_header(); ?>

<div class="BGHome">
<!-- TravelType -->
<div class="TravelType">
    <!-- TravelTypeBox -->
    <div class="TravelTypeBox">
        <h1>เว็บไซต์รีวิวที่เที่ยว ที่กิน ที่พัก แบบชิลชิลไทยแลนด์</h1>
        <p class="FindPlace">กำลังมองหาสถานที่แบบไหน<!-- <i class="fa-regular fa-circle-question"></i>--></p>
        <!--<p class="ChoosePlace">เลือกตามประเภท</p>-->
        <ul>
            <?php
                $categoriesTP = get_categories( array(
                    'orderby' 		=> 'name',
                    'order'   		=> 'ASC',
                    'hide_empty'    => false,
                    'parent'  		=> 0
                ) );
                foreach ( $categoriesTP as $categoryTP ) {
                    $taxonomy_idTP = get_queried_object()->term_taxonomy_id;
                    $Cate_idTP = 'category_'.$taxonomy_idTP;
                    $photoTP = get_field('category_cover', 'category_'.$categoryTP->term_id);
                    $iconTP = get_field('icon', 'category_'.$categoryTP->term_id);
            ?>
            <li>
                <a href="<?php echo esc_url( get_category_link( $categoryTP->term_id ) ); ?>" title="<?php echo esc_html( $categoryTP->name ); ?>" target="_blank">
                <p class="Picture"><img src="<?php echo esc_url($photoTP['url']); ?>" alt="<?php echo esc_html( $categoryTP->name ); ?>" width="<?php echo $photoTP['sizes']['large-width']; ?>" height="<?php echo $photoTP['sizes']['large-height']; ?>"></p>
                <p class="Icon"><?php echo $iconTP; ?></p>
                <p class="Title"><?php echo esc_html( $categoryTP->name ); ?><span><?php echo esc_html( $categoryTP->slug ); ?></span></p>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <!-- End TravelTypeBox -->
</div>
<!-- EndTravelType -->
</div>

<!-- TravelType2 -->
<div class="TravelType2">
    <!-- TravelCategoryList -->
    <div class="TravelCategoryList">
        <div class="OpenCategory"><h2> เลือกตามหมวดหมู่ <span><!--<i class="fa-solid fa-arrow-pointer"></i>--></span><br><i class="fa fa-chevron-right" aria-hidden="true"></i></h2></div>
        <div class="CategoryList">
            <ul>
                <?php
                    $categoriesTPSub = get_categories( array(
                        'orderby' 		=> 'name',
                        'order'   		=> 'ASC',
                        'hide_empty'    => false,
                        'parent'  		=> 0
                    ) );
                    foreach ( $categoriesTPSub as $categoryTPSub ) {
                ?>
                    <?php
                        $SubcategoriesTP = get_categories( array(
                            'orderby'       => 'name', 
                            'order'   		=> 'ASC',
                            'parent'        => $categoryTPSub->term_id,
                            'hide_empty'    => false
                            
                        ) );
                        foreach ( $SubcategoriesTP as $SubcategoryTP ) {
                            $SubiconTP = get_field('icon', 'category_'.$SubcategoryTP->term_id);
                    ?>
                    <li>
                        <a href="<?php echo esc_url( get_category_link( $SubcategoryTP->term_id ) ); ?>" title="<?php echo esc_html( $SubcategoryTP->name ); ?>" target="_blank">
                        <p class="Title"><?php echo esc_html( $SubcategoryTP->name ); ?></p>
                        <p class="Icon"><?php echo $SubiconTP; ?></p>
                        </a>
                    </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!-- End TravelCategoryList -->
</div>
<!-- EndTravelType2 -->

<?php
    $wp_query_Check = null;
    $wp_query_Check = new WP_Query( array('post_type' => 'post', 'showposts' => '1','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'travel'));
    if ($wp_query_Check->have_posts()) :
?>
<!-- TypeSectionTkicky -->
<div class="TypeSectionTkicky">
    <div class="TypeSection"><p><i class="fa-solid fa-location-dot"></i></p><div class="Tryangle"></div></div>

    <!-- TravelHighlight -->
    <div class="TravelHighlight">
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

                            //$post_recommend = get_field('post_recommend',get_the_ID());
                            //if( $post_recommend && in_array('recommend', $post_recommend) ){ echo 'recommend'; }else{ echo 'Noooo'; }
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

            <?php
                $wp_query = null;
                $wp_query = new WP_Query( array('post_type' => 'post', 'showposts' => '6','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'travel','meta_query'=>array( array( 'key' => 'post_recommend', 'value' => 'recommend', 'compare' => 'NOT LIKE' ) )));
                if ($wp_query->have_posts()) :
            ?>
            <div class="TravelOthersList">
                <div class="Header">
                    <h2><i class="fa-solid fa-location-dot"></i> ที่เที่ยวอัพเดทล่าสุด</h2>
                    <div class="SeeAll"><a href="<?php echo get_bloginfo("url"); ?>/travel" title="ที่เที่ยวอัพเดททั้งหมด">ที่เที่ยวทั้งหมด <i class="fa-solid fa-angles-right"></i></a></div>
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

                            //$post_recommend = get_field('post_recommend',get_the_ID());
                            //if( $post_recommend && in_array('recommend', $post_recommend) ){ echo 'recommend'; }else{ echo 'Noooo'; }
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
                <div class="Viewall"><a href="<?php echo get_bloginfo("url"); ?>/travel" title="ที่เที่ยวอัพเดททั้งหมด">ที่เที่ยวทั้งหมด <i class="fa-solid fa-angles-right"></i></a></div>
            </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
    <!-- TravelHighlight -->

</div>
<!-- End TypeSectionTkicky -->
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php
    $wp_query_Check = null;
    $wp_query_Check = new WP_Query( array('post_type' => 'post', 'showposts' => '1','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'eat'));
    if ($wp_query_Check->have_posts()) :
?>
<!-- TypeSectionTkicky -->
<div class="TypeSectionTkicky EatBGSection clr">
    <div class="TypeSection"><p><i class="fa-solid fa-utensils"></i></p><div class="Tryangle"></div></div>
    <!-- EatRecommend -->
    <div class="EatRecommend">
        <!-- EatRecommendBox -->
        <div class="EatRecommendBox">
            <?php
                $wp_query = null;
                $wp_query = new WP_Query( array('post_type' => 'post', 'showposts' => '3','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'eat','meta_query'=>array( array( 'key' => 'post_recommend', 'value' => 'recommend', 'compare' => 'LIKE' ) )));
                if ($wp_query->have_posts()) :
            ?>
            <h2><i class="fa-regular fa-thumbs-up"></i> ที่กินแนะนำ [Recommend]</h2>
            <!-- EatRecommendHighlight -->
            <div class="EatRecommendHighlight">
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

            <?php
                $wp_query = null;
                $wp_query = new WP_Query( array('post_type' => 'post', 'showposts' => '4','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'eat','meta_query'=>array( array( 'key' => 'post_recommend', 'value' => 'recommend', 'compare' => 'NOT LIKE' ) )));
                if ($wp_query->have_posts()) :
            ?>
            <!-- EatRecommendList -->
            <div class="EatRecommendList clr">
                <div class="Header">
                    <h2><i class="fa-solid fa-utensils"></i> ที่กินอัพเดทล่าสุด</h2>
                    <div class="SeeAll"><a href="<?php echo get_bloginfo("url"); ?>/eat" title="ที่กินอัพเดททั้งหมด">ที่กินทั้งหมด <i class="fa-solid fa-angles-right"></i></a></div>
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
            <div class="Viewall"><a href="<?php echo get_bloginfo("url"); ?>/eat" title="ที่กินอัพเดททั้งหมด">ที่กินทั้งหมด <i class="fa-solid fa-angles-right"></i></a></div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

        </div>
        <!-- End EatRecommendBox -->

    </div>
    <!-- EatRecommend -->
</div>
<!-- End TypeSectionTkicky -->
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php
    $wp_query_Check = null;
    $wp_query_Check = new WP_Query( array('post_type' => 'post', 'showposts' => '1','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'hotel'));
    if ($wp_query_Check->have_posts()) :
?>
<!-- TypeSectionTkicky -->
<div class="TypeSectionTkicky">
    <div class="TypeSection"><p><i class="fa-solid fa-bed"></i></p><div class="Tryangle"></div></div>

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
    <div class="HotelReccommend">
        <div class="HotelReccommendBox">
            <h2><i class="fa-regular fa-thumbs-up"></i> ที่พักแนะนำ [Recommend]</h2>
            <div class="HotelReccommendBoxLR">
                <div class="BoxLeft">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">
                    <div class="large"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></div> 
                    <?php
					    //$image_id_others = get_post_thumbnail_id(get_the_ID());
						//$image_url_others = wp_get_attachment_image_src($image_id_others, 'large', true);
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

    <?php
        $wp_query = null;
        $wp_query = new WP_Query( array('post_type' => 'post', 'showposts' => '5','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'hotel','meta_query'=>array( array( 'key' => 'post_recommend', 'value' => 'recommend', 'compare' => 'NOT LIKE' ) )));
        if ($wp_query->have_posts()) :
    ?>
    <!-- HotelList -->
    <div class="HotelList">
        <div class="HotelListBox">
            <div class="HotelListBoxLR">
                <div class="BoxLeft">
                    <p class="HotelTitleOthers"><i class="fa-solid fa-bed"></i> ที่พักอื่น ๆ ที่น่าสนใจ</p>
                    <p class="SeeAll"><a href="<?php echo get_bloginfo("url"); ?>/hotel" title="ที่พักอัพเดททั้งหมด">ที่พักทั้งหมด <i class="fa-solid fa-angles-right"></i></a></p>
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
                </div>
                <div class="Viewall"><a href="<?php echo get_bloginfo("url"); ?>/hotel" title="ที่พักอัพเดททั้งหมด">ที่พักทั้งหมด <i class="fa-solid fa-angles-right"></i></a></div>
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
        </div>
    </div>
    <!-- HotelList -->
    <?php endif; ?>

</div>
<!-- End TypeSectionTkicky -->
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php
    $wp_query = null;
    $wp_query = new WP_Query( array('post_type'=>'blog','showposts'=>'6','orderby'=>'date','order'=>'DESC','post_status'=>'publish'));
    if ($wp_query->have_posts()) { 
?>
<!-- PostReccommend -->
<div class="PostReccommend">
    <div class="PostReccommendBox">
        
        <div class="Header">
            <h2><i class="fa-regular fa-newspaper"></i> บทความและข่าวสารอัพเดท</h2>
            <?php if ($wp_query->have_posts()) { ?><div class="SeeAll"><a href="<?php echo get_bloginfo("url"); ?>/blog" title="บทความและข่าวสารอัพเดททั้งหมด">ดูทั้งหมด <i class="fa-solid fa-angles-right"></i></a></div><?php } ?>
        </div>
        
        <ul>
            <?php
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$image_id = get_post_thumbnail_id(get_the_ID());
					$image_url = wp_get_attachment_image_src($image_id, 'large', true);
					if(empty($image_id)){$image_url[0] = get_bloginfo('template_directory').'/assets/images/no-photo.jpg';}	

                    $first_category = wp_get_post_terms( get_the_ID(), 'blog_category' )[0]->name;
			?>
            <li>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">
                <p class="Picture"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></p>
                <p class="Title"><?php the_title(); ?></p>
                <p class="DateTime"><span><i class="fa-regular fa-clock"></i> <?php the_modified_date('d.m.Y'); ?></span> <span class="TypeShow"><?php echo $first_category; ?></span></p>
                </a>
            </li>
            <?php endwhile; ?>
        </ul>
        <div class="Viewall"><a href="<?php echo get_bloginfo("url"); ?>/blog" title="บทความและข่าวสารทั้งหมด">บทความและข่าวสารทั้งหมด <i class="fa-solid fa-angles-right"></i></a></div>
        <?php wp_reset_postdata(); ?>
    </div>
</div>
<!-- End PostReccommend -->
<?php } ?>

<?php get_footer(); ?>