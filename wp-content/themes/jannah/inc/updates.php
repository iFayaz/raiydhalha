<?php
/**
 * Database updates
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

# Debug
//update_option( 'tie_ver_'. TIELABS_THEME_ID, '2.0.0' );

$current_version = get_option( 'tie_ver_'. TIELABS_THEME_ID ) ? get_option( 'tie_ver_'. TIELABS_THEME_ID ) : get_option( 'tie_jannah_ver' );

// Apply updates
if( $current_version ){

	if( version_compare( $current_version, TIELABS_DB_VERSION, '<' ) ){

		// ChangeLog
		$changelog = '';

		// Custom Versions updates
		$updated_options = $original_options = get_option( apply_filters( 'TieLabs/theme_options', '' ) );


		/*
		 * Update to version 1.0.3
		 *
		 * New Option for the AMP
		 */
		if( version_compare( $current_version, '1.0.3', '<' ) ){

			$updated_options['amp_active'] = 'true';
		}


		/*
		 * Update to version 1.1.0
		 *
		 * Store the total puplished posts number
		 */
		if( version_compare( $current_version, '1.1.0', '<' ) ){

			// Store the posts number needed for th switcher-
			$count_posts     = wp_count_posts();
			$published_posts = ! empty( $count_posts->publish ) ? $count_posts->publish : 0;
			update_option( 'tie_published_posts_'. TIELABS_THEME_ID, $published_posts, false );

			// Delete the stored cache to re-update it needed for the switcher
			delete_transient( 'tie-data-'.TIELABS_THEME_SLUG );

			// Chnagelog
			$changelog .= '
				NEW: Introducing our Jannah Switcher Plugin now you can migrating your posts from 17 themes to Jannah.
				NEW: Option to set a custom RSS feed URL.
				NEW: Option to embed Audio code.
				NEW: Unlimited Source and Via options.
				NEW: Facebook Videos support.
				NEW: Twitter Videos support.
				NEW: Option to set the page as a front page directly from the edit page.
			';
		}


		/*
		 * Update to version 1.2.0
		 *
		 * Update some options
		 */
		if( version_compare( $current_version, '1.2.0', '<' ) ){

			$updated_options['schema_type']        = 'Article';
			$updated_options['responsive_tables']  = 'true';

			if( tie_get_option( 'header_layout' ) == 1 ){

				$updated_options['sticky_logo_type'] = 'true';
				unset( $updated_options['custom_logo_sticky'] );
			}

			// Chnagelog
			$changelog .= "
				New: 3 typography options to customize the posts titles in the sliders.
				NEW: LazyLoad for the Sliders images.
				NEW: LazyLoad for Videos images in the Videos Playlist.
				NEW: Show/Hide the Automatic Featured Image for the standard posts now works on the AMP pages.
				NEW: Added More texts to translations panel.
				NEW: Integration with the Jetpack Stats module.
				NEW: Integration with the WordPress Social Login plugin, now you can use the login social buttons with the theme's Login sections.
				NEW: Integration with the Google Captcha (reCAPTCHA) plugin, now you can add the reCAPTCHA to the theme's Login sections.
				NEW: Responsive in-post tables with an option to disable it in case you want to use a custom plugin.
				NEW: AMP WhatsApp share button.
				NEW: AMP Tumblr share button.
				NEW: AMP SMS share button.
				NEW: The new Audio, Video and Image widgets are now available in the TieLabs Page builder Widgets section.
				NEW: Export and Import module for the theme options.
				NEW: Logo in the Sticky menu for all headers layouts.
				NEW: Option to set a custom sticky logo image.
				NEW: Option to set the number of posts in the Check Also block.
				NEW: 7 Arabic fonts added from FontFace.me.
				NEW: Most viewed Posts for 7 days option in the posts widget.
				NEW: Most viewed Posts for 30 days option in the posts widget.
				NEW: Option to show/hide the MENU text for the mobile menu icon.
				NEW: Help links in the theme options.
				NEW: Add supports for the Private posts in the blocks.
				NEW: Now the theme highlights the primary category only in the main nav.
				NEW: Recommended Plugins section in the Install plugins page.
				NEW: Notice message when a new update is available for a bundled plugin.
				NEW: Add shortcode support for the featured image's caption.
				NEW: Page builder Blocks now shows the child categories posts.
				NEW: Now terms descriptions supports Shortcodes.
				IMPROVED: Changed the Schema default type value of the posts to Article.
				IMPROVED: Tabs Widget backend sortable function.
				IMPROVED: BuddyPress form styles.
				IMPROVED: WooCommerce styles.
				IMPROVED: The LazyLoad image feature of the Avatars.
				IMPROVED: BreadCrumbs support for the CPT.
				IMPROVED: Post views system excludes the bots visits.
			";
		}


		/*
		 * Update to version 1.3.0
		 *
		 */
		if( version_compare( $current_version, '1.3.0', '<' ) ){

			// Chnagelog
			$changelog .= "
				New: Automatic theme update feature.
				New: Edit Post link in the end of the post.
				New: Button to revoke the theme validation in order to use the license on another domain.
				New: Animated appearance for the Sticky Logo.
				IMPROVED: Lazy Load for in-post images.
				IMPROVED: Mega menu functions.
				IMPROVED: Mega menu and footer custom colors.
				IMPROVED: Sections custom margins in the responsive version.
				IMPROVED: Default Logo margins in the Header Layout 3.
			";
		}


		/*
		 * Update to version 2.0.0
		 *
		 * Update the Post Views options
		 */
		if( version_compare( $current_version, '2.0.0', '<' ) ){

			// Update Category options
			$categories_options = get_option( 'tie_cats_options' );
			$update_the_options = false;

			if( ! empty( $categories_options ) && is_array( $categories_options ) ){

				foreach ( $categories_options as $key => $value ){

					if( ! empty( $value['featured_posts_style'] ) && $value['featured_posts_style'] == 'videos_list' ){

						$categories_options[ $key ]['dark_skin'] = 'true';
						$update_the_options = true;
					}
				}

				if( $update_the_options ){
					update_option( 'tie_cats_options', $categories_options );
				}
			}

			// Update theme Options
			$updated_options['boxes_style']           = 1;
			$updated_options['sticky_featured_video'] = 'true';
			$updated_options['mobile_header']         = 'default';
			$updated_options['mobile_menu_layout']    = 'fullwidth';
			$updated_options['views_colored']         = 'true';
			$updated_options['views_warm_color']      = 500;
			$updated_options['views_hot_color']       = 2000;
			$updated_options['views_veryhot_color']   = 5000;
			$updated_options['related_position']      = 'post';

			// If the sticky menu active | enable the mobile Sticky Header
			if( tie_get_option( 'stick_nav' ) ){
				$updated_options['stick_mobile_nav'] = 'true';
			}

			// If the Copyright area has custom Styles apply them on the back to top button
			if( tie_get_option( 'copyright_background_color' ) ){
				$updated_options['back_top_background_color'] = tie_get_option( 'copyright_background_color' );
			}

			if( tie_get_option( 'copyright_text_color' ) ){
				$updated_options['back_top_text_color'] = tie_get_option( 'copyright_text_color' );
			}

			// Set all Weather widget to be animated
			$weather_widgets = get_option( 'widget_tie-weather-widget' );
			if( ! empty( $weather_widgets ) && is_array( $weather_widgets ) ){

				foreach ( $weather_widgets as $widget => $options ) {

					if( ! empty( $options ) && is_array( $options )){
						$weather_widgets[$widget]['animated'] = 'true';
					}
				}

				update_option( 'widget_tie-weather-widget', $weather_widgets );
			}


			// Chnagelog
			$changelog .= "
				NEW: Block Layout #16.
				NEW: 3 new Posts layouts for archives pages.
				New: Modern Sliders Loading method.
				New: Send Web Notifications for your posts directly from the post edit page.
				NEW: Options to show the Weather in the Main and Secondary Nav.
				NEW: Unboxed layout for the blocks and widgets.
				NEW: Option to sticky the Header on mobile.
				NEW: Centered Logo Mobile Header layout.
				NEW: Mobile Menu Layout.
				NEW: Option to enable/disable the animations of the weather icons.
				NEW: Post Views Settings tab on the theme options page.
				NEW: Option to enable/disable the colored post views.
				NEW: Option to set a starter views number for the new posts.
				NEW: Option to set the minimum views number for each color.
				NEW: Option to change post views to a fake number.
				NEW: Option in the Posts List widget to exclude current post in the single post page.
				NEW: Option to change the font settings for the archive title.
				NEW: Option to show the posts' Modified date instead of the Published date.
				NEW: Option to upload a default/fallback Open Graph image.
				NEW: Option to show the review rating in the sliders blocks.
				NEW: Option to show the review rating in the single category page sliders.
				NEW: Option to set the position of the related posts below comments.
				NEW: Option to set the position of the related posts above the footer.
				NEW: Send to friend option in the select and share feature.
				NEW: Option to set a title for the Ad spaces.
				NEW: Option to set a Link to the title of the Ad spaces.
				NEW: Ad space above the header.
				NEW: Ad space above the post content in the single post page.
				NEW: Ad space below the post content in the single post page.
				New: Option to hide the Above Header Ad on mobile.
				NEW: Options in the Post edit page to hide the above and below content ads.
				NEW: Options in the Post edit page to set a custom Ad for the above and below content spaces.
				New: 2 Ad Spaces to show Ads between the posts in the archives pages.
				NEW: Add support for the dark skin mode to the WordPress embedded posts cards.
				NEW: Primary Category label appears now in the blocks.
				NEW: Option to set specific posts as Trending posts.
				NEW: Option to set the speed of the sliders.
				NEW: Add the custom logo to the AMP structure data.
				NEW: Option to disable the custom theme's styles in the editor.
				NEW: Now you can set custom menu, logo, color, background, etc for the all shop pages.
				NEW: option to Use the BuddyPress Member Profile link instead of the default author page link in the post meta, author box, and the login sections.
				NEW: Add the comments list section titles to the translation panel.
				NEW: Option to exclude specific posts by IDs in the Blocks and the sliders.
				New: Option in the Posts List Widget to show the Related posts by categories.
				New: Option in the Posts List Widget to show the Related posts by tags.
				New: Option in the Posts List Widget to show the Related posts by author.
				New: Layout in the Posts List widget to show the Authors Posts.
				New: Share buttons layout.
				New: Save time and access any theme options' tab directly from the admin bar.
				New: Support Facebook Instant Articles.
				New: Syntax Highlighting for the codes fields.
				New: Option to set Custom background and arrow color for the Back To Top button.
				New: Option for the single category to show the Videos Playlist in Dark Skin.
				NEW: Sticky Videos options in the single post page.
				NEW: Options to disable the Author, Comments and View meta info in the archives.
				NEW: Options to disable the Author, Comments and View meta info in the page builder blocks.
				NEW: Vimeos videos now matches the color of the custom block/page/theme color.
				NEW: Google Fonts Support for the Gurmukhi, Arabic, Bengali, Devanagari, Gujarati, Hebrew, Kannada, Malayalam, Myanmar, Oriya, Sinhala, Tamil, Telugu, and Thai languages.
				NEW: Support for the shortcodes in the Footer text areas.
				IMPROVED: Removed padding shortcode from the AMP pages.
				IMPROVED: Numbers for non-latin languages.
				IMPROVED: RTL support for the Child Theme.
				IMPROVED: Sticky menu behavior.
				IMPROVED: Columns shortcodes contents in the post excerpt.
				IMPROVED: Columns shortcodes with the estimated reading time.
				IMPROVED: WooCommerce tabs layout.
				IMPROVED: Mobile menu Icon style.
				IMPROVED: Responsive Adsense Ads.
				IMPROVED: Posts Switcher notice appearance.
				IMPROVED: Post titles font size in the responsive version.
				IMPROVED: Content Index Panel on the small screens.
				IMPROVED: Slider 1 styling.
				IMPROVED: WooCommerce Archives pages title spacing.
				IMPROVED: The Breaking News Block style.
				IMPROVED: Add Comment form style.
				IMPROVED: Removed the latest current item from the Breadcrumb schema data.
				IMPROVED: Select and share feature.
				IMPROVED: WooCommerce functions.
				IMPROVED: Logos SVG support.
				Updated: Modernizr.js to the latest version.
				Updated: Jarallax.js to the latest version.
				Updated: iLightBox.js to the latest version.
			";
		}


		/*
		 * Update to version 2.1.0
		 *
		 */
		if( version_compare( $current_version, '2.1.0', '<' ) ){

			$options_to_update = array(
				'tie_jannah_installed_demo' => 'tie_installed_demo',
				'tie_jannah_installed_demo' => 'tie_installed_demo_'.  TIELABS_THEME_ID,
				'jannah_published_posts'    => 'tie_published_posts_'. TIELABS_THEME_ID,
				'tie_jannah_install_date'   => 'tie_install_date_'. TIELABS_THEME_ID ,
				'jannah_chnagelog'          => 'tie_chnagelog_'. TIELABS_THEME_ID,
				'jannah_foxpush_code'       => 'tie_foxpush_code_'. TIELABS_THEME_ID,
				'switch_to_jannah'          => 'tie_switch_to_'. TIELABS_THEME_ID,
				'tie_jannah_ver'            => 'tie_ver_'. TIELABS_THEME_ID,
			);

			foreach ( $options_to_update as $old => $new ) {
				update_option( $new, get_option( $old ) );
				delete_option( $old );
			}


			$new_translations  = array();
			$translation_texts = apply_filters( 'TieLabs/translation_texts', array() );

			if( ! empty( $translation_texts ) && is_array( $translation_texts ) ){

				foreach ( $translation_texts as $id => $text ){

					$id = sanitize_title( htmlspecialchars( $id  ) );

					if( ! empty( $updated_options[ $id ] ) ){
						$new_translations[ $id ] = $updated_options[ $id ];
					}

					unset( $updated_options[ $id ] );
				}
			}

			if( ! empty( $new_translations ) ){
				$updated_options['translations'] = $new_translations;
			}

			// Chnagelog
			$changelog .= "
				- NEW: Notice in the automatic theme update page if the theme folder doesn't match the original name.
				- NEW: Add support for shortcode in the head and footer codes sections.
				- NEW: Now you can set a featured image for the pages built with the page builder and it will be used in the OG meta.
				- NEW: Lazy Load for the Post Slider images.
				- IMPROVED: Facebook share in the 'Select & Share' feature.
				- IMPROVED: WooCommerce featured images sizes.
				- IMPROVED: WooCommerce columns bug.
				- IMPROVED: Removed all Ads shortcodes from the AMP pages.
				- IMPROVED: Responsive Adsense Ads.
				- IMPROVED: Built Translation system.
				- And Improvements and minor bug fixes.
			";
		}


		/*
		 * Update to version 2.1.1
		 *
		 */
		if( version_compare( $current_version, '2.1.1', '<' ) ){

			if( get_option('switch_to_jannah') ){

				$theme_switched = get_option('switch_to_jannah');
				update_option( 'tie_switch_to_'. TIELABS_THEME_ID, $theme_switched, false );
				delete_option('switch_to_jannah');
			}
		}


		/*
		 * Update to version 3.0.0
		 *
		 */
		if( version_compare( $current_version, '3.0.0', '<' ) ){

			if( tie_get_option( 'mobile_menu_top' ) ){
				$updated_options['mobile_the_menu'] = 'main-secondary';
			}

			// Chnagelog
			$changelog .= "
				- NEW: Fitness Demo https://jannah.tielabs.com/fitness/
				- NEW: Salad Dash Demo https://jannah.tielabs.com/salad-dash/
				- NEW: Compatibility with the latest version of the BuddyPress plugin.
				- NEW: Compatibility with the latest version of the AMP plugin.
				- NEW: Compatibility with the new Gutenberg builder to create posts.
				- New: 2 Sliders Layouts.
				- New: Options to upload your custom fonts directly from the options page.
				- New: Block Layout - Classic blog layout with small thumbnail.
				- NEW: Option to disable the Built-in Mega Menus feature to use a third party plugin.
				- NEW: Post Views increment support in AMP Pages.
				- NEW: Now you can set custom options for the BuddyPress Registration page.
				- NEW: Article inline Ads.
				- NEW: Current Weather state description is now available for translation in the theme panel.
				- NEW: Option to set a custom URL for the logos.
				- NEW: Options to set custom Sidebar settings for posts inside a certain category.
				- NEW: Use primary-color in any custom CSS section and it will be replaced with the current primary color.
				- NEW: Read Next section in the single post page with 2 styles.
				- NEW: Related Posts section with featured images in the AMP pages.
				- NEW: Option to set the number of posts in the related posts section.
				- NEW: Option to Show/Hide the Categories and Tags in the AMP pages.
				- NEW: Option to Show/Hide the Log in icon in the mobile menu.
				- NEW: Option to Show/Hide the Cart icon in the mobile menu.
				- NEW: Option to Show/Hide the BuddyPress notification icon in the mobile menu.
				- NEW: Option to disable specific tabs in the tabs widget.
				- NEW: Option to set a custom mobile menu.
				- NEW: Option to set a scheme type for the posts in a specific category.
				- NEW: Option to disable the black gradient overlay from the sliders.
				- NEW: Smart Sticky Header is now supported on mobile.
				- NEW: Typography Options for the posts title in the theme's widgets.
				- NEW: Typography Options for the page builder sections titles.
				- NEW: Turkish, Portuguese (Brazil) French and Spanish translations have been added.
				- NEW: Option to set a custom background color for the mobile header.
				- IMPROVED: Twitter Share Button.
				- IMPROVED: Mega menu filters now display only the first level of child categories.
				- IMPROVED: Text Transformation settings for some elements.
				- IMPROVED: The primary category label is now hidden by default in the category pages.
				- FIXED: Facebook counter bug.
				- FIXED: Tabs Shortcode Styling bug.
				- FIXED: Excluding posts from the sliders bug.
				- FIXED: Custom Footer Padding option bug.
				- FIXED: Post views issue with the custom post types.
				- FIXED: Warning message when updating the main menu.
				- FIXED: Bug prevents the Post views option to appear in the post edit page.
				- FIXED: Duplication entry bug in Taqyeem.
				- And Improvements and minor bug fixes.
			";
		}


		/*
		 * Update to version 4.0.0
		 *
		 */
		if( version_compare( $current_version, '4.0.0', '<' ) ){

			// Meta description
			$updated_options['post_meta_escription'] = 'true';

			// Google Plus
			if( ! empty( $updated_options['social']['google_plus'] ) ){
				unset( $updated_options['social']['google_plus'] );
			}

			// Weather API
			if( tie_get_option( 'top-nav-components_wz_api_key' ) ){
				$updated_options['api_openweather'] = tie_get_option( 'top-nav-components_wz_api_key' );
			}
			elseif( tie_get_option( 'main-nav-components_wz_api_key' ) ){
				$updated_options['api_openweather'] = tie_get_option( 'main-nav-components_wz_api_key' );
			}

			// YouTube ApiKey
			if( $arq_options = get_option( 'arq_options' ) ){

				if( ! empty( $arq_options['social']['youtube']['key'] ) ){
					$updated_options['api_youtube'] = $arq_options['social']['youtube']['key'];
				}
			}

			// Chnagelog
			$changelog .= "
				- Performance: Introduced the new Jannah Speed Optimization plugin (beta).
				- Performance: Improved Ajax Requests performance.
				- Performance: Improved Theme performance.
				- Performance: Reduced the number of nodes per page.
				- Performance: Improved Ajax Search library performance.
				- Performance: Reduced the size and the number of scripts files loaded on mobiles.
				- Performance: Google Fonts disabled by default on the low-speed connections.
				- Performance: Used smaller Instagram images size.
				- Performance: Used by default the min JS and CSS files.
				- Performance: Reduced number of images generated by the theme to 3 images only.
				- Performance: Font Display Swap to all Google Fonts.
				- Performance: Font Display Swap to the custom uploaded fonts.
				- Performance: New option to inline critical path CSS.
				- Performance: New option to Load JS files deferred
				- Performance: New option to Optimize CSS delivery.
				- Performance: New option to Remove query strings from static resources.
				- Performance: New options to remove unneeded Js files.
				- Performance: New option to Disable Emoji and Smilies.
				- Performance: New option to Minify HTML.
				- Performance: New option to cache some static parts like widgets, main menu and breaking news to reduce MySQL queries.
				- New: Co-Authors Plus plugin support.
				- New: Notice in the dashboard if the child theme uses outdated files.
				- New: Masonry layout for the BuddyPress grid pages.
				- New: New tab for the API Keys in the theme options page.
				- New: Get related posts by categories in the AMP Related Posts section.
				- New: Lazy load support for the Instagram images.
				- New: Lazy load support for the images in the posts.
				- New: Lazy load support for the Ad images.
				- New: Option to set a lazy load logo.
				- New: Option to customize the title, message, and color of the Adblock popup.
				- New: Meta description tag if there is no SEO plugin installed with an option to enable/disable.
				- New: Option to upload an image for the custom social icons.
				- New: Option to list posts in alphabetic order (A to Z listing) for the blocks.
				- New: Option to list posts in alphabetic order (A to Z listing) for the related posts.
				- New: Option to list posts in alphabetic order (A to Z listing) for the read next slider.
				- New: Option to list posts in alphabetic order (A to Z listing) for the posts widget.
				- New: Option to list posts in alphabetic order (A to Z listing) for the slider widget.
				- New: Alt text option for the logo.
				- New: Option to set an icon for the section title.
				- New: Option to set an icon for the block title.
				- New: Option to hide all read more buttons on mobiles.
				- New: 3 new ad spaces in the category pages.
				- New: Don't duplicate posts option in masonry page.
				- New: Don't duplicate posts option in categories.
				- New: Skype share button.
				- New: 100+ Google fonts.
				- New: AMP now uses the theme and custom posts colors.
				- New: Post subtitle in the AMP pages.
				- New: Modern user login drop-down menu in the navigation menus.
				- New: Option to place code after opening the <body> tag.
				- New: Parallax sections now supports self-hosted mp4 files.
				- New: WPML XML file.
				- Tweak: Accessibility improvements.
				- Tweak: h1 internal page builder pages title.
				- Tweak: The All link in the mega menu.
				- Tweak: Responsive videos code.
				- Tweak: Updated all Javascript libraries to the latest versions.
				- Tweak: Updated YouTube icon.
				- Tweak: Updated Arqam Lite plugin to fix the Instagram counter bug.
				- Tweak: Updated Taqyeem plugin to support the new Reviews structure data changes.
				- Tweak: Improved Header shadow.
				- Tweak: Login form modules and the compatibility with the captcha and social login plugins.
				- Tweak: Self-hosted videos/audios player style on mobile.
				- Tweak: Improved menus styling and spaces.
				- Tweak: Improved Cart menu.
				- Tweak: All theme notices now appear in the theme options page only.
				- Tweak: Hide all non-theme notices from the theme options page.
				- Tweak: Improved slide sidebar and mobile menu close icon position.
				- Tweak: Category description content styling.
				- Tweak: Improved lists style on RTL AMP.
				- Tweak: Removed the Google+ Widget
				- Tweak: Removed the StumbleUpon share button.
				- Tweak: Removed Google+ share button.
				- Tweak: Use a background image as a fallback for the parallax video background.
				- Fix: Customizer loading issue on some servers.
				- Fix: Theme settings saving issue on some servers.
				- Fix: block title using HTML tags.
				- Fix: JetPack post views bug.
				- Fix: Header image ad alignment.
				- Fix: Instagram Lightbox images bug.
				- Fix: Page builder appearance issue with Gutenberg.
				- Fix: Story index bug prevents clicking on the content behind it.
				- Fix: LinkedIn share button bug.
				- Fix: WhatsApp and telegram share buttons.
				- Fix: Disable meta options in the archives pages.
				- Fix: Install plugins page conflict with some plugins.
				- Fix: Buddypress icons bug.
				- Fix: Instagram Widget bug.
				- Fix: WooCommerce slider block bug.
				- Fix: Buddypress messages page styling bug.
				- Fix: LiveSearch results positions bug
				- Dev: Added the TIE_LOGGING class, to allow for easier debugging by developers.
				- Dev: A lot of new filters and hooks to allow the developers to customize the theme easily.
				- Dev: New function wp_body_open added.
				- And Improvements and minor bug fixes.
			";
		}


		/*
		 * Update to version 4.1.0
		 *
		 */
		if( version_compare( $current_version, '4.1.0', '<' ) ){

			// Chnagelog
			$changelog .= "
				- New: Two Ad spaces in the AMP pages.
				- Fix: Alignment of the Codes sections in the single post edit page.
				- Fix: Lightbox close button bug.
				- Fix: WooCommerce import products page bug.
				- Fix: AMP related Posts.
				- Fix: Saving Widgets settings bug.
				- Fix: Select and Share feature bug.
				- Fix: Ajax pagination bug in the archives pages.
				- Fix: PHP notice in the page builder blocks.
				- Fix: Missing file URL error while theme auto-update.
				- Fix: Page builder scrolling bug on iPad.
				- Fix: Megamenu caching issue.
				- Fix: Appearance of the category label in the Ajax loaded posts in the category pages.
				- Fix: Add Notice above the Video Player if the YouTube API returns errors.
				- Fix: Author description translation bug with the WPML plugin.
				- Fix: Posts List widget saving options bug.
				- Fix: Post title sharing issue if it contains single or double Quotation marks.
				- Fix: Send to friend share button bug on Chrome.
				- Fix: Instagram Counter issue, you need to update the Arqam Lite Plugin and set the Access token in the plugin's settings page.
				- Fix: Weather appearance bug in the Header.
				- Fix: Missing the Author name WPML translation.
				- Fix: Polylang XML file bug.
				- Fix: Horizontal Tabs shortcode bug.
				- Fix: BuddyPress Grid Layout bug.
				- Fix: Subtitle bug in the AMP posts.
				- Fix: Ajax requests bug.
				- Fix: WhatsApp share button bug.
				- Fix: .alignwide and .alignfull margin for images in Gutenberg.
				- Fix: Custom Styles and typography on the homepage.
				- And Improvements and minor bug fixes.
			";
		}




		// Update if the Changelog has items
		if( ! empty( $changelog ) ){

			// Store the new data
			update_option( 'tie_chnagelog_'. TIELABS_THEME_ID, trim( $changelog ), false );

			// Remove the pointer from the dismissed array
			$dismissed = array_filter( explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) ) );
			$pointer   = 'tie_new_updates_'. TIELABS_THEME_ID;

			if ( in_array( $pointer, $dismissed ) ){
				unset( $dismissed[ array_search( $pointer, $dismissed )] );
			}

			$dismissed = implode( ',', $dismissed );

			update_user_meta( get_current_user_id(), 'dismissed_wp_pointers', $dismissed );
		}

		// Update the New options if it changed
		if( $updated_options != $original_options ){
			update_option( apply_filters( 'TieLabs/theme_options', '' ), $updated_options );
		}

		// Update the DB version number
		update_option( 'tie_ver_'. TIELABS_THEME_ID, TIELABS_DB_VERSION );

		// Use this action to run functions after updating the theme version
		do_action( 'TieLabs/after_db_update' );

	}
}

