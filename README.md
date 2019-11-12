# ✨ WP Starter
Boilerplate repository for creating WordPress sites.

## Getting started
1. Make replacements (see next section)
2. Run `yarn install`
3. Run `yarn run build` (to test)
4. Insert WordPress core (everything except `wp-content`) into `public` directory
5. Install WordPress
6. Install WordPress plugins

## Replacements
Makes sure to exclude this file (`README.md`).

### Replacements: Search
- `theme-folder-name` → theme folder name
- `theme-text-domain` → text domain (for translations)
- `theme_prefix_` → theme prefix (PHP functions)
- `ThemePrefix` → theme prefix (PHP classes)

### Replacements: Specific files
- `package.json` → change `name` and `description`
- `webpack.config.js` → change `setup.url` (default: [https://wp-starter.localhost]())
- `public/wp-content/themes/theme-folder-name/style.css` → update

## Plugins
```console
wp plugin install disable-comments --activate
```

### Plugins: Install manually
- ACF Pro

## Development
You can use the following commands:

- `yarn run dev`: during development
- `yarn run build`: create production bundle