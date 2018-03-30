<?php

// =============================================================================
// FUNCTIONS/GLOBAL/PLUGINS/THE-GRID.PHP
// -----------------------------------------------------------------------------
// Plugin setup for theme compatibility.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Filter for The Grid plugin compatibility
//   02. Filter to remove The Grid registration Panel
// =============================================================================

// Filter For Grid Compatibility
// =============================================================================

add_filter( 'tg_grid_un13306812', function() {
	return true;
} );


// Filter to remove The Grid registration Panel
// =============================================================================

add_filter( 'tg_grid_unregister', function() {
	return __( 'This is an exclusive deal for X users only. Your validated X license unlocks all features of The Grid including the skin builder. Updates are distributed automatically by Themeco as well as support provided in our forum.', '__x__' );
} );
