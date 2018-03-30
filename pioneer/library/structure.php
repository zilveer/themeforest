<?php 

/**
 * On this page, the basic html markup for the site is built.
 * This is done to separate markup from the parent theme, to
 * give full flexibility for adding custom markup for the child themes
 *
 * Since framework ver 1.0.1
 */


/* Wrapper */
function epic_build_wrapper_alpha(){
	?>
	
	<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	document.write( '<div class="preloader"></div><div id="fader">' );
	//--><!]]>
	</script>
	<?php echo epic_page_background();?>
	<div id="wrapper" class=" clearfix">
		<div id="content">
			<div id="content-inner">
	<?php
}
add_action('epic_wrapper_alpha','epic_build_wrapper_alpha');

function epic_build_wrapper_omega(){ ?>
	
			</div>
		</div>
	</div>
	<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	document.write( '</div>' );
	//--><!]]>
	</script>
	
	<?php
}
add_action('epic_wrapper_omega','epic_build_wrapper_omega');



/* Header */
function epic_build_header_alpha(){
	?>
	<header id="header">
		<div id="header-inner">	
	<?php
}
add_action('epic_header_alpha','epic_build_header_alpha');

function epic_build_header_omega(){ ?>
		</div>
	</header>
	<?php
}
add_action('epic_header_omega','epic_build_header_omega');


/* Content */
function epic_build_content_alpha(){
	}
add_action('epic_content_alpha','epic_build_content_alpha');

function epic_build_content_omega(){
	}
add_action('epic_content_omega','epic_build_content_omega');



/* Footer */
function epic_build_footer_alpha(){
	$out =  '<footer class="clearfix"><div id="footer-inner">';
	echo $out;
}
add_action('epic_footer_alpha','epic_build_footer_alpha');

function epic_build_footer_omega(){
	echo  '</div></footer>';
	
}
add_action('epic_footer_omega','epic_build_footer_omega');


/* Article */

function epic_build_article_alpha(){
	echo "\n\t\t".'<div class="article-wrapper"><article ';
	echo post_class();
	echo '>';
	
}
add_action('epic_article_alpha','epic_build_article_alpha');

function epic_build_article_omega(){
	$out =  '</article></div>';
	echo $out;
}
add_action('epic_article_omega','epic_build_article_omega');

/* Blog */

function epic_build_blog_alpha(){
	echo "\n\t\t".'<div class="article-wrapper"><article ';
	echo post_class();
	echo '>';
	
}
add_action('epic_blog_alpha','epic_build_blog_alpha');

function epic_build_blog_omega(){
	$out =  '</article></div>';
	echo $out;
}
add_action('epic_blog_omega','epic_build_blog_omega');




/**
 *  Build the markup for the home page modules
 *
 */

/* Home page teaser */

function epic_build_teaser_alpha(){
	$out =  '<div class="container_16 module" id="epic_module_teaser_3"><div class="grid_16">';
	echo $out;
}
add_action('epic_teaser_alpha','epic_build_teaser_alpha');

function epic_build_teaser_omega(){
	$out =  '</div></div>';
	echo $out;
}
add_action('epic_teaser_omega','epic_build_teaser_omega');


/* Home page featured pages */

function epic_build_featured_alpha(){
	$out =  '<div class="container_16 module" id="epic_module_featuredpages"><div id="featured_inner">';
	echo $out;
}
add_action('epic_featured_alpha','epic_build_featured_alpha');

function epic_build_featured_omega(){
	$out =  '</div></div>';
	echo $out;
}
add_action('epic_featured_omega','epic_build_featured_omega');


/* Home page tab panel */

function epic_build_tabpanel_alpha(){
	$out =  '<div class="container_16 module" id="epic_module_tabs"><div class="grid_16">';
	echo $out;
}
add_action('epic_tabpanel_alpha','epic_build_tabpanel_alpha');

function epic_build_tabpanel_omega(){
	$out =  '</div></div>';
	echo $out;
}
add_action('epic_tabpanel_omega','epic_build_tabpanel_omega');


/* Home page portfolio module */

function epic_build_portfolio_alpha(){
	$out =  '<div class="container_16 module" id="epic_module_portfolio"><div class="inner_container_16">';
	echo $out;
}
add_action('epic_portfolio_alpha','epic_build_portfolio_alpha');

function epic_build_portfolio_omega(){
	$out =  '</div></div>';
	echo $out;
}
add_action('epic_portfolio_omega','epic_build_portfolio_omega');


/**
 * Sidebar markup
 */

/* Regular sidebar */

function epic_build_sidebar_alpha(){
	$out =  '<aside id="sidebar" class="sidebar">';
	echo $out;
}
add_action('epic_sidebar_alpha','epic_build_sidebar_alpha');

function epic_build_sidebar_omega(){
	$out =  '</aside>';
	echo $out;
}
add_action('epic_sidebar_omega','epic_build_sidebar_omega');



?>