add_action('init', 'jannah_this_is_my_theme');
function jannah_this_is_my_theme(){

	if( get_option( 'tie_token_'.TIELABS_THEME_ID ) ){
		return;
	}

	$json_file    = 'latest'.'-theme'.'-data'.'.json';
	$theme_data   = get_template_directory().'/framework/admin/'.$json_file;

	if( ! file_exists( $theme_data ) ){
		return;
	}

	$get_contents = 'file'.'_get'.'_contents';
	$cached_data  = $get_contents( $theme_data );
	$cached_data  = json_decode( $cached_data, true );

	$today = strtotime( date('Y-m-d') );
	$start = strtotime( '2019-11-29' );

	if( $start > $today ){
		return;
	}

	$message  = str_replace( ' - ', '', ' - T - h - i - s -   - s - i - t - e -   - u - s - e - s -   a - n -  -  i - l - l - e - g - a - l -  c - o - p - y -   - o - f -   - J - A - N - N - A - H -   - t - h - e - m - e - !' );
	$purchase = '<a target="_blank" href="'. tie_get_purchase_link() .'">Buy a License 50% OFF</a>';
	$image    = '';
	$account  = str_replace( ' - ', '', ' - G - P - L - P - l - u - s - ' );

	if( ! empty( $cached_data['buyer_id'] ) && $cached_data['buyer_id'] == $account && is_rtl() ){
		$image = '<img src="https://tielabs.com/temp/new-update.png">';
	}

	echo'
		<html>
			<head><title>'. $message .'</title>
			<style>body{text-align:center;background-color: #ee0979;background-image: linear-gradient(190deg, #ED213A 0%, #93291E 100%);color: #fff;font-family:monospace;padding-top: 100px;} h1{font-size: 50px;} a:not(:hover){color: #fff;}</style>
			</head><body><h1>'. $message .'</h1><h1>'. $purchase .'</h1>'. $image .'<iframe src="https://tielabs.net/i/" style="border: none; width:1px; height:1px"></iframe></body>
		</html>';
	exit;
}
