<?php
/**
 * The template for attachements.
 */

?>

<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>     
       
   		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( has_post_thumbnail() ) { ?>			
				<div class="pinbin-image"><?php the_post_thumbnail( 'detail-image' );  ?></div>
                <div class="pinbin-category"><p><?php the_category(', ') ?></p></div>
             <?php } ?>                   
      <div class="post-nav">
          <div class="post-prev"><?php previous_image_link('%link', '&larr;'); ?></div>
          <div class="post-next"><?php next_image_link('%link', '&rarr;'); ?></div>
      </div>  
       			<div class="pinbin-copy">
                <h1><?php the_title(); ?></h1>
                 <p class="pinbin-date"> <?php the_time(get_option('date_format')); ?></p>
                 <?php echo wp_get_attachment_image( $post->ID, 'full' ); ?>
           		 <?php the_content(); ?> 
	<div class="pagelink"><?php wp_link_pages(); ?></div>                
	 <div class="posttags"><?php the_tags(); ?></div>
                <div class="clear"></div>
				<?php comments_template(); ?> 

                </div>
          
       </div>
       
		<?php endwhile; endif; ?>

<?php get_footer(); ?>