<?php 
/*
Template Name: Home
*/

	get_header();

	if ( opt('vertical_template') == 1 ) {
        ?>
        <div class="home-vertical">
    <?php }
    // Menu
     if ( opt('vertical_template') == 0 ) { get_template_part('article', 'menu');  }
     if ( opt('vertical_template') == 1 ) { get_template_part('article', 'vmenu'); }

    get_template_part('article', 'intro');

$locations = get_nav_menu_locations();
$sections = array(
    '0'=>'portfolio',
    '1'=>'home',
    '2'=>'resume',
    '3'=>'contact',
    '4'=>'page',
    '5'=>'post',
    '6'=>'custom',);
if (isset($locations['primary-nav'])) {
    $menu_id = $locations['primary-nav'];
    $menu_items = wp_get_nav_menu_items( $menu_id, array() );

    
	
    
    if( !empty( $menu_items ) ) {
        $used_sections=array();
         foreach( $menu_items as $menu_item ) { 
           $url=$menu_item->url;
		  
		
		   if($menu_item->classes[0]=="custompart"){
              $id=explode("#",$url);
			  if(is_array($id)){
				array_push($used_sections,array("customPart",end($id)));  
				}
			}
			
		   $part=explode("#",$url);
		   switch(end($part)){
			   case "home":
			   array_push($used_sections,array("1",$menu_item->object_id));
			   break;
			   case "portfolio":
			   array_push($used_sections,array("0",$menu_item->object_id));
			   break;
			   case "resume":
			   array_push($used_sections,array("2",$menu_item->object_id));
			   break;
			   case "contact":
			   array_push($used_sections,array("3",$menu_item->object_id));
			   break;
		   }
		   
           
    
             
        }
    }

    foreach($used_sections as $section){
        
        switch ($section[0]) {
            case '1':
                get_template_part('article', 'about');
                break;
            case '0':
                get_template_part('article', 'portfolio');
                break;
            case '3':
                get_template_part('article', 'contact');
                break;
            case '2':
                get_template_part('article', 'resume');
                break;
            case 'customPart':
                if($post = get_post($section[1])){
                    $color = get_post_meta($post->ID,'custom_part_color',true);
                    $padding = get_post_meta($post->ID,"custom_part_paddig",true);
                    $label = get_post_meta($post->ID,"custom_part_title_show",true);
                }
                customPart($section[1],$color,$padding,$label);

                break;
        } // end switch
    } // end foreach of used sections
} // end if primary nav is exist




			
		get_template_part('article', 'out'); 
		
	get_footer();

if ( opt('vertical_template') == 1 ) { ?></div><?php }




//Custom Part Function
function customPart($postName,$color='#FFF',$padding='0',$label='0'){
    $post = get_post($postName)
    ?>
    <!-- Coustom part -->
    <article class="cvpage custom_part <?php if ( opt('vertical_template') == 0 ) { ?> wrap <?php } ?>" id="<?php echo $postName ?>" style="background-color:<?php echo $color ?>">

        <?php if ( $padding == 0) { ?>
        <div class="content">
            <?php } else if ( $padding == 1 ) { ?>
            <div class="padding-content">
                <?php } ?>

                <div class="custom-part-scroll">
                    <?php if ( $label == 1) { ?>
                    <div class="page-title">
                        <h2><?php echo $post->post_title; ?></h2>
                    </div>
                    <?php
                    }
                    if($post){
                    ?>
                    <div class="custom-part-content">
                    <?php
                    echo do_shortcode($post->post_content);
                    }
                    ?>
                    </div>


                </div>
            </div>
    </article>
    <!-- Coustom part End -->

<?php
}