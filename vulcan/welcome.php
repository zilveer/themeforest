            <?php 
            $welome_title = get_option('vulcan_welcome_title');
            $site_desc = get_option('vulcan_site_desc');
            ?>
            <h3><?php echo ($welome_title) ? stripslashes($welome_title) : "Let me introduce ourselves";?></h3>
            <p><?php echo ($site_desc) ? stripslashes($site_desc) : "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt laboredolore magna aliqua. Ut enim ad minim veniam, quisnos trud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in repre henderit in voluptate velitesse cillumdo lore fugiater.";?></p>
