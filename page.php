<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * 
 * 
 */

get_header(); ?>

<div id="channelnav">
  <?php wp_nav_menu( array( 'theme_location' => 'generic-menu','depth'  => 3, 'menu_class'  => 'ch-menu', 'fallback_cb' => 'false') ); ?>
 </div>



   <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
	
    <div id="content">
    <?php get_template_part('sidebar-generic'); ?>

	

   
<?php
/* Run the loop to output the page.
 * If you want to overload this in a child theme then include a file
 * called loop-page.php and that will be used instead.
 */
 get_template_part( 'loop', 'page' );
?>
</div>

<?php get_footer(); ?>
</div>