<?php
/**
 * Tabula Rasa functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, tabularasa_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'tabularasa_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 *
 */
 
 
 /* 
 * Loads the Options Panel
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {

	/* Set the file path based on whether we're in a child theme or parent theme */

	if ( STYLESHEETPATH == TEMPLATEPATH ) {
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');
	} else {
		define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('stylesheet_directory') . '/admin/');
	}

	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() {?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>
<?php
}
 




 // Add jquery scripts
 
function add_our_scripts() {
 
    if (!is_admin()) { // Add the scripts, but not to the wp-admin section.
    // Adjust the below path to where scripts dir is, if you must.
    $scriptdir = get_bloginfo('template_directory')."/scripts/";
 
    // Remove the wordpress inbuilt jQuery.
    wp_deregister_script('jquery');
 
    // Lets use the one from Google AJAX API instead.
    wp_register_script( 'jquery', 'http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js', false, '1.2.6');
    // Register the Superfish javascript file
    wp_register_script( 'superfish', $scriptdir.'superfish.js', false, '1.4.8');
    wp_register_script( 'hoverIntent', $scriptdir.'hoverIntent.js', false, '1.4.8');
	
	
 
    //load the scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('superfish');
    wp_enqueue_script('hoverIntent');
	
    } // end the !is_admin function
} //end add_our_scripts function
 
//Add our function to the wp_head. You can also use wp_print_scripts.
add_action( 'wp_head', 'add_our_scripts',0);

