<?php
/**
 * The template for displaying attachments.
 *
 * @package WordPress

 */

get_header(); ?>

 <div id="channelnav">
  <?php wp_nav_menu( array( 'theme_location' => 'generic-menu','depth'  => 3, 'menu_class'  => 'ch-menu', 'fallback_cb' => 'false' ) ); ?>
 </div>


<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
    
<div id="content">

      
<?php
/* Run the loop to output the page.
 * If you want to overload this in a child theme then include a file
 * called loop-page.php and that will be used instead.
 */
 get_template_part( 'loop', 'attachment' );
?>
</div>



<?php get_footer(); ?>

</div>



