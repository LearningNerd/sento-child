== Think Up Themes ==

- By Think Up Themes, http://www.thinkupthemes.com/

Requires at least:	3.4.1
Tested up to:		4.0.0

Sento is the free version of the multi-purpose professional theme (Sento Pro) ideal for a business or blog website. The theme has a responsive layout, HD retina ready and comes with a powerful theme options panel with can be used to make awesome changes without touching any code. The theme also comes with a full width easy to use slider. Easily add a logo to your site and create a beautiful homepage using the built-in homepage layout.

-----------------------------------------------------------------------------
	Support
-----------------------------------------------------------------------------

- For support for Sento (free) please post a support ticket over at the https://wordpress.org/support/theme/sento.

-----------------------------------------------------------------------------
	Frequently Asked Questions
-----------------------------------------------------------------------------

- None Yet


-----------------------------------------------------------------------------
	Limitations
-----------------------------------------------------------------------------

- RTL support is yet to be added. This is planned for inclusion in v1.1.0


-----------------------------------------------------------------------------
	Copyright, Sources, Credits & Licenses
-----------------------------------------------------------------------------

Sento WordPress Theme, Copyright 2015 Think Up Themes Ltd
Sento is distributed under the terms of the GNU GPL

Demo images are licensed under CC0 1.0 Universal (CC0 1.0) and available from http://unsplash.com/

The following opensource projects, graphics, fonts, API's or other files as listed have been used in developing this theme. Thanks to the author for the creative work they made. All creative works are licensed as being GPL or GPL compatible.

    [1.01] Item:        Underscores (_s) starter theme - Copyright: Automattic, automattic.com
           Item URL:    http://underscores.me/
           Licence:     Licensed under GPLv2 or later
           Licence URL: http://www.gnu.org/licenses/gpl.html

    [1.02] Item:        Redux Framework
           Item URL:    https://github.com/ReduxFramework/ReduxFramework
           Licence:     GPLv3
           Licence URL: http://www.gnu.org/licenses/gpl.html

    [1.03] Item:        html5shiv (jQuery file)
           Item URL:    http://code.google.com/p/html5shiv/
           Licence:     MIT
           Licence MIT: http://opensource.org/licenses/mit-license.html

    [1.04] Item:        PrettyPhoto
           Item URL:    http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
           Licence:     GPLv2
           Licence URL: http://www.gnu.org/licenses/gpl-2.0.html

    [1.05] Item:        ImagesLoaded
           Item URL:    https://github.com/desandro/imagesloaded
           Licence:     MIT
           Licence URL: http://opensource.org/licenses/mit-license.html

    [1.06] Item:        Retina js
           Item URL:    http://retinajs.com
           Licence:     MIT
           Licence URL: http://opensource.org/licenses/mit-license.html

    [1.07] Item:        ResponsiveSlides
           Item URL:    https://github.com/viljamis/ResponsiveSlides.js
           Licence:     MIT
           Licence URL: http://opensource.org/licenses/mit-license.html

    [1.08] Item:        Font Awesome
           Item URL:    http://fortawesome.github.io/Font-Awesome/#license
           Licence:     SIL Open Font &  MIT
           Licence OFL: http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL
           Licence MIT: http://opensource.org/licenses/mit-license.html

    [1.09] Item:        Twitter Bootstrap
           Item URL:    https://github.com/twitter/bootstrap/wiki/License
           Licence:     Apache 2.0
           Licence URL: http://www.apache.org/licenses/LICENSE-2.0

    [1.10] Item:        Google Fonts - Open Sans
           Item URL:    http://www.google.com/fonts/specimen/Open+Sans
           Licence:     SIL Open Font
           Licence URL: http://scripts.sil.org/OFL

-----------------------------------------------------------------------------
	Changelog
-----------------------------------------------------------------------------

Version 1.1.15
- Updated: Logo alt tag now translation ready.
- Updated: Improved ecaping of outputs in 00.theme-setup.php.
- Updated: Improved ecaping of outputs in 01.general-settings.php.
- Updated: Redux migration script removed as all users are highly likely to have already migrated.

