<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 *
 */

get_header(); ?>

<div id="channelnav">
  <?php wp_nav_menu( array( 'theme_location' => 'generic-menu','depth'  => 3, 'menu_class'  => 'ch-menu', 'fallback_cb' => 'false' ) ); ?>
 </div>

<div id="content">

   
    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

<?php get_template_part('sidebar-generic'); ?>

<?php
	/* Queue the first post, that way we know
	 * what date we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>

	
  <h2 >
    <?php if ( is_day() ) : ?>
    <?php printf( __( 'Daily Archives: %s', 'tabularasa' ), get_the_date() ); ?>
    <?php elseif ( is_month() ) : ?>
    <?php printf( __( 'Monthly Archives: %s', 'tabularasa' ), get_the_date('F Y') ); ?>
    <?php elseif ( is_year() ) : ?>
    <?php printf( __( 'Yearly Archives: %s', 'tabularasa' ), get_the_date('Y') ); ?>
    <?php else : ?>
    <?php _e( 'Blog Archives', 'tabularasa' ); ?>
    <?php endif; ?>
  </h2>
   

<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	/* Run the loop for the archives page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-archives.php and that will be used instead.
	 */
	 get_template_part( 'loop', 'archive' );
?>
</div>


<?php get_footer(); ?>








