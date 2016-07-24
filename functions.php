<?php

if (!defined('bestblog')) define('bestblog', '1.0');

if (!class_exists('bestblog_scripts_load'))
	{
	class bestblog_scripts_load {
		
		public function __construct() {
			add_action('wp_enqueue_scripts', array( $this, 'bestblog_scripts' ));
			add_action('after_setup_theme', array($this, 'bestblog_after_theme_setup'));
			}

		public function bestblog_scripts() {
				
			/** 
			---------------------------------------------------------------
			 CSS Files 
			---------------------------------------------------------------	
			**/
			
			/* bootstrap min */
			wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array() , bestblog);
			
			/* ionicons min */
			wp_enqueue_style('ionicons', get_template_directory_uri() . '/css/ionicons.min.css', array() , bestblog);
			
			/* owl.carousel */
			wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css', array() , bestblog);
			
			
			/* theme stylesheet */
		    wp_enqueue_style( 'stylesheet', get_stylesheet_uri() ); 
			
			
			/** 
			---------------------------------------------------------------
			 jQuery Files
			---------------------------------------------------------------	
			**/
			
			/* jQuery librery */
			wp_enqueue_script('jQuery');
			
				

			/* bootstrap min  js */
			wp_enqueue_script('bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array(
				'jquery'
			) , bestblog, true);	
			
			/* owl.carousel min js */
			wp_enqueue_script('owl.carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(
				'jquery'
			) , bestblog, true);	

			/* custom js */
			wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array(
				'jquery'
			) , bestblog, true);	

			
			/* wordpress comments */
			if (is_singular() && comments_open() && get_option('thread_comments'))
				{
				wp_enqueue_script('comment-reply');
				}
			}

		function bestblog_after_theme_setup() {
			
			add_theme_support( 'post-formats', array(
			  'aside',
			  'image',
			  'video',
			  'quote',
			  'link',
			 ) );
			
			/* load text domain */
			load_theme_textdomain('bestblog', get_template_directory() . '/languages');
			/* widget shortcode support*/
			add_filter('widget_text', 'do_shortcode');
			
			/* theme supports */
			add_theme_support('post-thumbnails', array('post'));
			add_theme_support('automatic-feed-links');
			
			// image size 
			add_image_size('recent_post_widget', '35', '40', true);
			
			/* register nav */
			register_nav_menus(array(
				'primarymenu' => __('Primary Menu', 'bestblog')
			));
			
			/* register sidebar */
			function bestblog_widgets_register_func()
				{
				register_sidebar(array(
					'name' => __('Right Sidebar', 'bestblog') ,
					'id' => 'right_sidebar',
					'description' => __('Widgets in this area will be shown left side', 'bestblog') ,
					'before_widget' => '',
					'after_widget' => '',
					'before_title' => '<h4 class="widget-title">',
					'after_title' => '</h4>',
				));

				register_sidebar(array(
					'name' => __('Footer Sidebar', 'bestblog') ,
					'id' => 'footer_sidebar',
					'description' => __('Footer sidebar Widgets in this area will be shown on all posts and pages text.', 'bestblog') ,
					'before_widget' => '<div class="col-md-3 widget">',
					'after_widget' => '</div>',
					'before_title' => '<h4 class="widget-title">',
					'after_title' => '</h4>',
				));
				}

			add_action('widgets_init', 'bestblog_widgets_register_func');
			
			
			
			}
		}
	}

if (class_exists('bestblog_scripts_load'))
	{
	global $bestblog_scripts_load;
	$bestblog_scripts_load = new bestblog_scripts_load();
	}

	
//Default menu show Bestblog menu bar

