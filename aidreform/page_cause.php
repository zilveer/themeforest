<?php

global $cs_node,$post,$cs_theme_option,$cs_counter_node,$wpdb;

$cs_xmlObject_transaction = new stdclass();
$cause_status = '';
	  $meta_compare = '';
	  
        if ( $cs_node->cause_type == "Upcoming Causes" ) $meta_compare = ">=";

        else if ( $cs_node->cause_type == "Past Causes" ) $meta_compare = "<";
		
if($cs_node->cs_cause_excerpt == ''){ $cs_node->cs_cause_excerpt = 100;}

if ( !isset($cs_node->cause_per_page) || empty($cs_node->cause_per_page)) { $cs_node->cause_per_page = -1; }

	$filter_cause = '';

	$row_cat = $wpdb->get_row("SELECT * from ".$wpdb->prefix."terms WHERE slug = '" . $cs_node->cause_cat ."'" );

	if ( isset($_GET['filter-cause']) ) {$filter_cause = $_GET['filter-cause'];}

	else {

		if(isset($row_cat->slug)){

			$filter_cause = $row_cat->slug;

		}

	}

	if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;

		 if( isset($cs_node->cause_type) && $cs_node->cause_type == "Upcoming Causes" ){
			
			$args = array(

                    'posts_per_page'			=> "-1",

                    'post_type'					=> 'cs_cause',

                  //  'event-category'			=> "$filter_cause",

                    'post_status'				=> 'publish',

                    'meta_key'					=> 'cause_end_date',

                    'meta_value'				=> date('m/d/Y'),

                    'meta_compare'				=> $meta_compare,

                    'orderby'					=> 'meta_value',

                    'order'						=> 'ASC',

                );
			
			 
			 
		} else if( isset($cs_node->cause_type) && $cs_node->cause_type == "Past Causes" ){
			
			$args = array(

                    'posts_per_page'			=> "-1",

                    'post_type'					=> 'cs_cause',

                  //  'event-category'			=> "$filter_cause",

                    'post_status'				=> 'publish',

                    'meta_key'					=> 'cause_end_date',

                    'meta_value'				=> date('m/d/Y'),

                    'meta_compare'				=> $meta_compare,

                    'orderby'					=> 'meta_value',

                    'order'						=> 'ASC',

                );
			 
			 
		 } else {
			 
			 $args = array(

				'posts_per_page'			=> "-1",
		
				'post_type'					=> 'cs_cause',
		
				'post_status'				=> 'publish',
		
				'order'						=> 'ASC',
		
			);
			 
		 }

	

	if(isset($cs_node->menu_cat) && $cs_node->menu_cat <> '' && $cs_node->menu_cat <> '0'){

		$menu_category_array = array('cs_cause-category' => "$filter_cause");

		$args = array_merge($args, $menu_category_array);

	}

	$custom_query = new WP_Query($args);

	$post_count = 0;

	$post_count = $custom_query->post_count;



?>

