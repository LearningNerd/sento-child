<?php
/**
 * Blog functions.
 *
 * @package Sento
 */


 /* ----------------------------------------------------------------------------------
	BLOG STYLE
---------------------------------------------------------------------------------- */

function thinkup_input_blogclass($classes){
global $thinkup_blog_style;
global $thinkup_blog_style1layout;

global $post;

	if ( thinkup_check_isblog() ) {
		$classes[] = 'blog-style1 blog-style1-layout1';
	}
	return $classes;
}
add_action( 'body_class', 'thinkup_input_blogclass');

// Add blog class to search results page
function thinkup_input_searchclass($classes){

	if ( is_search() ) {
		$classes[] = 'blog-style1';
	}
	return $classes;
}
add_action( 'body_class', 'thinkup_input_searchclass');	

/* ----------------------------------------------------------------------------------
	BLOG STYLE - CLASSES FOR STYLE 1
---------------------------------------------------------------------------------- */

function thinkup_input_stylelayout_class1() {
global $post;

	if ( has_post_thumbnail( $post->ID ) ) {
		echo ' one_fifth';
	}
}

function thinkup_input_stylelayout_class2() {
global $post;

	if ( has_post_thumbnail( $post->ID ) ) {
		echo ' four_fifth last';
	}
}


/* ----------------------------------------------------------------------------------
	BLOG STYLE (INCLUDED TO ALLOW ADDITION OF NEW LAYOUTS IN FUTURE UPDATE)
---------------------------------------------------------------------------------- */

function thinkup_input_stylelayout() {
	echo ' column-1';
}


/* ----------------------------------------------------------------------------------
	HIDE POST TITLE
---------------------------------------------------------------------------------- */

function thinkup_input_blogtitle() {

		echo	'<h2 class="blog-title">',
				'<a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'sento' ), the_title_attribute( 'echo=0' ) ) ) . '">' . esc_attr( get_the_title() ) . '</a>',
				'</h2>';
}


/* ----------------------------------------------------------------------------------
	BLOG CONTENT
---------------------------------------------------------------------------------- */

// Input post thumbnail / featured media
function thinkup_input_blogimage() {
global $post;
global $thinkup_blog_lightbox;
global $thinkup_blog_link;

	$size    = NULL;
	$link    = NULL;
	$media   = NULL;
	$output  = NULL;

	$blog_lightbox = NULL;
	$blog_link     = NULL;
	$blog_class    = NULL;
	$blog_overlay  = NULL;

	// Set image size for blog thumbnail
	$size = 'column4-1/1';

	$featured_id = get_post_thumbnail_id( $post->ID );
	$featured_img = wp_get_attachment_image_src($featured_id,'full', true);

	// Determing featured media to input
	$link  = $featured_img[0];
	$media = get_the_post_thumbnail( $post->ID, $size );

	// Determine which links to show on hover
	if ( $thinkup_blog_lightbox =='1' ) {
		$blog_lightbox = '<a class="hover-zoom prettyPhoto" href="' . esc_url( $link ) . '"><i class="dashicons dashicons-editor-distractionfree"></i></a>';
	}
	if ( $thinkup_blog_link =='1' ) {
		$blog_link = '<a class="hover-link" href="' . esc_url( get_permalink() ) . '"><i class="dashicons dashicons-arrow-right-alt2"></i></a>';
	}

	// Determine which if single link animation should be shown
	if ( ( $thinkup_blog_lightbox =='1' and $thinkup_blog_link !== '1' ) 
		or ( $thinkup_blog_lightbox !=='1' and $thinkup_blog_link == '1' ) ) {
		$blog_class = ' style2';
	}

	if ( $thinkup_blog_lightbox =='1' or $thinkup_blog_link =='1' ) {
		$blog_overlay .= '<div class="image-overlay' . $blog_class . '">';
		$blog_overlay .= '<div class="image-overlay-inner"><div class="prettyphoto-wrap">';
		$blog_overlay .= $blog_lightbox;
		$blog_overlay .= $blog_link;
		$blog_overlay .= '</div></div>';
		$blog_overlay .= '</div>';
	}

	// Output media on blog page
	if ( ! empty( $featured_id ) ) {
		$output .= '<div class="blog-thumb">';
		$output .= '<a href="'. esc_url( get_permalink( $post->ID ) ) . '">' . $media . '</a>';
		$output .= $blog_overlay;
		$output .= '</div>';
	}

	return $output;
}