Version 1.1.14
- Fixed:   prettyPhoto.js now fully compatible with https sites.
- Updated: Font Awesome library updated to latest version v4.6.3. Ensures all icons in FA library are available to use.

Version 1.1.13
- Fixed:   Custom Redux extensions now load correctly. Issue introduced in previous version where extensions did not load is now corrected.

Version 1.1.12
- Fixed:   Custom Redux extensions now moved to folder main-extensions to ensure compatibility with Redux plugin. Ensures plugin and theme can be used without conflicting.
- Updated: "ReduxFramework::$_url . 'assets/img/layout" changed to "trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout".

Version 1.1.11
- Fixed:   ThinkUpSlider now checks to see if any slide is assigned, rather than just the first slide. Corrects issue where deleting slides resulted in issues.

Version 1.1.10
- Fixed:   Checkbox field saves as as "off" when unticked.
- Fixed:   Switch field saves as as "off" when switched off.
- Fixed:   Full post content on blog archive pages only displayed if explicitly set by user in theme options.
- Fixed:   Masonry script now output on all archive pages. Fixes issue where masonry layout didn't work on category and tags pages.
- Updated: Links in breadcrumb function sanitized.
- Updated: thinkup_input_wptitle() outputs at start of wp_head().
- Updated: style-shortcodes.css updated to be consistent with all themes.
- Updated: Link to gmpg.org in header.php now compatible with https sites.
- Updated: All references to textdomain 'themecheck' changed to 'redux-framework'.
- Updated: Links to widgets page changed from /wp-admin/widgets.php to esc_url( admin_url( 'widgets.php' ) ).
- Updated: Homepage (Content) section renamed to Homepage (Featured) to make it clear that the section is intended for minimal content.
- Updated: Theme tags updated to reflect new tags. Old rags will be removed once WP v4.6 is released and users can no longer filter with old tags.
- Removed: alert( 'test000' ); removed from jquery.serializeForm.js.
- Removed: //alert( 'test11-22' ); removed from extension_customizer.min.js.
- Removed: Deregistered redux scripts removed for compliance with .org requirements 'wpb_ace' and 'jquerySelect2'.

Version 1.1.9
- Fixed:   Post content displayed on main blog page can be set by user using core WordPress <!--more--> tag.
- Updated: Logo image width set to "auto".

Version 1.1.8
- Fixed:   Syntax around version number on line 91 in functions.php corrected. This issue prevented v1.1.7 from working altogether.

Version 1.1.7
- Fixed:   PHP notices fixed for comments form - changes made comments.php file.
- Fixed:   Custom titles now display correctly on mobile layouts. Issue previously caused titles to be squashed on smaller screens.
- Updated: Margin added to alignleft and alignright classes.

Version 1.1.6
- Updated: Post share icons now display correctly on single post pages.
- Removed: Old files .mo and .po removed.

Version 1.1.5
- Updated: Portfolio masonry container checks updated in main-frontend.js.
- Updated: Variable $open_sans renamed to $font_translate in function thinkup_googlefonts_url().
- Updated: Function thinkup_input_logoretinaja() renamed to thinkup_input_logoretinaja() to be inline with proper naming convention.
- Updated: Function thinkup_get_comments_number_str() renamed to thinkup_comments_returnstring() to be inline with proper naming convention.
- Updated: Function thinkup_get_comments_popup_link() renamed to thinkup_input_commentspopuplink() to be inline with proper naming convention.

Version 1.1.4
- Updated: Social media links in pre-header now open in new tab.
- Updated: Translation .pot file updated to take account of recent updates in core theme files.

Version 1.1.3
- Fixed:   Disables sortable slides in Customizer. This prevents issues where phantom slides still appear after deleting slides.
- Updated: Various minor styling updates for theme options in customizer.

Version 1.1.2
- Fixed:   "$this->_extension_url" used for redux extensions fixed to ensure custom extensions are loaded correctly on all sites.

