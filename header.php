<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>  
  	<meta charset="<?php bloginfo('charset'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php wp_title('&#124;', true, 'right'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
    <?php wp_head(); ?>
</head>

  <body <?php body_class(); ?>>

 	<!-- logo and navigation -->

 <nav id="site-navigation" class="main-nav" role="navigation">
    <div id="main-nav-wrapper"> 
                <div id="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"  title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
              
                    <?php $pinbin_options = get_option('theme_pinbin_options'); ?>

                <?php if ( $pinbin_options['logo'] != '' ): ?>
                  <div id="logo">
                    <img src="<?php echo $pinbin_options['logo']; ?>" />
                  </div>
                <?php  endif; ?>
              </a>
              
         </div>  
          <?php if ( has_nav_menu( 'main_nav' ) ) { ?>
          <?php wp_nav_menu( array( 'theme_location' => 'main_nav' ) ); ?>
          <?php } else { ?>
          <ul><?php wp_list_pages("depth=3&title_li=");  ?></ul>
          <?php } ?> 

    </div>
  </nav>  
<div class="clear"></div>
<div id="wrap">
  <div id="header"></div>