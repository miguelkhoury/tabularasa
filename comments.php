<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to tabularasa_comment which is
 * located in the functions.php file.
 *
 * @package WordPress

 */
?>

			
<?php if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'tabularasa' ); ?></p>
			
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<div id="comments">
  <?php if ( have_comments() ) : ?>
 
    <h4> This page has <?php comments_number('no comments','one comment', ' % comments' );  ?> as of today.</h4>
  
            


  
  <ol>
    <?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use tabularasa_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define tabularasa_comment() and that will be used instead.
					 * See tabularasa_comment() in tabularasa/functions.php for more.
					 */
					wp_list_comments( array( 'avatar_size'       => 64) );
				?>
  </ol>
  
  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
  <div id="comments-nav-below" class="navigation">
  <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'tabularasa' ) ); ?></div>
  <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'tabularasa' ) ); ?></div></div>



			
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
<p class="smalltext"><?php _e( '', 'tabularasa' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>
</div>



