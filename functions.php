<?php

function reviewzine_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Lora, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$lato = _x( 'on','Lato font: on or off','reviewzine' );
	$hind = _x( 'on','Hind font: on or off', 'reviewzine' );

	if( 'off' !== $lato || 'off' !== $hind ){
		$font_families = array();
		if( 'off' !== $lato ){
			$font_families[] = 'Lato:400,500,600,700';
		}
		if( 'off' !== $hind ){
			$font_families[] = 'Hind:400,600,700';
		}
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

function reviewzine_add_editor_styles() {
    add_editor_style( reviewzine_fonts_url() );
}
add_action( 'after_setup_theme', 'reviewzine_add_editor_styles' );

function reviewzine_admin_add_editor_styles() {
    add_editor_style( 'css/editor_style.css' );
}
add_action( 'admin_init', 'reviewzine_admin_add_editor_styles' );

function reviewzine_scripts_styles() {
	wp_dequeue_style( 'islemag-fonts' );
	wp_enqueue_style( 'reviewzine-fonts', reviewzine_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'reviewzine_scripts_styles', 12 );

function reviewzine_scripts() {

	wp_dequeue_style( 'islemag-bootstrap' );
	wp_dequeue_style( 'islemag-style' );
	wp_dequeue_style( 'islemag-fontawesome' );

	wp_enqueue_style( 'reviewzine-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css',array(), '3.3.5');
	wp_enqueue_style( 'reviewzine-islemag-style', get_template_directory_uri().'/style.css' );
	wp_enqueue_style( 'reviewzine-fontawesome', get_template_directory_uri().'/css/font-awesome.min.css',array(), '4.4.0');
	wp_enqueue_style( 'reviewzine-style', get_stylesheet_uri() );

	if( is_page_template('template-frontpage.php') ){
		wp_dequeue_script( 'islemag-script-index' );
		wp_enqueue_script( 'reviewzine-script-index', get_stylesheet_directory_uri() . '/js/script.index.js', array('jquery'), '1.0.0', true );
	}

}

add_action( 'wp_enqueue_scripts', 'reviewzine_scripts', 20 );

// Customizer scripts & styles

function reviewzine_customizer_script() {

	wp_dequeue_style( 'islemag-fontawesome_admin' );
	wp_dequeue_style( 'islemag-slectric-style' );
	wp_dequeue_style( 'islemag_admin_stylesheet' );

	wp_enqueue_style( 'reviewzine-fontawesome_admin', get_template_directory_uri().'/css/font-awesome.min.css',array(), '1.0.0' );
	wp_enqueue_style( 'reviewzine-slectric-style', get_template_directory_uri().'/css/selectric.css',array(), '1.0.0' );
	wp_enqueue_style( 'reviewzine_admin_stylesheet', get_template_directory_uri().'/css/admin-style.css','1.0.0' );

}
add_action(  'customize_controls_enqueue_scripts', 'reviewzine_customizer_script', 20  );



remove_action('wp_head','islemag_style',100);
add_action('wp_head','reviewzine_style', 102);
function reviewzine_style() {

	echo '<style type="text/css" class="reviewzine-css">';

	$islemag_title_color = esc_attr( get_theme_mod( 'islemag_title_color','#1e3046' ) );
	if( !empty( $islemag_title_color ) ){
		echo '.title-border span { color: '. $islemag_title_color .' }';
		echo '.post .entry-title, .post h1, .post h2, .post h3, .post h4, .post h5, .post h6, .post h1 a, .post h2 a, .post h3 a, .post h4 a, .post h5 a, .post h6 a { color: '. $islemag_title_color .' }';
		echo '.page-header h1 { color: '. $islemag_title_color .' }';
	}

	$islemag_sidebar_textcolor = esc_attr( get_theme_mod( 'header_textcolor','#1e3046' ) );
	if( !empty( $islemag_sidebar_textcolor ) ){
		echo '.sidebar .widget li a, .islemag-content-right, .islemag-content-right a, .post .entry-content,
		 .post .entry-cats, .post .entry-cats a, .post .entry-comments', '.post .entry-separator, .post .entry-footer a,
		 .post .entry-footer span, .post .entry-footer .entry-cats, .post .entry-footer .entry-cats a, .author-content { color: '.$islemag_sidebar_textcolor.'}';
	}

	$islemag_top_slider_post_title_color = esc_attr( get_theme_mod( 'islemag_top_slider_post_title_color','#ffffff' ) );
	if( !empty( $islemag_top_slider_post_title_color ) ){
		echo '.islemag-top-container .entry-block .entry-overlay-meta .entry-title a { color: '. $islemag_top_slider_post_title_color .' }';
	}

	$islemag_top_slider_post_text_color = esc_attr( get_theme_mod( 'islemag_top_slider_post_text_color','#ffffff' ) );
	if( !empty($islemag_top_slider_post_text_color) ){
		echo '.islemag-top-container .entry-overlay-meta .entry-overlay-date { color: '. $islemag_top_slider_post_text_color .' }';
		echo '.islemag-top-container .entry-overlay-meta .entry-separator { color: '. $islemag_top_slider_post_text_color .' }';
		echo '.islemag-top-container .entry-overlay-meta > a { color: '. $islemag_top_slider_post_text_color .' }';
	}

	$islemag_sections_post_title_color = esc_attr( get_theme_mod( 'islemag_sections_post_title_color','#1e3046' ) );
	if( !empty($islemag_sections_post_title_color) ){
		echo '.home.blog .islemag-content-left .entry-title a, .blog-related-carousel .entry-title a { color: '. $islemag_sections_post_title_color .' }';
	}



	$islemag_sections_post_text_color = esc_attr( get_theme_mod( 'islemag_sections_post_text_color','#8d8d8d' ) );
	if( !empty($islemag_sections_post_text_color) ){
		echo '.islemag-content-left .entry-meta, .islemag-content-left .blog-related-carousel .entry-content p,
		.islemag-content-left .blog-related-carousel .entry-cats .entry-label, .islemag-content-left .blog-related-carousel .entry-cats a,
		.islemag-content-left .blog-related-carousel > a, .islemag-content-left .blog-related-carousel .entry-footer > a { color: '. $islemag_sections_post_text_color .' }';
		echo '.islemag-content-left .entry-meta .entry-separator { color: '. $islemag_sections_post_text_color .' }';
		echo '.islemag-content-left .entry-meta a { color: '. $islemag_sections_post_text_color .' }';
		echo '.islemag-content-left .islemag-template3 .col-sm-6 .entry-overlay p { color: '. $islemag_sections_post_text_color .' }';
	}

	echo '</style>';
}

// Change customizer colors
function reviewzine_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'islemag_sections_post_text_color' )->default = '#8d8d8d';
	$wp_customize->get_setting( 'islemag_sections_post_title_color' )->default = '#1e3046';
	$wp_customize->get_setting( 'islemag_title_color' )->default = '#1e3046';

}
add_action( 'customize_register', 'reviewzine_customize_register', 1000 );

