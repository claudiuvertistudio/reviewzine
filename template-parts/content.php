<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package islemag
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("entry"); ?>>

	<div class="entry-media">
		<figure>
			<a href="<?php the_permalink(); ?>">
			 <?php
			 $islemag_thumbnail_id = get_post_thumbnail_id();
			 if($islemag_thumbnail_id){
				 $islemag_thumb_meta = wp_get_attachment_metadata($islemag_thumbnail_id);
				 if($islemag_thumb_meta['width'] > 250 && $islemag_thumb_meta['height'] > 250 ) {
					 if( $islemag_thumb_meta['width'] / $islemag_thumb_meta['height'] > 1.5 ){
						 the_post_thumbnail('islemag_blog_post');
					 } else {
						 the_post_thumbnail('islemag_blog_post_no_crop');
					 }
				 }
			 } else {
				 echo '<img src="' . get_template_directory_uri() . '/img/blogpost-placeholder.jpg" />';
			 } ?>
			</a>
		</figure>
	</div><!-- End .entry-media -->

	<div class="entry-date"><div><?php echo get_the_date( 'd' ); ?><span><?php echo strtoupper( get_the_date( 'F' ) ); ?></span></div></div>
	<?php
		$id = get_the_ID();
		$format = get_post_format( $id );
		switch ( $format ) {
			case 'aside':
				$icon_class = "fa-file-text";
				break;
			case 'chat':
				$icon_class = "fa-comment";
				break;
			case 'gallery':
				$icon_class = "fa-file-image-o";
				break;
			case 'link':
				$icon_class = "fa-link";
				break;
			case 'image':
				$icon_class = "fa-picture-o";
				break;
			case 'quote':
				$icon_class = "fa-quote-right";
				break;
			case 'status':
				$icon_class = "fa-line-chart";
				break;
			case 'video':
				$icon_class = "fa-video-camera";
				break;
			case 'audio':
				$icon_class = "fa-headphones";
				break;
		}
		if( !empty( $icon_class ) ){ ?>
			<span class="entry-format"><i class="fa <?php echo $icon_class; ?>"></i></span>
	<?php
		} ?>
	<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<header class="entry-header">
		<div class="row">
			<div class="col-md-6">
				<a href="<?php the_permalink(); ?>" class="entry-comments"><i class="fa fa-comment-o"></i><?php comments_number( '0', '1', '%' ); ?></a>
				<span class="entry-separator">|</span>
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="entry-author"><i class="fa fa-user"></i><?php the_author(); ?></a>
			</div>
			
			<?php
            if( function_exists ( 'cwppos_calc_overall_rating' ) ){
              $rating = cwppos_calc_overall_rating( get_the_ID() );
              if( !empty($rating['option1']) ){ ?>
              	<div class="col-md-6">
	                <div class="star-ratings-css pull-right">
	                  <div class="star-ratings-css-top" style="width: <?php echo $rating['overall']; ?>%">
	                    <span><i class="fa fa-star"></i></span>
	                    <span><i class="fa fa-star"></i></span>
	                    <span><i class="fa fa-star"></i></span>
	                    <span><i class="fa fa-star"></i></span>
	                    <span><i class="fa fa-star"></i></span>
	                  </div>
	                  <div class="star-ratings-css-bottom">
	                    <span><i class="fa fa-star-o"></i></span>
	                    <span><i class="fa fa-star-o"></i></span>
	                    <span><i class="fa fa-star-o"></i></span>
	                    <span><i class="fa fa-star-o"></i></span>
	                    <span><i class="fa fa-star-o"></i></span>
	                  </div>
	                </div>
	                <div class="clearfix"></div>
                </div>
            <?php } } ?>
			
		</div>
	</header>

	<div class="entry-content">
		<?php
			$ismore = @strpos( $post->post_content, '<!--more-->');
			if( $ismore ) : the_content( sprintf( esc_html__( 'Read more %s ...', 'reviewzine' ), '<span class="screen-reader-text">'.esc_html__('about ', 'reviewzine') . get_the_title() . '</span>' ) );
			else : the_excerpt();
			endif;
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'reviewzine' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article>
