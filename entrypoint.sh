#!/bin/bash
set -e

# Substitui todos os placeholders nos assets JS
echo "Injecting runtime environment variables..."
for file in /var/www/html/public/build/assets/*.js; do
  envsubst < "$file" > "$file.tmp"
  mv "$file.tmp" "$file"
done

echo "Starting Apache..."
exec "$@"