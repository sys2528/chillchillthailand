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

	/* DisplayCategory */
	$categories = get_the_category();
	if ( ! empty( $categories ) ) {
	    $cateConnect = esc_html( $categories[0]->slug );
	    $cateConnectName = esc_html( $categories[0]->name );  
	}
?>
<br><br><br>
<h1>Blog : <?php echo $taxonomy_name; ?></h1>

<?php get_footer(); ?>