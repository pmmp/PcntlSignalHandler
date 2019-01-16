# PcntlSignalHandler
PocketMine-MP plugin to allow stopping the server gracefully using CTRL+C

## How do I use it?
Drop it in your `plugins` directory and restart the server. No additional setup is necessary.

## Caveats
You won't be able to use CTRL+C to abort the server. If your server hangs, you'll need to do the following:
- Escape from the server console. You can do this with CTRL+Z.
- Run `kill -9 $(pidof php)` to kill the zombie server.
