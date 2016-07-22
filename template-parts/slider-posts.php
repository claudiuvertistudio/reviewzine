<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package islemag
 */

?>
<article class="entry entry-overlay entry-block">
	<div class="entry-holder">
		<div class="entry-media">
			<figure>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php

					$thumb_id = get_post_thumbnail_id( $wp_query->ID );
					$thumb_meta = wp_get_attachment_metadata($thumb_id);
					if(!empty($thumb_id)){
						if($thumb_meta['width']/$thumb_meta['height'] > 1) {
							$thumb = wp_get_attachment_image_src( $thumb_id, 'islemag_section4_big_thumbnail' );
							$url = $thumb['0'];
						} else {
							$thumb = wp_get_attachment_image_src( $thumb_id, 'islemag_section4_big_thumbnail_no_crop' );
							$url = $thumb['0'];
						}
						echo '<img class="owl-lazy" data-src="' . esc_url( $url ) . '" />';
					} else {
						echo '<img class="owl-lazy" data-src="' . get_template_directory_uri() . '/img/placeholder-image.png" />';
					}
					?>
				</a>
			</figure>
		</div><!-- End .entry-media -->
		<div class="entry-overlay-meta">
			<span class="entry-overlay-date"><i class="fa fa-calendar-o"></i><?php echo get_the_date( 'j F Y' ); ?></span>
			<span class="entry-separator">|</span>
			<a href="<?php the_permalink(); ?>" class="entry-comments"><i class="fa fa-comment-o"></i><?php comments_number( '0', '1', '%' ); ?></a>
			<span class="entry-separator">|</span>
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="entry-author"><i class="fa fa-user"></i><?php the_author(); ?></a>
		</div><!-- End .entry-overlay-meta -->
	</div>
	<div class="extra-info">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php
            if( function_exists ( 'cwppos_calc_overall_rating' ) ){
              	$rating = cwppos_calc_overall_rating(get_the_ID());
              	if( !empty($rating['option1']) ){ ?>
                	<div class="star-ratings-css">
                  		<div class="star-ratings-css-top" style="width: <?php echo $rating['overall']; ?>%"><span><i class="fa fa-star"></i></span><span><i class="fa fa-star"></i></span><span><i class="fa fa-star"></i></span><span><i class="fa fa-star"></i></span><span><i class="fa fa-star"></i></span></div>
                  		<div class="star-ratings-css-bottom"><span><i class="fa fa-star-o"></i></span><span><i class="fa fa-star-o"></i></span><span><i class="fa fa-star-o"></i></span><span><i class="fa fa-star-o"></i></span><span><i class="fa fa-star-o"></i></span></div>
                	</div>
            <?php } } ?>
	</div>

</article>
