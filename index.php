<?php

// Some constants
define('MAX_PING_MS', 50);
define('MIN_CLIENTS', 1);
define('API_ENDPOINT', 'http://localhost:8000/servers.php');
define('EXCLUDE_INSTRUMENT', 'Bass Guitar');
define('HIGHLIGHT_INSTRUMENT', 'Drums');

// Directory servers to check (these are the built in Jamulus ones https://jamulus.io/wiki/Running-a-Server#3-directory)
$directory_servers = array(
    ['Any Genre 1', 'anygenre1.jamulus.io:22124'],
    ['Any Genre 2', 'anygenre2.jamulus.io:22224'],
    ['Any Genre 3', 'anygenre3.jamulus.io:22624'],
    ['Genre Rock', 'rock.jamulus.io:22424'],
    ['Genre Jazz', 'jazz.jamulus.io:22324'],
    ['Genre Classical/Folk', 'classical.jamulus.io:22524'],
    ['Genre Choral/Barbershop', 'choral.jamulus.io:22724']
); 

// The array we're going to fill up with the relevant information for display later
$display_output = array();

// This is the variable we'll set to true if any servers might be looking for the EXCLUDE_INSTRUMENT
$jam_time_is_now = FALSE;

// Get the data from each of the directory servers
foreach($directory_servers as $directory_server) {

    // Get data
    $json_object = json_decode(file_get_contents(API_ENDPOINT . '?directory=' . $directory_server[1]), TRUE); 

    foreach ($json_object as $server) {
        $name = '';
        $highlight = FALSE;

        // Only list servers where <= MAX PING and with clients >= MIN CLIENTS, ignore pings less than 1ms.
        if($server['ping'] <= MAX_PING_MS && $server['ping'] > 0 && $server['nclients'] >= MIN_CLIENTS) {
            if($server['name'] == '') {
                $name = $server['ip'];
            } else {
                $name = $server['name'];
            };

            $instruments = array();

            // Get the instruments
            foreach($server['clients'] as $client) {
                if($client['instrument'] == '-') {
                    array_push($instruments, 'Unknown');
                } else {
                    array_push($instruments, $client['instrument']);
                };
            };

            // Alphabetize the instruments array
            sort($instruments);

            // Summarize/flatten duplicate instruments
            $instrument_summary = array_count_values($instruments);
            $instruments_flat = array();

            foreach ($instrument_summary as $instrument => $number_of_instruments) {
                if($number_of_instruments == 1) {
                    array_push($instruments_flat, $instrument);
                } else {
                    array_push($instruments_flat, $instrument . ' (' . $number_of_instruments . ')');
                };
            };

            // Check if this server should be highlighted
            if(in_array(HIGHLIGHT_INSTRUMENT, $instruments) && !in_array(EXCLUDE_INSTRUMENT, $instruments)) {
                $highlight = TRUE;
                $jam_time_is_now = TRUE;
            };

            // Add the following to the array directory_server_name, server_name, ping, nclients, instruments, highlight
            array_push($display_output, [$directory_server[0], $name, $server['ping'], $server['nclients'], $instruments_flat, $highlight]);
        };
    };
};

// Sort the array by ping time
usort($display_output, function ($a, $b) {
    $a_val = (int) $a[2];
    $b_val = (int) $b[2];

    if($a_val > $b_val) return 1;
    if($a_val < $b_val) return -1;
    return 0;
});

?>

<!DOCTYPE html>
            <html lang="en">
            <head>
                <title>Jam Alert!</title>
                <meta http-equiv="refresh" content="300">
                <meta name="viewport" content="width=device-width,initial-scale=1">
                <style>
                    body {
                        font-family: sans-serif;
                    }

                    table {
                        border-collapse: collapse;
                    }

                    th {
                        text-align: left;
                    }

                    th, td {
                        border: 1px solid black;
                    }

                    th, td {
                        padding: 4px;
                        margin: -1px;
                    }

                    .highlight {
                        background-color: #feff89;
                    }

                    .instrument_list {
                        margin: 0;
                        padding: 0;
                        list-style: none;
                    }

                </style>
            </head>
            <body>
                <h1>Jam Alert!</h1>
                <div>
                <?php if($jam_time_is_now) print '<p>JAM TIME IS NOW!!!</p>'; ?>
                <table>
                    <tr>
                        <th>Directory Server</th>
                        <th>Server</th>
                        <th>Ping</th>
                        <th>Clients</th>
                        <th>Instruments</th>
                    </tr>

<?php



foreach($display_output as $server_display) {
    if($server_display[5]) {
        print '<tr class="highlight">';
    } else {
        print '<tr>';
    }
    
    print '<td>' . $server_display[0] . '</td>';
    print '<td>' . $server_display[1] . '</td>';
    print '<td>' . $server_display[2] . '</td>';
    print '<td>' . $server_display[3] . '</td>';
    print '<td><ul class="instrument_list">';
        foreach($server_display[4] as $instrument) {
            print '<li>' . $instrument . '</li>';
        }; 
    print '</ul></td>';
};

?>

</table>
<p id="refresh-datetime"></p>
</div>

                <script>
                    document.getElementById('refresh-datetime').innerHTML = 'Last refreshed: ' + new Date().toString();
                </script>
            </body>
        </html>