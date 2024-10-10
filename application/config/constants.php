<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('ADMIN_URL')      OR define('ADMIN_URL', 'admin/');
defined('AGENT_URL')      OR define('AGENT_URL', 'agent/');

defined('SITE_TITLE')      OR define('SITE_TITLE', 'Agent Diary');

defined('CURRENCY_SYMBOL')      OR define('CURRENCY_SYMBOL', '₹');

// Google Javascript Map API
defined('GOOGLE_JAVASCRIPT_MAP_API') OR define('GOOGLE_JAVASCRIPT_MAP_API', 'AIzaSyBKuWzkssV5VE2pjY-pt4oV7G9AEmgI8-k');

defined('API_KEY')      OR define('API_KEY', '123456');  
if ($_SERVER["HTTP_HOST"] == "localhost") {
defined('SITE_MAIL')      OR define('SITE_MAIL', 'rakeshkumar.softechure@gmail.com');  
defined('MAINEMAIL')      OR define('MAINEMAIL', 'rakeshkumar.softechure@gmail.com');
}
else {
defined('SITE_MAIL')      OR define('SITE_MAIL', 'info@agentdairy.com');  
defined('MAINEMAIL')      OR define('MAINEMAIL', 'info@agentdairy.com');
}

//Text Local SMS
defined('TEXTLOCAL_USERNAME')      OR define('TEXTLOCAL_USERNAME', 'Akeshsinghal@gmail.com');
defined('TEXTLOCAL_KEY')      OR define('TEXTLOCAL_KEY', '3qahD3QgaEI-ff6Kg3BzTdZ1kIMS36DCipDZeFzJn3');
defined('TEXTLOCAL_SENDER_ID')      OR define('TEXTLOCAL_SENDER_ID', 'TXTLCL');

# FCM Notification
defined('FCM_PROJECT_ID')           OR define('FCM_PROJECT_ID', 'agent-diary-b5b28');
defined('FCM_CLIENT_EMAIL')         OR define('FCM_CLIENT_EMAIL', 'firebase-adminsdk-vt0qv@agent-diary-b5b28.iam.gserviceaccount.com');
defined('FCM_PRIVATE_KEY')          OR define('FCM_PRIVATE_KEY', "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC6Mir47svaA/lM\nkYN/EdIti6R3m0Xv2KawKlJjqTsp1VuMBr8iBmLw3x10BIzwgco3BBFqGA8C/z/u\nmn08St3/hwHZXIPjY8TR4kHiIR1r9oglIk/MvjY66wrB9pHo/rDxqa9IP+5FnsNs\nB6t56MkWV+HDmFG1maPLiEkPK9ffw2oTklSZQM8vpPWoSwfkQj7PvedpwOtzj2kZ\niV/1iN4p5xsCuTlC7Yw48dixZivUlBDf+JfRWT8X6+Ww5a1dE42EylGzL6UyfIaP\n6cQCVQ19tkhdG+glSDpy3Xk+eKB1QrnVNB3UFJb0CdQHh9w02UjqrrE9SrCHngZk\nSOKZpYmXAgMBAAECggEAMCl55BogsKwGeD/Le7roWs+cIzQOyxOHSlooJY9ItnFx\n1K6KEgsE3LlZrQDgU/W+kKyEtKS0fVn494cOjeHvuoD5gXfkxZSw/HlCAXP/YEXM\nwY42hgdNj7/scG+PHm2C53+0z0N6JpgChJcXS9li6lyhES79M7QiIiuGel4k4MQC\nWBjzcXB+FL3EqURlx/fRtyABf0j6cLb6bvk9KhQCyUO5szmy3h2YlQHgAVhOzBlC\nyWojtru2j6up6hzyzlEYKJgwaDS4ojAdEXD0y4JyOhheihW38FQ8tcVAl5MXWeOF\nreZpcNv1x5Mb8hrGpqUubTWxob8e7oVrVeYtwc9tAQKBgQDgB5iGMPZicbWtknuW\nsfZYhIwBJOrVH78BT4n0HU+TT/WPj8I7GRNjo+OFx+wpXDEQmx7jr4UOGnUnYDq/\nXVDXHY1CMQWLYpR+UApySTByjNCLzKF0H0ip/dUXIYDQzbUH4jYENfMmuIjPnbNE\nf/BJ7e38nSKlpa25ht7yu7bckQKBgQDUxGfP8RxnGwW7O7qtS3Yog7V0O7zurPOi\niNMkRiULGpmreuMWcw6cR9H2kDEodZtv28pnZ03jvYVWc1uaWRo0BZ4OqCSH41iE\n51jh56q9i5402xNeykEWxPr/dTnKYmfjOAj7qtrnqW3gNkNdkyVTRxxMX6GwjRAq\noATDKrC3pwKBgGPNfnlpnpnEpnco5r3/kgtlISnxVFyVw/XFhWOnGyg5WuAV3yWM\nykJ9ZILYybCzTXhkYqJ0MwZRaxebmxBddgIfPCrcw+eQhy6uYbkAOgEOEmn1Q4gD\n189DMYcYedaLjbZxZDcEAcqiMvCrBI3joRyOTpNXPXQmFvqrxu7ECXbBAoGAYqvn\nHPdLXcGZadhsXVumo2lZaFsf5mxM3K6phKQHH9wpMe5ejBW1y+I+zCLYuVO5TynV\n9xhgdeJ5iLsc2zrBPSjxwQhXULGtZo1HmhRvCVJLf2Wt2QLhJqcZZAlAUMxMM4LU\nH6p/tHnNm/JuUWIhKDrNM9oRySfSPIJTUxNkOvcCgYEA3EC7noU6Y11hGWumkx2p\nOUPQGPKmpvseBvhA49o7ecov24bTHZEV6gEy6s1y36fUccOy8KkZPorwwSjKAlWW\n0rQFwINq/Y9dIN34PjFXkQZMU5XWmszre6FhINW3uarYjR1VvWlOk9ktJRW6JD1g\nL5HmmfTQYCSX9homY+OwNm0=\n-----END PRIVATE KEY-----\n");
