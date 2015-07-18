<?php
/**
 * The loop that displays a scroll on a page.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * 
 * 
 */
 ?>
 
 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						
			
				 
					<?php } else { ?>
		          
   <h1 class="entry-title"><?php the_title(); ?></h1>
   
   
		        
					<?php } ?>

				  <div class="entry-content">
						<?php the_content(); ?>
                        
                        <!-- "previous page" action -->
                     <a class="prev browse left"></a>
                        
                        
                     <div class="scrollable">
                        <div class="items"> 
                            
                          <?php $my_query = new WP_Query('post_status=future,publish'); ?>


	<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>

		
                          <div>
                           
                          <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                           
                        </div>
                          
                          
                   
                            
                          <?php endwhile; ?>
                         
                       </div>
                    </div>
	
 <!-- "next page" action -->
<a class="next browse right"></a>

<br clear="all" />                

</div>   
                        
       
 <?php wp_reset_postdata();
   ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'homebase' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'homebase' ), '<span class="edit-link">', '</span>' ); ?>
                        
 </div><!-- .entry-content -->
				</div><!-- #post-## -->
                
				<?php comments_template( '', true ); ?>

		

<?php endwhile; // end of the loop. ?>




