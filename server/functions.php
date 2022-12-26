<?php

function render_html($jam_time_is_now, $display_output) {
    $html = <<<EOF
    <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>Jam Alert!</title>
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
                <table>
                    <tr>
                        <th>Directory Server</th>
                        <th>Server</th>
                        <th>Ping</th>
                        <th>Clients</th>
                        <th>Instruments</th>
                    </tr>
    EOF;

    foreach($display_output as $server_display) {
        if($server_display['highlight']) {
            $html .= '<tr class="highlight">';
        } else {
            $html .= '<tr>';
        }
        
        $html .= '<td>' . $server_display['directory_server'] . '</td>';
        $html .= '<td>' . $server_display['name'] . '</td>';
        $html .= '<td>' . $server_display['ping'] . '</td>';
        $html .= '<td>' . $server_display['nclients'] . '</td>';
        $html .= '<td><ul class="instrument_list">';
            foreach($server_display['instruments'] as $instrument) {
                $html .= '<li>' . $instrument . '</li>';
            }; 
        $html .= '</ul></td>';
    };

    $html .= <<<EOF
    </table>
    <p id="refresh-datetime"></p>
                <script>
                    document.getElementById('refresh-datetime').innerHTML = 'Last refreshed: ' + new Date().toString();
                </script>
            </body>
        </html>
    EOF;

    echo $html;
};

function render_json($jam_time_is_now, $display_output) {
    $json_output = array('jam_time_is_now' => $jam_time_is_now, 'display_output' => $display_output);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($json_output);
};

?>