<?php

// =============================================================================
// VIEWS/ELEMENTS/QUOTE.PHP
// -----------------------------------------------------------------------------
// Quote element.
// =============================================================================

// Prepare Atts
// ------------

$atts = array(
  'class' => x_attr_class( array( $style_id, 'x-quote', $class ) ),
);

if ( isset( $id ) && ! empty( $id ) ) {
  $atts['id'] = $id;
}

$atts = cs_apply_effect( $atts, $_view_data );


// Quote Marks
// -----------

$the_opening_mark = '';
$the_closing_mark = '';

if ( $quote_marks_opening_graphic === true ) {
  $the_opening_mark = cs_get_partial_view(
    'graphic',
    array_merge(
      cs_extract( $_view_data, array( 'quote_marks_opening_graphic' => 'graphic' ) ),
      array( 'id' => '', 'class' => 'x-quote-mark-opening' )
    )
  );
}

if ( $quote_marks_closing_graphic === true ) {
  $the_closing_mark = cs_get_partial_view(
    'graphic',
    array_merge(
      cs_extract( $_view_data, array( 'quote_marks_closing_graphic' => 'graphic' ) ),
      array( 'id' => '', 'class' => 'x-quote-mark-closing' )
    )
  );
}

// Quote
// -----

$the_quote = '<div class="x-quote-text">' . $quote_content . '</div>';


// Cite
// ----

$the_cite = "";

if ( isset( $quote_cite_content ) && ! empty( $quote_cite_content ) ) {

  $quote_cite_content = '<span class="x-quote-cite-text">' . $quote_cite_content . '</span>';

  $the_cite = '<footer class="x-quote-cite">';

  if ( $quote_cite_graphic === true ) {

    $the_cite_mark = cs_get_partial_view(
      'graphic',
      array_merge(
        cs_extract( $_view_data, array( 'quote_cite_graphic' => 'graphic' ) ),
        array( 'id' => '', 'class' => 'x-quote-cite-mark' )
      )
    );

    $the_cite      .= $the_cite_mark . $quote_cite_content;

  } else {
    $the_cite .= $quote_cite_content;
  }

  $the_cite .= '</footer>';

}


// Output
// ------

echo x_tag( 'blockquote', $atts, $custom_atts, [
  $the_opening_mark,
  x_tag( 'div', [ 'class' => 'x-quote-content' ], [
    $the_quote,
    $the_cite
  ]),
  $the_closing_mark
]);
