<?php

// =============================================================================
// VIEWS/ELEMENTS/COUNTER.PHP
// -----------------------------------------------------------------------------
// Counter element.
// =============================================================================

$class  = ( isset( $class )  ) ? $class  : '';


// Prepare Attr Values
// -------------------

$is_compact      = $countdown_labels_output === 'compact';
$singular_labels = cs_get_countdown_labels( false, $is_compact );
$plural_labels   = cs_get_countdown_labels( true, $is_compact );

$countdown_end = cs_dynamic_content( $countdown_end );

$current_time = strtotime( current_time( 'mysql' ) );

if ( 'TBD' === strtoupper( $countdown_end ) ) {
  $countdown_end = date( 'Y-m-d H:i:s', $current_time + WEEK_IN_SECONDS );
}

// Timestamp Diff
// --------------

$timestamp_diff = strtotime( $countdown_end ) - $current_time;


// Prepare Atts
// ------------

$atts = array(
  'class' => array( $style_id, 'x-countdown', 'has-' . $countdown_labels_output . '-labels', $class )
);

if ( ! empty( $countdown_aria_content ) ) {
  $atts = array_merge( $atts, array(
    'role'        => 'timer',
    'aria-live'   => 'polite',
    'aria-atomic' => 'true',
  ) );
}

if ( isset( $id ) && ! empty( $id ) ) {
  $atts['id'] = $id;
}

$atts = cs_apply_effect( $atts, $_view_data );

if ( $timestamp_diff > 0 ) {
  $counter_data = array(
    'end'                    => date( 'Y-m-d\TH:i:s', strtotime( $countdown_end ) ), // reformat the date to ensure it can be parsed by all browsers (Safari)
    'serverTime'             => date( 'Y-m-d\TH:i:s', $current_time ),
    'hideEmpty'              => $countdown_hide_empty,
    'hideOnComplete'         => $countdown_hide_on_end,
    'leadingZeros'           => $countdown_leading_zeros,
    'completeMessageContent' => cs_expand_content( $countdown_complete_content ),
    'singularLabels'         => $singular_labels,
    'pluralLabels'           => $plural_labels,
    'ariaLabel'              => $countdown_aria_content,
  );

  $atts = array_merge( $atts, cs_element_js_atts( 'countdown', $counter_data ) );
}


// Units
// -----

$units_content           = '';
$countdown_units_display = explode( ' ', trim( $countdown_units_display ) );

if ( $timestamp_diff > 0 ) {

  $units_content .= '<div class="x-countdown-units" aria-hidden="true">';

    foreach( $countdown_units_display as $unit ) :

      if ( $countdown_hide_empty ) {
        if (
          $unit === 'd' && $timestamp_diff <  ( 60 * 60 * 24 ) ||
          $unit === 'h' && $timestamp_diff <  ( 60 * 60      ) ||
          $unit === 'm' && $timestamp_diff <  ( 60 * 1       ) ||
          $unit === 's' && $timestamp_diff <= ( 60 * 0       )
        ) {
          continue;
        }
      }

      $units_label = $countdown_labels ? '<div class="x-countdown-label"><div data-x-countdown-label-' . $unit . '>' . $plural_labels[$unit] . '</div></div>' : '';

      $units_content .= '<div class="x-countdown-unit x-countdown-' . $unit . '" data-x-countdown-unit>'
                        . '<div class="x-countdown-unit-content">'
                          . '<div class="x-countdown-number" data-x-countdown-' . $unit . '>'
                            . '<span class="x-countdown-digit">0</span>'
                            . '<span class="x-countdown-digit">0</span>'
                          . '</div>'
                          . $units_label
                        . '</div>'
                      . '</div>';

    endforeach;

  $units_content .= '</div>';

}


// Complete
// --------

$complete_content = '';

if ( $timestamp_diff <= 0 ) {
  $complete_content .= '<div class="x-countdown-complete">' . $countdown_complete_content . '</div>';
}


// Output
// ------

?>

<div <?php echo x_atts( $atts, $custom_atts ); ?>>
  <?php echo $units_content; ?>
  <?php echo $complete_content; ?>
  <?php if ( ! empty( $countdown_aria_content ) ) : ?>
    <div class="visually-hidden" data-x-countdown-aria></div>
  <?php endif; ?>
</div>