/**
 * Callback function for comments list
 **/
function reviewzine_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>

	<div class="media">
		<div class="media-left">
			<figure class="author-avatar">
				<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 52, '', '', array('class'=>'media-object') ); ?>
			</figure>
		</div>
		<div class="media-body">
			<div class="comment-author vcard">
				<?php printf( __( '<h4 class="media-heading">%s</h4>', 'reviewzine' ), get_comment_author_link() ); ?>
				<div class="reply pull-right reply-link"> <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?> </div>
				<div class="comment-extra-info">
					<?php printf( __( '<span class="comment-date">(%1$s - %2$s)</span>', 'reviewzine' ), get_comment_date(),  get_comment_time() ); ?>
					<?php edit_comment_link( __( '(Edit)', 'reviewzine' ), '  ', '' ); ?>
				</div>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'reviewzine' ); ?></em>
				<br />
			<?php endif; ?>
			<div class="media-body">
				<?php comment_text(); ?>
			</div>
		</div>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}


require_once get_stylesheet_directory() . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'reviewzine_register_required_plugins' );

function reviewzine_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'      => 'WP Product Review',
			'slug'      => 'wp-product-review',
			'required'  => false,
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'reviewzine-tgmpa',       // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                       // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins',  // Menu slug.
		'has_notices'  => true,                     // Show admin notices or not.
		'dismissable'  => true,                     // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                       // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                    // Automatically activate plugins after installation or not.
		'message'      => '',                       // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'reviewzine' ),
			'menu_title'                      => __( 'Install Plugins', 'reviewzine' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'reviewzine' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'reviewzine' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'reviewzine' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'reviewzine'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'reviewzine'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'reviewzine'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'reviewzine'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'reviewzine'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'reviewzine'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'reviewzine'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'reviewzine'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'reviewzine'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'reviewzine' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'reviewzine' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'reviewzine' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'reviewzine' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'reviewzine' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'reviewzine' ),
			'dismiss'                         => __( 'Dismiss this notice', 'reviewzine' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'reviewzine' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'reviewzine' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}
