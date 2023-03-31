<?php
// Check if the 'code' parameter is present in the URL
if (isset($_GET['code'])) {
    // Display a confirmation message and any further instructions
    echo "<h1>Bot Authorized Successfully</h1>";
    echo "<p>Your bot has been successfully authorized and added to your server. You can now close this page.</p>";
} else {
    // Display an error message if the 'code' parameter is not present
    echo "<h1>Error Authorizing Bot</h1>";
    echo "<p>There was an error authorizing the bot. Please make sure you followed the correct authorization link and try again.</p>";
}
?>
