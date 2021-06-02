<?php include('chat_connection.php');

session_start();

echo count_unseen_message($_SESSION['user_id'], $connect);

?>