Version 1.1.1
- Fixed:   Floating elements now cleared within template-sitemap.php using class "clearboth".
- Updated: Redux notices prevented from displaying.
- Updated: Padding added to ThinkUpSlider content area.
- Updated: Icon tag removed from post sticky class. Icon is now added via css.
- Removed: References to "filters.svg#grayscale" removed from style-shortcodes.css.
- Updated: Validation for links changed from "url" to "html" to allow for links to inner pages.
- Updated: input specific type styling extended to include input[type=search] and  input[type=tel].
- Updated: Class ".portfolio-wrapper" added to all instances of ID "#container" where a masonry layout is used.
- Updated: Margin removed from alignright class if used in #pre-header to ensure pre-header height displays correctly.
- Removed: Custom JS option in customizer removed. Can potentially cause issues with customizer if user specified JS is incorrect.

Version 1.1.0
- New:     Customizer support added. All Theme options settings now controlled from within Customizer.
- New:     Dummy "Theme Options" section added under Appearance to guide users to location of new theme options and relevant information - Remove in upcoming update.
- Fixed:   Pagination clears correctly when inner paginated pages are being viewed.
- Fixed:   Migration script updated to prevent loss of data. If data doesn't migrate to customizer. Support can still retrieve from database.
- Removed: Redundant Redux css code from style-backend.css.
- Removed: Redundant Redux jQuery code from main-backend.js.
- Removed: Theme options panel removed - replaced with customizer to comply with new WordPress guidelines.

Version 1.0.8
- Fixed:   Link to Font Awesome on backend updated to prevent 404 error.
- Updated: Prep for Customizer integration. Redux global variable changed from $redux -> $thinkup_redux_variables. Migration function thinkup_migrate_redux_option().

Version 1.0.7
- Fixed:   Custom social media icons now display correctly.
- Fixed:   thinkup_check_ishome() now works correctly on all sites.
- Fixed:   Post feautured images now display correctly on Firefox. max-width: 100%; added to .blog-thumb.	
- Updated: Post meta displays immediately after post title on search results page.

Version 1.0.6
- Fixed:   Pages on search results page now display correctly. Date previously overlapped content.
- Fixed:   Fix jQuery code used to add tr tags in main-backend.js. Improves compatibility with 3rd party code.
- Updated: Title on search results page moved into entry-content div.
- Updated: Language file updated to include .pot file instead of .po and .mo.
- Updated: css code in style-shortcodes.css completely rewritten. Much tidier and easier or end user to customize.
- Updated: Sidebar left / right margin changed from 50px to 20px to improve theme styling.

Version 1.0.5
- Fixed:   Images in homepage featured section now align left (same as text).
- Fixed:   404 error page now displays correctly. File "08.special-pages.php" includes missing function.
- Updated: prettyPhoto updates to v3.1.6 to put in place prettyPhoto XSS fix.
- Updated: #sidebar styling in style-responsive.css applied with !important attribute.
- Updated: #main-core styling in style-responsive.css applied with !important attribute.

Version 1.0.4
- Updated: All user input data is now escaped on all outputs.
- Updated: caroufredsel now checks to if carousel item exists before executing code - reduces jQuery notices.
- Updated: caroufredsel code updated to ensure carousel code is not applied to individual items (e.g. postitem, featured items, images).
- Removed: Social media links for thinkupthemes removed from theme options panel.

Version 1.0.3
- Updated: Reverted back to v1.0.1 to allow user to set "Front-page content sections" directly from theme options panel.

Version 1.0.2
- New:     add_post_type_support( 'page', 'excerpt' ) support added.
- New:     Featured homepage areas now use content from pages not content input directly from the theme options panel.
- Updated: Wording in featured area 3 updated to give useful instructions to user.
- Updated: Breadcrumb styling improvement. Padding to sides of delimeter increased from 2px to 5px.

Version 1.0.1
- New:     Headings for widget areas are now translation ready (backend).
- New:     Variable $thinkup_general_fixedlayoutswitch used to assign responsive layout for default settings.
- New:     Translation file updated to be .pot file.
- Updated: Theme now displays responsive layout on default settings. 
- Updated: All references to "@package ThinkUpThemes" changed to "@package Sento".
- Removed: Variable $thinkup_general_responsiveswitch was used to set fixed layout by default.
- Removed: .po translation file removed. .pot file is required instead.

Version 1.0.0
- Initial release.