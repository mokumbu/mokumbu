#!/bin/bash
set -e

echo "Injecting runtime environment variables..."

APP_ENV_FILE="/var/www/html/.env"

get_runtime_value() {
  local key="$1"
  local value="${!key:-}"

  if [ -z "$value" ] && [ -f "$APP_ENV_FILE" ]; then
    local line
    line="$(grep -m1 "^${key}=" "$APP_ENV_FILE" || true)"
    if [ -n "$line" ]; then
      value="${line#*=}"
      value="${value%\"}"
      value="${value#\"}"
      value="${value%\'}"
      value="${value#\'}"
    fi
  fi

  printf '%s' "$value"
}

replace_placeholder_in_file() {
  local file="$1"
  local key="$2"
  local value="$3"
  local escaped_value

  escaped_value="$(printf '%s' "$value" | sed -e 's/[\/&|]/\\&/g')"
  sed -i "s|\\\${${key}}|${escaped_value}|g" "$file"
}

firebase_vars=(
  "VITE_FIREBASE_API_KEY"
  "VITE_FIREBASE_AUTH_DOMAIN"
  "VITE_FIREBASE_PROJECT_ID"
  "VITE_FIREBASE_STORAGE_BUCKET"
  "VITE_FIREBASE_MESSAGING_SENDER_ID"
  "VITE_FIREBASE_APP_ID"
)

for file in /var/www/html/public/build/assets/*.js; do
  [ -f "$file" ] || continue
  for key in "${firebase_vars[@]}"; do
    value="$(get_runtime_value "$key")"
    if [ -n "$value" ]; then
      replace_placeholder_in_file "$file" "$key" "$value"
    else
      echo "Warning: $key is empty; placeholder in $file was not replaced."
    fi
  done
done

echo "Starting Supervisor..."

exec "$@"
