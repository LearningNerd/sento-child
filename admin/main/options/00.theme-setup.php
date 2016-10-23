<?php
/**
 * Theme setup functions.
 *
 * @package Sento
 */


//----------------------------------------------------------------------------------
//	ADD CUSTOM HOOKS
//----------------------------------------------------------------------------------

// Used at top of header.php
function thinkup_hook_header() { 
	do_action('thinkup_hook_header');
}

// Used at top of header.php within the body tag
function thinkup_bodystyle() { 
	do_action('thinkup_bodystyle');
}

// Used after <body> tag in header.php
function thinkup_hook_bodyhtml() { 
	do_action('thinkup_hook_bodyhtml');
}


//----------------------------------------------------------------------------------
//	ADD PAGE TITLE
//----------------------------------------------------------------------------------

function thinkup_title_select() {
	global $post;

	if ( is_page() ) {
		printf( __( '%s', 'sento' ), get_the_title() );
	} elseif ( is_attachment() ) {
		printf( __( 'Blog Post Image: ', 'sento' ) . '%s', esc_attr( get_the_title( $post->post_parent ) ) );
	} else if ( is_single() ) {
		printf( __( '%s', 'sento' ), get_the_title() );
	} else if ( is_search() ) {
		printf( __( 'Search Results: ', 'sento' ) . '%s', get_search_query() );
	} else if ( is_404() ) {
		printf( __( 'Page Not Found', 'sento' ) );
	} else if ( is_category() ) {
		printf( __( 'Category Archives: ', 'sento' ) . '%s', single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		printf( __( 'Tag Archives: ', 'sento' ) . '%s', single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		the_post();
		printf( __( 'Author Archives: ', 'sento' ) . '%s', get_the_author() );
		rewind_posts();
	} elseif ( is_day() ) {
		printf( __( 'Daily Archives: ', 'sento' ) . '%s', get_the_date() );
	} elseif ( is_month() ) {
		printf( __( 'Monthly Archives: ', 'sento' ) . '%s', get_the_date( 'F Y' ) );
	} elseif ( is_year() ) {
		printf( __( 'Yearly Archives: ', 'sento' ) . '%s', get_the_date( 'Y' ) );
	} elseif ( is_post_type_archive( 'portfolio' ) ) {
		printf( __( 'Portfolio', 'sento' ) );
	} elseif ( is_post_type_archive( 'client' ) ) {
		printf( __( 'Our Clients', 'sento' ) );
	} elseif ( is_post_type_archive( 'team' ) ) {
		printf( __( 'Our Team', 'sento' ) );
	} elseif ( is_post_type_archive( 'testimonial' ) ) {
		printf( __( 'Customer Testimonials', 'sento' ) );
	} elseif ( is_post_type_archive( 'product' ) and function_exists( 'thinkup_woo_titleshop_archive' ) ) {
		printf( thinkup_woo_titleshop_archive() );
	} elseif ( thinkup_check_isblog() ) {
		printf( __( 'Blog', 'sento' ) );
	} elseif ( is_tax() ) {
		echo get_queried_object()->name;
	} else {
		printf( __( '%s', 'sento' ), get_the_title() );
	}
}


//----------------------------------------------------------------------------------
//	ADD BREADCRUMBS FUNCTIONALITY
//----------------------------------------------------------------------------------

function thinkup_input_breadcrumb() {

	$output           = NULL;
	$count_loop       = NULL;
	$count_categories = NULL;

	$delimiter = '<span class="delimiter">/</span>';

	$delimiter_inner   =   '<span class="delimiter_core"> &bull; </span>';
	$main              =   __( 'Home', 'sento' );
	$maxLength         =   30;

	/* Archive variables */
	$arc_year       =   get_the_time('Y');
	$arc_month      =   get_the_time('F');
	$arc_day        =   get_the_time('d');
	$arc_day_full   =   get_the_time('l');  

	/* URL variables */
	$url_year    =   get_year_link($arc_year);
	$url_month   =   get_month_link($arc_year,$arc_month);

	/* Display breadcumbs if NOT the home page */
	if ( ! is_front_page() ) {
		$output .= '<div id="breadcrumbs"><div id="breadcrumbs-core">';
		global $post, $cat;
		$homeLink = esc_url( home_url( '/' ) );
		$output .= '<a href="' . esc_url( $homeLink ) . '">' . esc_html( $main ) . '</a>' . $delimiter;    

		/* Display breadcrumbs for single post */
		if ( is_single() ) {
			$category = get_the_category();
			$num_cat = count($category);
			if ($num_cat <=1) {
				$output .= ' ' . get_the_title();
			} else {

				// Count Total categories
				foreach( get_the_category() as $category) {
					$count_categories++;
				}
				
				// Output Categories
				foreach( get_the_category() as $category) {
					$count_loop++;

					if ( $count_loop < $count_categories ) {
						$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->cat_name ) . '</a>' . $delimiter_inner; 
					} else {
						$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->cat_name ) . '</a>'; 
					}
				}
				
				if (strlen(get_the_title()) >= $maxLength) {
					$output .=  ' ' . $delimiter . trim(substr(get_the_title(), 0, $maxLength)) . ' ...';
				} else {
					$output .=  ' ' . $delimiter . get_the_title();
				}
			}
		} elseif (is_category()) {
			$output .= '<span class="breadcrumbs-cat">' . __( 'Archive Category: ', 'sento' ) . '</span>' . get_category_parents($cat, true, '') ;
		} elseif ( is_tag() ) {
			$output .= '<span class="breadcrumbs-tag">' . __( 'Posts Tagged: ', 'sento' ) . '</span>' . single_tag_title("", false);
		} elseif ( is_day()) {
			$output .=  '<a href="' . esc_url( $url_year ) . '">' . $arc_year . '</a> ' . $delimiter . ' ';
			$output .=  '<a href="' . esc_url( $url_month ) . '">' . $arc_month . '</a> ' . $delimiter . $arc_day . ' (' . $arc_day_full . ')';
		} elseif ( is_month() ) {
			$output .=  '<a href="' . esc_url( $url_year ) . '">' . $arc_year . '</a> ' . $delimiter . $arc_month;
		} elseif ( is_year() ) {
			$output .=  $arc_year;
		} elseif ( is_search() ) {
			$output .= __( 'Search Results for: ', 'sento' ) . get_search_query() . '"';
		} elseif ( is_page() && !$post->post_parent ) {
			$output .=  get_the_title();
		} elseif ( is_page() && $post->post_parent ) {
			$post_array = get_post_ancestors( $post );
			krsort( $post_array ); 
			foreach( $post_array as $key=>$postid ){
				$post_ids = get_post( $postid );
				$title = $post_ids->post_title;
				$output  .= '<a href="' . esc_url( get_permalink( $post_ids ) ) . '">' . esc_html( $title ) . '</a>' . $delimiter;
			}
			$output .= get_the_title();
		} elseif ( is_author() ) {
			global $author;
			$user_info = get_userdata($author);
			$output .= __( 'Archived Article(s) by Author: ', 'sento' ) . $user_info->display_name ;
		} elseif ( is_404() ) {
			$output .= __( 'Error 404 - Not Found.', 'sento' );
		} elseif( is_tax() ) {
			$output .= get_queried_object()->name;
		} elseif ( is_post_type_archive( 'portfolio' )	) {
			$output .= __( 'Portfolio', 'sento' );
		} elseif ( is_post_type_archive( 'client' )	) {
			$output .= __( 'Clients', 'sento' );
		} elseif ( is_post_type_archive( 'team' )	) {
			$output .= __( 'Team', 'sento' );
		} elseif ( is_post_type_archive( 'testimonial' )	) {
			$output .= __( 'Testimonials', 'sento' );
		} elseif ( is_post_type_archive( 'product' ) and function_exists( 'thinkup_woo_titleshop_archive' ) ) {
			$output .= thinkup_woo_titleshop_archive();
		}
       $output .=  '</div></div>';
	   
	   return $output;
    }
}


