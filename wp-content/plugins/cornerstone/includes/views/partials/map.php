<?php

// =============================================================================
// VIEWS/PARTIALS/MAP.PHP
// -----------------------------------------------------------------------------
// Map partial.
// =============================================================================

$style_id = ( isset( $style_id ) ) ? $style_id : '';

$is_preview = apply_filters( 'cs_is_preview', false );

// Prepare Attr Values
// -------------------

$classes = array( $style_id, 'x-map', 'x-map-' . $map_type, $class );


// Prepare Atts
// ------------

$atts = array(
  'class' => $classes,
);

if ( isset( $id ) && ! empty( $id ) ) {
  $atts['id'] = $id;
}


// Content
// -------

switch ( $map_type ) {

  // Embed
  // -----

  case 'embed' :

    $map_embed_content = ( ! empty( $map_embed_code ) ) ? $map_embed_code : '<img style="object-fit: cover; width: 100%; height: 100%;" src="' . cornerstone_make_placeholder_pixel() . '" width="1" height="1" alt="Placeholder">';

    break;


  // Google
  // ------
  // 01. Setup and enqueue Google Maps API script.
  // 02. Populate Google Map API data attributes.

  case 'google' :

    $map_google_api_script = 'https://maps.googleapis.com/maps/api/js?v=3'; // 01

    if ( $map_google_api_key ) {
      $map_google_api_script = add_query_arg( array( 'key' => esc_attr( $map_google_api_key ) ), $map_google_api_script );
    }

    if ( $map_google_api_key || ( ! $is_preview && ! $map_google_api_key ) ) {
      wp_enqueue_script( 'x-google-map', $map_google_api_script );
    }

    $map_google_data = array(
      'lat'       => $map_google_lat,
      'lng'       => $map_google_lng,
      'drag'      => $map_google_drag,
      'zoom'      => $map_google_zoom,
      'zoomLevel' => $map_google_zoom_level,
      'styles'    => $map_google_styles
    );

    $atts = array_merge( $atts, cs_element_js_atts( 'map_google', $map_google_data ) ); // 02

    break;

}


// Output
// ------

?>

<div <?php echo x_atts( $atts ); ?>>
  <?php

  switch ( $map_type ) {

    case 'embed' :
      echo $map_embed_content;
      break;

    case 'google' :

      do_action( 'x_render_children', $_modules, $_view_data );

      if ( $is_preview && ! $map_google_api_key ) {
        echo '<img style="object-fit: cover; width: 100%; height: 100%;" src="' . cornerstone_make_placeholder_pixel() . '" width="1" height="1" alt="Placeholder">';
      }

      break;

  }

  ?>
</div>
