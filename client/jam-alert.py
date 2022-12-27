#!/usr/bin/env python3

import json
import urllib.request
import time
from gpiozero import PWMLED

# Blue LED on 23, Green LED on 24

blueLed = PWMLED(23)
greenLed = PWMLED(24)

# Wait 30 seconds before trying to contact the server
# This is a hack, but when run from systemd on boot,
# the script runs before the web server is ready.
time.sleep(30)

while True:
  blueLed.on() # Turn on blue led while polling
  if json.loads(urllib.request.urlopen("http://jam.local?format=json").read())['jam_time_is_now'] == True:
    # It's jam time! Hit the lights!
    greenLed.pulse() # Let's see how annoying this is...
    print('light on')
  else:
    # It's not jam time... Shut off the lights.
    greenLed.off()
    print('light off')
  blueLed.off() # Turn blue led off when done
  time.sleep(120) # Check every two minutes, this seems reasonable.
