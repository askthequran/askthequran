<!DOCTYPE html>
<html>
<head>
    <title>Ask The Quran Discord Bot Authorization</title>
</head>
<body>
    <?php
        // Check if authorization code is present in the URL
        if (isset($_GET["code"])) {
            // Get the authorization code from the URL
            $authorization_code = $_GET["code"];

            // TODO: Exchange the authorization code for an access token using your bot's client secret
            // and make API calls to the Discord API using the access token

            // Display a confirmation message
            echo "<h1>Thank you for authorizing Ask The Quran bot!</h1>";
        } else {
            // Display an error message if the authorization code is not present in the URL
            echo "<h1>Authorization failed!</h1>";
        }
    ?>
    <?php
// Set the authorization parameters
$client_id = '1091130947711271093';
$client_secret = 'JMpj6ThhiMrROeRFr-2wVbJpiDg7kGIy';
$redirect_uri = 'http://askthequran.rf.gd/htdocs/index.php';
$code = $_GET['code'];

// Exchange the authorization code for an access token
$url = 'https://discord.com/api/oauth2/token';
$data = array(
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'grant_type' => 'authorization_code',
    'code' => $code,
    'redirect_uri' => $redirect_uri,
    'scope' => 'identify guilds'
);
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$token_data = json_decode($response, true);

// Use the access token to fetch the user's information
$access_token = $token_data['access_token'];
$token_type = $token_data['token_type'];
$expires_in = $token_data['expires_in'];
$refresh_token = $token_data['refresh_token'];
$scopes = $token_data['scope'];
$auth_header = "Authorization: {$token_type} {$access_token}";

$user_url = 'https://discord.com/api/users/@me';
$user_options = array(
    'http' => array(
        'header'  => "{$auth_header}\r\n",
        'method'  => 'GET'
    )
);
$user_context  = stream_context_create($user_options);
$user_response = file_get_contents($user_url, false, $user_context);
$user_data = json_decode($user_response, true);

// Print out the user's information
echo 'Hello, ' . $user_data['username'] . '#' . $user_data['discriminator'] . '!';
?>

</body>
</html>
