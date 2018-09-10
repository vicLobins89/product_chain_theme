<?php
/* This is the core theme file.

  - head cleanup (remove rsd, uri links, junk css, ect)
  - enqueueing scripts & styles
  - theme support functions
  - custom menu output & fallbacks
  - related post function
  - page-navi function
  - removing <p> from around images
  - customizing the post excerpt

*/

/*********************
WP_HEAD
*********************/

function bones_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end bones head cleanup */

// A better title
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

} // end better title

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

//Page Slug Body Class
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );


/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function bones_scripts_and_styles() {

  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

  if (!is_admin()) {

		// modernizr (without media query polyfill)
		wp_register_script( 'bones-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );

		// register main stylesheet
		wp_register_style( 'bones-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );

		// ie-only style sheet
		wp_register_style( 'bones-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );

    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
		  wp_enqueue_script( 'comment-reply' );
    }
	  
		// adding scripts file in the footer
		wp_register_script( 'masonry-js', get_stylesheet_directory_uri() . '/library/js/masonry.pkgd.min.js', array( 'jquery' ), '', true );
		wp_register_script( 'bones-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '0', true );
		wp_register_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAYkSQ40G1hKISa4JT2Ryk7ushGIWEOpjI', array( 'jquery' ), '', true );
		wp_register_script( 'google-maps-acf', get_stylesheet_directory_uri() . '/library/js/google-maps-acf.js', array( 'jquery' ), '', true );

		// enqueue styles and scripts
		wp_enqueue_script( 'bones-modernizr' );
		wp_enqueue_style( 'bones-stylesheet' );
		wp_enqueue_style( 'bones-ie-only' );

		$wp_styles->add_data( 'bones-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'masonry-js' );
		wp_enqueue_script( 'bones-js' );
		wp_enqueue_script( 'google-maps' );
		wp_enqueue_script( 'google-maps-acf' );

	}
}

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function bones_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',    // background image default
	    'default-color' => '',    // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	// rss
	add_theme_support('automatic-feed-links');

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'bonestheme' ),   // main nav in header
			'socket-nav' => __( 'Socket Links', 'bonestheme' ),  // socket nav at the top of page
			'footer-links' => __( 'Footer Links', 'bonestheme' ) // secondary nav in footer
		)
	);

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );

} /* end bones theme support */


/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using bones_related_posts(); )
function bones_related_posts() {
	global $post;
	
	if( !wp_get_post_tags( $post->ID ) ) {
		$tags = wp_get_post_terms($post->ID, 'custom_tag', array("fields" => "all"));
	} else {
		$tags = wp_get_post_tags( $post->ID );
	}
	
	if($tags) {
		if( !wp_get_post_tags( $post->ID ) ) {
			echo '<section class="row case-studies cf curved">
				<div class="cf wrap entry-content">
				<h2>Further Case Studies</h2>';
			foreach( $tags as $tag ) {
				$tag_arr .= $tag->slug . ',';
			}
			
			$args = array(
				'tax_query' => array(
						array(
							'taxonomy' => 'custom_tag',
							'field' => 'slug',
							'terms' => array( $tag_arr )
						)
				),
				'post_type'=>'custom_type',
				'numberposts' => 3,
				'post__not_in' => array($post->ID)
			);
		} else {
			echo '<section class="row case-highlights cf curved">
				<div class="cf wrap entry-content">
				<h2>Related Posts</h2>';
			foreach( $tags as $tag ) {
				$tag_arr .= $tag->slug . ',';
			}
			
			$args = array(
				'tag' => $tag_arr,
				'numberposts' => 3,
				'post__not_in' => array($post->ID)
			);
		}
		$related_posts = get_posts( $args );
		if($related_posts) {
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<div class="col-4">
					<div class="post-item" onclick="window.location='<?php the_permalink(); ?>';">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-thumb">
							<?php the_post_thumbnail('rectangle-thumb-s'); ?>
						</a>

						<h3>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-title">
								<?php the_title(); ?>
							</a>
						</h3>

						<?php the_excerpt(); ?>
					</div>
				</div>
			<?php endforeach; }
		else { ?>
			<?php echo '<p class="no_related_post">' . __( 'No Related Posts Yet!', 'bonestheme' ) . '</p>'; ?>
		<?php }
	}
	wp_reset_postdata();
	echo '</div></section>';
} /* end bones related posts function */

/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function bones_page_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '&larr;',
    'next_text'    => '&rarr;',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/

//add_filter('excerpt_length', function($length) {
//    return 6;
//});

// remove the p from around imgs
function bones_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This changes the […] to a Read More link
function bones_excerpt_more($more) {
	global $post;
	return '...';
}
//add_filter( 'excerpt_more', 'bones_excerpt_more' );

remove_filter('term_description','wpautop');

// First sentence excerpt
function end_with_sentence($excerpt) {
	$newExcerpt = substr($excerpt,0,strpos($excerpt,'.')+1);
	if( strlen($newExcerpt) <= 1 ) {
		return $excerpt;
	} else {
		return $newExcerpt;
	}
}
add_filter( 'get_the_excerpt', 'end_with_sentence' );


add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_author() ) {

            $title = '<span class="vcard">' . get_the_author() . '</span>' ;

        }

    return $title;

});


function render_ribbon($atts) {
	return file_get_contents(get_template_directory_uri() . '/library/images/svg/ribbon.svg');
}
add_shortcode('ribbon', 'render_ribbon');

function render_haggis($atts) {
	return file_get_contents(get_template_directory_uri() . '/library/images/svg/haggis.svg');
}
add_shortcode('haggis', 'render_haggis');

function render_arrowUp($atts) {
	return '<div class="arrow arrow-up">'.file_get_contents(get_template_directory_uri() . '/library/images/svg/arrow-up.svg').'</div>';
}
add_shortcode('arrow-up', 'render_arrowUp');

function render_arrow5($atts) {
	return file_get_contents(get_template_directory_uri() . '/library/images/svg/arrow-outline-05.svg');
}
add_shortcode('arrow5', 'render_arrow5');

function render_arrow6($atts) {
	return file_get_contents(get_template_directory_uri() . '/library/images/svg/arrow-outline-06.svg');
}
add_shortcode('arrow6', 'render_arrow6');

function render_chain($atts) {
	return '<div class="arrow chain">'.file_get_contents(get_template_directory_uri() . '/library/images/svg/chain.svg').'</div>';
}
add_shortcode('chain', 'render_chain');

?>
