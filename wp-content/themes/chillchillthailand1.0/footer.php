<!-- Footer -->
<footer>
    <!-- FooterBox -->
    <div class="FooterBox">
        <div class="Logo"><h2><span>ชิลชิล</span>ไทยแลนด์</h2></div>
        <div class="FooterLink">
            <ul>
                <?php
                    $categoriesTail = get_categories( array(
                        'orderby' 		=> 'name',
                        'order'   		=> 'ASC',
                        'hide_empty'    => false,
                        'parent'  		=> 0
                    ) );
                    foreach ( $categoriesTail as $categoryTail ) {
                ?>
                <li>
                    <p><a href="<?php echo esc_url( get_category_link( $categoryTail->term_id ) ); ?>" title="<?php echo esc_html( $categoryTail->name ); ?>"><?php echo esc_html( $categoryTail->name ); ?></a></p>
                    <ul>
                        <?php
                        $SubcategoryTail = array(
                            'orderby'       => 'name', 
                            'order'   		=> 'ASC',
                            'parent'        => $categoryTail->term_id,
                            'hide_empty'    => false
                        );
                        $SubcategoriesTail = get_categories( $SubcategoryTail );
                        foreach ($SubcategoriesTail as $SubcategoryTailShow) {
                            echo '<li><a href="'.esc_url( get_category_link( $SubcategoryTailShow->term_id ) ).'" title="'.$SubcategoryTailShow->name.'">'.$SubcategoryTailShow->name.'</a></li>';
                        }
                        ?>
                    </ul>
                </li>
                <?php } ?>
                <li class="Icon">
                    <p>ติดตามเราได้ที่ :</p>
                    <?php $FooterSNS = get_page('13'); ?>
                    <?php if($FooterSNS->facebook_url!=''){ ?><a href="<?php echo $FooterSNS->facebook_url; ?>" target="_blank" title="ติดตามเราที่ Facebook"><i class="fa-brands fa-square-facebook"></i></a><?php } ?>
                    <?php if($FooterSNS->youtube_url!=''){ ?><a href="<?php echo $FooterSNS->youtube_url; ?>" target="_blank" title="ติดตามเราที่ Youtube"><i class="fa-brands fa-youtube"></i></a><?php } ?>
                    <?php if($FooterSNS->instagram_url!=''){ ?><a href="<?php echo $FooterSNS->instagram_url; ?>" target="_blank" title="ติดตามเราที่ Instagram"><i class="fa-brands fa-instagram"></i></a><?php } ?>
                    <?php if($FooterSNS->line_url!=''){ ?><a href="<?php echo $FooterSNS->line_url; ?>" target="_blank" title="ติดตามเราที่ Line"><i class="fa-brands fa-twitter"></i></a><?php } ?>
                    <?php if($FooterSNS->twitter_url!=''){ ?><a href="<?php echo $FooterSNS->twitter_url; ?>" target="_blank" title="ติดตามเราที่ Twitter"><i class="fa-brands fa-line"></i></a><?php } ?>
                    <?php if($FooterSNS->tiktok_url!=''){ ?><a href="<?php echo $FooterSNS->tiktok_url; ?>" target="_blank" title="ติดตามเราที่ TikTok"><i class="fa-brands fa-tiktok"></i></a><?php } ?>
                </li>
            </ul>
        </div>
        <div class="Copyright">
            <p><a href="<?php echo get_bloginfo("url"); ?>/blog" title="บทความและข่าว">บทความและข่าว</a> <a href="<?php echo get_bloginfo("url"); ?>/about" title="เกี่ยวกับเรา">เกี่ยวกับเรา</a> <a href="<?php echo get_bloginfo("url"); ?>/contact" title="ติดต่อเรา">ติดต่อเรา</a></p>
            <p>Copyright @<?php echo date('Y'); ?> ChillChillThailand.com. <span>All right reserved.</span></p>
        </div>
    </div>
    <!-- End FooterBox -->

    <!-- BacktoTop -->
    <a href="javascript:void(0);" class="cd-top" name="Back to Top">TOP</a>
	<!-- ENd BacktoTop -->
</footer>
<!-- End Footer -->
<?php wp_reset_query(); ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/jquery-migrate-3.4.0.min.js"></script>
<?php if ( is_front_page() || is_archive() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/slick/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        /* TravelSlide */
        $('.TravelSlide').slick({
            autoplay: true,
            autoplaySpeed: 4000,
            arrows: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            fade: true,
            responsive: [
                {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    dots: true,
                }
                }
            ]
        });
    });
</script>
<?php } ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/plugins.js"></script>
<?php if ( is_single() && 'post' == get_post_type() ) { ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/venobox2/venobox.js"></script>
<script type="text/javascript">
	$('.venobox').venobox({});
	new VenoBox({
		selector: '.wp-block-gallery',
	});
</script>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>