/* ----------------------------------------------------------------------------------
	ADD MENU DESCRIPTION FEATURE
---------------------------------------------------------------------------------- */

class thinkup_menudescription extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
		global $wp_query;
		
		$item_output = NULL;
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
 
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) .'"' : ' href="' . get_permalink( $item->ID ) . '"';

        // Insert title for top level
		if ( has_nav_menu( 'header_menu' ) ) {
			$title = ( $depth == 0 )
				? '<span>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' : apply_filters( 'the_title', $item->title, $item->ID );
		} else {
			$title = ( $depth == 0 )
				? '<span>' . apply_filters( 'the_title', get_the_title($item->ID), $item->ID ) . '</span>' : apply_filters( 'the_title', get_the_title($item->ID), $item->ID );
		}

        // Structure of output
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $title;
		$item_output .= '</a>';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}


//----------------------------------------------------------------------------------
//	ADD PAGINATION FUNCTIONALITY
//----------------------------------------------------------------------------------
function thinkup_input_pagination( $pages = "", $range = 2 ) {
global $paged;
global $wp_query;

$pag_before  = NULL;
$pag_after   = NULL;
$pag_current = NULL;
$pag_close   = NULL;
$pag_clear   = NULL;

	$showitems = ($range)+1;  

	if(empty($paged)) $paged = 1;

	if($pages == "") {
		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}

if ( $paged > 1 ) {
	$pag_before  = '<span class="pag-before">';
	$pag_current = '</span><span class="pag-current">';
	$pag_after   = '</span><span class="pag-after">';
	$pag_close   = '</span>';
	$pag_clear   = '<span class="clearboth"></span>';
}

if ( $paged == 1 ) {
	$pag_class = ' pag-start';
} else if ( $paged == $pages ) {
	$pag_class = ' pag-end';
} else {
	$pag_class = ' pag-inner';
}

	if(1 != $pages) {
		echo '<ul class="pag' . $pag_class . '">';

			echo $pag_before;
	
			if($paged > 2 && $paged > $range+1 && $showitems < $pages)
				echo '<li class="pag-first"><a href="' . esc_url( get_pagenum_link(1) ) . '"><i class="fa fa-angle-double-left"></i></a></li>';
			if($paged > 1 && $showitems < $pages) 
				echo '<li class="pag-previous"><a href="' . esc_url( get_pagenum_link($paged - 1) ) . '"><i class="fa fa-angle-left"></i></a></li>';

			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					if ( $paged == $i ) {
						echo $pag_current;
							echo '<li class="current"><span>' . $i . '</span></li>'; 
						echo $pag_after;
					} else {
						echo '<li><a href="' . esc_url( get_pagenum_link($i) ) . '">'. $i . '</a></li>';
					}
				}
			}

			if ($paged < $pages && $showitems < $pages)
				echo '<li class="pag-next"><a href="' . esc_url( get_pagenum_link($paged + 1) ) . '"><i class="fa fa-angle-right"></i></a></li>';
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
				echo '<li class="pag-last" ><a href="' . esc_url( get_pagenum_link($pages) ) . '"><i class="fa fa-angle-double-right"></i></a></li>';

			echo $pag_close;
			echo $pag_clear;

		echo '</ul>';
	}
}


