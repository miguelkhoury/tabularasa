<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * 
 * 
 */

get_header(); ?>

 <div id="channelnav">
  <?php wp_nav_menu( array( 'theme_location' => 'blog-menu','depth'  => 3, 'menu_class'  => 'ch-menu', 'fallback_cb' => 'false' ) ); ?>
 </div>




   
    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
	<div id="content">
		<?php get_template_part('sidebar-blog'); ?>
        
				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '' . $category_description . '';

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'category' );
				?>
 </div>




<?php get_footer(); ?>

