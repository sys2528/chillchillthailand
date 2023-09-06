<?php get_header(); ?>

    <!-- BreadcrumbsCCT -->
    <div class="BreadcrumbsCCT">
        <nav aria-label="breadcrumbs" class="rank-math-breadcrumb"><p><a href="<?php echo get_bloginfo("url"); ?>">หน้าแรก</a><span class="separator"> - </span><span class="last">บทความและข่าวสาร</span></p></nav>
	</div>
	<!-- End BreadcrumbsCCT -->

    <!-- HeaderPage -->
    <div class="HeaderPage">
        <div class="HeaderPageBox">
            <h1>บทความและข่าวสาร</h1>
            <p class="Captions">อัพเดทข่าวสารเกี่ยวกับเรื่องเที่ยว บทความที่น่าสนใจเกี่ยวกับเรื่องเที่ยว เรื่องน่ารู้ สถานที่เที่ยว ที่กิน ที่พัก วัฒนธรรม รวมถึงกิจกรรมที่น่าสนใจในประเทศไทย</p>
        </div>
    </div>
    <!-- HeaderPage -->

    <!-- PostReccommend -->
    <div class="PostReccommend" style="padding-top:20px;background-image:none;">
        <div class="PostReccommendBox">
            <?php
                $wp_query = null;
                $wp_query = new WP_Query( array('post_type'=>'blog','orderby'=>'date','order'=>'DESC','post_status'=>'publish','paged'=>$paged));
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
                    <p class="Picture"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>"></a></p>
                    <p class="Title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
                    <p class="DateTime"><span><i class="fa-regular fa-clock"></i> <?php the_modified_date('d.m.Y'); ?></span> <span class="TypeShow"><?php echo $first_category; ?></span></p>
                </li>
                <?php endwhile; ?>
            </ul>
            <?php }else{ ?>
                <p class="EmptyData">ยังไม่มีบทความและข่าวสาร</p>
            <?php } ?>
        </div>
        <?php pagination(); wp_reset_postdata(); ?>
    </div>
    <!-- End PostReccommend -->

<?php get_footer(); ?>