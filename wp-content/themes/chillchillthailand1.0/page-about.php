<?php get_header(); ?>

    <!-- BreadcrumbsCCT -->
    <div class="BreadcrumbsCCT">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	</div>
	<!-- End BreadcrumbsCCT -->

    <!-- HeaderPage -->
	<div class="HeaderPage clr">
        <div class="HeaderPageBox">
            <h1>เกี่ยวกับเรา</h1>
        </div>
    </div>
    <!-- HeaderPage -->

	<!-- AboutUs -->
    <div class="AboutUs">
        <div class="AboutUsBox">
            <?php the_content('Read the rest of this entry &raquo;'); ?>
        </div>
        <div class="AuthorsList">
            <h2>นักเขียนของเรา</h2>
            <ul>
                <?php
                    $args = array(
                        'role'    => 'editor',
                        'orderby' => 'user_nicename',
                        'order'   => 'ASC'
                    );
                    $users = get_users( $args );
                    foreach ( $users as $user ) {
                ?>
                <li>
                <?php
                    //$author_id = get_the_author_meta( 'ID' );
                    //$face = get_field('blogger_photo', 'user_'.$user->ID);
                    $author_badge = get_field('blogger_photo', 'user_'. $user->ID );
                    $size = 'thumbnail';
                ?>
                    <p class="AuthorImage"><img src="<?php echo $author_badge['url']; ?>" width="<?php echo $author_badge['sizes']['large-width']; ?>" height="<?php echo $author_badge['sizes']['large-height']; ?>" /></p>
                    <p class="AuthorName"><?php echo esc_html( $user->user_nicename ); ?></p>
                    <p class="Bio"><?php echo $user->user_description; ?></p>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!-- End AboutUs -->

<?php get_footer(); ?>