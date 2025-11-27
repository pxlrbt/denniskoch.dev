#!/usr/bin/env bash
set -euo pipefail

usage() {
  cat <<EOF
Usage: $(basename "$0") <github_repo_name> [target_dir]

Beispiele:
  $(basename "$0") filament-changelog
  $(basename "$0") filament-changelog changelog

Repo wird von: git@github.com:pxlrbt/<github_repo_name>.git geklont
EOF
}

# Parameter prüfen
if [ $# -lt 1 ]; then
  usage >&2
  exit 1
fi

REPO="$1"
TARGET_DIR="$REPO/docs"

GIT_BASE="git@github.com:pxlrbt"
DOCS_BUILD_CMD="npm run docs:build"
DOCS_DIST_SUBPATH="docs/.vitepress/dist"
URL_ROOT="https://denniskoch.dev/projects"
PUBLIC_ROOT="/home/ploi/denniskoch.dev/public/projects"

TMP_DIR="$(mktemp -d)"
trap 'rm -rf "$TMP_DIR"' EXIT

echo "→ Klone Repository: $REPO"
git clone "$GIT_BASE/$REPO.git" "$TMP_DIR/$REPO"

pushd "$TMP_DIR/$REPO" >/dev/null

npm ci

# Docs bauen
echo "→ Baue Dokumentation"
$DOCS_BUILD_CMD

popd >/dev/null

DIST_PATH="$TMP_DIR/$REPO/$DOCS_DIST_SUBPATH"
if [ ! -d "$DIST_PATH" ]; then
  echo "✖ Build-Output nicht gefunden: $DIST_PATH" >&2
  exit 2
fi

DEST="$PUBLIC_ROOT/$TARGET_DIR"
DEST_URL="$URL_ROOT/$TARGET_DIR"
echo "→ Kopiere nach: $DEST"
rm -rf "$DEST"
mkdir -p "$DEST"
cp -R "$DIST_PATH"/. "$DEST"

echo "✅ Docs deployed to: $DEST"
echo "✅ Check: $DEST_URL"
