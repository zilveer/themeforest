<?php

$i = get_the_title();

// add search form?
$search =
  is_home() ||
  is_singular( 'post' ) ||
  is_page_template('template-journal.php') ||
  is_search();

if ( is_singular( 'post' ) && !a_media_content_is_empty() )
  $search = false;

// pre
if (is_singular('post')) $i = __('Entry', A_DOMAIN) . " &gt; {$i}";
if (is_singular('item')) $i = __('Project', A_DOMAIN) . " &gt; {$i}";

// homepage
if (is_home()) $i = get_bloginfo( 'description' );

// 404
if (is_404()) $i = __('Error 404 - Not Found', A_DOMAIN);

// searches
$criteria = '';
if ( is_category() ) $criteria = single_cat_title('', false);
else if ( is_tag() ) $criteria = single_tag_title('', false);
else if ( is_year() ) $criteria = get_the_time('Y');
else if ( is_month() ) $criteria = get_the_time('F, Y');
else if ( is_day() ) $criteria = get_the_time('F jS, Y');
else if ( is_author() ) $criteria = __('Author', A_DOMAIN);

if ( is_search() ) $criteria = trim(get_search_query());
if ( is_tax() ) { $o = get_queried_object(); $criteria = $o->name; }

if ($criteria) $i = sprintf(__('Entries for %s', A_DOMAIN), $criteria);

// customs
if ( is_tax() ) {
  $o = get_queried_object(); 
  $i = $o->name;
  if ($o->description) $i = $o->description;
}

// meta
if ($sub = Acorn::getm('subheading')) $i = $sub;

?>

<div class="clear fat"></div>
<p class="info"><?php echo $i ?></p>

<?php if ($search) get_template_part( 'searchform' ) ?>