/**Breadcrumbs**/
 function dimox_breadcrumbs() {
 
  $delimiter = '/';
  $home = 'Home'; // text for the 'Home' link
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
 
    echo '<div id="crumbs">';
 
    global $post;
    $homeLink = get_bloginfo('url');
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
	
	if ( !is_home() && !is_front_page() || is_paged() ) {
	}
	elseif ( is_home() ) {
    echo $before;
    wp_title("");
    echo $after;
	

}
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo '<a href="/blog" rel="nofollow">Blog</a> ' . $delimiter . ' ' . get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat;
  
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
 // end dimox_breadcrumbs()
 
 
 
 
 
 //  Advanced Editing Buttons Using TinyMCE

 

function disable_mce_buttons( $opt ) {
	$opt['theme_advanced_disable'] = '';
	return $opt;
}
add_filter('tiny_mce_before_init', 'disable_mce_buttons');

function custom_options( $opt ) {
	//format drop down list
	$opt['theme_advanced_blockformats'] = 'p,h1,h2,h3';
	

	
	return $opt;
}
add_filter('tiny_mce_before_init', 'custom_options');

/*
Plugin Name: Custom Styles Dropdown
Plugin URI: http://alisothegeek.com/2011/05/tinymce-styles-dropdown-wordpress-visual-editor/
Description: This plugin is a base for deep customization of the Styles dropdown menu in the visual post editor.
Author: Aliso the Geek
Version: 1.0
Author URI: http://alisothegeek.com/
*/

add_editor_style();

add_filter( 'mce_buttons_2', 'atg_mce_buttons_2' );

function atg_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

add_filter( 'tiny_mce_before_init', 'atg_mce_before_init' );

function atg_mce_before_init( $settings ) {

    $style_formats = array(
    	array(
        	'title' => 'Big Text',
        	'inline' => 'span',
        	'styles' => array(
        		'color' => 'inherit',
        		'fontWeight' => 'light',
				'fontSize' => '200%',
				'lineHeight' => '1.2em',
				
        	)
        ),
		
		
		
		array(
    		'title' => 'Button',
    		'selector' => 'a',
    		'classes' => 'button'
    	),
		
		
		/* extra arrays that are currently commented out. Add them in when ready !
        array(
        	'title' => 'Callout Box',
        	'block' => 'div',
        	'classes' => 'callout',
        	'wrapper' => true
        )*/
		
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}

/* Style Format Options

title [required]              label for this dropdown item

selector|block|inline         selector limits the style to a specific HTML
[required]                    tag, and will apply the style to an existing tag
                              instead of creating one
                              
                              block creates a new block-level element with the
                              style applied, and will replace the existing block
                              element around the cursor
                              
                              inline creates a new inline element with the style
                              applied, and will wrap whatever is selected in the
                              editor, not replacing any tags

classes [optional]            space-separated list of classes to apply to the
                              element

styles [optional]             array of inline styles to apply to the element
                              (two-word attributes, like font-weight, are written
                              in Javascript-friendly camel case: fontWeight)

attributes [optional]         assigns attributes to the element (same syntax as styles)

wrapper [optional,            if set to true, creates a new block-level element
default = false]              around any selected block-level elements

exact [optional,              disables the "merge similar styles" feature, needed
default = false]              for some CSS inheritance issues

*/


 // end Advanced Editing Buttons Using TinyMCE
 
 

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 625;

/** Tell WordPress to run tabularasa_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'tabularasa_setup' );

if ( ! function_exists( 'tabularasa_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override tabularasa_setup() in a child theme, add your own tabularasa_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
 
 function register_my_menus() {
  register_nav_menus(
    array( 'channel1-menu' => __( 'Portal 1 Menu' ), 'channel2-menu' => __( 'Portal 2 Menu' ), 'channel3-menu' => __( 'Portal 3 Menu' ), 'channel4-menu' => __( 'Portal 4 Menu' ),  'generic-menu' => __( 'Generic Menu' ), 'blog-menu' => __( 'Blog Menu' ),'footer-menu' => __( 'Footer Menu' ))
  );
}

add_action( 'init', 'register_my_menus' );

// add excerpts to pages

function add_page_excerpt_meta_box() { add_meta_box( 'postexcerpt', __('Excerpt'), 'post_excerpt_meta_box', 'page', 'normal', 'core' ); }

add_action( 'admin_menu', 'add_page_excerpt_meta_box' );

function tabularasa_setup() {
	
	

// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	
	if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );
if ( function_exists( 'add_image_size' ) ) 
	

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'tabularasa', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'admin' => __( 'Top Tabbed Navigation', 'tabularasa' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	if ( ! defined( 'HEADER_TEXTCOLOR' ) )
		define( 'HEADER_TEXTCOLOR', '' );

	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	if ( ! defined( 'HEADER_IMAGE' ) )
		define( 'HEADER_IMAGE', '%s/images/headers/sky.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to tabularasa_header_image_width and tabularasa_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'tabularasa_header_image_width', 955 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'tabularasa_header_image_height', 141 ) );

	

	// Don't support text inside the header image.
	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See tabularasa_admin_header_style(), below.
	add_custom_image_header( '', 'tabularasa_admin_header_style' );

	// ... and thus ends the changeable header business.

		// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
		register_default_headers( array(
			'sky' => array(
				'url' => '%s/images/headers/sky.jpg',
				'thumbnail_url' =>'%s/images/headers/sky_thumb.jpg',
				/* translators: header image description */
				'description' => __( 'sky', 'tabularasa' )
			),
		
			
			'white' => array(
				'url' => '%s/images/headers/white.jpg',
				'thumbnail_url' =>'%s/images/headers/white_thumb.jpg',
				/* translators: header image description */
				'description' => __( 'blank', 'tabularasa' )
			),
		
	)
);
}
endif;

