<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 *
 * 
 */

get_template_part('header-empty'); ?>

<div id="channelnav">
  <?php wp_nav_menu( array( 'theme_location' => 'generic-menu','depth'  => 3, 'menu_class'  => 'ch-menu', 'fallback_cb' => 'false') ); ?>
</div>


   


<div id="content">
                <h1 class="entry-title">
                  <?php _e( 'Blank Stare. Crickets Chirping.', 'tabularasa' ); ?>
               </h1>
				
				<p><?php _e( 'Um, the page you requested could not be found. Perhaps searching will help.', 'tabularasa' ); ?></p>
				
				<?php get_search_form(); ?>
              
			
             
</div>
    



  <?php get_footer(); ?>