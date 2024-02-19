#!/usr/bin/env bash
php -S localhost:3000 -t . &
node node_chat &
wrangler dev --config cf_clean_target_tabs/wrangler.toml --port 5000 &
wait