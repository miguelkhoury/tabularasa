<?php
/**
 * Template Name: Portal 1 No Sidebar
 *
 * A custom page template for Portal 1 Navigation, with no sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * 
 * 
 */

get_header(); ?>

  <div id="channelnav">
  <?php wp_nav_menu( array( 'theme_location' => 'channel1-menu','depth'  => 3, 'menu_class'  => 'ch-menu', 'fallback_cb' => 'false' ) ); ?>
 </div>
  <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
 
 <div id="content">



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