// Input post excerpt / content to blog page
function thinkup_input_blogtext() {
global $post;
global $thinkup_blog_postswitch;

	// Output post content
	if ( is_search() ) {
		the_excerpt();
	} else if ( ! is_search() ) {
		if ( ( empty( $thinkup_blog_postswitch ) or $thinkup_blog_postswitch == 'option1' ) and ! is_numeric( strpos( $post->post_content, '<!--more-->' ) ) ) {
			the_excerpt();
		} else if ( $thinkup_blog_postswitch == 'option2' ) {		
			the_content();
		}
	}
}


/* ----------------------------------------------------------------------------------
	BLOG POST EXCERPT
---------------------------------------------------------------------------------- */

function thinkup_input_blogpostexcerpt() {
global $thinkup_blog_postswitch;
global $thinkup_blog_postexcerpt;

global $thinkup_blog_pageid;
$_thinkup_meta_blogpostexcerpts = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogpostexcerpts', true );

	if ( $thinkup_blog_postswitch == 'option1' or empty( $thinkup_blog_postswitch ) ) {

		if ( thinkup_check_isblog() or get_page_template_slug( $thinkup_blog_pageid ) == 'template-blog.php' ) {

			if ( ! is_numeric( $_thinkup_meta_blogpostexcerpts ) ) {
				if ( is_numeric( $thinkup_blog_postexcerpt ) ) {
					return $thinkup_blog_postexcerpt;
				}
			} else if ( is_numeric( $_thinkup_meta_blogpostexcerpts ) ) {
				return $_thinkup_meta_blogpostexcerpts;
			}
		}
	}

	// return default value if not triggered above
	return 55;
}
add_filter( 'excerpt_length', 'thinkup_input_blogpostexcerpt', 999 );

function thinkup_input_blogpostcount() {
global $thinkup_blog_pageid;

global $thinkup_blog_pageid;
$_thinkup_meta_blogpostcount = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogpostcount', true );

	if ( empty( $_thinkup_meta_blogpostcount ) or $_thinkup_meta_blogpostcount == 'default' ) {
		return get_option('posts_per_page');
	} else {
		return $_thinkup_meta_blogpostcount;
	}
}


/* ----------------------------------------------------------------------------------
	BLOG META CONTENT & POST META CONTENT
---------------------------------------------------------------------------------- */

// Input sticky post
function thinkup_input_sticky() {
	printf( '<span class="sticky"><a href="%1$s" title="%2$s">' . __( 'Sticky', 'sento' ) . '</a></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_title() )
	);
}

// Input blog date
function thinkup_input_blogdate() {
	printf( __( '<span class="date"><a href="%1$s" title="%2$s"><time datetime="%3$s"><span class="date-day">%4$s</span><span class="date-month">%5$s</span></time></a></span>', 'sento' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_title() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'j' ) ),
		esc_html( get_the_date( 'F' ) )
	);
}

// Input blog comments
function thinkup_input_blogcomment() {

	if ( '0' != get_comments_number() ) {
		echo	'<span class="comment">';
			if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {;
				comments_popup_link( __( '<span class="comment-count">0</span> <span class="comment-text">Comments</span>', 'sento' ), __( '<span class="comment-count">1</span> <span class="comment-text">Comment</span>', 'sento' ), __( '<span class="comment-count">%</span> <span class="comment-text">Comments</span>', 'sento' ) );
			};
		echo	'</span>';
	}
}

