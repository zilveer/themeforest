<?php
# 
# rt-theme search 
# 

get_header();
$category = get_category_by_slug(get_query_var("category_name"));  
	
	//call sub page header
	get_template_part( 'sub_page_header', 'sub_page_header_file' ); 

	//call the sub content holder 1st part
	sub_page_layout("subheader","");
?>
	<div class="box one box-shadow">
		
		<!-- page title -->
		<div class="head_text nomargin">
			<div class="arrow"></div><!-- arrow -->
			<h2><?php printf( __( 'Search Results for: %s', 'rt_theme' ), '<span>' . get_search_query() . '</span>' );?></h2>
		</div>
		<!-- /page title -->
	</div>

	<div class="space margin-b20"></div>

<?php  
	
	//call the posts 
	get_template_part( 'list_loop', 'search' );
	
	//call the sub content holder 2nd part
	sub_page_layout("subfooter",""); 
?>

	<div class="space margin-b20"></div>
	
<?php
get_footer(); 
?>