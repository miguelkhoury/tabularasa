<?php
/**
 * Template Name: No Portal Nav or Sidebar
 *
 * A page with no portal navigation and no sidebar.
 *
 * @package WordPress
 * 
 * 
 */

get_header(); ?>


   
    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
    
<div id="content">
    
<?php
/* Run the loop to output the page.
 * If you want to overload this in a child theme then include a file
 * called loop-page.php and that will be used instead.
 */
 get_template_part( 'loop', 'single' );
?>
</div>


<?php get_footer(); ?>


</div>

