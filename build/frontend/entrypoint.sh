#!/bin/sh
set -e

cd /var/www/frontend
npm install

exec "$@"
