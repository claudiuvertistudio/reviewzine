<?php

function reviewzine_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Lora, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$nunito = _x( 'on', 'Nunito font: on or off', 'reviewzine' );
	$hind = _x( 'on','Hind font: on or off', 'reviewzine' );

	if( 'off' !== $nunito || 'off' !== $hind ){
		$font_families = array();
		if( 'off' !== $nunito ){
			$font_families[] = 'Nunito:300,400,700';
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

	$islemag_sidebar_textcolor = esc_attr( get_theme_mod( 'header_textcolor','#454545' ) );
	if( !empty( $islemag_sidebar_textcolor ) ){
		echo '.sidebar .widget li a, .islemag-content-right, .islemag-content-right a, .post .entry-content, .post .entry-content p,
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



	$islemag_sections_post_text_color = esc_attr( get_theme_mod( 'islemag_sections_post_text_color','#1e3046' ) );
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

	$wp_customize->get_setting( 'islemag_sections_post_text_color' )->default = '#1e3046';
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

	<figure class="author-avatar">
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
	</figure>
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

	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}
