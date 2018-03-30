// Porto Config Scss Plugins File
// Created at <?php echo date("Y-m-d H:i:s") ?>

<?php
$b = porto_check_theme_options();
$dark = $b['css-type'] == 'dark';
?>

//** Padding between columns. Gets divided in half for the left and right.
$grid-gutter-width:         <?php echo $b['grid-gutter-width'] ?>px !default;

// Large screen / wide desktop
$container-large-desktop: (<?php echo $b['container-width'] ?>px) !default;
$screen-lg: (<?php echo $b['container-width'] + $b['grid-gutter-width'] ?>px) !default;

$dark: <?php echo ($dark) ? '1' : '0' ?>;

$brand-primary:         #0088cc !default;
$brand-success:         #47a447 !default;
$brand-info:            #5bc0de !default;
$brand-warning:         #ed9c28 !default;
$brand-danger:          #d2322d !default;

<?php if ($dark) : ?>
$color-dark: <?php echo $b['color-dark'] ?>;
<?php else : ?>
    $color-dark: #1d2127;
<?php endif; ?>
$color-dark-inverse: #FFF;
$color-dark-1: $color-dark;
$color-dark-2: lighten($color-dark-1, 2%);
$color-dark-3: lighten($color-dark-1, 5%);
$color-dark-4: lighten($color-dark-1, 8%);
$color-dark-5: lighten($color-dark-1, 3%);
$color-darken-1: darken($color-dark-1, 2%);

$dark-bg: $color-dark;
$dark-default-text: #808697;

<?php if ($dark) : ?>

//** Background color for `<body>`.
$body-bg: $color-dark-3 !default;

//== Colors
//
//## Gray and brand colors for use across Bootstrap.

$gray-base:              #fff !default;
$gray-darker:            #999 !default;
$gray-dark:              #777 !default;
$gray:                   #777 !default;
$gray-light:             #777 !default;
$gray-lighter:           $color-dark-4 !default;

//== Components

//** Global color for active items (e.g., navs or dropdowns).
$component-active-color:    $color-dark-3 !default;
//** Global background color for active items (e.g., navs or dropdowns).
$component-active-bg:       $brand-primary !default;

//== Tables
//** Background color used for `.table-striped`.
$table-bg-accent:               $color-dark-3 !default;
//** Background color used for `.table-hover`.
$table-bg-hover:                $color-dark-2 !default;
$table-bg-active:               $table-bg-hover !default;

//** Border color for table and cell borders.
$table-border-color:            $color-dark-3 !default;

//== Buttons
$btn-default-color:              #fff !default;
$btn-default-bg:                 $color-dark-3 !default;
$btn-default-border:             $color-dark-3 !default;

//== Forms
//
//##

//** `<input>` background color
$input-bg:                       $color-dark-3 !default;
//** `<input disabled>` background color
$input-bg-disabled:              $gray-lighter !default;

//** Text color for `<input>`s
$input-color:                    #777 !default;
//** `<input>` border color
$input-border:                   $color-dark-3 !default;

//** Border color for inputs on focus
$input-border-focus:             $color-dark-4 !default;

//** Placeholder text color
$input-color-placeholder:        #999 !default;

//== Dropdowns
//** Background for the dropdown menu.
$dropdown-bg:                    $color-dark-3 !default;
//** Dropdown menu `border-color`.
$dropdown-border:                $color-dark-3 !default;
//** Dropdown menu `border-color` **for IE8**.
$dropdown-fallback-border:       $color-dark-3 !default;
//** Divider color for between dropdown items.
$dropdown-divider-bg:            $color-dark-4 !default;

//** Dropdown link text color.
$dropdown-link-color:            $gray-dark !default;
//** Hover color for dropdown links.
$dropdown-link-hover-color:      darken($gray-dark, 5%) !default;
//** Hover background for dropdown links.
$dropdown-link-hover-bg:         $color-dark-4 !default;

//** Deprecated `$dropdown-caret-color` as of v3.1.0
$dropdown-caret-color:           #fff !default;

//== Tabs
$nav-tabs-border-color:                     $color-dark-3 !default;
$nav-tabs-active-link-hover-border-color:   $color-dark-3 !default;

$nav-tabs-justified-link-border-color:            $color-dark-3 !default;

//== Pagination
$pagination-bg:                        $color-dark-3 !default;
$pagination-border:                    $color-dark-3 !default;
$pagination-hover-border:              $color-dark-3 !default;
$pagination-active-color:              $color-dark-3 !default;
$pagination-disabled-bg:               $color-dark-3 !default;
$pagination-disabled-border:           $color-dark-3 !default;

