<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php wp_title(''); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/style-responsive.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/nav.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/fontawesome/css/all.css">
<link rel="icon" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon.png" type="image" sizes="1000x1000">
<!-- End CSS -->
<?php if ( is_front_page() || is_archive() ){ ?>
<!-- SlickSlider -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/slick/slick-theme.css"/>
<!-- End SlickSlider -->
<?php } ?>
<?php if ( is_single() && 'post' == get_post_type() ) { ?>
<link href="<?php bloginfo('template_directory'); ?>/assets/venobox2/venobox.css" rel="stylesheet" />
<?php } ?>
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
<!-- End Fonts -->
<?php wp_head(); ?>
<!-- Google tag (gtag.js) -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=G-6311KYPCXJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-6311KYPCXJ');
</script>-->
<!-- Google Tag Manager -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-MQDX7L8XJJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-MQDX7L8XJJ');
</script>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PL8WZX7S');</script>
<!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PL8WZX7S"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Header -->
<header class="TopHeader">
	<div class="MenuBox">
		<div class="Logo"><a href="<?php echo get_bloginfo("url"); ?>" title="<?php echo get_bloginfo( 'description' ); ?>"><span>ชิลชิล</span>ไทยแลนด์</a></div>
		<div class="MenuList">
			<nav>
				<h2><span>ชิลชิล</span>ไทยแลนด์</a></h2>
				<ul>
					<a href="javascript:void(0);" class="btn-close" name="Close menu"><i class="fa-solid fa-xmark"></i></a>
					<li><a href="<?php echo get_bloginfo("url"); ?>" title="หน้าแรก">หน้าแรก</a></li>
					<?php
						$categories = get_categories( array(
							'orderby' 		=> 'name',
							'order'   		=> 'ASC',
							'hide_empty'    => false,
							'parent'  		=> 0
						) );
						foreach ( $categories as $category ) {
					?>
					<li><a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo esc_html( $category->name ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
					<?php } ?>
					<li><a href="<?php echo get_bloginfo("url"); ?>/blog" title="บทความและข่าว">บทความและข่าว</a></li>
					<li><a href="<?php echo get_bloginfo("url"); ?>/contact" title="ติดต่อเรา">ติดต่อเรา</a></li>
				</ul>
			</nav>
			<div class="Others">
				<div class="Search"><?php get_search_form(); ?></div>
			</div>
			<div class="OthersSocialBox Icon">
				<p>ติดตามเราได้ที่ :</p>
				<?php $HeaderSNS = get_page('13'); ?>
				<?php if($HeaderSNS->facebook_url!=''){ ?><a href="<?php echo $HeaderSNS->facebook_url; ?>" target="_blank" title="ติดตามเราที่ Facebook"><i class="fa-brands fa-square-facebook"></i></a><?php } ?>
				<?php if($HeaderSNS->youtube_url!=''){ ?><a href="<?php echo $HeaderSNS->youtube_url; ?>" target="_blank" title="ติดตามเราที่ Youtube"><i class="fa-brands fa-youtube"></i></a><?php } ?>
				<?php if($HeaderSNS->instagram_url!=''){ ?><a href="<?php echo $HeaderSNS->instagram_url; ?>" target="_blank" title="ติดตามเราที่ Instagram"><i class="fa-brands fa-instagram"></i></a><?php } ?>
				<?php if($HeaderSNS->line_url!=''){ ?><a href="<?php echo $HeaderSNS->line_url; ?>" target="_blank" title="ติดตามเราที่ Line"><i class="fa-brands fa-twitter"></i></a><?php } ?>
				<?php if($HeaderSNS->twitter_url!=''){ ?><a href="<?php echo $HeaderSNS->twitter_url; ?>" target="_blank" title="ติดตามเราที่ Twitter"><i class="fa-brands fa-line"></i></a><?php } ?>
				<?php if($HeaderSNS->tiktok_url!=''){ ?><a href="<?php echo $HeaderSNS->tiktok_url; ?>" target="_blank" title="ติดตามเราที่ TikTok"><i class="fa-brands fa-tiktok"></i></a><?php } ?>
			</div>
		</div>
	</div>
	<a href="javascript:void(0);" title="ลิงค์เมนู" name="ลิงค์เมนู" class="btn-nav"><i class="fa-solid fa-bars"></i></i></a>
</header>
<!-- End Header -->