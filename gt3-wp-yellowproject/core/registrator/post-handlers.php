<?php

#Handler for feedbacks
if (isset($_POST['sendthisfeedback'])) {
    sendFeedback(filter_var(esc_attr($_POST['senderemail']), FILTER_SANITIZE_EMAIL), esc_attr($_POST['sendermessage']), esc_attr($_POST['sendername']), esc_attr($_POST['feedback_url']));
}

?>