function bestblog_default_menu(){
		
		echo '<ul class="nav navbar-nav navbar-right">';
		if(is_user_logged_in()){
		echo '<li class="current"><a href="'.esc_url(home_url()).'/wp-admin/nav-menus.php">Create A Account</a></li>
		<li>
	        <form role="search" method="get" id="searchform" class="searchform search hidden-xs" action="' . home_url( '/' ) . '" >
			  <div class="search-wrapper">
				<input type="text" placeholder="Search" class="search-input"/ name="s" value="' . get_search_query() . ' " id="s">
				
				<span class="ion-ios-search-strong"></span>
			  </div>
			</form>
		</li>';
		}
		
	
	else {
		echo '<li><a href="'.esc_url(home_url()).'">Home</a></li>
		<li>
	        <form role="search" method="get" id="searchform" class="searchform search hidden-xs" action="' . home_url( '/' ) . '" >
			  <div class="search-wrapper">
				<input type="text" placeholder="Search" class="search-input"/ name="s" value="' . get_search_query() . ' " id="s">
				
				<span class="ion-ios-search-strong"></span>
			  </div>
			</form>
		</li>';
	}
		echo '</ul>';
}	


// search bar on menu bar 
add_filter( 'wp_nav_menu_items','add_search_box_menu', 10, 2 );
function add_search_box_menu( $items, $args ) {
	
    $items .= '<li>
	        <form role="search" method="get" id="searchform" class="searchform search hidden-xs" action="' . home_url( '/' ) . '" >
			  <div class="search-wrapper">
				<input type="text" placeholder="Search" class="search-input"/ name="s" value="' . get_search_query() . ' " id="s">
				
				<span class="ion-ios-search-strong"></span>
			  </div>
			</form>
		</li>';
    return $items;
}

//reset comment default 
function bestblog_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
    }
add_filter( 'comment_form_fields', 'bestblog_comment_field_to_bottom' );


function bestblog_theme_support(){
  add_theme_support('title-tag');
  add_theme_support('custom-background');
}
add_action('after_setup_theme','bestblog_theme_support');

if( !isset($content_width)) {
$content_width = 900;
}
//include files 
require 'inc/wp_bootstrap_navwalker.php';
require 'inc/breadcrumbs.php';
require 'inc/widgets/bestblog_search.php';
require 'inc/widgets/bestblog_tag_list.php';
require 'inc/widgets/bestblog_category.php';
require 'inc/widgets/bestblog_tab_content.php';
require 'inc/widgets/twitter-feed.php';
require 'inc/widgets/bestblog-recentpost.php';



//include 'inc/widgets/customlink_widget.php';

//admin enqueue script 
function bestblog_load_custom_wp_admin_style() {
	
    /* custom admin enqueue */
	wp_enqueue_style( 'custom-admin-css', get_template_directory_uri() . '/css/admin/custom-admin.css');
}
add_action( 'admin_enqueue_scripts', 'bestblog_load_custom_wp_admin_style' ); 



// pagination 

function bestblog_pagination() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="pagination-wrapper text-center"><ul class="pagination">' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li class="previous">%s</li>' . "\n", get_previous_posts_link('Previous') );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li></li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li></li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li class="next">%s</li>' . "\n", get_next_posts_link('Next') );

	echo '</ul></div>' . "\n";

}

/* breadcrumbs */

function bestblog_breadcrumb() {
    global $post;
    echo '<ul id="breadcrumbs">';
    if (!is_home()) {
        echo '<li><a href="';
        echo home_url('home');
        echo '">';
        echo 'Home';
        echo '</a></li><li class="separator"> <i class="fa fa-long-arrow-right"></i> </li>';
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li class="separator"> <i class="fa fa-long-arrow-right"></i> </li><li> ');
            if (is_single()) {
                echo '</li><li class="separator"> <i class="fa fa-long-arrow-right"></i> </li><li>';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                    $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> <li class="separator"> <i class="fa fa-long-arrow-right"></i></li>';
                }
                echo $output;
                echo '<strong title="'.$title.'"> '.$title.'</strong>';
            } else {
                echo '<li><strong> '.get_the_title().'</strong></li>';
            }
        }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ul>';
}