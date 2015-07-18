<?php
/**
 * Template Name: Scrollable Post Page
 *

 *
 */

get_header(); ?>

<div id="channelnav">
  <?php wp_nav_menu( array( 'theme_location' => 'generic-menu','depth'  => 3, 'menu_class'  => 'ch-menu', 'fallback_cb' => 'false' ) ); ?>
 </div>


    

  <div id="content">

      
      <?php
	/* Run the loop to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-index.php and that will be used instead.
	 */
	 get_template_part( 'loop-scrollable', 'page' );
	?>

<?php get_footer(); ?>
</div>
</div>

