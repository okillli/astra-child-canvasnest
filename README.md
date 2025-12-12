# Astra Child Theme - Canvas Nest

**WooCommerce Shop for Canvas Prints**  
Hosted on: Hostinger | Domain: canvasnest.co.uk

## Project Overview

This is a custom WordPress child theme for Astra, built for the Canvas Nest WooCommerce store. The theme focuses on professional spacing, layout improvements, and custom styling using CSS and PHP hooks.

## Current Issues to Fix

The store has several design and UX problems that need to be addressed:

- **Product Grid Spacing**: Inconsistent gaps between product items on shop pages
- **Header Spacing**: Header padding appears uneven/unprofessional
- **Mobile Layout**: Mobile menu and spacing issues on smaller screens
- **Product Page Layout**: Single product page needs improved spacing around images, price, and add-to-cart button
- **Typography**: Font sizes and line heights need consistency across the site
- **Overall Polish**: Design feels unprofessional; needs refinement in spacing system

## File Structure

```
astra-child-canvasnest/
├── style.css          # Main theme stylesheet (imports Astra parent)
├── functions.php      # PHP hooks, filters, and custom functions
├── README.md          # This file
└── (future files)
    ├── inc/           # Custom PHP includes (WooCommerce hooks, etc)
    ├── template-parts/ # Custom WooCommerce template overrides
    └── assets/        # CSS/JS if needed for complex functionality
```

## How Claude Code Will Use This

1. **CSS Improvements**: Claude will add/modify styles in `style.css` for spacing, layout, and typography fixes
2. **PHP Hooks**: Claude will add WooCommerce-specific filters/actions in `functions.php` for structural changes
3. **Template Overrides**: Claude may create custom WooCommerce templates in a `woocommerce/` directory to override default layouts

## WordPress Setup

- **WP Version**: 6.9
- **Parent Theme**: Astra (free version)
- **WooCommerce**: Active with 87 products
- **Host**: Hostinger
- **SFTP Access**: File path: `/wp-content/themes/astra-child-canvasnest/`

## Deployment Instructions

### From GitHub to WordPress (Hostinger)

1. **Pull changes locally**:
   ```bash
   git clone https://github.com/okillli/astra-child-canvasnest.git
   cd astra-child-canvasnest
   ```

2. **Upload to Hostinger via SFTP**:
   - Connect to: `canvasnest.co.uk` (SFTP credentials in Hostinger hPanel)
   - Upload the theme folder to: `/public_html/wp-content/themes/astra-child-canvasnest/`

3. **Activate in WordPress**:
   - Go to WP Admin → Appearance → Themes
   - Activate "Astra Child - Canvas Nest"
   - Clear any caching (LiteSpeed Cache, Smush, etc.)

4. **Test**: Visit the shop page and check mobile/desktop views

## Common Claude Code Tasks

### Add Product Grid Spacing
```css
/* Example: In style.css */
.woocommerce ul.products li {
    margin-bottom: 30px; /* Consistent spacing */
}
```

### Modify WooCommerce Hooks
```php
// Example: In functions.php
add_filter('woocommerce_product_loop_columns', function($columns) {
    return 3; // 3-column grid
});
```

### Override WooCommerce Templates
Create: `woocommerce/loop/product.php` to customize how each product displays in the shop grid.

## Resources

- [Astra Theme Docs](https://wpastra.com/docs/)
- [WooCommerce Hooks](https://woocommerce.com/document/hooks/)
- [WordPress Child Themes](https://developer.wordpress.org/themes/advanced-topics/child-themes/)

## Notes for Claude Code

- **Don't modify Astra parent theme** - all changes go in this child theme
- **Test changes locally first** before deploying to production
- **Use WooCommerce hooks** instead of editing templates when possible (easier to maintain)
- **Keep CSS organized** with comments and sections
- **Document any new functions** in the code