// Input blog categories
function thinkup_input_blogcategory() {
$categories_list = get_the_category_list( __( ', ', 'sento' ) );

	if ( $categories_list && thinkup_input_categorizedblog() ) {
		echo	'<span class="category">';
		printf( __( '%1$s', 'sento' ), $categories_list );
		echo	'</span>';
	};
}

// Input blog tags
function thinkup_input_blogtag() {
$tags_list = get_the_tag_list( '', __( ', ', 'sento' ) );

	if ( $tags_list ) {
		echo	'<span class="tags">';
		printf( __( '%1$s', 'sento' ), $tags_list );
		echo	'</span>';
	};
}

// Input blog author
function thinkup_input_blogauthor() {
	printf( __( '<span class="author"><a href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 'sento' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'sento' ), get_the_author() ) ),
		get_the_author()
	);
}

//----------------------------------------------------------------------------------
//	CUSTOM READ MORE FOR the_content() AND the_excerpt().
//----------------------------------------------------------------------------------

function thinkup_input_readmore() {
global $post;
global $thinkup_blog_style;
global $thinkup_blog_pageid;
global $thinkup_translate_blogreadmore;

// Set variables to avoid php non-object notice error
$_thinkup_meta_blogstyle = NULL;
$class_button = NULL;

// Assign meta data variable
if ( ! empty( $thinkup_blog_pageid ) ) {
	$_thinkup_meta_blogstyle = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle', true );
}

	// Specify button class for blog style
	if ( get_page_template_slug( $thinkup_blog_pageid ) !== 'template-blog.php' ) {
		if ( empty( $thinkup_blog_style ) or $thinkup_blog_style == 'option1') {
			$class_button = 'themebutton2';
		} else {
			$class_button = 'themebutton2';		
		}
	} else if ( get_page_template_slug( $thinkup_blog_pageid ) == 'template-blog.php' ) {
		if ( empty( $_thinkup_meta_blogstyle ) or $_thinkup_meta_blogstyle == 'option1' ) {
			if ( empty( $thinkup_blog_style ) or $thinkup_blog_style == 'option1' ) {
				$class_button = 'themebutton2';
			} else {
				$class_button = 'themebutton2';		
			}
		} else if ( $_thinkup_meta_blogstyle == 'option2' ) {
			$class_button = 'themebutton2';
		} else {
			$class_button = 'themebutton2';
		}
	}

	if( empty( $thinkup_translate_blogreadmore ) ) {
		$thinkup_translate_blogreadmore = __( 'READ MORE', 'sento');
	}

	return '<p class="more-link"><a href="'. esc_url( get_permalink( $post->ID ) ) . '" class="' . $class_button . '">' . esc_html( $thinkup_translate_blogreadmore ) . '</a></p>';
}
add_filter( 'excerpt_more', 'thinkup_input_readmore' );
add_filter( 'the_content_more_link', 'thinkup_input_readmore' );


/* ----------------------------------------------------------------------------------
	INPUT BLOG META COMMENT CLASS
---------------------------------------------------------------------------------- */

// Input blog comments
function thinkup_input_blogcommentclass() {
global $thinkup_blog_style;
global $thinkup_blog_date;

global $post;
global $thinkup_blog_pageid;

// Set variables to avoid php non-object notice error
$_thinkup_meta_blogstyle = NULL;

// Assign meta data variable
if ( ! empty( $thinkup_blog_pageid ) ) {
	$_thinkup_meta_blogstyle = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle', true );
	$_thinkup_meta_blogdate  = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogdate', true );
}

// Ensure entry-ontent displays correctly if post has no featured media
$check_blogimage = thinkup_input_blogimage();

if ( empty( $check_blogimage ) ) {
	$class_aligndate = '1';
} else {
	$class_aligndate = NULL;
}

	// Only output for blog layout 1
	if ( get_page_template_slug( $thinkup_blog_pageid ) !== 'template-blog.php' ) {
		if ( $thinkup_blog_date !== '1' and $class_aligndate == '1' ) {
			echo ' date-icon';
		}
	} else if ( get_page_template_slug( $thinkup_blog_pageid ) == 'template-blog.php' ) {
		if ( empty( $_thinkup_meta_blogdate ) ) {
			if ( $thinkup_blog_date !== '1' and $class_aligndate == '1' ) {
				echo ' date-icon';
			}
		} else if ( $_thinkup_meta_blogdate == 'on' and $class_aligndate == '1' ) {
			echo ' date-icon';
		}
	}
}


/* ----------------------------------------------------------------------------------
	INPUT BLOG META CONTENT
---------------------------------------------------------------------------------- */

// Blog meta content - Blog style 1
function thinkup_input_blogmeta() {
global $thinkup_blog_style;
global $thinkup_blog_date;
global $thinkup_blog_author;
global $thinkup_blog_comment;
global $thinkup_blog_category;
global $thinkup_blog_tag;

global $post;
global $thinkup_blog_pageid;
$_thinkup_meta_blogdate     = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogdate', true );
$_thinkup_meta_blogauthor   = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogauthor', true );
$_thinkup_meta_blogcomment  = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogcomment', true );
$_thinkup_meta_blogcategory = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogcategory', true );
$_thinkup_meta_blogtags     = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogtags', true );

// Set variables to avoid php non-object notice error
$_thinkup_meta_blogstyle = NULL;

// Assign meta data variable
if ( ! empty( $thinkup_blog_pageid ) ) {
	$_thinkup_meta_blogstyle = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle', true );
}

	if ( get_page_template_slug( $thinkup_blog_pageid ) !== 'template-blog.php' ) {
		if ( $thinkup_blog_date !== '1' or 
			$thinkup_blog_author !== '1' or 
			$thinkup_blog_comment !== '1' or 
			$thinkup_blog_category !== '1' or 
			$thinkup_blog_tag !== '1') {

			echo '<div class="entry-meta">';
				if ( is_sticky() && is_home() && ! is_paged() ) { thinkup_input_sticky(); }

				if ($thinkup_blog_date !== '1')     { thinkup_input_blogdate();     }
				if ($thinkup_blog_author !== '1')   { thinkup_input_blogauthor();   }
				if ($thinkup_blog_comment !== '1')  { thinkup_input_blogcomment();  }	
				if ($thinkup_blog_category !== '1') { thinkup_input_blogcategory(); }
				if ($thinkup_blog_tag !== '1')      { thinkup_input_blogtag();      }
			echo '</div>';
		}
	} else if ( get_page_template_slug( $thinkup_blog_pageid ) == 'template-blog.php' ) {
		if ( $_thinkup_meta_blogdate == 'on' or 
			$_thinkup_meta_blogauthor == 'on' or 
			$_thinkup_meta_blogcomment == 'on' or 
			$_thinkup_meta_blogcategory == 'on' or 
			$_thinkup_meta_blogtags == 'on') {

			echo '<div class="entry-meta">';
				if ($_thinkup_meta_blogdate == 'on')     { thinkup_input_blogdate();     }
				if ($_thinkup_meta_blogauthor == 'on')   { thinkup_input_blogauthor();   }
				if ($_thinkup_meta_blogcomment == 'on')  { thinkup_input_blogcomment();  }	
				if ($_thinkup_meta_blogcategory == 'on') { thinkup_input_blogcategory(); }
				if ($_thinkup_meta_blogtags == 'on')      { thinkup_input_blogtag();      }
			echo '</div>';
		}
	}
}


/* ----------------------------------------------------------------------------------
	INPUT POST META CONTENT
---------------------------------------------------------------------------------- */

function thinkup_input_postmedia() {
global $thinkup_post_date;
global $thinkup_post_author;
global $thinkup_post_comment;
global $thinkup_post_category;
global $thinkup_post_tag;

global $post;
global $wp_embed;

if ( ! empty( $post->ID ) ) {
	$_thinkup_meta_featuredmedia   = get_post_meta( $post->ID, '_thinkup_meta_featuredmedia', true );
	$_thinkup_meta_featuredgallery = get_post_meta( $post->ID, '_thinkup_meta_featuredgallery', true ); 
}

	// Set output variable to avoid php errors
	$output = NULL;

	if ( get_post_format() == 'image' ) {

		$output .= '<div class="post-thumb">' . get_the_post_thumbnail( $post->ID, 'column1-1/4' ) . '</div>';

	} else if ( get_post_format() == 'gallery' and ! empty( $_thinkup_meta_featuredgallery ) ) {

		if ( is_array( $_thinkup_meta_featuredgallery ) ) $slide_height = $_thinkup_meta_featuredgallery['height'];

		if ( empty( $slide_height ) ) $slide_height = '200';

		$output .= '<div class="post-thumb">';
		$output .= '<div class="rslides-sc" data-height="' . esc_attr( $slide_height ) . '">';
		$output .= '<div class="rslides-container">';
		$output .= '<div class="rslides-inner">';
		$output .= '<ul class="slides">';

		$count = 0;

		// Begin loop to import gallery images
		foreach ( $_thinkup_meta_featuredgallery['image'] as $slide => $list) {

			$slide_id = $_thinkup_meta_featuredgallery['image'][ $count ];

			$slide_img   = wp_get_attachment_image_src( $slide_id, true );
			$slide_image = 'background: url(' . esc_url( $slide_img[0] ) . ') no-repeat center; background-size: cover;';

			$output .= '<li>';
			$output .= '<img src="' . esc_url( get_template_directory_uri() ) . '/images/transparent.png" style="' . $slide_image . '" alt="Image" />';
			$output .= '</li>';

		$count++;
		}

		$output .= '</ul>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';

	} else if ( get_post_format() == 'video' and ! empty( $_thinkup_meta_featuredmedia ) ) {

		// Remove http:// and https:// from video link
		if ( strpos( $_thinkup_meta_featuredmedia, 'https://' ) !== false ) {
			$_thinkup_meta_featuredmedia = 'https://' . str_replace( 'https://', '', $_thinkup_meta_featuredmedia );
		} else {
			$_thinkup_meta_featuredmedia = 'http://' . str_replace( 'http://', '', $_thinkup_meta_featuredmedia );
		}

		$link  = $_thinkup_meta_featuredmedia;
		$media = $wp_embed->run_shortcode('[embed]' . $_thinkup_meta_featuredmedia . '[/embed]');

		$output .= '<div class="post-thumb">' . $media . '</div>';

	}

	// Output featured items if set
	if ( ! empty( $output ) ) {
		echo $output;
	}
}

// Add format-media class to post article for featured image, gallery and video
function thinkup_input_postmediaclass($classes) {
global $post;
global $wp_embed;

if ( ! empty( $post->ID ) ) {
	$_thinkup_meta_featuredmedia   = get_post_meta( $post->ID, '_thinkup_meta_featuredmedia', true );
	$_thinkup_meta_featuredgallery = get_post_meta( $post->ID, '_thinkup_meta_featuredgallery', true ); 
}

	if ( is_singular( 'post' ) ) {
		if ( get_post_format() == 'image' or get_post_format() == 'gallery' or get_post_format() == 'video' ) {
			$classes[] = 'format-media';
		} else {
			$classes[] = 'format-nomedia';			
		}
	}
	return $classes;
}
add_action( 'post_class', 'thinkup_input_postmediaclass');

// Input meta data for single post
function thinkup_input_postmeta() {
global $thinkup_post_date;
global $thinkup_post_author;
global $thinkup_post_comment;
global $thinkup_post_category;
global $thinkup_post_tag;
global $thinkup_post_title;

// Reset variable values to avoid php error
$class_comment = NULL;

	if ( $thinkup_post_date !== '1' or 
		$thinkup_post_author !== '1' or 
		$thinkup_post_comment !== '1' or 
		$thinkup_post_category !== '1' or 
		$thinkup_post_tag !== '1' or 
		$thinkup_post_title !== '1') {


			// Only output for blog layout 1
			if ( '0' != get_comments_number() and $thinkup_post_comment !== '1' ) {
				$class_comment = ' comment-icon';
			}

			echo '<header class="entry-header' . $class_comment . '">';

			if ($thinkup_post_title !== '1') { echo '<h3 class="post-title">' . get_the_title() . '</h3>'; }

			echo '<div class="entry-meta">';
				if ($thinkup_post_date !== '1')     { thinkup_input_blogdate();     }
				if ($thinkup_post_author !== '1')   { thinkup_input_blogauthor();   }
				if ($thinkup_post_comment !== '1')  { thinkup_input_blogcomment();  }	
				if ($thinkup_post_category !== '1') { thinkup_input_blogcategory(); }
				if ($thinkup_post_tag !== '1')      { thinkup_input_blogtag();      }
			echo '</div>';

			echo '<div class="clearboth"></div></header><!-- .entry-header -->';
	}
}


/* ----------------------------------------------------------------------------------
	SHOW SOCIAL SHARING
---------------------------------------------------------------------------------- */

/* HTML for Social Sharing */
function thinkup_input_sharecode() {
global $thinkup_post_sharemessage;
global $thinkup_post_sharefacebook;
global $thinkup_post_sharetwitter;
global $thinkup_post_sharegoogle;
global $thinkup_post_sharelinkedin;
global $thinkup_post_sharetumblr;
global $thinkup_post_sharepinterest;
global $thinkup_post_shareemail;

	/* Remove white spaces from title */
	$page_title = str_replace(' ', '%20', get_the_title());

	echo	'<div id="sharepost">';
		echo	'<div id="sharemessage">';
		if ( ! empty( $thinkup_post_sharemessage ) ) { 
			echo '<p>' . esc_attr( $thinkup_post_sharemessage ) . '</p>';
		} else {
			echo '<p>Spread the word. Share this post!</p>'; 
		}
		echo	'</div>';
		echo	'<div id="shareicons" class="">';
		if ( $thinkup_post_sharefacebook == '1' ) {
			echo '<a class="shareicon facebook" onclick="MyWindow=window.open(&#39;//www.facebook.com/sharer.php?u=' . esc_url( get_permalink() ) . '&#38;t=' . esc_attr( $page_title ) . '&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="//www.facebook.com/sharer.php?u=' . esc_url( get_permalink() ) . '&#38;t=' . esc_attr( $page_title ) . '" data-tip="top" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>';
		}
		if ( $thinkup_post_sharetwitter == '1' ) {
			echo '<a class="shareicon twitter" onclick="MyWindow=window.open(&#39;//twitter.com/home?status=Check%20this%20out!%20' . esc_attr( $page_title ) . '%20at%20' . esc_url( get_permalink() ) . '&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="//twitter.com/home?status=Check%20this%20out!%20' . esc_attr( $page_title ) . '%20at%20' . esc_url( get_permalink() ) . '" data-tip="top" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>';
		}
		if ( $thinkup_post_sharegoogle == '1' ) {
			echo '<a class="shareicon Google" onclick="MyWindow=window.open(&#39;//plus.google.com/share?url=' . esc_url( get_permalink() ) . '&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="//plus.google.com/share?url=' . esc_url( get_permalink() ) . '" data-tip="top" data-original-title="Google+"><i class="fa fa-google-plus"></i></a>';
		}
		if ( $thinkup_post_sharelinkedin =='1' ) {
			echo '<a class="shareicon linkedin" onclick="MyWindow=window.open(&#39;//linkedin.com/shareArticle?mini=true&url=' . esc_url( get_permalink() ) . '&summary=' . esc_attr( $page_title ) . '&source=LinkedIn&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="//linkedin.com/shareArticle?mini=true&url=' . esc_url( get_permalink() ) . '&summary=' . esc_attr( $page_title ) . '&source=LinkedIn" data-tip="top" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a>';
		}
		if ( $thinkup_post_sharetumblr == '1' ) {
			echo '<a class="shareicon tumblr" data-tip="top" data-original-title="Tumblr" onclick="MyWindow=window.open(&#39;//www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&amp;name=' . urlencode($page_title) . '&amp;description=' . urlencode(get_the_excerpt()) . '&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="//www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&amp;name=' . urlencode($page_title) . '&amp;description=' . urlencode(get_the_excerpt()) . '"><i class="fa fa-tumblr"></i></a>';
		}
		if ( $thinkup_post_sharepinterest == '1' ) {
			echo '<a class="shareicon pinterest" data-tip="top" data-original-title="Pinterest" onclick="MyWindow=window.open(&#39;//pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . urlencode(get_the_title()) . '&amp;media=' . urlencode(wp_get_attachment_url( get_post_thumbnail_id($post->ID) )) . '&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="//pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . urlencode(get_the_title()) . '&amp;media=' . urlencode(wp_get_attachment_url( get_post_thumbnail_id($post->ID) )) . '"><i class="fa fa-pinterest"></i></a>';
		}
		if ( $thinkup_post_shareemail == '1' ) {
			echo	'<a class="shareicon email" data-tip="top" data-original-title="Email" onclick="MyWindow=window.open(&#39;mailto:?subject=' . get_the_title() . '&amp;body=' . esc_url( get_permalink() ) . '&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="mailto:?subject=' . esc_attr( get_the_title() ) . '&amp;body=' . esc_url( get_permalink() ) . '"><i class="fa fa-envelope"></i></a>';
		}
		echo	'</div>';		
	echo	'</div>';
}

/* Output Social Sharing */
function thinkup_input_share() {
global $thinkup_post_share;

global $post;
$_thinkup_meta_share = get_post_meta($post->ID, '_thinkup_meta_share', true);

	if ( empty( $_thinkup_meta_share ) or $_thinkup_meta_share == 'option1' )  {
		if ( $thinkup_post_share == '1' ) {
			thinkup_input_sharecode();
		}
	} else if ( $_thinkup_meta_share == 'option2' ) {
		thinkup_input_sharecode();
	}
}


/* ----------------------------------------------------------------------------------
	TEMPLATE FOR COMMENTS AND PINGBACKS (PREVIOUSLY IN TEMPLATE-TAGS).
---------------------------------------------------------------------------------- */

/* Display comments  - Style 1 */
function thinkup_input_allowcomments() {

	if ( comments_open() || '0' != get_comments_number() ) {
		comments_template( '/comments.php', true );
	}
}


/* ----------------------------------------------------------------------------------
	TEMPLATE FOR COMMENTS AND PINGBACKS (PREVIOUSLY IN TEMPLATE-TAGS).
---------------------------------------------------------------------------------- */

function thinkup_input_commenttemplate( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'sento'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'sento' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
					<?php echo get_avatar( $comment, 100 ); ?>
			<header>

				<div class="comment-author">
					<h4><?php printf( '%s', sprintf( '%s', get_comment_author_link() ) ); ?></h4>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'sento'); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( '%1$s', get_comment_date( "j / M / Y" ) ); ?>
					</time></a>
					<?php edit_comment_link( __( 'Edit', 'sento' ), ' ' );
					?>
				</div>

				<span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</span>

			</header>

			<footer>

				<div class="comment-content"><?php comment_text(); ?></div>

			</footer>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}

// List comments in single page
function thinkup_input_comments() {
	$args = array( 
		'callback' => 'thinkup_input_commenttemplate', 
	);
	wp_list_comments( $args );
}


?>