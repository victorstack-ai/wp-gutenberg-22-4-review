# Gutenberg 22.4 Review Demo

This plugin is a small, buildable companion to a Gutenberg 22.4 review. It ships a custom block and a block pattern configured for **pattern overrides** so each synced pattern instance can safely customize text.

## What's Included

- `g224/spotlight-card` custom block (dynamic render).
- Pattern `g224/spotlight-card` with bindings to `core/pattern-overrides`.
- Minimal styling to make the card visually distinct.

## Requirements

- WordPress with Gutenberg 22.4+ (or the matching core version that includes pattern overrides for custom blocks).

## Install

1. Copy the plugin folder to `wp-content/plugins/`.
2. Activate **Gutenberg 22.4 Review Demo**.

## Try Pattern Overrides

1. Insert the pattern: **Spotlight Card (Overrides Ready)**.
2. Convert the pattern into a **Synced pattern** (or insert it as a synced pattern if your editor supports it).
3. In a post or template, insert that synced pattern instance.
4. Use the **Pattern overrides** panel to change the title/summary per instance.

You should see the overrides update without breaking the synced pattern relationship.

## Notes

- The key enabler is the `block_bindings_supported_attributes_g224/spotlight-card` filter in `gutenberg-22-4-review.php`.
- The pattern content sets `metadata.bindings` to `core/pattern-overrides` for `title` and `summary`.

## License

GPL-2.0-or-later