<div class="element_size_<?php echo $cs_node->cause_element_size; ?>">

    <header class="cs-heading-title">

    	<?php if ($cs_node->cause_title <> '') { ?>

            <h2 class="cs-section-title float-left"><?php echo $cs_node->cause_title;?></h2>

         <?php }?>

          <?php	if ($cs_node->cs_cause_link_url <> '' && $cs_node->cs_cause_link_title <> '') { ?>

                 <a href="<?php echo $cs_node->cs_cause_link_url;?>" class="btnshowmore float-right"> <em class="fa fa-th-large"></em>

                    <?php echo $cs_node->cs_cause_link_title;?>

                </a>

        <?php  } ?>

         <?php if($cs_node->cause_filterable == "On"){

			$qrystr= "";

			if ( isset($_GET['page_id']) ) $qrystr = "&page_id=".$_GET['page_id'];

		?>  

        <!-- Sortby Start -->

        <div id="filter-list">

            <ul id="filters">

               <?php if($cs_node->cause_cat <> ''){?> <li class="<?php if(($cs_node->cause_cat==$filter_cause) || empty($cs_node->cause_cat)){echo 'bgcolr';}?>"><a href="?<?php echo $qrystr."&filter-cause=".$row_cat->slug?>"><?php _e("All",'AidReform');?></a></li><?php }?>

                 <?php

                    if( $cs_node->cause_cat <> ""){

                    $categories = get_categories( array('child_of' => "$row_cat->term_id", 'taxonomy' => 'cs_cause-category', 'hide_empty' => 0) );

                    }else{

                    $categories = get_categories( array('taxonomy' => 'cs_cause-category', 'hide_empty' => 0) );

                    }

                    foreach ($categories as $category) {

                    ?>

               			<li <?php if($category->slug==$filter_cause){echo 'class="bgcolr"';}?>><a href="?<?php echo $qrystr."&filter-cause=".$category->slug?>"><?php echo $category->cat_name?></a></li>

               <?php }?>

            </ul>

        </div>

        <!-- Sortby End -->

        <?php }?>

    </header>

    <div class="our_causes fullwidth">

    <?php 

		 if( isset($cs_node->cause_type) && $cs_node->cause_type == "Upcoming Causes" ){
			
			$args = array(

                    'posts_per_page'			=> "$cs_node->cause_per_page",

                    'post_type'					=> 'cs_cause',

                  //  'event-category'			=> "$filter_cause",

                    'post_status'				=> 'publish',

                    'meta_key'					=> 'cause_end_date',

                    'meta_value'				=> date('m/d/Y'),

                    'meta_compare'				=> $meta_compare,

                    'orderby'					=> 'meta_value',

                    'order'						=> 'ASC',

                );
			
			 
			 
		} else if(isset($cs_node->cause_type) && $cs_node->cause_type == "Past Causes" ){
			
			$args = array(

                    'posts_per_page'			=> "$cs_node->cause_per_page",

                    'post_type'					=> 'cs_cause',

                  //  'event-category'			=> "$filter_cause",

                    'post_status'				=> 'publish',

                    'meta_key'					=> 'cause_end_date',

                    'meta_value'				=> date('m/d/Y'),

                    'meta_compare'				=> $meta_compare,

                    'orderby'					=> 'meta_value',

                    'order'						=> 'ASC',

                );
			 
			 
		 } else {
			 
			  $args = array(
	
					'posts_per_page'		=> "$cs_node->cause_per_page",
	
					'paged'					=> $_GET['page_id_all'],
	
					'post_type'				=> 'cs_cause',
	
					'post_status'			=> 'publish',
	
					'order'					=> 'ASC',
	
				);
			 
		 }

            if(isset($filter_cause) && $filter_cause <> '' && $filter_cause <> '0'){

                $menu_category_array = array('cs_cause-category' => "$filter_cause");

                $args = array_merge($args, $menu_category_array);

            }
			
            $custom_query = new WP_Query($args);

	        while ( $custom_query->have_posts() ): $custom_query->the_post(); 

            $post_xml = get_post_meta($post->ID, "cs_cause_meta", true);

            if($post_xml <> ''){

                $cs_xmlObject = new SimpleXMLElement($post_xml);

            }

			$payment_gross = 0;

			$percentage_amount = 0;

			$cs_tr = get_post_meta($post->ID, "cs_cause_transaction_meta", true);

			if($cs_tr <> ''){

                $cs_xmlObject_transaction = new SimpleXMLElement($cs_tr);

				if(count($cs_xmlObject_transaction->transaction)>0){

				foreach ( $cs_xmlObject_transaction->transaction as $transct ){

						$payment_gross = $payment_gross+$transct->payment_gross;

				}

				if($payment_gross<>'0' && $cs_xmlObject->cause_goal_amount <> '0'){

					$percentage_amount = (($payment_gross/$cs_xmlObject->cause_goal_amount)*100);
					

					if($percentage_amount>100){

						$percentage_amount = 100;
						
						$cause_status = 'Closed';

					}

				}

			 }

            }

            $image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID), 262, 262);

			$no_image = '';

            if($image_url == ""){

                    $no_image = 'no-img';

            }

        ?>

        <article <?php post_class($no_image); ?>>

            <figure>

            <?php if($image_url <> ""){?><img src="<?php echo $image_url;?>" alt=""><?php }?>

                <figcaption>

                    <div class="text">

                        <h2 class="cs-post-title">

                            <a href="<?php the_permalink();?>" class="colrhvr"><?php echo substr(get_the_title(), 0, 43); if(strlen(get_the_title())>43) echo '...'; ?></a>

                        </h2>

                       <!-- <div class="progress-bar-charity" data-loadbar="< ?php echo round($percentage_amount);?>" data-loadbar-text="< ?php echo round($percentage_amount);?>%">
                          <div class="bgcolr" style="padding: 0px 0px 0px < ?php echo round($percentage_amount);?>%;">
                                <span></span>
                            </div>
                        </div>-->
                            <div class="progress-bar-charity" data-loadbar="<?php echo round($percentage_amount);?>" data-loadbar-text="<?php echo round($percentage_amount);?>%">
                            <?php //echo $percentage_amount; ?>
								<?php
                                    if(count($cs_xmlObject_transaction->transaction)=='0'|| ($payment_gross=='0'))
                                        {
                                        echo'<div class="bgcolr" style="padding: 0px 0px 0px 0%;">
                                        <span></span>
                                         </div>';
                                        }else{
                                ?>		
                                <div class="bgcolr" style="padding: 0px 0px 0px <?php echo round($percentage_amount);?>%;">
                                    <span></span>
                                </div>
                                <?php }?>
                            </div>
							 <div class="progress-desc fullwidth">

                            <span class="progress-box"> <strong><?php if(isset($cs_theme_option['paypal_currency_sign'])){ echo $cs_theme_option['paypal_currency_sign']; }?><?php echo number_format($payment_gross);?></strong>

                                <?php if(isset($cs_theme_option['trans_switcher'])){ if($cs_theme_option['trans_switcher'] == "on"){ _e('Raised','AidReform');}}else { if(isset($cs_theme_option['cause_raised'])){ echo $cs_theme_option['cause_raised']; }}?>

                            </span>

                            <span class="progress-box"><strong><?php echo count($cs_xmlObject_transaction->transaction);?></strong>

                                <?php if(isset($cs_theme_option['trans_switcher'])){if($cs_theme_option['trans_switcher'] == "on"){ _e('Donors','AidReform');}}else{ if(isset($cs_theme_option['cause_donors'])){ echo $cs_theme_option['cause_donors']; }}?>

                            </span>

                            <span class="progress-box">

                                <strong><?php if(isset($cs_theme_option['paypal_currency_sign'])){ echo $cs_theme_option['paypal_currency_sign']; }?><?php echo number_format((float)$cs_xmlObject->cause_goal_amount);?></strong>

                                <?php if(isset($cs_theme_option['trans_switcher'])){if($cs_theme_option['trans_switcher'] == "on"){ $trans_featured = _e('Goal','AidReform');}}else{ if(isset($cs_theme_option['trans_switcher'])){ echo $cs_theme_option['cause_goal']; }}?>

                            </span>

                        </div>

                        <div class="desc fullwidth">

                            <p><?php  cs_get_the_excerpt($cs_node->cs_cause_excerpt,false);?></p>

                            <?php 

                                $before_cat = '<div class="post-category-list"><em class="fa fa-list"></em>';

                                $categories_list = get_the_term_list ( get_the_id(), 'cs_cause-category', $before_cat, ', ', '</div>' );

                                if ( $categories_list ){ printf( __( '%1$s', 'AidReform' ),$categories_list ); }

                            ?>

                            <a class="btnshare-post addthis_button_compact"><em class="fa fa-share-square-o"></em></a>

                        </div>

                    </div>

                </figcaption>

            </figure>

        </article>

      <?php endwhile;?>

    </div>

	 <?php 

         $qrystr = '';

         if ( $cs_node->cause_pagination == "Show Pagination" and $post_count > $cs_node->cause_per_page and $cs_node->cause_per_page > 0 and $cs_node->cause_filterable != "On" ) {

            echo "<nav class='pagination'><ul>";

                if ( isset($_GET['page_id']) ) $qrystr = "&page_id=".$_GET['page_id'];

                    echo cs_pagination($post_count, $cs_node->cause_per_page,$qrystr);

            echo "</ul></nav>";

        }

    ?>

</div>