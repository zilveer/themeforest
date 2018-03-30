<?php

// =============================================================================
// FUNCTIONS/GLOBAL/PLUGINS/CONVERTPLUG.PHP
// -----------------------------------------------------------------------------
// Plugin setup for theme compatibility.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Remove Notices
// =============================================================================

// Remove Notices
// =============================================================================

//
// 1. Removes admin notices.
// 2. Disables update checks from the Brainstorm Force server.
// 3. Removes the "Registration" tab for ConvertPlug's settings home.
//

define( 'BSF_14058953_NOTICES', false );                 // 1
define( 'BSF_14058953_CHECK_UPDATES', false );           // 2
define( 'BSF_REMOVE_14058953_FROM_REGISTRATION', true ); // 3