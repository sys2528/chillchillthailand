<?php
	require_once locate_template('lib/pagination.php');

	// Featured Image
	if ( function_exists( 'add_theme_support' ) ) { 
	  add_theme_support( 'post-thumbnails' );
	}

	// Hide action_scheduler_pastdue_actions_check_pre
	add_filter( 'action_scheduler_pastdue_actions_check_pre', '__return_false' );

	/*  set_posts_per_page */
	add_action( 'pre_get_posts',  'set_posts_per_page'  );
	function set_posts_per_page( $query ) {
		/* video */
		if (!is_admin() && $query->is_post_type_archive('blog')) {
			$query->set( 'posts_per_page', 12 );
		}
		/* news */
		if (!is_admin() && $query->is_post_type_archive('post')) {
			$query->set( 'posts_per_page', 12 );
		}
	}
	/*  End set_posts_per_page */

	/* Registers support for editor styles & Enqueue it. */
	function editor_styles_setup() {
		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		// Enqueue editor styles.
		add_editor_style( 'assets/css/custom-style.css' );
	}
	add_action( 'after_setup_theme', 'editor_styles_setup' );

?>