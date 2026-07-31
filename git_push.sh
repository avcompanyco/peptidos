#!/bin/bash
cd /www/wwwroot/peptidossuizos.com/
git add .
msg="${1:-Update Swiss Peptides codebase}"
git commit -m "$msg"
git push origin main
