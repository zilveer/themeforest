<?php 
/*
	Generate pagination.
	Input : 
		- int $num_pages_per_phrase : the number of page per group.
	No output.
*/
function ew_get_pagenum_link($pagenum = 1, $escape = true ) {
    global $wp_rewrite;

    $pagenum = (int) $pagenum;

    $request = esc_url( remove_query_arg( 'paged' ) );

    $home_root = parse_url(home_url());
    $home_root = ( isset($home_root['path']) ) ? $home_root['path'] : '';
    $home_root = preg_quote( trailingslashit( $home_root ), '|' );

    $request = preg_replace('|^'. $home_root . '|', '', $request);
    $request = preg_replace('|^/+|', '', $request);

    if ( !$wp_rewrite->using_permalinks() || is_admin() ) {
        $base = trailingslashit( home_url() );

        if ( $pagenum > 1 ) {
            //$result = add_query_arg( 'paged', $pagenum, $base . $request );
			$result = $base . $request;
        } else {
            $result = $base . $request;
        }
    } else {
        $qs_regex = '|\?.*?$|';
        preg_match( $qs_regex, $request, $qs_match );

        if ( !empty( $qs_match[0] ) ) {
            $query_string = $qs_match[0];
            $request = preg_replace( $qs_regex, '', $request );
        } else {
            $query_string = '';
        }

        $request = preg_replace( "|$wp_rewrite->pagination_base/\d+/?$|", '', $request);
        $request = preg_replace( '|^index\.php|', '', $request);
        $request = ltrim($request, '/');

        $base = trailingslashit( home_url() );

        if ( $wp_rewrite->using_index_permalinks() && ( $pagenum > 1 || '' != $request ) )
            $base .= 'index.php/';

        if ( $pagenum > 1 ) {
            $request = ( ( !empty( $request ) ) ? trailingslashit( $request ) : $request ) . user_trailingslashit( $wp_rewrite->pagination_base . "/" . $pagenum, 'paged' );
        }

        $result = $base . $request . $query_string;
    }

    $result = apply_filters('get_pagenum_link', $result);

    if ( $escape )
        return esc_url( $result );
    else
        return esc_url_raw( $result );
}


if(!function_exists ('ew_pagination')){
	function ew_pagination($num_pages_per_phrase = 3){
			if(function_exists ('wp_pagenavi')){
				wp_pagenavi() ;			
				return;
			}
			global $wp_query;

			if( !isset($_GET['page']) ){
				$_GET['page'] = 1;
			}
			
			if($wp_query->found_posts > 0) : 
			$pageLink = ew_get_pagenum_link($_GET['page']);
			$pageLink = str_replace(array('page='.$_GET['page'],'page/'.$_GET['page']),'',$pageLink);
			if(strpos($pageLink,'?') === false)
				$pageLink .= '?';
			elseif(strpos($pageLink,'?') >= 0 && strpos($pageLink,'&') === false)
				$pageLink .= '&';
				
			//best case
			if( isset($_GET['page']) || isset($_GET['paged']) ){
				$paged = isset($_GET['paged']) ? $_GET['paged'] : $_GET['page'];
			}else{
				if(!is_paged()){
					$paged = 1;
				}else{
					$paged = get_query_var('paged');
				}
			}
			if( get_query_var('paged') ){
				$paged = get_query_var('paged');
			}


			
			$term = get_query_var('term');
			$tax = get_query_var('taxonomy');
			$max_page = min(array($wp_query->max_num_pages,$num_pages_per_phrase));
			$phrase = ceil($paged/$max_page);
			$start_page = $max_page*($phrase-1) + 1;

			?>
			<span class='curent-total'><span><span>Page <?php echo $paged ; ?> of <?php echo $wp_query->max_num_pages ; ?></span></span></span>
			<?php
			if($paged > 1){?>
			<a class="first" href="<?php echo $pageLink;?><?php echo 'paged=1'; //first link ?>"><span><span><?php _e('First','wpdance')?></span></span></a>
			<a class="previous" href="<?php echo $pageLink;?><?php echo 'paged=' . ($paged - 1); //next link ?>"><span><span><?php _e('Previous','wpdance')?></span></span></a>
			<?php }
			if($phrase > 1){?>
					<a class="previous-phrase" href="<?php echo $pageLink;?><?php echo 'paged=' . ($max_page*($phrase-2) + 1); //prev prase link ?>">...</a>
			<?php } ?>
			<?php
			for($i=0;$start_page+$i<=min(array($wp_query->max_num_pages,$start_page+$max_page-1));$i++){?>
					<?php if($paged==$start_page+$i):?>
					<span class="pager current<?php if($i == 0) echo ' first-pager';if($start_page+$i == min(array($wp_query->max_num_pages,$start_page+$max_page-1))) echo ' last-pager';?>"><span><span><?php echo $start_page+$i;?></span></span></span>
					<?php else:?>
					<a class="pager<?php if($i == 0) echo ' first-pager';if($start_page+$i == min(array($wp_query->max_num_pages,$start_page+$max_page-1))) echo ' last-pager';?>" href="<?php echo $pageLink;?><?php echo 'paged=' . ($start_page + $i); ?>"><span><span><?php echo $start_page+$i;?></span></span></a>
					<?php endif; ?>
					<?php
			}
			if($phrase < ceil($wp_query->max_num_pages/$max_page)){?>
					<a class="next-phrase" href="<?php echo $pageLink;?><?php echo 'paged=' . ($max_page*$phrase + 1); //next phrase link ?>">...</a>
			<?php } ?>
			<?php if($paged < $wp_query->max_num_pages){?>
					<a class="next" href="<?php echo $pageLink;?><?php echo 'paged=' . ($paged + 1); //next link ?>"><span><span><?php _e('Next','wpdance')?></span></span></a>
					<a class="last" href="<?php echo $pageLink;?><?php echo 'paged=' . $wp_query->max_num_pages; //next link ?>"><span><span><?php _e('Last','wpdance')?></span></span></a>
			<?php }?>
		
			<?php
			endif;
			
	}
}	
?>