//----------------------------------------------------------------------------------
//	ADD CUSTOM FEATURED IMAGE SIZES
//----------------------------------------------------------------------------------

function thinkup_input_addimagesizes() {

	// Image size for testimonial shortcode
	add_image_size( 'sc-testimonial-1', 53, 53, true );
	add_image_size( 'sc-testimonial-2', 85, 85, true );

	/* 1 Column Layout */
	add_image_size( 'column1-1/2', 1140, 570, true );
	add_image_size( 'column1-1/3', 1140, 380, true );
	add_image_size( 'column1-1/4', 1140, 285, true );
	add_image_size( 'column1-2/5', 1140, 456, true );

	/* 2 Column Layout */
	add_image_size( 'column2-1/1', 570, 570, true );
	add_image_size( 'column2-1/4', 570, 142, true );
	add_image_size( 'column2-1/2', 570, 285, true );
	add_image_size( 'column2-2/3', 570, 380, true );
	add_image_size( 'column2-3/5', 570, 342, true );

	/* 3 Column Layout */
	add_image_size( 'column3-1/1', 380, 380, true );
	add_image_size( 'column3-1/3', 380, 107, true );
	add_image_size( 'column3-2/5', 380, 152, true );	
	add_image_size( 'column3-2/3', 380, 254, true );
	add_image_size( 'column3-3/4', 380, 285, true );

	/* 4 Column Layout */
	add_image_size( 'column4-1/1', 285, 285, true );
	add_image_size( 'column4-2/3', 285, 190, true );
	add_image_size( 'column4-3/4', 285, 214, true );
}
add_action( 'init', 'thinkup_input_addimagesizes' );
 
