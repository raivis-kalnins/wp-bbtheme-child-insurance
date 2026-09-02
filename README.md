# WP BBTheme Child Insurance 3.7.0

Child theme for WP BBTheme. Built to use the shared Gutenberg/WP BBuilder design system and demo importer.

## Included
- WooCommerce cover-package catalogue
- Custom package finder inspired by feature-led breakdown cover stores
- Vehicle type, billing cycle and home-assistance add-to-cart options
- Insurance Quote custom post type with product-level quote request form
- Legacy WooCommerce basket, checkout, order and My Account shells
- Demo insurance package products and comparison content

## Requirements
- WordPress 6.6+
- PHP 8.0+
- Parent theme `wp-bbtheme` 3.7.0+
- WP BBuilder
- WooCommerce + WP Theme Woo Support

## SCSS structure (3.8.10.9)

Frontend styles are split into `tokens`, `tools`, `base`, `header`, `footer`, `components`, `swiper`, `motion`, `forms`, `blog`, `quality`, `sector`, `responsive` and `features`. Fluid typography uses the suite `fluid-font()` mixin and explicit viewport guards rather than `clamp()`. The generated production CSS intentionally contains no `!important` declarations.

### Build compatibility

The child build is dependency-free and works with Yarn 1.22.x as well as newer Yarn versions. No Corepack step is required. Use:

```sh
yarn prod
```

The command runs `node tools/build.mjs` and rebuilds the hashed CSS/JS manifest directly.
