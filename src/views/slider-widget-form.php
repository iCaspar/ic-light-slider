<?php
/**
 * slider-widget-form.php
 */

namespace ICaspar\LightSlider;

?>

<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title: ', IC_LIGHT_SLIDER_TEXT_DOMAIN ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
           name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
           value="<?php echo esc_attr( $instance['title'] ); ?>">
</p>
<p>
    <select id="<?php echo $this->get_field_id( 'slider' ); ?>"
            name="<?php echo $this->get_field_name( 'slider' ); ?>"
            class="widefat" style="width:100%;">
		<?php foreach ( get_terms( $this->terms ) as $term ): ?>
            <option <?php selected( $instance['slider'], $term->term_id ); ?>
                    value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
		<?php endforeach; ?>
    </select>
</p>