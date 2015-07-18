<?php
/**
 * The Sidebar containing Generic widget areas.
 *
 * @package WordPress
 *
 */
?>

		<div id="primary" class="widget-area" role="complementary">
			<ul id="sidebar_right">

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'generic-widget-area' ) ) : ?>
	
		
			

		<?php endif; // end generic widget area ?>
			</ul>
		<!-- #generic .widget-area -->


</div>
