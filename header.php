<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package WordPress
 * 
 * 
 */
?>
            
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>><head>
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
<meta charset="<?php get_template_directory_uri( 'charset' ); ?>" />


<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_option( 'blogdescription', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'tabularasa' ), max( $paged, $page ) );

	?></title>
	

        
        
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<?php
	/*If the post has the 'css' custom field, load a stylesheet
	 *The stylesheet to load is based on the value of the 'css' field
	 */
	if ( get_post_meta($post->ID, 'css', true) ) 
	{
		$style = get_post_meta($post->ID, 'css', true);
		$stylepath = get_stylesheet_directory_uri('template_url') . '/' . $style . '.css';
		echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"$stylepath\" />\n";
	}
?>


<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();

?>

 <script type="text/javascript">

		// Initialize functions
		jQuery(function(){
			jQuery('ul.ch-menu').superfish();
		
		});
		
	
		</script>



</head>
<?php
$url = explode('/',$_SERVER['REQUEST_URI']);
$dir = $url[1] ? $url[1] : 'home';
?>
<body id="<?php echo $dir ?>" <?php body_class(); ?>>

<!--[if IE]>
<div id="ie">
<![endif]-->






               
<div id="wrapper">


  <div id="container">
  <div id="header">
  
  <div id="header_widget">
    <?php get_template_part('sidebar-header'); ?>
  </div>
  
  <div id="adminnav">
    <?php wp_nav_menu( array( 'theme_location' => 'admin','menu_class'  => 'admin-menu', 'fallback_cb' => 'false') ); ?>
  
    

  
  </div>

  
  <div class="branding_transparency" id="branding"><a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
    <?php bloginfo( 'name' ); ?>
  </a></div>
  
  
  <div class="motto_transparency" id="motto">
    <?php bloginfo( 'description' ); ?>
  </div>
  
  

  
  <?php              
                    
// Check if this post or page has the page-banner custom field

  
 ?>
    
   <?php    if (get_post_meta($post->ID, 'page-banner', true)) { ?>
  <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php bloginfo('url'); ?>/wp-content/uploads/<?php echo get_post_meta($post->ID, 'page-banner', true) ?>&a=t&w=<?php echo HEADER_IMAGE_WIDTH; ?>&h=<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo('name'); ?>"width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" class="optionalheader" />
  
  <?php } else { ?>
  
 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php header_image(); ?>&a=t&w=<?php echo HEADER_IMAGE_WIDTH; ?>&h=<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo('name'); ?>" class="optionalheader" />
  <?php } ?>
  
 
  
  
  </div>
