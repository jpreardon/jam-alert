# Worklog

## TODO

- Make page readable on a phone
- Try to add a last polled time or similar so one can investigate whether the script is still working
- Check for valid format parameter at the beginning of the index.php
- Get systemd to run the python script at the right time and remove the initial sleep delay from the python script

## Log

### 2022-12-27

- Change the LED behavior, turn blue on only when polling server, blink green.

### 2022-12-26

- Clean up instrument listing so it's more readable.
- Remove extraneous comments from index.php
- Turn off automatic refresh
- Get ambient display working
  - Return JSON from the PHP page if requested
  - Move server scripts into a 'server' directory
  - Create script that queries JSON for the jam_time_is_now flag
  - Get python client script working on Raspberry Pi at boot time
  - Get GPIO working on raspberry pi
- Use associative array so JSON makes more sense
- Move configs to config.php, add client directory with the most basic of python scripts.
- Update readme with some pictures of the prototype.

Helpful for re-imaging raspberry pi: https://www.tomshardware.com/reviews/raspberry-pi-headless-setup-how-to,6028.html

Helpful for setting up Apache and PHP: https://pimylifeup.com/raspberry-pi-apache/

Raspi Pinouts: https://www.raspberrypi.com/documentation/computers/raspberry-pi.html

Helpful for getting systemd set up: https://www.dexterindustries.com/howto/run-a-program-on-your-raspberry-pi-at-startup/

Note that I had to add a delay to the python script since systemd was starting the script too early.

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
 
