<?php

// =============================================================================
// CORNERSTONE/INCLUDES/ELEMENTS/DEFINITIONS/NAV-DROPDOWN.PHP
// -----------------------------------------------------------------------------
// V2 element definitions.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Values
//   02. Style
//   03. Render
//   04. Builder Setup
//   05. Register Element
// =============================================================================

// Values
// =============================================================================

$values = cs_compose_values(
  'menu-dropdown',
  'menu-item',
  array(
    'anchor_padding'      => cs_value( '0.75em', 'style' ),
    'anchor_text_margin'  => cs_value( '5px auto 5px 5px', 'style' ),
    'anchor_flex_justify' => cs_value( 'flex-start', 'style' )
  ),
  'omega',
  'omega:toggle-hash'
);



// Style
// =============================================================================

function x_element_style_nav_dropdown() {
  $style = cs_get_partial_style( 'anchor', array(
    'selector'   => '.x-anchor-toggle',
    'key_prefix' => 'toggle'
  ) );

  $style .= cs_get_partial_style( 'effects', array(
    'selector' => '.x-anchor-toggle',
    'children' => ['.x-anchor-text-primary', '.x-anchor-text-secondary', '.x-graphic-child'], // '[data-x-particle]'
  ) );

  $style .= cs_get_partial_style( 'dropdown' );

  $style .= cs_get_partial_style( 'dropdown', [
    'selector' => ' .x-dropdown'
  ] );

  $style .= cs_get_partial_style( 'anchor', array(
    'selector'   => '.x-anchor-menu-item',
    'key_prefix' => '',
  ) );

  return $style;
}



// Render
// =============================================================================

function x_element_render_nav_dropdown( $data ) {
  $data = array_merge(
    $data,
    cs_make_aria_atts(
      'toggle_anchor',
      array(
        'controls' => 'dropdown',
        'haspopup' => 'true',
        'expanded' => 'false',
        'label'    => __( 'Toggle Dropdown Content', '__x__' ),
      ),
      $data['id'],
      $data['unique_id']
    )
  );

  cs_defer_partial( 'x_before_site_end', 'menu', cs_extract( $data, array( 'menu' => '', 'anchor' => '' ) ) );

  $data_toggle = cs_extract( $data, [ 'toggle_anchor' => 'anchor', 'toggle' => '', 'effects' => '' ] );
  $data_toggle['toggle_trigger'] = $data['dropdown_toggle_trigger'];

  return cs_get_partial_view( 'anchor', $data_toggle );

}



// Builder Setup
// =============================================================================

function x_element_builder_setup_nav_dropdown() {
  return cs_compose_controls(
    cs_partial_controls( 'menu', array( 'type' => 'dropdown' ) ),
    cs_partial_controls( 'dropdown', array( 'add_toggle_trigger' => true ) ),
    cs_partial_controls( 'anchor', cs_recall( 'settings_anchor:toggle' ) ),
    cs_partial_controls( 'anchor', array(
      'type'             => 'menu-item',
      'group'            => 'menu_item_anchor',
      'group_title'      => __( 'Links', '__x__' ),
      'is_nested'        => true,
      'label_prefix_std' => __( 'Menu Items', '__x__' )
    ) ),
    cs_partial_controls( 'effects' ),
    cs_partial_controls( 'omega', array( 'add_toggle_hash' => true ) )
  );
}



// Register Element
// =============================================================================

cs_register_element( 'nav-dropdown', [
  'title'   => __( 'Navigation Dropdown', '__x__' ),
  'values'  => $values,
  'components' => [ 'toggle', 'dropdown', 'effects' ],
  'builder' => 'x_element_builder_setup_nav_dropdown',
  'style'   => 'x_element_style_nav_dropdown',
  'render'  => 'x_element_render_nav_dropdown',
  'icon'    => 'native'
] );
