<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title('|'); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php // icons & favicons ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
		<meta name="theme-color" content="#121212">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

		<?php wp_head(); ?>
		
		<?php wp_head(); ?>
		<?php $options = get_option('rh_settings'); ?>

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<div id="container">

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

				<div id="inner-header" class="cf">

					<?php
					if($options['logo']){
						echo '<a id="logo" href="'. home_url() .'"><img src="'. $options['logo'] .'" alt="'. get_bloginfo('name') .'" /></a>';
					} else {
						echo '<p id="logo" class="h1" itemscope itemtype="http://schema.org/Organization"><a href="'. home_url() .'">'. get_bloginfo('name') .'</a></p>';
					}
					if($options['logo_alt']){
						echo '<a id="logo-mobile" href="'. home_url() .'"><img src="'. $options['logo_alt'] .'" alt="'. get_bloginfo('name') .'" /></a>';
					}
					?>
					
					<a class="menu-button" title="Main Menu"></a>
					<nav role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php wp_nav_menu(array(
							'container' => false,                           // remove nav container
							'container_class' => 'menu cf',                 // class of container (should you choose to use it)
							'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
							'menu_class' => 'nav top-nav cf',               // adding custom nav class
							'theme_location' => 'main-nav',                 // where it's located in the theme
							'before' => '',                                 // before the menu
							'after' => '',                                  // after the menu
							'link_before' => '',                            // before each link
							'link_after' => '',                             // after each link
							'depth' => 0,                                   // limit the depth of the nav
							'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>
					</nav>
					
					<?php
					if( $options['twitter_url'] || $options['facebook_url'] || $options['instagram_url'] || $options['youtube_url'] || $options['linkedin_url']) {
						echo '<div class="social">';
						
						echo ($options['linkedin_url'] != '' ? '<a href="'.$options['linkedin_url'].'" target="_blank"><i class="fab fa-linkedin-in"></i></a>' : '');
						
						echo ($options['twitter_url'] != '' ? '<a href="'.$options['twitter_url'].'" target="_blank"><i class="fab fa-twitter"></i></a>' : '');
						
						echo ($options['facebook_url'] != '' ? '<a href="'.$options['facebook_url'].'" target="_blank"><i class="fab fa-facebook"></i></a>' : '');
						
						echo ($options['instagram_url'] != '' ? '<a href="'.$options['instagram_url'].'" target="_blank"><i class="fab fa-instagram"></i></a>' : '');
						
						echo ($options['youtube_url'] != '' ? '<a href="'.$options['youtube_url'].'" target="_blank"><i class="fab fa-youtube"></i></a>' : '');
						
						echo '</div>';
					}
					?>
					
				</div>

			</header>
