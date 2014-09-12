<?php
/**
 * Error page displayed when no results are found
 */

?>

<?php get_header(); ?>

   		<div class="type-page">
                                
       			<div class="pinbin-copy">
                
					<h1><?php _e( '404: Page or File Not Found', 'pinbin') ?></h1>
			
						<p><?php _e( 'Oops! It seems you stumbled on something that does not exist or was moved', 'pinbin') ?></p>
					
					<h2><?php _e( 'Need help?', 'pinbin') ?></h2>

					<p><?php _e( 'You might try the following:', 'pinbin') ?></p>
					<ul> 
						<li><?php _e( 'Check spelling', 'pinbin') ?></li>
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>/"><?php _e( 'Return to  home page', 'pinbin') ?></a></li> 
						<li><?php _e( 'Click ', 'pinbin') ?> <a href="javascript:history.back()"><?php _e( 'Return button', 'pinbin') ?></a></li>
					</ul>
		      
         		</div>
                              
       </div>
              
<?php get_footer(); ?>
