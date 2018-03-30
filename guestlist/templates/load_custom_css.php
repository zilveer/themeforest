<style>
/* this appears here because you can change these colors in the backend*/
    
a, a:visited, a:active {
    color: <?php echo $bSettings->get('title_color') ?>;
}
a:hover {
    color: <?php echo $bSettings->get('title_color') ?>;
}
.event_container .event_info {
	color: <?php echo $bSettings->get('title_color') ?>;
}
.event_container .event_info li a, .event_container .event_info li a:visited, .event_container .event_info li a:active {
    color: <?php echo $bSettings->get('title_color') ?>;
}
.event_container .event_info li a:hover {
    color: <?php echo $bSettings->get('title_color') ?>;
}
.post_container h1 {
	color: <?php echo $bSettings->get('title_color') ?>;
}
.post_container h2 {
	color: <?php echo $bSettings->get('title_color') ?>;
}
.contact_container h1 {
	color: <?php echo $bSettings->get('title_color') ?>;
}

.contact_container h2 {
	color: <?php echo $bSettings->get('title_color') ?>;
}
.upcoming_menu .date {
	color: <?php echo $bSettings->get('title_color') ?>;
}

<?php
    echo $bSettings->get('css');
?>
</style>


            
