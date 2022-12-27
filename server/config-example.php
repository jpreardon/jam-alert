<?php
    /* Suppress error display */
    ini_set('display_errors',0); // set to 1 for dev

    /* Define Constants */
    define('MAX_PING_MS', 50);
    define('MIN_CLIENTS', 1);
    define('EXCLUDE_INSTRUMENT', 'Bass Guitar');
    define('HIGHLIGHT_INSTRUMENT', 'Drums');
    /* Domain */
    // This should be the full path to the servers.php file
    define('API_ENDPOINT', '[http://localhost/jamulus-php/servers.php]');
?>




