<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 *
 */

get_template_part('header-empty'); ?>

<div id="channelnav">
  <?php wp_nav_menu( array( 'theme_location' => 'generic-menu','depth'  => 3, 'menu_class'  => 'ch-menu', 'fallback_cb' => 'false' ) ); ?>
 </div>


    

<div id="content">


<?php if ( have_posts() ) : ?>
				<h1><?php printf( __( 'Search Results for: %s', 'tabularasa' ), '' . get_search_query() . '' ); ?></h1>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
				 <h1 class="entry-title">
                  <?php _e( 'Blank Stare. Crickets Chirping.', 'tabularasa' ); ?>
               </h1>
					
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'tabularasa' ); ?></p>
						<?php get_search_form(); ?>
					
				</div><!-- #post-0 -->
<?php endif; ?>
</div>



<?php get_footer(); ?>

</div>
