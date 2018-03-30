<?php

$id = esc_attr($_GET['id']);



$args = array(
    'post_type' => $this->settings->getPrefix().'_event', 
    'p' => $id,
);

$guestlist = new WP_Query( $args );


if(!$guestlist->have_posts())
{
    echo "this event does not exist.";
}else {


$guestlist->the_post();



$startdate  = strtotime(BebelUtils::getCustomMeta('event_registration_start', '', get_the_ID()));
$enddate    = strtotime(BebelUtils::getCustomMeta('event_registration_end', '', get_the_ID()));

$eventdate  = strtotime(BebelUtils::getCustomMeta('event_date', '', get_the_ID()));

?>

<h2>
    <a href="admin.php?page=bebelEventsGuestlist"><?php echo __('Overview', $this->settings->getPrefix()) ?></a> 
    &raquo; 
    <?php echo __('Manage Guestlist', $this->settings->getPrefix()) ?> &#8220;<?php the_title() ?>&#8221; 
    (<a href="http://localhost/guestlist/wp-admin/post.php?post=<?php the_ID() ?>&amp;action=edit" title="Edit this event"><?php echo __('edit', $this->settings->getPrefix()) ?></a>)</h2>

<h3><?php echo __('Event Text Excerpt', $this->settings->getPrefix()) ?></h3>

<?php the_excerpt(); ?>

<h3><?php echo __('Event Details', $this->settings->getPrefix()) ?></h3>

<b><?php echo __('Registration Start', $this->settings->getPrefix()) ?></b> <?php echo date("F jS Y, H:i", $startdate) ?><br />
<b><?php echo __('Registration End', $this->settings->getPrefix()) ?></b> <?php echo date("F jS Y, H:i", $enddate) ?><br />
<b><?php echo __('Event Date', $this->settings->getPrefix()) ?></b> <?php echo date("F jS Y, H:i", $eventdate) ?><br />

<a href="<?php bloginfo('stylesheet_directory') ?>/bebelCp2/bundles/bebelEventsBundle/admin/misc/printlist.php?id=<?php the_ID() ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory') ?>/images/event/print.png" style="float:right;"></a>

<h3><?php echo __('The Guest List', $this->settings->getPrefix()) ?></h3>



<table class="wp-list-table widefat fixed posts" cellspacing="0">
    <thead>
        <tr>
            <th scope='col' id='title' class='manage-column column-author sortable desc'  style="padding-left: 20px;">
                <span><?php echo __('Last Name', $this->settings->getPrefix()) ?></span>
            </th>
            <th scope='col' id='author' class='manage-column column-title sortable desc'  style="">
                <span><?php echo __('First Name', $this->settings->getPrefix()) ?></span>
            </th>
            <th scope='col' id='author' class='manage-column column-title sortable desc'  style="">
                <span><?php echo __('Access Code', $this->settings->getPrefix()) ?></span>
            </th>
            <th scope='col' id='date' class='manage-column column-author sortable asc'  style="width: 150px; height: 40px">
                <span><?php echo __('Delete', $this->settings->getPrefix()) ?></span>
            </th>	
        </tr>
    </thead>
    
    <?php 
    
    $guestlist_users = bebelEventsUtils::getGuestlistDetailsByEventId(get_the_ID());
    
    if(count($guestlist_users) == 0):
    ?>    
    <tbody id="the-list">
        <tr id="post-4" class="post-4 bg_event type-bg_event status-publish hentry alternate iedit author-self" valign="top">
            <td class="post-title page-title column-title" colspan="3">
                <?php echo __('Nobody signed up yet', $this->settings->getPrefix()) ?>
            </td>		
        </tr>
	</tbody>    
    <?php    
    endif;
    
    foreach($guestlist_users as $user):
        
    ?>
    <tbody id="the-list">
        <tr id="post-4" class="post-4 bg_event type-bg_event status-publish hentry alternate iedit author-self" valign="top">
            <td class="post-title page-title column-title">
                <strong><?php echo $user->last_name ?></strong>
            </td>
            <td class="author column-author">
                <strong><?php echo $user->first_name ?></strong>
            </td>
            <td class="author column-author">
                <strong><?php echo $user->access_code ?></strong>
            </td>

			<td class="date column-date"><a class="delete" href="admin.php?page=bebelEventsGuestlist&do=deleteFromList&id=<?php the_ID(); ?>&user_id=<?php echo $user->id ?>"><?php echo __('Delete', $this->settings->getPrefix()) ?></a></td>		
        </tr>
	</tbody>
    <?php
    endforeach;
}
    ?>