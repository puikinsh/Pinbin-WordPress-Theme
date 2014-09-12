<?php

/* The template for displaying Search Results pages. */

get_header(); ?>

		<section id="primary" class="site-content">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'pinbin' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>
		<?php while (have_posts()) : the_post(); ?>	
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( has_post_thumbnail() ) { ?>			
				<div class="pinbin-image"><?php the_post_thumbnail( 'detail-image' );  ?></div>
				<?php } ?> 
       			<div class="pinbin-copy"><h2><a class="front-link" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                <p class="pinbin-date"><?php the_time(get_option('date_format')); ?>  </p>

                  <?php the_excerpt(); ?> 

         </div>
       </div>
				<?php endwhile; ?>

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

			</div><!-- #content -->
		</section><!-- #primary .site-content -->

<?php get_footer(); ?>