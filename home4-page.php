<?php
/**
 * Template Name: 4 Box Home Sidebar with Nav
 *
 * A custom page template for the three channel home page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * 
 * 
 */

get_header(); ?>

<div id="channelnav">
  <?php wp_nav_menu( array( 'theme_location' => 'generic-menu','depth'  => 3, 'menu_class'  => 'ch-menu', 'fallback_cb' => 'false' ) ); ?>
 </div>
<div id="content">
  

    
  

<?php get_template_part('sidebar-home'); ?>



    

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
					
					<?php } else { ?>
						
					<?php } ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tabularasa' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'tabularasa' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
  </div><!-- #post-## -->

 
</div>
<div id="chboxwrap">
<div class="chboxbig">
 <?php
  $args=array(
  'orderby' =>'parent',
  'order' =>'asc',
  'post_type' =>array('page','post'),
  'ignore_sticky_posts' => 1,
  'meta_key' =>  'channel-box',
  'meta_value' =>  '1',
   );
   $page_query = new WP_Query($args); ?>
  
  <?php while ($page_query->have_posts()) : $page_query->the_post(); ?>
  <div class="section"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail',array ('class' => 'alignright')); ?></a>
    <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    <?php the_excerpt(); ?>
    
    
  </div>
  <?php endwhile; ?>
  
</div>
<div class="chboxbig">
<?php
  $args=array(
  'orderby' =>'parent',
  'order' =>'asc',
  'post_type' =>array('page','post'),
  'ignore_sticky_posts' => 1,
  'meta_key' =>  'channel-box',
  'meta_value' =>  '2',
   );
   $page_query = new WP_Query($args); ?>
  
  <?php while ($page_query->have_posts()) : $page_query->the_post(); ?>
  <div class="section"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail',array ('class' => 'alignright')); ?></a>
    <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    <?php the_excerpt(); ?>
    
    
  </div>
  <?php endwhile; ?></div>

<div class="chboxbig">
<?php
  $args=array(
  'orderby' =>'parent',
  'order' =>'asc',
  'post_type' =>array('page','post'),
  'ignore_sticky_posts' => 1,
  'meta_key' =>  'channel-box',
  'meta_value' =>  '3',
   );
   $page_query = new WP_Query($args); ?>
  
  <?php while ($page_query->have_posts()) : $page_query->the_post(); ?>
 <div class="section"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail',array ('class' => 'alignright')); ?></a>
    <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    <?php the_excerpt(); ?>    
    
  </div>
  <?php endwhile; ?></div> 

<div class="chboxbig">
<?php
  $args=array(
  'orderby' =>'parent',
  'order' =>'asc',
  'post_type' =>array('page','post'),
  'ignore_sticky_posts' => 1,
  'meta_key' =>  'channel-box',
  'meta_value' =>  '4',
   );
   $page_query = new WP_Query($args); ?>
  
  <?php while ($page_query->have_posts()) : $page_query->the_post(); ?>
  <div class="section"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail',array ('class' => 'alignright')); ?></a>
    <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    <?php the_excerpt(); ?>
    
    
  </div>
  <?php endwhile; ?></div>
 </div>





<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>
