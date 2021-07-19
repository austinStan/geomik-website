<?php

// =============================================================================
// _COLOR-ALT-CSS.PHP
// -----------------------------------------------------------------------------
// Generated styling.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Setup
//   02. Base
// =============================================================================

// Setup
// =============================================================================

$type = ( isset( $type ) && $type === 'color' ) ? $type : $type . '-color';
$base = ( isset( $base )                      ) ? $base : '';
$alt  = ( isset( $alt )                       ) ? $alt  : '';



// Base
// =============================================================================
// 01. If $alt is not transparent or $alt doesn't equal $base, proceed.
// 02. $type can be "color," "border," or "background," and if necessary will
//     be appended with a dash via the ternary above.

?>

@unless $<?php echo $alt; ?>?? || $<?php echo $alt; ?> === $<?php echo $base; ?> { <?php // 01 ?>
  <?php echo $type; ?>: $<?php echo $alt; ?>; <?php // 02 ?>
}
