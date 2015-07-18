<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 *
 */
?>
<!--Footer Nav -->

<div id="footer">

<div class="footerwidget">
  <?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
</div>



      <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'fallback_cb' => 'false', 'depth' => 1, 'container_class'=>'footernav') );   ?>
      

   <div id="footercredits">

<!--Legal and Credits --> 


&copy;&nbsp;<?php
echo date("Y");
?> 

 <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
  <?php bloginfo( 'name' ); ?>.</a>
  All rights reserved.  &nbsp;<?php wp_loginout(); ?>
  <div id="footermotto">
  <?php bloginfo('description'); ?> 

</div>
</div>


<!--closing DIVs --> 

</div>
</div>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
wp_footer();
?>

<!--[if IE]>
</div>
<![endif]-->

<script type="text/javascript">
// custom easing called "custom"
$.easing.custom = function (x, t, b, c, d) {
	var s = 1.70158; 
	if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
	return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
}



// use the custom easing
$("div.scrollable").scrollable({easing: 'custom', speed: 700, circular: true});
</script>


</body>
</html>