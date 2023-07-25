<?php get_header(); ?>

<div class="BGHome">
<!-- TravelType -->
<div class="TravelType">
    <!-- TravelTypeBox -->
    <div class="TravelTypeBox">
        <h1>เว็บไซต์รีวิวที่เที่ยว ที่กิน ที่พัก แบบชิลชิล</h1>
        <p class="ChoosePlace">เลือกตามประเภท</p>
        <p class="FindPlace">กำลังมองหาสถานที่แบบไหน <i class="fa-regular fa-circle-question"></i></p>
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
                <a href="<?php echo esc_url( get_category_link( $categoryTP->term_id ) ); ?>" title="<?php echo esc_html( $categoryTP->name ); ?>">
                <p class="Picture"><img src="<?php echo esc_url($photoTP['url']); ?>" alt="<?php echo esc_html( $categoryTP->name ); ?>"></p>
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
        <div class="OpenCategory"><h2> เลือกตามหมวดหมู่ <br><i class="fa fa-chevron-right" aria-hidden="true"></i></h2></div>
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
                        <a href="<?php echo esc_url( get_category_link( $SubcategoryTP->term_id ) ); ?>" title="<?php echo esc_html( $SubcategoryTP->name ); ?>">
                        <p class="Title"><?php echo esc_html( $SubcategoryTP->name ); ?></p>
                        <p class="Icon"><?php echo$SubiconTP; ?></p>
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

