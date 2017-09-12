<?php
/**
 * slide-link-metabox.php
 */

namespace ICaspar\LightSlider;

?>

<input class="widefat" type="url"
       name="<?php echo $this->metaBoxConfig['meta_key']; ?>" id="<?php echo $this->metaBoxConfig['meta_key']; ?>"
       placeholder="http://example.com/"
       value="<?php echo esc_url( $stored ); ?>"/>