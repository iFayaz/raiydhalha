<?php
/**
 * Block Layout - Scroll #2
 *
 * This template can be overridden by copying it to your-child-theme/templates/loops/loop-scroll-2.php.
 *
 * HOWEVER, on occasion TieLabs will need to update template files and you
 * will need to copy the new files to your child theme to maintain compatibility.
 *
 * @author   TieLabs
 * @version  2.1.0
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

?>

<div <?php tie_post_class( 'slide' ); ?>>

	<?php

		if ( has_post_thumbnail() ){
			tie_post_thumbnail( TIELABS_THEME_SLUG.'-image-large', false, false, false );
		}
	?>

	<div class="post-overlay">
		<div class="post-content">
			<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php tie_the_title( $block['title_length'] ); ?></a></h3>
		</div>
	</div>
</div><!-- .Slide /-->
