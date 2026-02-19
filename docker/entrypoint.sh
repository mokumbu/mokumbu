#!/bin/bash
set -e

echo "Injecting runtime environment variables..."

for file in /var/www/html/public/build/assets/*.js; do
  [ -f "$file" ] || continue
  envsubst < "$file" > "$file.tmp"
  mv "$file.tmp" "$file"
done

echo "Starting Supervisor..."

exec "$@"