<?php
/**
 * Authors Widget Loop
 *
 * This template can be overridden by copying it to your-child-theme/templates/loops/loop-authors-widget.php.
 *
 * HOWEVER, on occasion TieLabs will need to update template files and you
 * will need to copy the new files to your child theme to maintain compatibility.
 *
 * @author   TieLabs
 * @version  2.1.0
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

?>

<li <?php tie_post_class( 'widget-post-list' ); ?>>

	<?php

		$no_thumb = 'no-small-thumbs';

		# Show the avatar if it is active only
		if( get_option( 'show_avatars' ) ){
			$no_thumb = '';
			?>
			<div class="post-widget-thumbnail" style="width:70px">
				<a class="author-avatar" href="<?php echo tie_get_author_profile_url(); ?>">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 70 ); ?>
				</a>
			</div>
			<?php
		}

	?>

	<div class="comment-body post-widget-body <?php echo esc_attr( $no_thumb ) ?>">
		<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>

		<?php tie_the_post_meta( array( 'comments' => false, 'views' => false ) ); ?>
	</div>

</li>
