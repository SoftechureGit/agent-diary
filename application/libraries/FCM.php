<?php
class FCM
{
    protected static $access_token         =   "";

    function __construct()
    {
        # Generate Access Token
        // $serviceAccount         =   FCM_CREDENTIAL_PATH; // Path to your downloaded JSON file

        // Load the service account credentials
        // $credentials = json_decode(file_get_contents($serviceAccount), true);

        // Create a JWT token
        $now = time();
        $scope = 'https://www.googleapis.com/auth/firebase.messaging';
        $payload = [
            'iss' => FCM_CLIENT_EMAIL,
            'sub' => FCM_CLIENT_EMAIL,
            'aud' => 'https://oauth2.googleapis.com/token',
            'iat' => $now,
            'exp' => $now + 3600, // Token valid for 1 hour
            'scope' => $scope, // Add this line if needed
        ];

        // Encode the JWT Header and Payload
        $header = json_encode(['alg' => 'RS256', 'typ' => 'JWT']);
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($payload)));

        // Create the signature
        $signature = '';
        openssl_sign($base64UrlHeader . '.' . $base64UrlPayload, $signature, FCM_PRIVATE_KEY, OPENSSL_ALGO_SHA256);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Create the JWT
        $jwt = $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;

        // Get the access token
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt,
        ]));

        $response = curl_exec($ch);
        $tokenInfo = json_decode($response, true);

        curl_close($ch);
        # End Generate Access Token

        if ($tokenInfo ?? 0):
            self::$access_token     = $tokenInfo['access_token'];
        else:
            echo 'Error getting access token ';
            exit;
        endif;
    }

    function send($param = null)
    {

        $arr                    =   [];
        
        $device_id              =   $param->device_id ?? '';
        $title                  =   $param->title ?? '';
        $message                =   $param->message ?? '';

        # Validation
        if(!$device_id || !$title || !$message):
            return (object) ['status' => false, 'message' => "Parameters requried"];
        endif;
        # End Validation

        # Details
        $accessToken            =   self::$access_token;
        $project_id             =   FCM_PROJECT_ID;
        $url                    =   "https://fcm.googleapis.com/v1/projects/$project_id/messages:send"; // Replace with your project ID
        # End Details

        // Check for the access token
        if ($accessToken) {

            // Prepare the FCM message
            $message_body = [
                'message' => [
                    'token' => $device_id, // Replace with the recipient device token
                    'data' => [
                        'title' => $title,
                        'message' => $message,
                    ],
                ],
            ];

            // Send the FCM notification
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json',
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message_body));

            $response = curl_exec($ch);
            curl_close($ch);

            $arr            =   ['status' => true, 'message' => "Notifcation sent", 'response' => $response];
        } else {
            $arr            =   ['status' => true, 'message' => "Error getting access token"];
        }

        return (object) $arr;
    }
}
