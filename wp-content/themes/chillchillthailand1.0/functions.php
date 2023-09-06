<?php
	require_once locate_template('lib/pagination.php');

	// Featured Image
	if ( function_exists( 'add_theme_support' ) ) { 
	  add_theme_support( 'post-thumbnails' );
	}

	// Hide action_scheduler_pastdue_actions_check_pre
	add_filter( 'action_scheduler_pastdue_actions_check_pre', '__return_false' );

	/*  set_posts_per_page */
	/*add_action( 'pre_get_posts',  'set_posts_per_page'  );
	function set_posts_per_page( $query ) {
		if (!is_admin() && $query->is_post_type_archive('blog')) {
			$query->set( 'posts_per_page', 12 );
		}
		if (!is_admin() && $query->is_post_type_archive('post')) {
			$query->set( 'posts_per_page', 12 );
		}
	}*/
	/*  End set_posts_per_page */

	/* Registers support for editor styles & Enqueue it. */
	function editor_styles_setup() {
		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		// Enqueue editor styles.
		add_editor_style( 'assets/css/custom-style.css' );
	}
	add_action( 'after_setup_theme', 'editor_styles_setup' );

	/* Get Facilities */
	function GetFacilities($PostID){
		$hotels_facilities = get_field('hotels_facilities',$PostID);
        $CountFacilities = count($hotels_facilities);
		if( $hotels_facilities ){
			$f = 1;
			foreach( $hotels_facilities as $hotels_facility ){
				if($f<=6){
					if($hotels_facility=='wifi'){ echo '<i class="fa-solid fa-wifi" title="อินเทอร์เน็ต Wi-Fi"></i> '; }
					if($hotels_facility=='park'){ echo '<i class="fa-solid fa-square-parking" title="ที่จอดรถ"></i> '; }
					if($hotels_facility=='pool'){ echo '<i class="fa-solid fa-person-swimming" title="สระว่ายน้ำ"></i> '; }
					if($hotels_facility=='coffee'){ echo '<i class="fa-solid fa-mug-hot" title="กาแฟสำเร็จรูป"></i> '; }
					if($hotels_facility=='breakfast'){ echo '<i class="fa-solid fa-bell-concierge" title="อาหารเช้า"></i> '; }
					if($hotels_facility=='fitness'){ echo '<i class="fa-solid fa-dumbbell" title="ฟิตเนส"></i> '; }
					if($hotels_facility=='bar'){ echo '<i class="fa-solid fa-wine-glass" title="บาร์"></i> '; }
					if($hotels_facility=='balcony'){ echo '<i class="fa-solid fa-door-closed" title="ระเบียง/ชานเรือน"></i> '; }
					if($hotels_facility=='kitchen'){ echo '<i class="fa-solid fa-kitchen-set" title="ห้องครัว"></i> '; }
					if($hotels_facility=='air'){ echo '<i class="fa-regular fa-snowflake" title="เครื่องปรับอากาศ"></i> '; }
					if($hotels_facility=='fridge'){ echo '<i class="fa-solid fa-icicles" title="ตู้เย็น"></i> '; }
					if($hotels_facility=='smoking_area'){ echo '<i class="fa-solid fa-smoking" title="พื้นที่สูบบุหรี่"></i> '; }
					//if($hotels_facility=='xxxxxx'){ echo 'xxxxxx'; }
				}
			$f++;
		  }
		  if($CountFacilities>6){ echo '+'.($CountFacilities-6); }
		}
	}

	/* Get Facilities Full */
	function GetFacilitiesFull($PostID){
		$hotels_facilities = get_field('hotels_facilities',$PostID);
        $CountFacilities = count($hotels_facilities);
		if( $hotels_facilities ){
			echo '<ul>';
			foreach( $hotels_facilities as $hotels_facility ){
					if($hotels_facility=='wifi'){ echo '<li><i class="fa-solid fa-wifi"></i>อินเทอร์เน็ต Wi-Fi</i></li>'; }
					if($hotels_facility=='park'){ echo '<li><i class="fa-solid fa-square-parking" title="ที่จอดรถ"></i>ที่จอดรถ</li>'; }
					if($hotels_facility=='pool'){ echo '<li><i class="fa-solid fa-person-swimming" title="สระว่ายน้ำ"></i>สระว่ายน้ำ</li>'; }
					if($hotels_facility=='coffee'){ echo '<li><i class="fa-solid fa-mug-hot" title="กาแฟสำเร็จรูป"></i>กาแฟสำเร็จรูป</li>'; }
					if($hotels_facility=='breakfast'){ echo '<li><i class="fa-solid fa-bell-concierge" title="อาหารเช้า"></i>อาหารเช้า</li>'; }
					if($hotels_facility=='fitness'){ echo '<li><i class="fa-solid fa-dumbbell" title="ฟิตเนส"></i>ฟิตเนส</li>'; }
					if($hotels_facility=='bar'){ echo '<li><i class="fa-solid fa-wine-glass" title="บาร์"></i>บาร์</li>'; }
					if($hotels_facility=='balcony'){ echo '<li><i class="fa-solid fa-door-closed" title="ระเบียง/ชานเรือน"></i>ระเบียง/ชานเรือน</li>'; }
					if($hotels_facility=='kitchen'){ echo '<li><i class="fa-solid fa-kitchen-set" title="ห้องครัว"></i>ห้องครัว</li>'; }
					if($hotels_facility=='air'){ echo '<li><i class="fa-regular fa-snowflake" title="เครื่องปรับอากาศ"></i>เครื่องปรับอากาศ</li>'; }
					if($hotels_facility=='fridge'){ echo '<li><i class="fa-solid fa-icicles" title="ตู้เย็น"></i>ตู้เย็น</li>'; }
					if($hotels_facility=='smoking_area'){ echo '<li><i class="fa-solid fa-smoking" title="พื้นที่สูบบุหรี่"></i>พื้นที่สูบบุหรี่</li>'; }
					//if($hotels_facility=='xxxxxx'){ echo 'xxxxxx'; }
		  }
		  echo '</ul>';
		}
	}

	/* Password form */
	function my_custom_password_form() {
		global $post;
		$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
		$output = '
		<div class="ProtectPostBox">
			<div class="container">
				<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="form-inline post-password-form" method="post">
					<p>' . __( 'กรุณากรอกรหัสผ่านเพื่อดูบทความนี้.' ) . '</p>
					<label for="' . $label . '">' . __( 'รหัสผ่าน : ' ) . ' <input name="post_password" id="' . $label . '" type="password" size="20" class="form-control" /></label> <button type="submit" name="Submit" class="button-primary">' . esc_attr_x( 'ส่ง', 'post password form' ) . '</button>
				</form>
			</div>
		</div>';
		return $output;
	}
	add_filter('the_password_form', 'my_custom_password_form', 99);

	function strlenth($str)
	{
	$arr = str_split($str);
	$count = 0;
		foreach($arr as $val)
		{
			$ascii = ord($val);
			if(!( $ascii == 209 ||  ($ascii >= 212 && $ascii <= 218 ) || ($ascii >= 231 && $ascii <= 238 )))
				$count += 1;
		}
		return $count;
	}

?>