function thinkup_input_showimagesizes($sizes) {

	// 1 Column Layout
	$sizes['column1-1/2'] = 'Full - 1:2';
	$sizes['column1-1/3'] = 'Full - 1:3';
	$sizes['column1-1/4'] = 'Full - 1:4';
	$sizes['column1-2/5'] = 'Full - 2:5';

	// 2 Column Layout
	$sizes['column2-1/1'] = 'Half - 1:1';
	$sizes['column2-1/2'] = 'Half - 1:2';
	$sizes['column2-2/3'] = 'Half - 2:3';
	$sizes['column2-3/5'] = 'Half - 3:5';

	// 3 Column Layout
	$sizes['column3-1/1'] = 'Third - 1:1';
	$sizes['column3-2/5'] = 'Third - 2:5';
	$sizes['column3-2/3'] = 'Third - 2:3';
	$sizes['column3-3/4'] = 'Third - 3:4';

	// 4 Column Layout
	$sizes['column4-1/1'] = 'Quarter - 1:1';
	$sizes['column4-2/3'] = 'Quarter - 2:3';
	$sizes['column4-3/4'] = 'Quarter - 3:4';

	return $sizes;
}
add_filter('image_size_names_choose', 'thinkup_input_showimagesizes');


//----------------------------------------------------------------------------------
//	ADD FUNCTION TO GET CURRENT PAGE URL
//----------------------------------------------------------------------------------

function thinkup_check_currentpage() {
	$pageURL = 'http';
	if( isset($_SERVER["HTTPS"]) ) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	$pageURL = rtrim($pageURL, '/') . '/';

	$currentURL = get_permalink();

	// Add www. to current page url if present in permalink
	if (strpos( $currentURL, 'www.' ) !== false) {
		$pageURL = $pageURL;
	} else {
		$pageURL = str_replace( "www.", "", $pageURL );
	}

	return $pageURL;
}

function thinkup_check_ishome() {
	$pageURL = 'http';
	if( isset($_SERVER["HTTPS"]) ) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	$pageURL = rtrim($pageURL, '/') . '/';

	$pageURL = str_replace( "www.", "", $pageURL );
	$siteURL = str_replace( "www.", "", site_url( '/' ) );

	if ( $pageURL == $siteURL ) {
		return true;
	} else {
		return false;
	}
}


//----------------------------------------------------------------------------------
//	ADD CUSTOM COMMENTS POP UP LINK FUNCTION - Credit to http://www.thescubageek.com/code/wordpress-code/add-get_comments_popup_link-to-wordpress/
//----------------------------------------------------------------------------------

// Modifies WordPress's built-in comments_popup_link() function to return a string instead of echo comment results
function thinkup_input_commentspopuplink( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
    global $wpcommentspopupfile, $wpcommentsjavascript;
 
    $id = get_the_ID();
 
    if ( false === $zero ) $zero = __( 'No Comments','sento' );
    if ( false === $one ) $one = __( '1 Comment','sento' );
    if ( false === $more ) $more = __( '% Comments','sento' );
    if ( false === $none ) $none = __( 'Comments Off','sento' );
 
    $number = get_comments_number( $id );
 
    $str = '';
 
    if ( 0 == $number && !comments_open() && !pings_open() ) {
        $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
        return $str;
    }
 
    if ( post_password_required() ) {
        $str = __('Enter your password to view comments.','sento');
        return $str;
    }
 
    $str = '<a href="';
    if ( $wpcommentsjavascript ) {
        if ( empty( $wpcommentspopupfile ) )
            $home = home_url();
        else
            $home = get_option('siteurl');
        $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
        $str .= '" onclick="wpopen(this.href); return false"';
    } else { // if comments_popup_script() is not in the template, display simple comment link
        if ( 0 == $number )
            $str .= get_permalink() . '#respond';
        else
            $str .= get_comments_link();
        $str .= '"';
    }
 
    if ( !empty( $css_class ) ) {
        $str .= ' class="'.$css_class.'" ';
    }
    $title = the_title_attribute( array('echo' => 0 ) );
 
    $str .= apply_filters( 'comments_popup_link_attributes', '' );
 
    $str .= ' title="' . esc_attr( sprintf( __('Comment on %s','sento'), $title ) ) . '">';
    $str .= thinkup_comments_returnstring( $zero, $one, $more );
    $str .= '</a>';
     
    return $str;
}
 
