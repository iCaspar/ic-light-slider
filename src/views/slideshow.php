<?php
/**
 * slideshow.php
 */

namespace ICaspar\LightSlider;

?>

<div class="ic-slider wrap">
	<?php
	while ( $slides->have_posts() ) {
		$slides->the_post();
		$url = get_post_meta( get_the_ID(), '_slide-link', true );

		if ( has_post_thumbnail() && $url ) {
			?>
            <a href="<?php echo esc_url( $url ); ?>">
				<?php the_post_thumbnail('full'); ?>
            </a>
		<?php } elseif ( has_post_thumbnail() ) { ?>
			<?php the_post_thumbnail('full'); ?>
		<?php } else { ?>
            <p>This Slide intentionally left blank</p>
		<?php
		}
	}
	?>
</div>