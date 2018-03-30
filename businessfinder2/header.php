<!doctype html>
<!--[if IE 8]>
<html {languageAttributes}  class="lang-{$currentLang->locale} {$options->layout->custom->pageHtmlClass} ie ie8">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)]><!-->
<html {languageAttributes} class="lang-{$currentLang->locale} {$options->layout->custom->pageHtmlClass}">
<!--<![endif]-->
<head>
	<meta charset="{$wp->charset}">
	<meta name="viewport" content="width=device-width, target-densityDpi=device-dpi">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="{$wp->pingbackUrl}">

	{if $options->theme->general->favicon != ""}
		<link href="{$options->theme->general->favicon}" rel="icon" type="image/x-icon" />
	{/if}

	{includePart parts/seo}

	{googleAnalytics $options->theme->google->analyticsTrackingId}

	{wpHead}

	{!$options->theme->header->customJsCode}
</head>

{var $searchFormClass = ""}
{if $elements->unsortable[search-form]->display}
	{var $searchFormClass = $elements->unsortable[search-form]->option('type') != "" ? "search-form-type-".$elements->unsortable[search-form]->option('type') : "search-form-type-1"}
{/if}

<body n:class="$wp->bodyHtmlClass(false), defined('AIT_REVIEWS_ENABLED') ? reviews-enabled, $searchFormClass, $options->layout->general->showBreadcrumbs ? breadcrumbs-enabled">
	{* usefull for inline scripts like facebook social plugins scripts, etc... *}
	{doAction ait-html-body-begin}

	{if $wp->isPage}
	<div id="page" class="page-container header-one">
	{else}
	<div id="page" class="hfeed page-container header-one">
	{/if}


		<header id="masthead" class="site-header" role="banner">

			<div class="top-bar">
				<div class="grid-main">

					<div class="top-bar-tools">
					{includePart parts/social-icons}
					{includePart portal/parts/header-resources}
					{includePart parts/woocommerce-cart}
					{includePart parts/languages-switcher}
					</div>
					<p class="site-description">{!html_entity_decode($wp->description)}</p>

				</div>
			</div>
				<div class="header-container grid-main">

					<div class="site-logo">
						{if $options->theme->header->logo}
						<a href="{$homeUrl}" title="{$wp->name}" rel="home"><img src="{$options->theme->header->logo}" alt="logo"></a>
						{else}
						<div class="site-title"><a href="{$homeUrl}" title="{$wp->name}" rel="home">{$wp->name}</a></div>
						{/if}

					</div>

					<div class="menu-container">
						<nav class="main-nav menu-hidden" role="navigation" data-menucollapse={$options->theme->header->menucollapse}>

							<div class="main-nav-wrap">
								<h3 class="menu-toggle">{__ 'Menu'}</h3>
								{menu main}
							</div>
						</nav>

						<div class="menu-tools">
							{includePart portal/parts/user-panel}
						</div>
					</div>

				</div>


			</header><!-- #masthead -->

		<div class="sticky-menu menu-container" >
			<div class="grid-main">
				<div class="site-logo">
					{if $options->theme->header->logo}
					<a href="{$homeUrl}" title="{$wp->name}" rel="home"><img src="{$options->theme->header->logo}" alt="logo"></a>
					{else}
					<div class="site-title"><a href="{$homeUrl}" title="{$wp->name}" rel="home">{$wp->name}</a></div>
					{/if}
				</div>
				<nav class="main-nav menu-hidden">
					<!-- wp menu here -->
				</nav>
			</div>
		</div>
