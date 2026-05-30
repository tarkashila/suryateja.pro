#!/usr/bin/env bash
# suryateja.pro — deploy to VPS.
# Usage:
#   ./deploy.sh                  # uses $VPS_HOST / $VPS_USER / $VPS_PATH from env or defaults below
#   VPS_HOST=1.2.3.4 ./deploy.sh
#
# Pattern matches other Vyomai projects: rsync source → ssh build → up.

set -euo pipefail

VPS_USER="${VPS_USER:-root}"
VPS_HOST="${VPS_HOST:-suryateja.pro}"          # set to VPS IP or hostname
VPS_PATH="${VPS_PATH:-/opt/suryateja-pro}"
SSH_PORT="${SSH_PORT:-22}"

REMOTE="${VPS_USER}@${VPS_HOST}"
SSH="ssh -p ${SSH_PORT} ${REMOTE}"
RSYNC_SSH="ssh -p ${SSH_PORT}"

cyan()  { printf "\033[36m%s\033[0m\n" "$*"; }
green() { printf "\033[32m%s\033[0m\n" "$*"; }
red()   { printf "\033[31m%s\033[0m\n" "$*" 1>&2; }

cyan "==> 0. Local syntax check"
node --check server.js
cyan "    ok"

cyan "==> 1. Ensuring remote path exists: ${VPS_PATH}"
$SSH "mkdir -p '${VPS_PATH}'"

cyan "==> 2. Backing up remote SQLite DB (if present)"
$SSH "if [ -f '${VPS_PATH}/data/contact.sqlite' ]; then \
  cp '${VPS_PATH}/data/contact.sqlite' '${VPS_PATH}/data/contact.sqlite.\$(date +%Y%m%d-%H%M%S).bak' && \
  echo '    backup created'; \
else \
  echo '    no existing DB — skipping backup'; \
fi"

cyan "==> 3. Rsync source to ${REMOTE}:${VPS_PATH}"
# NOTE the trailing slashes — both sides — to sync contents to top level.
rsync -avz --delete \
  -e "${RSYNC_SSH}" \
  --exclude '.git' \
  --exclude 'node_modules' \
  --exclude 'data' \
  --exclude '.env' \
  --exclude 'CLAUDE.local.md' \
  --exclude 'Images' \
  --exclude '*.php' \
  --exclude 'form_submissions.txt' \
  --exclude 'test' \
  --exclude 'script.js' \
  --exclude 'style.css' \
  ./ "${REMOTE}:${VPS_PATH}/"

cyan "==> 4. Ensuring remote .env exists"
$SSH "if [ ! -f '${VPS_PATH}/.env' ]; then \
  cp '${VPS_PATH}/.env.example' '${VPS_PATH}/.env' && \
  echo '    .env created from .env.example — EDIT IT before first run.'; \
fi"

cyan "==> 5. Build & up (docker compose)"
$SSH "cd '${VPS_PATH}' && docker compose up -d --build"

cyan "==> 6. Health check"
sleep 3
if $SSH "wget -qO- http://127.0.0.1:3000/health" | grep -q '"ok":true'; then
  green "    /health: ok"
else
  red "    /health failed — check 'docker compose logs -f web' on the VPS"
  exit 1
fi

green "✔ Deploy complete: https://suryateja.pro"
