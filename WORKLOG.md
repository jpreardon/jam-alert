# Worklog

## TODO

- Get ambient display working
    - Get GPIO working on raspberry pi
- Check for valid format at the beginning of the script

## Log

### 2022-12-26

- Clean up instrument listing so it's more readable.
- Remove extraneous comments from index.php
- Turn off automatic refresh
- Get ambient display working
  - Return JSON from the PHP page if requested
  - Move server scripts into a 'server' directory
  - Create script that queries JSON for the jam_time_is_now flag
- Use associative array so JSON makes more sense
- Move configs to config.php, add client directory with the most basic of python scripts.

Helpful for re-imaging raspberry pi: https://www.tomshardware.com/reviews/raspberry-pi-headless-setup-how-to,6028.html

Helpful for setting up Apache and PHP: https://pimylifeup.com/raspberry-pi-apache/

Raspi Pinouts: https://www.raspberrypi.com/documentation/computers/raspberry-pi.html

### 2022-12-25

Initial script that creates a simple page that shows servers with acceptable ping times with people on them. They get highlighted if there's a drummer and no bassist.

This is the data returned from [jamulus-php](https://github.com/softins/jamulus-php):

 - numip
 - port
 - country
 - maxclients
 - perm
 - name
 - ipaddrs
 - city
 - ip
 - ping
 - os
 - version
 - versionsort
 - nclients
 - clients
    - chanid
    - country
    - instrument
    - skill
    - name
    - city
 - index
 