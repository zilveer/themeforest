<?php

define('WP_USE_THEMES', false);
include_once '../../../../../../../../wp-load.php';
include_once TEMPLATEPATH.'/functions.php';


$id = esc_attr($_GET['id']);



$args = array(
    'post_type' => $bSettings->getPrefix().'_event', 
    'p' => $id,
);

$guestlist = new WP_Query( $args );


if(!$guestlist->have_posts())
{
    die("this event does not exist.");
}

if (current_user_can('manage_options')) 
{
    $guestlist->the_post();
    $guestlist_users = bebelEventsUtils::getGuestlistDetailsByEventId($id);
    
        if(count($guestlist_users) == 0):
    ?>    
    
                <?php die(__('Nobody signed up yet', $bSettings->getPrefix())); ?>
    
    <?php    
    endif;
    $eventdate  = strtotime(BebelUtils::getCustomMeta('event_date', '', get_the_ID()));
    ?>
    <h1><?php the_title() ?></h1>
    <p style="font-variant: italic;"><?php __('Event on:', $bSettings->getPrefix()) ?> <?php echo date("F jS Y, H:i", $eventdate) ?></p>
    <?php
    foreach($guestlist_users as $user):
        
    ?>
    <table>
    <tbody id="the-list" style="width: 700px;">
        <tr id="post-4" class="post-4 bg_event type-bg_event status-publish hentry alternate iedit author-self" valign="top">
            <td class="post-title page-title column-title" style="width: 120px;border-bottom: 1px solid #999; height: 30px;">
                <strong><?php echo $user->last_name ?></strong>
            </td>
            <td class="author column-author" style="width: 200px;border-bottom: 1px solid #999;">
                <strong><?php echo $user->first_name ?></strong>
            </td>
            <td class="author column-author" style="width: 120px;border-bottom: 1px solid #999;">
                <strong><?php echo $user->access_code ?></strong>
            </td>
            <td class="author column-author" style="border: 1px solid #999; width: 15px; height: 15px; display: block;">
                
            </td>

			
        </tr>
	</tbody>
    </table>
    <?php
    endforeach;
}else {
    echo "go away.";
}

