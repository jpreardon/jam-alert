#!/usr/bin/env python3

import json
import urllib.request
import time
from gpiozero import LED

# Blue LED on 23, Green LED on 24

blueLed = LED(23)
greenLed = LED(24)

# Wait 30 seconds before trying to contact the server
# This is a hack, but when run from systemd on boot,
# the script runs before the web server is ready.
time.sleep(30)

while True:
  blueLed.on()
  if json.loads(urllib.request.urlopen("http://jam.local?format=json").read())['jam_time_is_now'] == True:
    # It's jam time! Hit the lights!
    greenLed.on()
    print('jamtime!!!')
  else:
    # It's not jam time... Shut off the lights.
    greenLed.off()
    print('not jamtime :(')
  time.sleep(120) # Check every two minutes, this seems reasonable.
