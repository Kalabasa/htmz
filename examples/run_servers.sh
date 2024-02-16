#!/usr/bin/env bash
php -S localhost:3000 -t . &
node node_chat &
wait