if ( ! function_exists( 'tabularasa_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in tabularasa_setup().
 *
 * @since Twenty Ten 1.0
 */
function tabularasa_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;



/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function tabularasa_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'tabularasa_page_menu_args' );





/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function tabularasa_excerpt_length( $length ) {
	return 200;
}
add_filter( 'excerpt_length', 'tabularasa_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function tabularasa_continue_reading_link() {
	return '<p> <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'tabularasa' ) . '</a></p>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and tabularasa_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function tabularasa_auto_excerpt_more( $more ) {
	return ' &hellip;' . tabularasa_continue_reading_link();
}
add_filter( 'excerpt_more', 'tabularasa_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function tabularasa_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= tabularasa_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'tabularasa_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Twenty Ten 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @since Twenty Ten 1.0
 * @deprecated Deprecated in Twenty Ten 1.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function tabularasa_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'tabularasa_remove_gallery_css' );

if ( ! function_exists( 'tabularasa_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own tabularasa_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function tabularasa_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s ', 'tabularasa' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'tabularasa' ); ?></em>
			
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'tabularasa' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'tabularasa' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'tabularasa' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'tabularasa' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;



function comment_reform ($arg) {
$arg['title_reply'] = __('Share Your Thoughts');
return $arg;
}
add_filter('comment_form_defaults','comment_reform');







/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override tabularasa_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function tabularasa_widgets_init() {
	
	
	/** New way which helps collapse when not needed Does not use UL or LI
	
	
	register_sidebar( array(
		'name' => __( 'Default Sidebar Area', 'prescriptiveit' ),
		'id' => 'generic-widget-area',
		'description' => __( 'The default sidebar widget area', 'prescriptiveit' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	
	**/
	
	
	register_sidebar( array(
		'name' => __( 'Header Widget', 'tabularasa' ),
		'id' => 'header-widget-area',
		'description' => __( 'The header widget area. Add or remove the Search widget here', 'tabularasa' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	register_sidebar( array(
		'name' => __( 'Home Info Widget', 'tabularasa' ),
		'id' => 'home-widget-area',
		'description' => __( 'The home info widget area', 'tabularasa' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	
	register_sidebar( array(
		'name' => __( 'Generic Widget', 'tabularasa' ),
		'id' => 'generic-widget-area',
		'description' => __( 'The generic widget area', 'tabularasa' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	register_sidebar( array(
		'name' => __( 'Blog Widget', 'tabularasa' ),
		'id' => 'blog-widget-area',
		'description' => __( 'The blog widget area', 'tabularasa' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	
	register_sidebar( array(
		'name' => __( 'Portal 1 Widget', 'tabularasa' ),
		'id' => 'ch1-widget-area',
		'description' => __( 'The channel 1 widget area', 'tabularasa' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	register_sidebar( array(
		'name' => __( 'Portal 2 Widget', 'tabularasa' ),
		'id' => 'ch2-widget-area',
		'description' => __( 'The channel 2 widget area', 'tabularasa' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	register_sidebar( array(
		'name' => __( 'Portal 3 Widget', 'tabularasa' ),
		'id' => 'ch3-widget-area',
		'description' => __( 'The channel 3 widget area', 'tabularasa' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Portal 4 Widget', 'tabularasa' ),
		'id' => 'ch4-widget-area',
		'description' => __( 'The channel 4 widget area', 'tabularasa' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


	

	register_sidebar( array(
		'name' => __( 'Footer Widget', 'tabularasa' ),
		'id' => 'footer-widget-area',
		'description' => __( 'The footer widget area', 'tabularasa' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	
	
}




/** Register sidebars by running tabularasa_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'tabularasa_widgets_init' );



/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
 *
 * @since Twenty Ten 1.0
 */
function tabularasa_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'tabularasa_remove_recent_comments_style' );

if ( ! function_exists( 'tabularasa_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function tabularasa_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'tabularasa' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'tabularasa' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'tabularasa_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function tabularasa_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'tabularasa' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'tabularasa' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'tabularasa' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;



/**
 * Featured image widget
 * Plugin URI: http://wordpress.org/extend/plugins/featured-image-widget/
 * Description: This widget shows the featured image for posts and pages. If a featured image hasn't been set, several fallback mechanisms can be used.
 * Version: 0.2
 * Author: Walter Vos
 * Author URI: http://www.waltervos.nl/
 */

class FeaturedImageWidget extends WP_Widget {
    function FeaturedImageWidget() {
        parent::WP_Widget(false, $name = 'Featured Image Widget');
    }

    function form($instance) {
        $title = esc_attr($instance['title']);
        $instance['image-size'] = (!$instance['image-size'] || $instance['image-size'] == '') ? 'post-thumbnail' : $instance['image-size'];
        ?>
<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tabularasa'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
<p>
    <label for="<?php echo $this->get_field_id('image-size'); ?>">Image size to display:</label>
    <select class="widefat" id="<?php echo $this->get_field_id('image-size'); ?>" name="<?php echo $this->get_field_name('image-size'); ?>">
                <?php foreach (get_intermediate_image_sizes() as $intermediate_image_size) : ?>
        <?php
        $selected = ($instance['image-size'] == $intermediate_image_size) ? ' selected="selected"' : '';
        ?>
        <option value="<?php echo $intermediate_image_size; ?>"<?php echo $selected; ?>><?php echo $intermediate_image_size; ?></option>
                <?php endforeach; ?>
    </select>
</p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $new_instance['title'] = strip_tags($new_instance['title']);
        return $new_instance;
    }

    function widget($args, $instance) {
        extract($args);
        $size = $instance['image-size'];
        global $post;

        if (has_post_thumbnail($post->ID)) {
            $title = apply_filters('widget_title', $instance['title']);
            echo $before_widget;
            if ( $title ) echo $before_title . $title . $after_title;
            echo get_the_post_thumbnail($post->ID, $size);
            echo $after_widget;
        } else {
            // the current post lacks a thumbnail, we do nothing?
        }
    }

    function get_attached_images($post_id) { // unused ATM
        $args = array(
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'numberposts' => 1,
                'post_status' => null,
                'post_parent' => $post_id
        );
        $attachments = get_posts($args);
        if (empty($attachments)) return false;
        else {
            foreach ($attachments as $key => $attachment) {
                if ($attachments[$key]->post_content == 'no slideshow') unset($attachments[$key]);
            }
            return $attachments;
        }
    }
} // End class FeaturedImageWidget

add_action('widgets_init', create_function('', 'return register_widget("FeaturedImageWidget");'));
?>
<?php

/*
Plugin Name: TinyMCE Excerpt
Plugin URI: http://www.simonwheatley.co.uk/wordpress-plugins/tinymce-excerpt/
Description: Use Tiny MCE for the excerpt while editing the excerpt.
Version: 1.33
Author: Simon Wheatley
Author URI: http://www.simonwheatley.co.uk/

Copyright 2007 Simon Wheatley

This script is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This script is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

// JQ JS to add the class 'mceEditor' to the excerpt textarea
function tme_convert_excerpt_js()
{
	// Only continue if this is an editing screen
	if ( ! tme_rich_editing() ) return;
?>
<script type="text/javascript">
	/* <![CDATA[ */
	// JQ JS to add the class 'mceEditor' to the excerpt textarea pre WP 2.5
	jQuery(document).ready( tme_convertExcerpt ); 
    function tme_convertExcerpt() {
		jQuery("#excerpt").addClass("mceEditor"); 
		if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
			// Ensure we don't double wrap stuff
			if ( ! jQuery("#excerpt").length )
				jQuery("#excerpt").wrap( "<div id='excerpteditorcontainer'></div>" ); 
			tinyMCE.execCommand("mceAddControl", false, "excerpt");
		}
	}
	/* ]]> */
</script>
<?php
}

// Enqueue script files, for inclusion by the standard WP magic
function tme_admin_enqueue_js()
{
	// Only continue if this is an editing screen
	if ( ! tme_rich_editing() ) return;
	wp_enqueue_script('jquery'); // Probably there anyway, but best to be sure
}

// Quick CSS make our new excerpt editor even more lovelier
function tme_admin_css()
{
	// Only continue if this is an editing screen
	if ( ! tme_rich_editing() ) return;
	// Fix the CSS, so the resize icon appears hard against the far right of the TinyMCE status bar.
?>
<style type='text/css'>
	#postexcerpt .mceStatusbarResize { margin-right: 0; }
	#postexcerpt #excerpteditorcontainer { border-style: solid; padding: 0; }	
</style>
<?php
}

// Are we on an editing screen?
function tme_rich_editing()
{
	global $editing;
	return ( $editing && user_can_richedit() );
}

// Hook it up to Wordpress

// We need to enqueue some scripts. This is not an ideal action 
// hook, but it does the business
add_action('admin_xml_ns', 'tme_admin_enqueue_js');
// Paragraphise the excerpt on save
add_filter('excerpt_save_pre', 'wpautop');
// Some CSS
add_action('admin_head', 'tme_admin_css');
// Some inline JS in the head, to avoid loading another file
add_action('admin_head', 'tme_convert_excerpt_js');


?>
<?php


// Add Custom Fields to Media Pages


function my_image_attachment_fields_to_edit($form_fields, $post) {  
    $form_fields["page-banner"] = array(  
        "label" => __("Custom Header"),  
        "input" => "text", // this is default if "input" is omitted  
        "value" => get_post_meta($post->ID, "page-banner", true)  
    );
	$form_fields["page-banner"]["helps"] = "Put an image file name here (with suffix) to use as a custom header."; 
	
	
    return $form_fields;  
}  

function my_image_attachment_fields_to_save($post, $attachment) {  
    if( isset($attachment['page-banner']) ){  
        update_post_meta($post['ID'], 'page-banner', $attachment['page-banner']);  
    }  
    return $post;  
} 

add_filter("attachment_fields_to_edit", "my_image_attachment_fields_to_edit", null, 2); 
add_filter("attachment_fields_to_save", "my_image_attachment_fields_to_save", null, 2);




function my_css_attachment_fields_to_edit($form_fields, $post) {  
    $form_fields["css"] = array(  
        "label" => __("Custom CSS"),  
        "input" => "text", // this is default if "input" is omitted  
        "value" => get_post_meta($post->ID, "css", true)  
    ); 
	$form_fields["css"]["helps"] = "Put a stylesheet name here (without suffix) to use as custom css."; 
	
    return $form_fields;  
}  

function my_css_attachment_fields_to_save($post, $attachment) {  
    if( isset($attachment['css']) ){  
        update_post_meta($post['ID'], 'css', $attachment['css']);  
    }  
    return $post;  
} 

add_filter("attachment_fields_to_edit", "my_css_attachment_fields_to_edit", null, 2); 
add_filter("attachment_fields_to_save", "my_css_attachment_fields_to_save", null, 2);



?>
<?php
/*************************************************************************
Plugin Name:  Unattach
Plugin URI:   http://outlandishideas.co.uk/blog/2011/03/unattach/
Description:  Allows detaching images and other media from posts, pages and other content types.
Version:      1.0.1
Author:       tamlyn
**************************************************************************/

//filter to add button to media library UI
function unattach_media_row_action( $actions, $post ) {
	if ($post->post_parent) {
		$url = admin_url('tools.php?page=unattach&noheader=true&&id=' . $post->ID);
		$actions['unattach'] = '<a href="' . esc_url( $url ) . '" title="' . __( "Unattach this media item.") . '">' . __( 'Unattach') . '</a>';
	}

	return $actions;
}

//action to set post_parent to 0 on attachment
function unattach_do_it() {
	global $wpdb;
	
	if (!empty($_REQUEST['id'])) {
		$wpdb->update($wpdb->posts, array('post_parent'=>0), array('id'=>$_REQUEST['id'], 'post_type'=>'attachment'));
	}
	
	wp_redirect(admin_url('upload.php'));
	exit;
}

//set it up
add_action( 'admin_menu', 'unattach_init' );
function unattach_init() {
	if ( current_user_can( 'upload_files' ) ) {
		add_filter('media_row_actions',  'unattach_media_row_action', 10, 2);
		//this is hacky but couldn't find the right hook
		add_submenu_page('tools.php', 'Unattach Media', 'Unattach', 'upload_files', 'unattach', 'unattach_do_it');
		remove_submenu_page('tools.php', 'unattach');
	}
}

?>
<?php
/*
Plugin Name: Executable PHP widget
Plugin URI: http://wordpress.org/extend/plugins/php-code-widget/
Description: Like the Text widget, but it will take PHP code as well. Heavily derived from the Text widget code in WordPress.
Author: Otto
Version: 2.1
Author URI: http://ottodestruct.com
License: GPL2

    Copyright 2009  Samuel Wood  (email : otto@ottodestruct.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2, 
    as published by the Free Software Foundation. 
    
    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    The license for this software can likely be found here: 
    http://www.gnu.org/licenses/gpl-2.0.html
    
*/

class PHP_Code_Widget extends WP_Widget {

	function PHP_Code_Widget() {
		$widget_ops = array('classname' => 'widget_execphp', 'description' => __('Arbitrary text, HTML, or PHP Code'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('execphp', __('PHP Code'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$text = apply_filters( 'widget_execphp', $instance['text'], $instance );
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
			ob_start();
			eval('?>'.$text);
			$text = ob_get_contents();
			ob_end_clean();
			?>			
			<div class="execphpwidget"><?php echo $instance['filter'] ? wpautop($text) : $text; ?></div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( $new_instance['text'] ) );
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = format_to_edit($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs.'); ?></label></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("PHP_Code_Widget");'));

// donate link on manage plugin page
add_filter('plugin_row_meta', 'execphp_donate_link', 10, 2);
function execphp_donate_link($links, $file) {
	if ($file == plugin_basename(__FILE__)) {
		$donate_link = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=otto%40ottodestruct%2ecom">Donate</a>';
		$links[] = $donate_link;
	}
	return $links;
}




	
	
	
/*
Plugin Name: Links in Captions
Plugin URI: http://www.seodenver.com/lottery/
Description: Easily add links to image captions in the WordPress editor.
Author: Katz Web Services, Inc.
Version: 1.2
Author URI: http://www.katzwebservices.com
*/

/*
Copyright 2010 Katz Web Services, Inc.  (email: info@katzwebservices.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.



How to use
Inside the captioninput, you can now add a link by using the following format: {a href="http://www.example.com"}Anchor text here{/a}, or alternatively you could use <code>{link url="http://www.example.com"}Anchor text here{/link}.



*/

add_shortcode('add_caption_link', 'add_link_to_caption_shortcode_shortcode');
add_filter('img_caption_shortcode', 'add_link_to_caption_shortcode', true, 3);
// This function is taken from wp-includes/media.php
function add_link_to_caption_replace_quotes2($string, $type = 'add') {
	$out = '}';
		if(is_array($string)) { $text = $string[1]; } else { $text = $string; }
		$text = str_replace("'",'%%squote%%', $text);
		$text = str_replace(''','%%squote%%', $text);
		$text = str_replace('&quot;','%%dquote%%', $text);
		$text = str_replace('"','%%dquote%%', $text);
	
	$out .= $text.'{/link}';
	return $out;
}
function add_link_to_caption_replace_quotes($string, $type = 'add') {
	if($type == 'add') {
		if(is_array($string)) { $text = $string[1]; } else { $text = $string; }
		$text = str_replace("'",'%%squote%%', $text);
		$text = str_replace(''','%%squote%%', $text);
		$text = str_replace('&quot;','%%dquote%%', $text);
		$text = str_replace('"','%%dquote%%', $text);
		return $text; 
	} else {
		$string = str_replace('%%squote%%', '\'', $string);
		$string = str_replace('%%dquote%%', '"', $string);
		return $string;
	}
}
function add_link_to_caption_shortcode($empty, $attr, $content) {
	$caption = '';
	if(!isset($attr['caption'])) {
		// Used double quotes for link
		$match = false; $string = $key = ''; $attrCopy = $attr; 
		foreach($attr as $key => $att) {
			if(preg_match('/\{link/ism', $att)) { $match = true; }
			if(!is_numeric($key)) {
				$attrCopy[$key] = $key.'="'.add_link_to_caption_replace_quotes($att).'"';
			}
		}

		if($match) {
			$string = implode(' ', $attrCopy);
			$string = preg_replace('/(href|url|rel|target|title|text)=(?:\s+)?(?:\'|')(.*?)(?:\'|')/ism', '$1=%%squote%%$2%%squote%%', $string);
			$string = preg_replace('/(href|url|rel|target|title|text)=(?:\s+)?(?:"|&quot;)(.*?)(?:"|&quot;)/ism', '$1=%%dquote%%$2%%dquote%%', $string);
			$string = preg_replace_callback('/((?:href|url|rel|target|title|text)=(?:%%dquote%%|%%squote%%)(?:.*?)(?:%%dquote%%|%%squote%%))/ism', 'add_link_to_caption_replace_quotes', $string);
			$string = preg_replace_callback('/\}(.*?)\{\/link\}/ism', 'add_link_to_caption_replace_quotes2', $string);
			$caption = preg_match('/caption(?:\s+)?\=(?:\s+)?(?:\'|"|&quot;|')(.*?)(?:\'|"|&quot;|')/ism', $string, $m);
			$caption = $m[1];
		}
	}
	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => $caption
	), $attr));

	# BEGIN Added for this plugin
		// replaces {link rel="nofollow" url="http://www.example.com"}Text{/link}
		$caption = preg_replace('/\{link(.*?)\}(.*?)\{\/link\}/ism', '[add_caption_link$1]$2[/add_caption_link]', $caption);
		$caption = preg_replace('/\{a(.*?)\}(.*?)\{\/a}/ism', '[add_caption_link$1]$2[/add_caption_link]', $caption);

		// Added for this plugin it replaces {link rel="nofollow" url="http://www.example.com" text="Text" /}
		$caption = preg_replace('/\{a(.*?)\/\}/ism', '[add_caption_link $1 /]', $caption);
		$caption = str_replace('&quot;', '"', $caption);

	# END Added for this plugin
	if ( 1 > (int) $width || empty($caption) )
		return add_link_to_caption_replace_quotes($content, 'remove');

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
			
	// Added do_shortcode() to the $caption for this plugin
	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . (10 + (int) $width) . 'px">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . add_link_to_caption_replace_quotes(do_shortcode($caption), 'remove') . '</p></div>';
}
function add_link_to_caption_shortcode_shortcode($attr, $content = null) {
	foreach($attr as $k => $v) {
		if($k != 'text' && $k != 'title') {
			$attr[$k] = str_replace('%%squote%%', '', str_replace('%%dquote%%', '', str_replace('"','', str_replace(''', '', str_replace('&quot;', '', str_replace('\'', '', $v))))));
		}
	}
	extract(shortcode_atts(array(
		'url'		=> '',
		'href'		=> '',
		'target'	=> '',
		'title'		=> '',
		'rel'		=> '',
		'text'		=> ''
	), $attr));
	
	$text =  empty($text) ? '' : add_link_to_caption_replace_quotes($text, 'remove');
	$content = empty($content) ? '' : add_link_to_caption_replace_quotes($content, 'remove');
	$title = empty($title) ? '' : add_link_to_caption_replace_quotes($title, 'remove');
	
	if(!empty($url)) {
		$link = ' href="'.$url.'"';
	} elseif(!empty($href)) {
		$link = ' href="'.$href.'"';
	}
	
	$rel = empty($rel) ? '' :  ' rel="'.$rel.'"';
	$target = empty($target) ? '' :  ' target="'.$target.'"';
	$title = empty($title) ? '' :  ' title="'.$title.'"';
	
	if(empty($link) || (empty($content) && empty($text))) { return $content; }
	else if(empty($content)) { $content = $text; }
	
	return "<a{$link}{$target}{$title}{$rel}>$content</a>";
}




?>