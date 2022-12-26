#!/usr/bin/env python3

import json
import urllib.request

if json.loads(urllib.request.urlopen("http://jam.local?format=json").read())['jam_time_is_now'] == True:
    # It's jam time! Hit the lights!
    print('jamtime!!!')
else:
    # It's not jam time... Shut off the lights.
    print('not jamtime :(')