<!-- TypeSectionTkicky -->
<div class="TypeSectionTkicky">
    <div class="TypeSection"><p><i class="fa-solid fa-location-dot"></i></p><div class="Tryangle"></div></div>

    <!-- TravelHighlight -->
    <div class="TravelHighlight">
        <div class="TravelHighlightBox">
            <h2><i class="fa-regular fa-thumbs-up"></i> ที่เที่ยวแนะนำ [Recommend]</h2>
            <div class="TravelHighlightList">
                <?php
                    $wp_query = null;
                    $wp_query = new WP_Query( array('post_type' => 'post', 'showposts' => '5','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'travel','meta_query'=>array( array( 'key' => 'post_recommend', 'value' => 'recommend', 'compare' => 'LIKE' ) )));
                    if ($wp_query->have_posts()) :
                ?>
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
                        <div class="Picture"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></a></div>
                        <div class="Descriptoin">
                            <div class="DescriptoinBox">
                            <p class="Type"><?php echo $first_category; ?>, 
                            <?php
                                $posttags = get_the_tags();
                                if ($posttags) {
                                    foreach($posttags as $tag) {
                                        echo $tag->name.' '; 
                                    }
                                }
                            ?>
                            </p>
                            <p class="Title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
                            <p class="Caption"><?php echo $ExerptDisplay; ?></p>
                            <p class="Links"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
                            </div>
                        </div>
                    </li>
                    <?php endwhile;  ?>
                </ul>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <div class="TravelOthersList">
                <div class="Header">
                    <h2><i class="fa-solid fa-location-dot"></i> ที่เที่ยวอัพเดทล่าสุด</h2>
                    <div class="SeeAll"><a href="<?php echo get_bloginfo("url"); ?>/travel" title="ที่เที่ยวอัพเดททั้งหมด">ที่เที่ยวทั้งหมด <i class="fa-solid fa-angles-right"></i></a></div>
                </div>
                <?php
                    $wp_query = null;
                    $wp_query = new WP_Query( array('post_type' => 'post', 'showposts' => '6','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'travel'));
                    if ($wp_query->have_posts()) :
                ?>
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
                        <div class="Picture"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></a></div>
                        <div class="Descriptoin">
                            <div class="DescriptoinBox">
                            <p class="Type"><?php echo $first_category; ?>, 
                            <?php
                                $posttags = get_the_tags();
                                if ($posttags) {
                                    foreach($posttags as $tag) {
                                        echo $tag->name.' '; 
                                    }
                                }
                            ?>
                            </p>
                            <p class="Title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
                            <p class="Caption"><?php echo $ExerptDisplay; ?></p>
                            <p class="DateTime"><!--<span><i class="fa-solid fa-eye"></i> 1,240 ครั้ง</span> --><span><i class="fa-regular fa-calendar-days"></i> <?php $PostDate = get_the_date( 'd.m.Y' ); echo $PostDate; ?></span></p>
                            <p class="Links"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
                            </div>
                        </div>
                    </li>
                    <?php endwhile;  ?>
                </ul>
                <div class="Viewall"><a href="<?php echo get_bloginfo("url"); ?>/travel" title="ที่เที่ยวอัพเดททั้งหมด">ที่เที่ยวทั้งหมด <i class="fa-solid fa-angles-right"></i></a></div>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
    <!-- TravelHighlight -->

</div>
<!-- End TypeSectionTkicky -->

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

                        if (has_excerpt()) {
                            $ExerptDisplay = wp_strip_all_tags(get_the_excerpt());
                        }else{
                            $ExerptDisplay = '';
                        }

                        $first_category = get_the_category( get_the_ID(), 'category' )[0]->name; 
                        $posts_opening_hours = get_field('posts_opening_hours',get_the_ID());
                        if($i==1){ $StyleBpx = 'large'; }else{ $StyleBpx = 'small'; }
                ?>
                <div class="<?php echo $StyleBpx; ?>">
                    <div class="Pic"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></a></div>
                    <div class="Detail">
                        <p class="Type">
                            <?php echo $first_category; ?>, 
                            <?php
                                $posttags = get_the_tags();
                                if ($posttags) {
                                    foreach($posttags as $tag) {
                                        echo $tag->name.' '; 
                                    }
                                }
                            ?>
                        </p>
                        <p class="Title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
                        <?php if($posts_opening_hours!=""){ ?><p class="DateTime"><i class="fa-regular fa-clock"></i> <?php echo $posts_opening_hours; ?></p><?php } ?>
                        <p class="Links"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
                    </div>
                </div> 
                <?php $i++; endwhile;  ?>
            </div>
            <!-- End EatRecommendHighlight -->
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

            <?php
                $wp_query = null;
                $wp_query = new WP_Query( array('post_type' => 'post', 'showposts' => '4','orderby' => 'date','order'=>'DESC','post_status'=>'publish','taxonomy'=>'category','term'=>'eat'));
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

                            if (has_excerpt()) {
                                $ExerptDisplay = wp_strip_all_tags(get_the_excerpt());
                            }else{
                                $ExerptDisplay = '';
                            }

                            $first_category = get_the_category( get_the_ID(), 'category' )[0]->name;
                            $posts_opening_hours = get_field('posts_opening_hours',get_the_ID());
                    ?>
                    <li>
                        <div class="EatListBox">
                            <div class="Pic"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></a></div>
                            <div class="Detail">
                                <p class="Type">
                                <?php echo $first_category; ?>, 
                                <?php
                                    $posttags = get_the_tags();
                                    if ($posttags) {
                                        foreach($posttags as $tag) {
                                            echo $tag->name.' '; 
                                        }
                                    }
                                ?>
                                </p>
                                <p class="Title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
                                <?php if($posts_opening_hours!=""){ ?><p class="DateTime"><i class="fa-regular fa-clock"></i> <?php echo $posts_opening_hours; ?></p><?php } ?>
                            </div>
                        </div> 
                        <p class="Links"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
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

<!-- TypeSectionTkicky -->
<div class="TypeSectionTkicky">
    <div class="TypeSection"><p><i class="fa-solid fa-bed"></i></p><div class="Tryangle"></div></div>

    <!-- HotelReccommend -->
    <div class="HotelReccommend">
        <div class="HotelReccommendBox">
            <h2><i class="fa-regular fa-thumbs-up"></i> ที่พักแนะนำ [Recommend]</h2>
            <div class="HotelReccommendBoxLR">
                <div class="BoxLeft">
                    <a href="#">
                    <div class="large"><img src="<?php bloginfo('template_directory'); ?>/assets/images/type/hotel4.jpg"></div> 
                    <div class="small"><img src="<?php bloginfo('template_directory'); ?>/assets/images/type/hotel3.jpg"></div>
                    <div class="small"><img src="<?php bloginfo('template_directory'); ?>/assets/images/type/hotel2.jpg"></div>
                    </a>
                </div>
                <div class="BoxRight">
                    <p class="Type">โรงแรม / รีสอร์ท, ชลบุรี</p>
                    <p class="Title"><a href="#">โรงแรมมิลเลนเนียมฮิลตันกรุงเทพ (Millennium Hilton Bangkok Hotel)</a></p>
                    <p class="Description">ที่พักริมแม่น้ำ วิวดี อาหารเช้าดี บริการดี ที่พักสะอาด นอนสบาย หลับสนิท ห้องเก็บเสียงดี ไม่มีเสียงเปิดปิดประตูห้องอื่นดังรบกวน</p>
                    <p class="TypeandFacilities"></span><i class="fa-solid fa-wifi"></i> <i class="fa-solid fa-person-swimming"></i> <i class="fa-solid fa-mug-hot"></i> <i class="fa-solid fa-bell-concierge"></i> <i class="fa-solid fa-dumbbell"></i> <i class="fa-solid fa-square-parking"></i> +3</p>
                    <p class="Links"><a href="#">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- HotelReccommend -->

    <!-- HotelList -->
    <div class="HotelList">
        <div class="HotelListBox">
            <div class="HotelListBoxLR">
                <div class="BoxLeft">
                    <p class="HotelTitleOthers"><i class="fa-solid fa-bed"></i> ที่พักอื่น ๆ ที่น่าสนใจ</p>
                    <p class="SeeAll"><a href="#">ที่พักทั้งหมด <i class="fa-solid fa-angles-right"></i></a></p>
                    <ul>
                        <li>
                            <div class="Picture"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/assets/images/type/hotel.jpg"></a></div>
                            <div class="Descriptions">
                                <p class="Title"><a href="#">โรงแรมมิลเลนเนียมฮิลตันกรุงเทพ (Millennium Hilton Bangkok Hotel)</a></p>
                                <p class="Caption">ที่พักริมแม่น้ำ วิวดี อาหารเช้าดี บริการดี ที่พักสะอาด นอนสบาย หลับสนิท ห้องเก็บเสียงดี ไม่มีเสียงเปิดปิดประตูห้องอื่นดังรบกวน</p>
                                <p class="TypeandFacilities">โรงแรม / รีสอร์ท, ชลบุรี<span> • </span><i class="fa-solid fa-wifi"></i> <i class="fa-solid fa-person-swimming"></i> <i class="fa-solid fa-mug-hot"></i> <i class="fa-solid fa-bell-concierge"></i> <i class="fa-solid fa-dumbbell"></i> <i class="fa-solid fa-square-parking"></i> +3</p>
                                <p class="ReadMore"><a href="#">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
                            </div>
                        </li>
                        <li>
                            <div class="Picture"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/assets/images/type/hotel2.jpg"></a></div>
                            <div class="Descriptions">
                                <p class="Title"><a href="#">โรงแรมมารวยการ์เด้น (Maruay Garden Hotel)</a></p>
                                <p class="Caption">โรงแรมยอดนิยมในการจัดประชุม อบรม สัมมนา ในย่าน ม.เกษตรฯ สะดวกสบายดีเหมือนกันครับ</p>
                                <p class="TypeandFacilities">วิลล่า / บ้านพัก, เลย<span> • </span><i class="fa-solid fa-wifi"></i> <i class="fa-solid fa-mug-hot"></i> <i class="fa-solid fa-bell-concierge"></i> <i class="fa-solid fa-dumbbell"></i> <i class="fa-solid fa-square-parking"></i> +2</p>
                                <p class="ReadMore"><a href="#">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
                            </div>
                        </li>
                        <li>
                            <div class="Picture"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/assets/images/type/hotel3.jpg"></a></div>
                            <div class="Descriptions">
                                <p class="Title"><a href="#">The Quarter Hualampong By Uhg</a></p>
                                <p class="Caption">หนึ่งในโรงแรมเครือ UHG ด้วยงานสถาปัตยกรรม Chiness modern สืบสานวัฒนธรรมการบริการ ที่เรียบง่าย อบอุ่น มีสไตล์โดดเด่น</p>
                                <p class="TypeandFacilities">โรงแรม / รีสอร์ท, เชียงใหม่<span> • </span><i class="fa-solid fa-wifi"></i> <i class="fa-solid fa-person-swimming"></i> <i class="fa-solid fa-mug-hot"></i> <i class="fa-solid fa-bell-concierge"></i> <i class="fa-solid fa-dumbbell"></i> <i class="fa-solid fa-square-parking"></i> +3</p>
                                <p class="ReadMore"><a href="#">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
                            </div>
                        </li>
                        <li>
                            <div class="Picture"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/assets/images/type/hotel4.jpg"></a></div>
                            <div class="Descriptions">
                                <p class="Title"><a href="#">The Quarter Hualampong By Uhg</a></p>
                                <p class="Caption">หนึ่งในโรงแรมเครือ UHG ด้วยงานสถาปัตยกรรม Chiness modern สืบสานวัฒนธรรมการบริการ ที่เรียบง่าย อบอุ่น มีสไตล์โดดเด่น</p>
                                <p class="TypeandFacilities">โรงแรม / รีสอร์ท, เชียงใหม่<span> • </span><i class="fa-solid fa-wifi"></i> <i class="fa-solid fa-person-swimming"></i> <i class="fa-solid fa-mug-hot"></i> <i class="fa-solid fa-bell-concierge"></i> <i class="fa-solid fa-dumbbell"></i> <i class="fa-solid fa-square-parking"></i> +3</p>
                                <p class="ReadMore"><a href="#">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
                            </div>
                        </li><li>
                            <div class="Picture"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/assets/images/type/hotel.jpg"></a></div>
                            <div class="Descriptions">
                                <p class="Title"><a href="#">The Quarter Hualampong By Uhg</a></p>
                                <p class="Caption">หนึ่งในโรงแรมเครือ UHG ด้วยงานสถาปัตยกรรม Chiness modern สืบสานวัฒนธรรมการบริการ ที่เรียบง่าย อบอุ่น มีสไตล์โดดเด่น</p>
                                <p class="TypeandFacilities">โรงแรม / รีสอร์ท, เชียงใหม่<span> • </span><i class="fa-solid fa-wifi"></i> <i class="fa-solid fa-person-swimming"></i> <i class="fa-solid fa-mug-hot"></i> <i class="fa-solid fa-bell-concierge"></i> <i class="fa-solid fa-dumbbell"></i> <i class="fa-solid fa-square-parking"></i> +3</p>
                                <p class="ReadMore"><a href="#">ดูรายละเอียด <i class="fa-solid fa-angles-right"></i></a></p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="Viewall"><a href="page-category.php">ที่พักทั้งหมด <i class="fa-solid fa-angles-right"></i></a></div>
                <div class="BoxRight">
                    Agoda box | Booking box
                </div>
            </div>
        </div>
    </div>
    <!-- HotelList -->

</div>
<!-- End TypeSectionTkicky -->

<!-- PostReccommend -->
<div class="PostReccommend">
    <div class="PostReccommendBox">
        <div class="Header">
            <h2><i class="fa-regular fa-thumbs-up"></i> บทความและข่าวสารอัพเดท</h2>
            <div class="SeeAll"><a href="<?php echo get_bloginfo("url"); ?>/blog" title="บทความและข่าวสารอัพเดท">ดูทั้งหมด <i class="fa-solid fa-angles-right"></i></a></div>
        </div>
        <?php
            $wp_query = null;
            $wp_query = new WP_Query( array('post_type'=>'blog','showposts'=>'6','orderby'=>'date','order'=>'DESC','post_status'=>'publish'));
            if ($wp_query->have_posts()) {
        ?>
        <ul>
            <?php
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$image_id = get_post_thumbnail_id(get_the_ID());
					$image_url = wp_get_attachment_image_src($image_id, 'large', true);
					if(empty($image_id)){$image_url[0] = get_bloginfo('template_directory').'/assets/images/no-photo.jpg';}	

                    $first_category = wp_get_post_terms( get_the_ID(), 'blog_category' )[0]->name;
			?>
            <li>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <p class="Picture"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></p>
                <p class="Title"><?php the_title(); ?></p>
                <p class="DateTime"><span><i class="fa-regular fa-calendar-days"></i> อัพเดท : <?php the_modified_date('d.m.Y'); ?></span> <span class="TypeShow"><?php echo $first_category; ?></span></p>
                </a>
            </li>
            <?php endwhile; ?>
        </ul>
        <div class="Viewall"><a href="<?php echo get_bloginfo("url"); ?>/blog" title="บทความและข่าวสารทั้งหมด">บทความและข่าวสารทั้งหมด <i class="fa-solid fa-angles-right"></i></a></div>
        <?php }else{ ?>
            <p class="EmptyData">ยังไม่มีบทความและข่าวสาร</p>
        <?php } ?>
        <?php wp_reset_postdata(); ?>
    </div>
</div>
<!-- End PostReccommend -->

<?php get_footer(); ?>