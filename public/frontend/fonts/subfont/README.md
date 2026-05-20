# Subfont (`--tl-ff-subfont`)

**TL Subfont** is self-hosted **Nunito Sans 300** (open license), used as a web-safe stand-in for **Avenir LT 35 Light** (`avenir-lt-w01_35-light`).

## Use in CSS

```css
font-family: var(--tl-ff-subfont);
```

Or class: `.tl-subfont`

## Replace with real Avenir (if you have a license)

1. Export or obtain `avenir-lt-w01-35-light.woff2` (or `.woff`).
2. Place it in this folder as `avenir-lt-w01-35-light.woff2`.
3. In `public/frontend/css/subfont.css`, point all `@font-face` `src` to that file (single file is enough for Latin/Vietnamese if your kit is full).

Do not commit commercial Avenir files to a public repo without checking your license.
