# Worklog

## TODO

- Get ambient display working
  - Return JSON from the PHP page if requested

## Log

### 2022-12-26

- Clean up instrument listing so it's more readable.
- Remove extraneous comments from index.php

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
 