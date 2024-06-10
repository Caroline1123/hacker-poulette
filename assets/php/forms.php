<?php
if (isset($_POST['first-name']) && (isset($_POST['last-name'])) && (isset($_POST['email'])) && (isset($_POST['country'])) && (isset($_POST['subject'])) && (isset($_POST['message']))) {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    echo "<h1> $first_name </h1>";
}
echo "<h1> Test ?</h1>";

?>