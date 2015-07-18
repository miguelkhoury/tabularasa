<?php
/**
* The  Sidebar containing the Channel 4 widget area.
*
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
	if ( ! dynamic_sidebar( 'ch4-widget-area' ) ) : ?>
	
		
			

		<?php endif; // end primary widget area ?>
			</ul>
		<!-- #channel4 .widget-area -->


</div>
