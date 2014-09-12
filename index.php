<?php
/**
 * Theme index file
 */

?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>
<div id="post-area">

<?php while (have_posts()) : the_post(); ?>

   		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		 <?php if ( has_post_thumbnail() ) { ?>
         <div class="pinbin-image"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'summary-image' );  ?></a></div>
          <div class="pinbin-category"><p><?php the_category(', ') ?></p></div>

		  <?php } ?>
       			<div class="pinbin-copy"><h2><a class="front-link" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                <p class="pinbin-date"><?php the_time(get_option('date_format')); ?>  </p>

                  <?php the_excerpt(); ?>

               <p class="pinbin-link"><a href="<?php the_permalink() ?>">&rarr;</a></p>
         </div>
       </div>

<?php endwhile; ?>
</div>
<?php else : ?>

<article id="post-0" class="post no-results not-found">
        <header class="entry-header">
          <h1 class="entry-title"><?php _e( 'Nothing Found', 'pinbin' ); ?></h1>
        </header><!-- .entry-header -->

        <div class="entry-content">
          <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'pinbin' ); ?></p>
          <?php get_search_form(); ?>
        </div><!-- .entry-content -->
</article><!-- #post-0 -->

<?php endif; ?>
    <nav id="nav-below" class="navigation" role="navigation">
        <div class="view-previous"><?php next_posts_link( __( '&#171; Previous', 'pinbin' ) ) ?></div>
        <div class="view-next"><?php previous_posts_link( __( 'Next &#187', 'pinbin' ) ) ?> </div>
    </nav>
<?php get_footer(); ?>
