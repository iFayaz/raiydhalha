<?php

	tie_build_theme_option(
		array(
			'title' => esc_html__( 'Accelerated Mobile Pages', TIELABS_TEXTDOMAIN ),
			'id'    => 'accelerated-mobile-pages-tab',
			'type'  => 'tab-title',
		));

	tie_build_theme_option(
		array(
			'text' => esc_html__( "AMP is a Google-backed project with the aim of speeding up the delivery of content through the use of stripped down code known as AMP HTML, it is a way to build web pages for static content (pages that don't change based on user behaviour), that allows the pages to load (and pre-render in Google search) much faster than regular HTML.", TIELABS_TEXTDOMAIN ),
			'type' => 'message',
		));

	if( TIELABS_AMP_IS_ACTIVE ){

		echo '<br />';

		$amp_structure = '?amp=1';
		$amp_message   = esc_html__( "You may need to enable pretty permalinks if it isn't working.", TIELABS_TEXTDOMAIN );

		if( get_option( 'permalink_structure' ) ){
			$amp_structure = '/amp/';
			$amp_message   = '';
		}

		tie_build_theme_option(
			array(
				'text' => sprintf( esc_html__( 'To access the AMP version go to any blog post and add %s to the end of the URL.', TIELABS_TEXTDOMAIN ), '<strong>'. $amp_structure .'</strong>' ) . $amp_message,
				'type' => 'message',
			));

		tie_build_theme_option(
			array(
				'title' => esc_html__( 'Accelerated Mobile Pages', TIELABS_TEXTDOMAIN ),
				'id'    => 'accelerated-mobile-pages',
				'type'  => 'header',
			));

		tie_build_theme_option(
			array(
				'name'   => esc_html__( 'Enable AMP', TIELABS_TEXTDOMAIN ),
				'id'     => 'amp_active',
				'type'   => 'checkbox',
				'toggle' => '#amp-theme-options',
			));


		echo '<div id="amp-theme-options">';

			tie_build_theme_option(
				array(
					'title' => esc_html__( 'Logo', TIELABS_TEXTDOMAIN ),
					'id'    => 'amp-logo',
					'type'  => 'header',
				));

			tie_build_theme_option(
				array(
					'name'  => esc_html__( 'Logo Image', TIELABS_TEXTDOMAIN ),
					'id'    => 'amp_logo',
					'type'  => 'upload',
				));

			tie_build_theme_option(
				array(
					'title' => esc_html__( 'Post Settings', TIELABS_TEXTDOMAIN ),
					'id'    => 'amp-post-settings',
					'type'  => 'header',
				));

			tie_build_theme_option(
				array(
					'name'   => esc_html__( 'Related Posts', TIELABS_TEXTDOMAIN ),
					'id'     => 'amp_related_posts',
					'toggle' => '#amp_related_posts_number-item',
					'type'   => 'checkbox',
				));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Number of posts to show', TIELABS_TEXTDOMAIN ),
					'id'   => 'amp_related_posts_number',
					'type' => 'number',
				));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Categories and Tags', TIELABS_TEXTDOMAIN ),
					'id'   => 'amp_taxonomy',
					'type' => 'checkbox',
				));

			tie_build_theme_option(
				array(
					'name'   => esc_html__( 'Share Buttons', TIELABS_TEXTDOMAIN ),
					'id'     => 'amp_share_buttons',
					'toggle' => '#amp_facebook_app_id-item',
					'type'   => 'checkbox',
				));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Facebook APP ID', TIELABS_TEXTDOMAIN ),
					'id'   => 'amp_facebook_app_id',
					'hint' => esc_html__( '(Required)', TIELABS_TEXTDOMAIN ),
					'type' => 'text',
				));

			tie_build_theme_option(
				array(
					'title' => esc_html__( 'Footer Settings', TIELABS_TEXTDOMAIN ),
					'id'    => 'amp-footer-settings',
					'type'  => 'header',
				));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Back to top button', TIELABS_TEXTDOMAIN ),
					'id'   => 'amp_back_to_top',
					'type' => 'checkbox',
				));

			tie_build_theme_option(
				array(
					'name'  => esc_html__( 'Footer Logo Image', TIELABS_TEXTDOMAIN ),
					'id'    => 'amp_footer_logo',
					'type'  => 'upload',
				));

			tie_build_theme_option(
				array(
					'name'    => esc_html__( 'Footer Menu', TIELABS_TEXTDOMAIN ),
					'id'      => 'amp_footer_menu',
					'type'    => 'select',
					'options' => TIELABS_ADMIN_HELPER::get_menus( true ),
				));

			$footer_codes = '<strong>'. esc_html__( 'Variables', TIELABS_TEXTDOMAIN ) .'</strong> '.
				esc_html__( 'These tags can be included in the textarea above and will be replaced when a page is displayed.', TIELABS_TEXTDOMAIN ) .'
				<br />
				<code>%year%</code> : <em>'.esc_html__( 'Replaced with the current year.', TIELABS_TEXTDOMAIN ) .'</em><br />
				<code>%site%</code> : <em>'.esc_html__( "Replaced with The site's name.",  TIELABS_TEXTDOMAIN ) .'</em><br />
				<code>%url%</code>  : <em>'.esc_html__( "Replaced with The site's URL.",   TIELABS_TEXTDOMAIN ) .'</em>';

			tie_build_theme_option(
				array(
					'name'  => esc_html__( 'Copyright Text', TIELABS_TEXTDOMAIN ),
					'id'    => 'amp_footer_copyright',
					'hint'  => $footer_codes,
					'type'  => 'textarea',
				));

			tie_build_theme_option(
				array(
					'title' => esc_html__( 'Advertisement', TIELABS_TEXTDOMAIN ),
					'id'    => 'amp-advertisement',
					'type'  => 'header',
				));

			tie_build_theme_option(
				array(
					'name'  => esc_html__( 'Below Header', TIELABS_TEXTDOMAIN ),
					'id'    => 'amp_ad_below_header',
					'hint'  => sprintf(
						esc_html__( 'Enter your Ad code, AMP pages support %1$s tag only, %2$sClick Here%3$s For More info.', TIELABS_TEXTDOMAIN ),
						'<code>&lt;amp-ad&gt;</code>',
						'<a href="https://www.ampproject.org/docs/reference/extended/amp-ad.html" target="_blank">',
						'</a>'
					),
					'type'  => 'textarea',
				));

			tie_build_theme_option(
				array(
					'name'  => esc_html__( 'Above Footer', TIELABS_TEXTDOMAIN ),
					'id'    => 'amp_ad_above_footer',
					'hint'  => sprintf(
						esc_html__( 'Enter your Ad code, AMP pages support %1$s tag only, %2$sClick Here%3$s For More info.', TIELABS_TEXTDOMAIN ),
						'<code>&lt;amp-ad&gt;</code>',
						'<a href="https://www.ampproject.org/docs/reference/extended/amp-ad.html" target="_blank">',
						'</a>'
					),
					'type'  => 'textarea',
				));

			tie_build_theme_option(
				array(
					'name'  => esc_html__( 'Above Content', TIELABS_TEXTDOMAIN ),
					'id'    => 'amp_ad_above',
					'hint'  => sprintf(
						esc_html__( 'Enter your Ad code, AMP pages support %1$s tag only, %2$sClick Here%3$s For More info.', TIELABS_TEXTDOMAIN ),
						'<code>&lt;amp-ad&gt;</code>',
						'<a href="https://www.ampproject.org/docs/reference/extended/amp-ad.html" target="_blank">',
						'</a>'
					),
					'type'  => 'textarea',
				));

			tie_build_theme_option(
				array(
					'name'  => esc_html__( 'Below Content', TIELABS_TEXTDOMAIN ),
					'id'    => 'amp_ad_below',
					'hint'  => sprintf(
						esc_html__( 'Enter your Ad code, AMP pages support %1$s tag only, %2$sClick Here%3$s For More info.', TIELABS_TEXTDOMAIN ),
						'<code>&lt;amp-ad&gt;</code>',
						'<a href="https://www.ampproject.org/docs/reference/extended/amp-ad.html" target="_blank">',
						'</a>'
					),
					'type'  => 'textarea',
				));

			tie_build_theme_option(
				array(
					'title' => esc_html__( 'Styling', TIELABS_TEXTDOMAIN ),
					'id'    => 'amp-styling',
					'type'  => 'header',
				));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Background Color', TIELABS_TEXTDOMAIN ),
					'id'   => 'amp_bg_color',
					'type' => 'color',
				));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Header Background Color', TIELABS_TEXTDOMAIN ),
					'id'   => 'amp_header_color',
					'type' => 'color',
				));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Title Color', TIELABS_TEXTDOMAIN ),
					'id'   => 'amp_title_color',
					'type' => 'color',
				));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Post meta Color', TIELABS_TEXTDOMAIN ),
					'id'   => 'amp_meta_color',
					'type' => 'color',
				));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Links color', TIELABS_TEXTDOMAIN ),
					'id'   => 'amp_links_color',
					'type' => 'color',
				));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Footer color', TIELABS_TEXTDOMAIN ),
					'id'   => 'amp_footer_color',
					'type' => 'color',
				));

			tie_build_theme_option(
				array(
					'name' => esc_html__( 'Underline text links on hover', TIELABS_TEXTDOMAIN ),
					'id'   => 'amp_links_underline',
					'type' => 'checkbox',
				));

		echo '</div>';
	}

	else{
		tie_build_theme_option(
			array(
				'text' => sprintf( esc_html__( 'You need to install the %s Plugin first.', TIELABS_TEXTDOMAIN ), '<a target="_blank" href="https://wordpress.org/plugins/amp/">Automattic AMP</a>' ),
				'type' => 'error',
			));
		}