//== Popovers
//** Popover body background color
$popover-bg:                          $color-dark-3 !default;
//** Popover border color
$popover-border-color:                $color-dark-3 !default;
//** Popover fallback border color
$popover-fallback-border-color:       $color-dark-4 !default;

//== Modals
//** Background color of modal content area
$modal-content-bg:                             $color-dark-3 !default;
//** Modal content border color
$modal-content-border-color:                   $color-dark-3 !default;
//** Modal content border color **for IE8**
$modal-content-fallback-border-color:          $color-dark-4 !default;

//** Modal backdrop background color
$modal-backdrop-bg:           #fff !default;
//** Modal header border color
$modal-header-border-color:   $color-dark-3 !default;

//== Progress bars
//** Background color of the whole progress component
$progress-bg:                 $color-dark-4 !default;

//== List group
//** Background color on `.list-group-item`
$list-group-bg:                 $color-dark-3 !default;
//** `.list-group-item` border color
$list-group-border:             $color-dark-3 !default;
//** Background color of single list items on hover
$list-group-hover-bg:           $color-dark-4 !default;
$list-group-link-color:         #bbb !default;
$list-group-link-heading-color: #ddd !default;

//== Panels
$panel-bg: $color-dark-3 !default;
$panel-default-border: $color-dark-3 !default;
$panel-default-heading-bg: $color-dark-4 !default;
//** Border color for elements within panels
$panel-inner-border:          $color-dark-3 !default;
$panel-footer-bg:             $color-dark-4 !default;
$panel-primary-text:          #777 !default;

//== Wells
$well-bg:                     $color-dark-3 !default;

//== Breadcrumbs
//** Breadcrumb background color
$breadcrumb-bg:                 $color-dark-4 !default;
//** Breadcrumb text color
$breadcrumb-color:              #fff !default;

//== Close
$close-color:                 #fff !default;
$close-text-shadow:           none !default;

//== Code
$code-bg:                     $color-dark-3 !default;
$kbd-color:                   #000 !default;
$kbd-bg:                      #ccc !default;

$pre-bg:                      $color-dark-3 !default;
$pre-border-color:            $color-dark-4 !default;


<?php else : ?>
//** Background color for `<body>`.
$body-bg: #fff !default;

//== Colors
//
//## Gray and brand colors for use across Bootstrap.

$gray-base:              #000 !default;
$gray-darker:            lighten($gray-base, 13.5%) !default; // #222
$gray-dark:              lighten($gray-base, 20%) !default;   // #333
$gray:                   lighten($gray-base, 33.5%) !default; // #555
$gray-light:             lighten($gray-base, 46.7%) !default; // #777
$gray-lighter:           lighten($gray-base, 93.5%) !default; // #eee

//== Components

//** Global color for active items (e.g., navs or dropdowns).
$component-active-color:    #fff !default;
//** Global background color for active items (e.g., navs or dropdowns).
$component-active-bg:       $brand-primary !default;

//== Tables
//** Background color used for `.table-striped`.
$table-bg-accent:               #f9f9f9 !default;
//** Background color used for `.table-hover`.
$table-bg-hover:                #f5f5f5 !default;
$table-bg-active:               $table-bg-hover !default;

//** Border color for table and cell borders.
$table-border-color:            #ddd !default;

//== Buttons
$btn-default-color:              #333 !default;
$btn-default-bg:                 #fff !default;
$btn-default-border:             #ccc !default;

//== Forms
//
//##

//** `<input>` background color
$input-bg:                       #fff !default;
//** `<input disabled>` background color
$input-bg-disabled:              $gray-lighter !default;

//** Text color for `<input>`s
$input-color:                    #777 !default;
//** `<input>` border color
$input-border:                   #ccc !default;

//** Border color for inputs on focus
$input-border-focus:             #66afe9 !default;

//** Placeholder text color
$input-color-placeholder:        #999 !default;

//== Dropdowns
//** Background for the dropdown menu.
$dropdown-bg:                    #fff !default;
//** Dropdown menu `border-color`.
$dropdown-border:                rgba(0,0,0,.15) !default;
//** Dropdown menu `border-color` **for IE8**.
$dropdown-fallback-border:       #ccc !default;
//** Divider color for between dropdown items.
$dropdown-divider-bg:            #e5e5e5 !default;

