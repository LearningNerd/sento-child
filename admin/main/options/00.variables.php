<?php
/**
 * Theme setup functions.
 *
 * @package Sento
 */


/* ----------------------------------------------------------------------------------
	ADD CUSTOM VARIABLES
---------------------------------------------------------------------------------- */

/* Add global variables used in Redux framework */
function thinkup_reduxvariables() { 

	// Fetch options stored in $data.
	global $thinkup_redux_variables;

	//  1.1.     General settings.
	$GLOBALS['thinkup_general_logoswitch']                  = thinkup_var ( 'thinkup_general_logoswitch' );
	$GLOBALS['thinkup_general_logolink']                    = thinkup_var ( 'thinkup_general_logolink', 'url' );
	$GLOBALS['thinkup_general_logolinkretina']              = thinkup_var ( 'thinkup_general_logolinkretina', 'url' );
	$GLOBALS['thinkup_general_sitetitle']                   = thinkup_var ( 'thinkup_general_sitetitle' );
	$GLOBALS['thinkup_general_sitedescription']             = thinkup_var ( 'thinkup_general_sitedescription' );
	$GLOBALS['thinkup_general_faviconlink']                 = thinkup_var ( 'thinkup_general_faviconlink', 'url' );
	$GLOBALS['thinkup_general_layout']                      = thinkup_var ( 'thinkup_general_layout' );
	$GLOBALS['thinkup_general_sidebars']                    = thinkup_var ( 'thinkup_general_sidebars' );
	$GLOBALS['thinkup_general_fixedlayoutswitch']           = thinkup_var ( 'thinkup_general_fixedlayoutswitch' );
	$GLOBALS['thinkup_general_boxlayout']                   = thinkup_var ( 'thinkup_general_boxlayout' );
	$GLOBALS['thinkup_general_boxbackgroundcolor']          = thinkup_var ( 'thinkup_general_boxbackgroundcolor' );
	$GLOBALS['thinkup_general_boxbackgroundimage']          = thinkup_var ( 'thinkup_general_boxbackgroundimage', 'url' );
	$GLOBALS['thinkup_general_boxedposition']               = thinkup_var ( 'thinkup_general_boxedposition' );
	$GLOBALS['thinkup_general_boxedrepeat']                 = thinkup_var ( 'thinkup_general_boxedrepeat' );
	$GLOBALS['thinkup_general_boxedsize']                   = thinkup_var ( 'thinkup_general_boxedsize' );
	$GLOBALS['thinkup_general_boxedattachment']             = thinkup_var ( 'thinkup_general_boxedattachment' );
	$GLOBALS['thinkup_general_customcss']                   = thinkup_var ( 'thinkup_general_customcss' );
	$GLOBALS['thinkup_general_customjavafront']             = thinkup_var ( 'thinkup_general_customjavafront' );

	//  1.2.1    Homepage.
	$GLOBALS['thinkup_homepage_layout']                     = thinkup_var ( 'thinkup_homepage_layout' );
	$GLOBALS['thinkup_homepage_sidebars']                   = thinkup_var ( 'thinkup_homepage_sidebars' );
	$GLOBALS['thinkup_homepage_sliderswitch']               = thinkup_var ( 'thinkup_homepage_sliderswitch' );
	$GLOBALS['thinkup_homepage_slidername']                 = thinkup_var ( 'thinkup_homepage_slidername' );
	$GLOBALS['thinkup_homepage_sliderpreset']               = thinkup_var ( 'thinkup_homepage_sliderpreset' );
	$GLOBALS['thinkup_homepage_sliderstyle']                = thinkup_var ( 'thinkup_homepage_sliderstyle' );
	$GLOBALS['thinkup_homepage_sliderspeed']                = thinkup_var ( 'thinkup_homepage_sliderspeed' );
	$GLOBALS['thinkup_homepage_sliderpresetwidth']          = thinkup_var ( 'thinkup_homepage_sliderpresetwidth' );
	$GLOBALS['thinkup_homepage_sliderpresetheight']         = thinkup_var ( 'thinkup_homepage_sliderpresetheight' );
	$GLOBALS['thinkup_homepage_introswitch']                = thinkup_var ( 'thinkup_homepage_introswitch' );
	$GLOBALS['thinkup_homepage_introaction']                = thinkup_var ( 'thinkup_homepage_introaction' );
	$GLOBALS['thinkup_homepage_introactionteaser']          = thinkup_var ( 'thinkup_homepage_introactionteaser' );
	$GLOBALS['thinkup_homepage_introactiontext1']           = thinkup_var ( 'thinkup_homepage_introactiontext1' );
	$GLOBALS['thinkup_homepage_introactionlink1']           = thinkup_var ( 'thinkup_homepage_introactionlink1' );
	$GLOBALS['thinkup_homepage_introactionpage1']           = thinkup_var ( 'thinkup_homepage_introactionpage1' );
	$GLOBALS['thinkup_homepage_introactioncustom1']         = thinkup_var ( 'thinkup_homepage_introactioncustom1' );
	$GLOBALS['thinkup_homepage_outroswitch']                = thinkup_var ( 'thinkup_homepage_outroswitch' );
	$GLOBALS['thinkup_homepage_outroaction']                = thinkup_var ( 'thinkup_homepage_outroaction' );
	$GLOBALS['thinkup_homepage_outroactionteaser']          = thinkup_var ( 'thinkup_homepage_outroactionteaser' );
	$GLOBALS['thinkup_homepage_outroactiontext1']           = thinkup_var ( 'thinkup_homepage_outroactiontext1' );
	$GLOBALS['thinkup_homepage_outroactionlink1']           = thinkup_var ( 'thinkup_homepage_outroactionlink1' );
	$GLOBALS['thinkup_homepage_outroactionpage1']           = thinkup_var ( 'thinkup_homepage_outroactionpage1' );
	$GLOBALS['thinkup_homepage_outroactioncustom1']         = thinkup_var ( 'thinkup_homepage_outroactioncustom1' );

	//  1.2.2    Homepage (Content).
	$GLOBALS['thinkup_homepage_sectionswitch']              = thinkup_var ( 'thinkup_homepage_sectionswitch' );
	$GLOBALS['thinkup_homepage_section1_image']             = thinkup_var ( 'thinkup_homepage_section1_image', 'id' );
	$GLOBALS['thinkup_homepage_section1_imagesize']         = thinkup_var ( 'thinkup_homepage_section1_imagesize' );
	$GLOBALS['thinkup_homepage_section1_title']             = thinkup_var ( 'thinkup_homepage_section1_title' );
	$GLOBALS['thinkup_homepage_section1_desc']              = thinkup_var ( 'thinkup_homepage_section1_desc' );
	$GLOBALS['thinkup_homepage_section1_link']              = thinkup_var ( 'thinkup_homepage_section1_link' );
	$GLOBALS['thinkup_homepage_section1_url']               = thinkup_var ( 'thinkup_homepage_section1_url' );
	$GLOBALS['thinkup_homepage_section1_target']            = thinkup_var ( 'thinkup_homepage_section1_target' );	
	$GLOBALS['thinkup_homepage_section1_button']            = thinkup_var ( 'thinkup_homepage_section1_button' );
	$GLOBALS['thinkup_homepage_section2_image']             = thinkup_var ( 'thinkup_homepage_section2_image', 'id' );
	$GLOBALS['thinkup_homepage_section2_imagesize']         = thinkup_var ( 'thinkup_homepage_section2_imagesize' );
	$GLOBALS['thinkup_homepage_section2_title']             = thinkup_var ( 'thinkup_homepage_section2_title' );
	$GLOBALS['thinkup_homepage_section2_desc']              = thinkup_var ( 'thinkup_homepage_section2_desc' );	
	$GLOBALS['thinkup_homepage_section2_link']              = thinkup_var ( 'thinkup_homepage_section2_link' );
	$GLOBALS['thinkup_homepage_section2_url']               = thinkup_var ( 'thinkup_homepage_section2_url' );
	$GLOBALS['thinkup_homepage_section2_button']            = thinkup_var ( 'thinkup_homepage_section2_button' );
	$GLOBALS['thinkup_homepage_section2_target']            = thinkup_var ( 'thinkup_homepage_section2_target' );
	$GLOBALS['thinkup_homepage_section3_image']             = thinkup_var ( 'thinkup_homepage_section3_image', 'id' );
	$GLOBALS['thinkup_homepage_section3_imagesize']         = thinkup_var ( 'thinkup_homepage_section3_imagesize' );
	$GLOBALS['thinkup_homepage_section3_title']             = thinkup_var ( 'thinkup_homepage_section3_title' );
	$GLOBALS['thinkup_homepage_section3_desc']              = thinkup_var ( 'thinkup_homepage_section3_desc' );	
	$GLOBALS['thinkup_homepage_section3_link']              = thinkup_var ( 'thinkup_homepage_section3_link' );
	$GLOBALS['thinkup_homepage_section3_url']               = thinkup_var ( 'thinkup_homepage_section3_url' );
	$GLOBALS['thinkup_homepage_section3_button']            = thinkup_var ( 'thinkup_homepage_section3_button' );
	$GLOBALS['thinkup_homepage_section3_target']            = thinkup_var ( 'thinkup_homepage_section3_target' );
	$GLOBALS['thinkup_homepage_introswitch']                = thinkup_var ( 'thinkup_homepage_introswitch' );
	$GLOBALS['thinkup_homepage_introaction']                = thinkup_var ( 'thinkup_homepage_introaction' );
	$GLOBALS['thinkup_homepage_introactionteaser']          = thinkup_var ( 'thinkup_homepage_introactionteaser' );
	$GLOBALS['thinkup_homepage_introactionbutton']          = thinkup_var ( 'thinkup_homepage_introactionbutton' );
	$GLOBALS['thinkup_homepage_introactionlink']            = thinkup_var ( 'thinkup_homepage_introactionlink' );
	$GLOBALS['thinkup_homepage_introactionpage']            = thinkup_var ( 'thinkup_homepage_introactionpage' );
	$GLOBALS['thinkup_homepage_introactioncustom']          = thinkup_var ( 'thinkup_homepage_introactioncustom' );
	$GLOBALS['thinkup_homepage_outroswitch']                = thinkup_var ( 'thinkup_homepage_outroswitch' );
	$GLOBALS['thinkup_homepage_outroaction']                = thinkup_var ( 'thinkup_homepage_outroaction' );
	$GLOBALS['thinkup_homepage_outroactionteaser']          = thinkup_var ( 'thinkup_homepage_outroactionteaser' );
	$GLOBALS['thinkup_homepage_outroactionbutton']          = thinkup_var ( 'thinkup_homepage_outroactionbutton' );
	$GLOBALS['thinkup_homepage_outroactionlink']            = thinkup_var ( 'thinkup_homepage_outroactionlink' );
	$GLOBALS['thinkup_homepage_outroactionpage']            = thinkup_var ( 'thinkup_homepage_outroactionpage' );
	$GLOBALS['thinkup_homepage_outroactioncustom']          = thinkup_var ( 'thinkup_homepage_outroactioncustom' );

	//  1.3.     Header
	$GLOBALS['thinkup_header_styleswitchpre']               = thinkup_var ( 'thinkup_header_styleswitchpre' );
	$GLOBALS['thinkup_header_styleswitch']                  = thinkup_var ( 'thinkup_header_styleswitch' );
	$GLOBALS['thinkup_header_locationswitch']               = thinkup_var ( 'thinkup_header_locationswitch' );
	$GLOBALS['thinkup_header_stickyswitch']                 = thinkup_var ( 'thinkup_header_stickyswitch' );
	$GLOBALS['thinkup_header_searchswitchpre']              = thinkup_var ( 'thinkup_header_searchswitchpre' );
	$GLOBALS['thinkup_header_searchswitch']                 = thinkup_var ( 'thinkup_header_searchswitch' );

	//  1.4.     Footer.
	$GLOBALS['thinkup_footer_layout']                       = thinkup_var ( 'thinkup_footer_layout' );
	$GLOBALS['thinkup_footer_widgetswitch']                 = thinkup_var ( 'thinkup_footer_widgetswitch' );
	$GLOBALS['thinkup_footer_scroll']                       = thinkup_var ( 'thinkup_footer_scroll' );	
	$GLOBALS['thinkup_footer_copyright']                    = thinkup_var ( 'thinkup_footer_copyright' );
	$GLOBALS['thinkup_subfooter_layout']                    = thinkup_var ( 'thinkup_subfooter_layout' );
	$GLOBALS['thinkup_subfooter_widgetswitch']              = thinkup_var ( 'thinkup_subfooter_widgetswitch' );
	$GLOBALS['thinkup_subfooter_widgetclose']               = thinkup_var ( 'thinkup_subfooter_widgetclose' );
	$GLOBALS['thinkup_footer_outroswitch']                  = thinkup_var ( 'thinkup_footer_outroswitch' );
	$GLOBALS['thinkup_footer_outroaction']                  = thinkup_var ( 'thinkup_footer_outroaction' );
	$GLOBALS['thinkup_footer_outroactionteaser']            = thinkup_var ( 'thinkup_footer_outroactionteaser' );
	$GLOBALS['thinkup_footer_outroactiontext1']             = thinkup_var ( 'thinkup_footer_outroactiontext1' );
	$GLOBALS['thinkup_footer_outroactionlink1']             = thinkup_var ( 'thinkup_footer_outroactionlink1' );
	$GLOBALS['thinkup_footer_outroactionpage1']             = thinkup_var ( 'thinkup_footer_outroactionpage1' );
	$GLOBALS['thinkup_footer_outroactioncustom1']           = thinkup_var ( 'thinkup_footer_outroactioncustom1' );

	//  1.3. - 1.4. Social Media.
	$GLOBALS['thinkup_header_socialswitchpre']              = thinkup_var ( 'thinkup_header_socialswitchpre' );
	$GLOBALS['thinkup_header_socialswitchmain']             = thinkup_var ( 'thinkup_header_socialswitchmain' );
	$GLOBALS['thinkup_header_socialswitchfooter']           = thinkup_var ( 'thinkup_header_socialswitchfooter' );
	$GLOBALS['thinkup_header_socialmessage']                = thinkup_var ( 'thinkup_header_socialmessage' );
	$GLOBALS['thinkup_header_facebookswitch']               = thinkup_var ( 'thinkup_header_facebookswitch' );
	$GLOBALS['thinkup_header_facebooklink']                 = thinkup_var ( 'thinkup_header_facebooklink' );
	$GLOBALS['thinkup_header_facebookiconswitch']           = thinkup_var ( 'thinkup_header_facebookiconswitch' );
	$GLOBALS['thinkup_header_facebookcustomicon']           = thinkup_var ( 'thinkup_header_facebookcustomicon', 'url' );
	$GLOBALS['thinkup_header_twitterswitch']                = thinkup_var ( 'thinkup_header_twitterswitch' );
	$GLOBALS['thinkup_header_twitterlink']                  = thinkup_var ( 'thinkup_header_twitterlink' );
	$GLOBALS['thinkup_header_twittericonswitch']            = thinkup_var ( 'thinkup_header_twittericonswitch' );
	$GLOBALS['thinkup_header_twittercustomicon']            = thinkup_var ( 'thinkup_header_twittercustomicon', 'url' );
	$GLOBALS['thinkup_header_googleswitch']                 = thinkup_var ( 'thinkup_header_googleswitch' );
	$GLOBALS['thinkup_header_googlelink']                   = thinkup_var ( 'thinkup_header_googlelink' );
	$GLOBALS['thinkup_header_googleiconswitch']             = thinkup_var ( 'thinkup_header_googleiconswitch' );
	$GLOBALS['thinkup_header_googlecustomicon']             = thinkup_var ( 'thinkup_header_googlecustomicon', 'url' );
	$GLOBALS['thinkup_header_linkedinswitch']               = thinkup_var ( 'thinkup_header_linkedinswitch' );
	$GLOBALS['thinkup_header_linkedinlink']                 = thinkup_var ( 'thinkup_header_linkedinlink' );
	$GLOBALS['thinkup_header_linkediniconswitch']           = thinkup_var ( 'thinkup_header_linkediniconswitch' );
	$GLOBALS['thinkup_header_linkedincustomicon']           = thinkup_var ( 'thinkup_header_linkedincustomicon', 'url' );
	$GLOBALS['thinkup_header_flickrswitch']                 = thinkup_var ( 'thinkup_header_flickrswitch' );
	$GLOBALS['thinkup_header_flickrlink']                   = thinkup_var ( 'thinkup_header_flickrlink' );
	$GLOBALS['thinkup_header_flickriconswitch']             = thinkup_var ( 'thinkup_header_flickriconswitch' );
	$GLOBALS['thinkup_header_flickrcustomicon']             = thinkup_var ( 'thinkup_header_flickrcustomicon', 'url' );
	$GLOBALS['thinkup_header_pinterestswitch']              = thinkup_var ( 'thinkup_header_pinterestswitch' );
	$GLOBALS['thinkup_header_pinterestlink']                = thinkup_var ( 'thinkup_header_pinterestlink' );
	$GLOBALS['thinkup_header_pinteresticonswitch']          = thinkup_var ( 'thinkup_header_pinteresticonswitch' );
	$GLOBALS['thinkup_header_pinterestcustomicon']          = thinkup_var ( 'thinkup_header_pinterestcustomicon', 'url' );
	$GLOBALS['thinkup_header_youtubeswitch']                = thinkup_var ( 'thinkup_header_youtubeswitch' );
	$GLOBALS['thinkup_header_youtubelink']                  = thinkup_var ( 'thinkup_header_youtubelink' );
	$GLOBALS['thinkup_header_youtubeiconswitch']            = thinkup_var ( 'thinkup_header_youtubeiconswitch' );
	$GLOBALS['thinkup_header_youtubecustomicon']            = thinkup_var ( 'thinkup_header_youtubecustomicon', 'url' );
	$GLOBALS['thinkup_header_rssswitch']                    = thinkup_var ( 'thinkup_header_rssswitch' );
	$GLOBALS['thinkup_header_rsslink']                      = thinkup_var ( 'thinkup_header_rsslink' );
	$GLOBALS['thinkup_header_rssiconswitch']                = thinkup_var ( 'thinkup_header_rssiconswitch' );
	$GLOBALS['thinkup_header_rsscustomicon']                = thinkup_var ( 'thinkup_header_rsscustomicon', 'url' );

	//  1.5.1.   Blog - Main page.
	$GLOBALS['thinkup_blog_layout']                         = thinkup_var ( 'thinkup_blog_layout' );
	$GLOBALS['thinkup_blog_sidebars']                       = thinkup_var ( 'thinkup_blog_sidebars' );
	$GLOBALS['thinkup_blog_style']                          = thinkup_var ( 'thinkup_blog_style' );
	$GLOBALS['thinkup_blog_style1layout']                   = thinkup_var ( 'thinkup_blog_style1layout' );
	$GLOBALS['thinkup_blog_style2layout']                   = thinkup_var ( 'thinkup_blog_style2layout' );
	$GLOBALS['thinkup_blog_lightbox']                       = thinkup_var ( 'thinkup_blog_hovercheck', 'option1' );
	$GLOBALS['thinkup_blog_link']                           = thinkup_var ( 'thinkup_blog_hovercheck', 'option2' );
	$GLOBALS['thinkup_blog_title']                          = thinkup_var ( 'thinkup_blog_title' );
	$GLOBALS['thinkup_blog_date']                           = thinkup_var ( 'thinkup_blog_contentcheck', 'option1' );
	$GLOBALS['thinkup_blog_author']                         = thinkup_var ( 'thinkup_blog_contentcheck', 'option2' );
	$GLOBALS['thinkup_blog_comment']                        = thinkup_var ( 'thinkup_blog_contentcheck', 'option3' );
	$GLOBALS['thinkup_blog_category']                       = thinkup_var ( 'thinkup_blog_contentcheck', 'option4' );
	$GLOBALS['thinkup_blog_tag']                            = thinkup_var ( 'thinkup_blog_contentcheck', 'option5' );
	$GLOBALS['thinkup_blog_postswitch']                     = thinkup_var ( 'thinkup_blog_postswitch' );
	$GLOBALS['thinkup_blog_postexcerpt']                    = thinkup_var ( 'thinkup_blog_postexcerpt' );

	//  1.5.2.   Blog - Single post.
	$GLOBALS['thinkup_post_layout']                         = thinkup_var ( 'thinkup_post_layout' );
	$GLOBALS['thinkup_post_sidebars']                       = thinkup_var ( 'thinkup_post_sidebars' );
	$GLOBALS['thinkup_post_date']                           = thinkup_var ( 'thinkup_post_contentcheck', 'option1' );
	$GLOBALS['thinkup_post_author']                         = thinkup_var ( 'thinkup_post_contentcheck', 'option2' );
	$GLOBALS['thinkup_post_comment']                        = thinkup_var ( 'thinkup_post_contentcheck', 'option3' );
	$GLOBALS['thinkup_post_category']                       = thinkup_var ( 'thinkup_post_contentcheck', 'option4' );
	$GLOBALS['thinkup_post_tag']                            = thinkup_var ( 'thinkup_post_contentcheck', 'option5' );
	$GLOBALS['thinkup_post_title']                          = thinkup_var ( 'thinkup_post_contentcheck', 'option6' );
	$GLOBALS['thinkup_post_authorbio']                      = thinkup_var ( 'thinkup_post_authorbio' );
	$GLOBALS['thinkup_post_share']                          = thinkup_var ( 'thinkup_post_share' );
	$GLOBALS['thinkup_post_sharemessage']                   = thinkup_var ( 'thinkup_post_sharemessage' );
	$GLOBALS['thinkup_post_sharefacebook']                  = thinkup_var ( 'thinkup_post_sharecheck', 'option1' );
	$GLOBALS['thinkup_post_sharetwitter']                   = thinkup_var ( 'thinkup_post_sharecheck', 'option2' );
	$GLOBALS['thinkup_post_sharegoogle']                    = thinkup_var ( 'thinkup_post_sharecheck', 'option3' );
	$GLOBALS['thinkup_post_sharelinkedin']                  = thinkup_var ( 'thinkup_post_sharecheck', 'option4' );
	$GLOBALS['thinkup_post_sharetumblr']                    = thinkup_var ( 'thinkup_post_sharecheck', 'option5' );
	$GLOBALS['thinkup_post_sharepinterest']                 = thinkup_var ( 'thinkup_post_sharecheck', 'option6' );
	$GLOBALS['thinkup_post_shareemail']                     = thinkup_var ( 'thinkup_post_sharecheck', 'option7' );

	//  1.14.     Support.
}
add_action( 'thinkup_hook_header', 'thinkup_reduxvariables' );

?>