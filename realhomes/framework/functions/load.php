<?php
/**
 * This file loads other files containing various functions used in this theme
 */

// Header functions
require_once( INSPIRY_FRAMEWORK . 'functions/header.php' );

//Basic functions
require_once( INSPIRY_FRAMEWORK . 'functions/basic.php' );

//Pagination functions
require_once( INSPIRY_FRAMEWORK . 'functions/pagination.php' );

// Price functions
require_once( INSPIRY_FRAMEWORK . 'functions/price.php' );

// Real Estate functions
require_once( INSPIRY_FRAMEWORK . 'functions/real-estate.php' );

// Real Estate Search Functions
require_once( INSPIRY_FRAMEWORK . 'functions/real-estate-search.php' );

// Home related functions
include_once( INSPIRY_FRAMEWORK . 'functions/home.php' );

// Breadcrumbs functions
require_once( INSPIRY_FRAMEWORK . 'functions/breadcrumbs.php' );

// Users / Members related functions
include_once( INSPIRY_FRAMEWORK . 'functions/member.php' );

// Property submit and edit
include_once( INSPIRY_FRAMEWORK . 'functions/submit-edit.php' );

// Favorites functions
include_once( INSPIRY_FRAMEWORK . 'functions/favorites.php' );

// Contact form handlers
include_once( INSPIRY_FRAMEWORK . 'functions/contact-form-handlers.php' );

// Property submit handler
include_once( INSPIRY_FRAMEWORK . 'functions/property-submit-handler.php' );

// Edit profile handler
include_once( INSPIRY_FRAMEWORK . 'functions/edit-profile-handler.php' );

// Theme's custom comment
include_once( INSPIRY_FRAMEWORK . 'functions/theme-comment.php' );

// Currency switcher
include_once( INSPIRY_FRAMEWORK . 'functions/currency-switcher.php' );

// Demo import functions
require_once( INSPIRY_FRAMEWORK . 'functions/demo-import.php' );
