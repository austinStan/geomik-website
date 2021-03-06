<?php

/**
 * Element Definition: Section
 */

class CSE_Row {

  public function ui() {
    return array(
      'title' => __( 'Row (v1)', 'cornerstone' ),
    );
  }

  public function flags() {
    return array(
      'context' => '_layout',
      'dynamic_child' => true
    );
  }

  public function _layout_defaults() {
    return array(
      'elements' => array(
        array( '_type' => 'classic:column', '_active' => true )
      )
    );
  }

  public function update_defaults( $defaults ) {
    return array_merge($defaults, $this->_layout_defaults() );
  }

  public function register_shortcode() {
    return false;
  }

  public function update_build_shortcode_atts( $atts ) {

    unset( $atts['title'] );
    unset( $atts['_column_layout'] );

    return $atts;

  }

}
