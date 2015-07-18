<?php
/**
  * Template Name: Blog
 *
 * This is the blog template for tabula rasa. It includes the blog sidebar
 *
 * @package WordPress
 */

get_header(); ?>

<div id="channelnav">
  <?php wp_nav_menu( array( 'theme_location' => 'blog-menu','depth'  => 3, 'menu_class'  => 'ch-menu', 'fallback_cb' => 'false' ) ); ?>
 </div>
  <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
<div id="content">

  
  


<?php get_template_part('sidebar-blog'); ?>

	<?php
	/* Run the loop to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-index.php and that will be used instead.
	 */
	 get_template_part( 'loop', 'single' );
	?>
    </div>
    

<?php get_footer(); ?>

</div>


