<?php
/**
 * The Standard post header base for MPC Themes
 *
 * Displays the thumbnail for posts in the Standard post format.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */

$chat = get_field('mpc_chat');
$odd = 1;

if (! empty($chat)) {
	foreach ($chat as $item) {
		echo '<div class="mpcth-chat-message' . ($odd % 2 == 0 ? ' mpcth-chat-message-odd' : '') . '">';
			echo '<p class="mpcth-chat-message-text' . ($odd % 2 == 0 ? ' mpcth-color-main-background' : '') . '">' . $item['mpc_chat_message'] . '</p>';
			echo '<p class="mpcth-chat-name">' . $item['mpc_chat_name'] . '</p>';
		echo '</div>';
		$odd++;
	}
}