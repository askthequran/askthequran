<?php

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Define constants
define('DISCORD_CLIENT_ID', getenv('DISCORD_CLIENT_ID'));
define('DISCORD_CLIENT_SECRET', getenv('DISCORD_CLIENT_SECRET'));
define('DISCORD_REDIRECT_URI', getenv('DISCORD_REDIRECT_URI'));

// Exchange the authorization code for an access token
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $params = array(
        'client_id' => "1091130947711271093",
        'client_secret' => "JMpj6ThhiMrROeRFr-2wVbJpiDg7kGIy",
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => "http://askthequran.rf.gd/htdocs/home/askthequran/bot.py",
        'scope' => 'bot'
    );
    $discord_redirect_uri = "http://askthequran.rf.gd/htdocs/home/askthequran/bot.py";
    $headers = array(
        'Content-Type: application/x-www-form-urlencoded'
    );
    $url = 'https://discord.com/api/oauth2/token';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_data = json_decode($response);
    if (isset($response_data->access_token)) {
        $access_token = $response_data->access_token;
        // Store the access token in a secure way (e.g. database, environment variable, etc.)
        // TODO: Replace with your own code to store the access token
    }
}

?>
