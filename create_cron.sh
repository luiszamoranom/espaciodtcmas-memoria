#!/bin/bash

export $(grep -v '^#' .env | xargs)

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
BACKUP_SCRIPT="$SCRIPT_DIR/backup.sh"

crontab -l | grep -v "$BACKUP_SCRIPT" | crontab -

(crontab -l 2>/dev/null; echo "*/$BACKUP_INTERVAL_MINUTES * * * * $BACKUP_SCRIPT") | crontab -

chmod +x "$BACKUP_SCRIPT"

echo "Crontab actualizado:"
crontab -l