// Modifies WordPress's built-in comments_number() function to return string instead of echo
function thinkup_comments_returnstring( $zero = false, $one = false, $more = false, $deprecated = '' ) {
    if ( !empty( $deprecated ) )
        _deprecated_argument( __FUNCTION__, '1.3' );
 
    $number = get_comments_number();
 
    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __( '% Comments', 'sento' ) : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? __( 'No Comments', 'sento' ) : $zero;
    else // must be one
        $output = ( false === $one ) ? __( '1 Comment', 'sento' ) : $one;
 
    return apply_filters('comments_number', $output, $number);
}


//----------------------------------------------------------------------------------
//	CHANGE FALLBACK WP_PAGE_MENU CLASSES TO MATCH WP_NAV_MENU CLASSES
//----------------------------------------------------------------------------------

function thinkup_input_menuclass( $ulclass ) {

	$ulclass = preg_replace( '/<ul>/', '<ul class="menu">', $ulclass, 1 );
	$ulclass = str_replace( 'children', 'sub-menu', $ulclass );

	return preg_replace('/<div (.*)>(.*)<\/div>/iU', '$2', $ulclass );
}
add_filter( 'wp_page_menu', 'thinkup_input_menuclass' );


//----------------------------------------------------------------------------------
//	DETERMINE IF THE PAGE IS A BLOG - USEFUL FOR HOMEPAGE BLOG.
//----------------------------------------------------------------------------------

// Credit to: http://www.poseidonwebstudios.com/web-development/wordpress-is_blog-function/
function thinkup_check_isblog() {
 
    global $post;
 
    //Post type must be 'post'.
    $post_type = get_post_type($post);
 
    //Check all blog-related conditional tags, as well as the current post type,
    //to determine if we're viewing a blog page.
    return (
        ( is_home() || is_archive() )
        && ($post_type == 'post')
    ) ? true : false ;
 
}


//----------------------------------------------------------------------------------
//	GET EXCERPT BY ID.
//----------------------------------------------------------------------------------

function thinkup_input_excerptbyid( $post_id, $except_count = 55 ) {
	$the_post = get_post( $post_id );
	
	// Get post excerpt
	$the_excerpt = $the_post->post_excerpt;
	
	// Get post content if no excerp set
	if ( empty( $the_excerpt ) ) {
		$the_excerpt = $the_post->post_content;
	}

	//Sets excerpt length by word count
	$excerpt_length = $except_count;

	 //Strips tags and images
	$the_excerpt = strip_tags( strip_shortcodes( $the_excerpt ) );
	$words = explode( ' ', $the_excerpt, $excerpt_length + 1 );

	if( count( $words ) > $excerpt_length ) {
		array_pop( $words );
		array_push( $words, '…' );
		$the_excerpt = implode( ' ', $words );
	}

	if ( ! empty( $the_excerpt ) ) {
		$the_excerpt = '<p>' . $the_excerpt . '</p>';
	}
	return $the_excerpt;
}


//----------------------------------------------------------------------------------
//	ADD GOOGLE FONT - OPEN SANS. (http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/)
//----------------------------------------------------------------------------------

function thinkup_googlefonts_url() {
    $fonts_url = '';

    // Translators: Translate this to 'off' if there are characters in your language that are not supported by Open Sans
    $font_translate = _x( 'on', 'Open Sans font: on or off', 'sento' );
 
    if ( 'off' !== $font_translate ) {
        $font_families = array();
  
        if ( 'off' !== $font_translate ) {
            $font_families[] = 'Open Sans:300,400,600,700';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

function thinkup_googlefonts_scripts() {
   wp_enqueue_style( 'thinkup-google-fonts', thinkup_googlefonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'thinkup_googlefonts_scripts' );


//----------------------------------------------------------------------------------
//	ADD THEMEBUTTON2 CLASS TO COMMENT CANCEL REPLY BUTTON
//----------------------------------------------------------------------------------

function thinkup_input_cancelreplyclass($class){
    $class = str_replace( 'id="cancel-comment-reply-link"', 'id="cancel-comment-reply-link" class="themebutton2"', $class);
    return $class;
}
add_filter('cancel_comment_reply_link', 'thinkup_input_cancelreplyclass');

