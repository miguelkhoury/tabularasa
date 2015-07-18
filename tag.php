<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 *
 */

get_header(); ?>

<div id="channelnav">
  <?php wp_nav_menu( array( 'theme_location' => 'generic-menu','depth'  => 2, 'menu_class'  => 'ch-menu') ); ?>
 </div>



   <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
	
    <div id="content">
    <?php get_template_part('sidebar-generic'); ?>
<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
?>
</div>


<?php get_footer(); ?>
