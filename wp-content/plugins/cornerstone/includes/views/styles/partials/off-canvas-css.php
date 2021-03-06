<?php

// =============================================================================
// _OFF-CANVAS-CSS.PHP
// -----------------------------------------------------------------------------
// Generated styling.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Setup
//   02. Base
//   03. Close
//   04. Content
// =============================================================================

// Setup
// =============================================================================

$selector          = ( isset( $selector ) && $selector !== ''                   ) ? $selector          : '.x-off-canvas';
$key_prefix        = ( isset( $key_prefix ) && $key_prefix !== ''               ) ? $key_prefix . '_'  : '';
$is_layout_element = ( isset( $is_layout_element ) && $is_layout_element !== '' ) ? $is_layout_element : false;


// Base
// ----

$data_background_color = array(
  'type' => 'background',
  'base' => $key_prefix . 'off_canvas_bg_color',
);


// Close
// -----

$data_close_color = array(
  'type' => 'color',
  'base' => $key_prefix . 'off_canvas_close_color',
  'alt'  => $key_prefix . 'off_canvas_close_color_alt',
);


// Content
// -------

$data_content_border = array(
  'width'  => $key_prefix . 'off_canvas_content_border_width',
  'style'  => $key_prefix . 'off_canvas_content_border_style',
  'base'   => $key_prefix . 'off_canvas_content_border_color',
);

$data_content_background_color = array(
  'type' => 'background',
  'base' => $key_prefix . 'off_canvas_content_bg_color',
);

$data_content_box_shadow = array(
  'type'       => 'box',
  'dimensions' => $key_prefix . 'off_canvas_content_box_shadow_dimensions',
  'base'       => $key_prefix . 'off_canvas_content_box_shadow_color',
);



// Base
// =============================================================================

?>

.$_el<?php echo $selector; ?> {
  font-size: $<?php echo $key_prefix; ?>off_canvas_base_font_size;
  transition-duration: $<?php echo $key_prefix; ?>off_canvas_duration;
  @if $_offscreen !== '' {
    z-index: calc((99999999 + $_order) * $_depth);
  }
}

.$_el<?php echo $selector; ?> .x-off-canvas-bg {
  <?php echo cs_get_partial_style( '_color-base', $data_background_color ); ?>
  transition-duration: $<?php echo $key_prefix; ?>off_canvas_duration;
  transition-timing-function: $<?php echo $key_prefix; ?>off_canvas_timing_function;
}



<?php

// Close
// =============================================================================
// transition-* order: color, opacity, transform

?>

.$_el<?php echo $selector; ?> .x-off-canvas-close {
  width: calc(1em * $<?php echo $key_prefix; ?>off_canvas_close_dimensions);
  height: calc(1em * $<?php echo $key_prefix; ?>off_canvas_close_dimensions);
  font-size: $<?php echo $key_prefix; ?>off_canvas_close_font_size;
  <?php echo cs_get_partial_style( '_color-base', $data_close_color ); ?>
  transition-duration: 0.3s, $<?php echo $key_prefix; ?>off_canvas_duration, $<?php echo $key_prefix; ?>off_canvas_duration;
  transition-timing-function: ease-in-out, $<?php echo $key_prefix; ?>off_canvas_timing_function, $<?php echo $key_prefix; ?>off_canvas_timing_function;
}

.$_el<?php echo $selector; ?> .x-off-canvas-close:hover,
.$_el<?php echo $selector; ?> .x-off-canvas-close:focus {
  <?php echo cs_get_partial_style( '_color-alt', $data_close_color ); ?>
}



<?php

// Content
// =============================================================================

?>

.$_el<?php echo $selector; ?> .x-off-canvas-content {
  <?php if ( $is_layout_element === true ) : ?>
    @if $<?php echo $key_prefix; ?>off_canvas_content_overflow !== 'visible' {
      overflow: $<?php echo $key_prefix; ?>off_canvas_content_overflow;
    }
    @if $<?php echo $key_prefix; ?>off_canvas_content_flexbox {
      display: flex;
      flex-direction: $<?php echo $key_prefix; ?>off_canvas_content_flex_direction;
      justify-content: $<?php echo $key_prefix; ?>off_canvas_content_flex_justify;
      align-items: $<?php echo $key_prefix; ?>off_canvas_content_flex_align;
      @if $<?php echo $key_prefix; ?>off_canvas_content_flex_wrap === true {
        flex-wrap: wrap;
        align-content: $<?php echo $key_prefix; ?>off_canvas_content_flex_align;
      }
    }
    @if $<?php echo $key_prefix; ?>off_canvas_content_width !== 'auto' {
      width: $<?php echo $key_prefix; ?>off_canvas_content_width;
    }
    @unless $<?php echo $key_prefix; ?>off_canvas_content_min_width?? {
      min-width: $<?php echo $key_prefix; ?>off_canvas_content_min_width;
    }
    @unless $<?php echo $key_prefix; ?>off_canvas_content_max_width?? {
      max-width: $<?php echo $key_prefix; ?>off_canvas_content_max_width;
    }
    @unless $<?php echo $key_prefix; ?>off_canvas_content_text_align?? {
      text-align: $<?php echo $key_prefix; ?>off_canvas_content_text_align;
    }
  <?php else : ?>
    @unless $<?php echo $key_prefix; ?>off_canvas_content_max_width?? {
      max-width: $<?php echo $key_prefix; ?>off_canvas_content_max_width;
    }
  <?php endif; ?>

  @unless $<?php echo $key_prefix; ?>off_canvas_close_offset === false {
    padding: calc($<?php echo $key_prefix; ?>off_canvas_close_font_size * $<?php echo $key_prefix; ?>off_canvas_close_dimensions);
  }
  <?php
  echo cs_get_partial_style( '_border-base', $data_content_border );
  echo cs_get_partial_style( '_color-base', $data_content_background_color );
  echo cs_get_partial_style( '_shadow-base', $data_content_box_shadow );
  ?>
  transition-duration: $<?php echo $key_prefix; ?>off_canvas_duration;
  transition-timing-function: $<?php echo $key_prefix; ?>off_canvas_timing_function;
}