//** Dropdown link text color.
$dropdown-link-color:            $gray-dark !default;
//** Hover color for dropdown links.
$dropdown-link-hover-color:      darken($gray-dark, 5%) !default;
//** Hover background for dropdown links.
$dropdown-link-hover-bg:         #f5f5f5 !default;

//** Deprecated `$dropdown-caret-color` as of v3.1.0
$dropdown-caret-color:           #000 !default;

//== Tabs
$nav-tabs-border-color:                     #ddd !default;
$nav-tabs-active-link-hover-border-color:   #ddd !default;

$nav-tabs-justified-link-border-color:            #ddd !default;

//== Pagination
$pagination-bg:                        #fff !default;
$pagination-border:                    #ddd !default;
$pagination-hover-border:              #ddd !default;
$pagination-active-color:              #fff !default;
$pagination-disabled-bg:               #fff !default;
$pagination-disabled-border:           #ddd !default;

//== Popovers
//** Popover body background color
$popover-bg:                          #fff !default;
//** Popover border color
$popover-border-color:                rgba(0,0,0,.2) !default;
//** Popover fallback border color
$popover-fallback-border-color:       #ccc !default;

//== Modals
//** Background color of modal content area
$modal-content-bg:                             #fff !default;
//** Modal content border color
$modal-content-border-color:                   rgba(0,0,0,.2) !default;
//** Modal content border color **for IE8**
$modal-content-fallback-border-color:          #999 !default;

//** Modal backdrop background color
$modal-backdrop-bg:           #000 !default;
//** Modal header border color
$modal-header-border-color:   #e5e5e5 !default;

//== Progress bars
//** Background color of the whole progress component
$progress-bg:                 #f5f5f5 !default;

//== List group
//** Background color on `.list-group-item`
$list-group-bg:                 #fff !default;
//** `.list-group-item` border color
$list-group-border:             #ddd !default;
//** Background color of single list items on hover
$list-group-hover-bg:           #f5f5f5 !default;
$list-group-link-color:         #555 !default;
$list-group-link-heading-color: #333 !default;

//== Panels
$panel-bg: #fff !default;
$panel-default-border: #ddd !default;
$panel-default-heading-bg: #f5f5f5 !default;
//** Border color for elements within panels
$panel-inner-border:          #ddd !default;
$panel-footer-bg:             #f5f5f5 !default;
$panel-primary-text:          #fff !default;

//== Wells
$well-bg:                     #f5f5f5 !default;

//== Breadcrumbs
//** Breadcrumb background color
$breadcrumb-bg:                 #f5f5f5 !default;
//** Breadcrumb text color
$breadcrumb-color:              #ccc !default;

//== Close
$close-color:                 #000 !default;
$close-text-shadow:           0 1px 0 #fff !default;

//== Code
$code-bg:                     #f9f2f4 !default;
$kbd-color:                   #fff !default;
$kbd-bg:                      #333 !default;

$pre-bg:                      #f5f5f5 !default;
$pre-border-color:            #ccc !default;

<?php endif; ?>

// Border radius
<?php if ($b['border-radius']) : ?>
    $border-radius-base:  4px !default;
    $border-radius-large: 6px !default;
    $border-radius-small: 3px !default;
    $pager-border-radius: 15px !default;
    $badge-border-radius: 10px !default;
    $border-radius-normal: 5px;
    $border-radius-base  : 4px;
    $border-radius-thick:  7px;
    $border-radius-strong: 8px;
    $scroll-border-radius: 10px;
    $scroll-border-radius-large: 12px;
<?php else : ?>
    $border-radius-base:  0 !default;
    $border-radius-large: 0 !default;
    $border-radius-small: 0 !default;
    $pager-border-radius: 0 !default;
    $badge-border-radius: 0 !default;
    $border-radius-normal: 0;
    $border-radius-base:   0;
    $border-radius-thick:  0;
    $border-radius-strong: 0;
    $scroll-border-radius: 0;
    $scroll-border-radius-large: 0;
<?php endif; ?>

<?php if ($b['thumb-padding']) : ?>
    //** Padding around the thumbnail image
    $thumbnail-padding:      4px !default;
    //** Thumbnail border color
    $thumbnail-border:       <?php echo $dark ? '$color-dark-3' : '#ddd' ?> !default;
    $thumbnail-border-width: 1px;
    $thumbnail-slide-width:  99.5%;
<?php else : ?>
    //** Padding around the thumbnail image
    $thumbnail-padding:      0 !default;
    //** Thumbnail border color
    $thumbnail-border:       transparent !default;
    $thumbnail-border-width: 0;
    $thumbnail-slide-width:  100%;
<?php endif; ?>

