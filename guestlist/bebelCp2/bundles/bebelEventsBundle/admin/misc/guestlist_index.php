<?php

/*
 * Manage all your guest lists in this file.
 * 
 * as we save our lists in a custom database, we first list only the lists we have (custom post type) and
 * then on the next page the stuff will be managable
 * 
 * オレ様
 * 
 */

// get the last events
    
$page = get_query_var('page');

$args = array(
    'post_type' => $this->settings->getPrefix().'_event', 
    'posts_per_page' => 10,
    'paged' => $page
);

$loop = new WP_Query( $args );
$i = 0;

?>

    
    
    <table class="wp-list-table widefat fixed posts" cellspacing="0">
        <thead>
            <tr>
                <th scope='col' id='title' class='manage-column column-title sortable desc'  style="padding-left: 20px;">
                    <span>Guest List</span>
                </th>
                <th scope='col' id='author' class='manage-column column-author sortable desc'  style="">
                    <span>Signed Up Users</span>
                </th>
                <th scope='col' id='date' class='manage-column column-author sortable asc'  style="width: 150px; height: 40px">
                    <span>Start Date - End Date</span>
                </th>	
            </tr>
        </thead>
    <?php 
    
    while ( $loop->have_posts()) : 
        $loop->the_post();
    
        $guestlist_details = bebelEventsUtils::getGuestlistDetailsByEventId(get_the_ID());
        
        $startdate  = strtotime(BebelUtils::getCustomMeta('event_registration_start', '', get_the_ID()));
        $enddate    = strtotime(BebelUtils::getCustomMeta('event_registration_end', '', get_the_ID()));
        $slots      = BebelUtils::getCustomMeta('event_slot_count', '', get_the_ID());

        
    ?>
    
	<tbody id="the-list">
        <tr id="post-4" class="post-4 bg_event type-bg_event status-publish hentry alternate iedit author-self" valign="top">
            <td class="post-title page-title column-title">
                <strong><a class="row-title" href="admin.php?page=bebelEventsGuestlist&amp;do=showguestlist&amp;id=<?php the_ID() ?>" title="View details from &#8220;<?php the_title() ?>&#8221;"><?php the_title() ?></a></strong>
                <div class="row-actions">
                    <span class='edit'><a href="admin.php?page=bebelEventsGuestlist&amp;do=showguestlist&amp;id=<?php the_ID() ?>" title="View Guest List">View List Details</a> | </span>
                    <span class='edit'><a href="post.php?post=<?php the_ID() ?>&amp;action=edit" title="Edit this event">Edit Event</a> | </span>
                    <span class='view'><a href="<?php bloginfo('stylesheet_directory') ?>/bebelCp2/bundles/bebelEventsBundle/admin/misc/printlist.php?id=<?php the_ID() ?>" title="View &#8220;<?php the_title() ?>&#8221;" target="_blank">Print list</a> | </span>
                    <span class='view'><a href="<?php echo get_permalink(); ?>" title="View &#8220;<?php the_title() ?>&#8221;" rel="permalink">View on Frontend</a></span></div>
            </td>
            <td class="author column-author"><?php echo count($guestlist_details) ?> / <?php echo ($slots == 0 || $slots == '') ? 'unlimited' : $slots; ?></td>

			<td class="date column-date"><?php echo date("F jS Y, H:i", $startdate) ?> - <?php echo date("F jS Y, H:i", $enddate) ?></td>		
        </tr>
	</tbody>

    
    <?php

    endwhile;

    ?>
    </table>

