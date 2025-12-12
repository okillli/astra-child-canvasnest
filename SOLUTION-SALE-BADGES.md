# SOLUTION: Sale Badge Mystery Solved!

**Date:** December 12, 2025
**Problem:** Two redundant sale badges appearing on products
**Root Cause:** TWO different systems creating badges!

---

## 🔍 What I Discovered

Using Playwright to inspect your site, I found **12 active plugins** and identified the culprits:

### The TWO Badge Sources:

1. **Green "-20%!" Badge**
   - Source: **Woo Discount Rules plugin**
   - Plugin URL: `/wp-content/plugins/woo-discount-rules/`
   - Shows percentage discount

2. **Red "Sale!" Badge**
   - Source: **Astra Theme**
   - Class: `.ast-on-card-button.ast-onsale-card`
   - Generic "Sale!" label

---

## ✅ EASY FIX - Disable in Plugin Settings

### Solution 1: Disable Woo Discount Rules Badge (Recommended)

**Navigate to:**
```
WordPress Admin → WooCommerce → Discount Rules → Settings → Product → On-sale badge
```

**Then:**
- Choose "**Do not show**" from the dropdown
- Save settings

**This will:**
- ✅ Remove the green "-20%!" badges completely
- ✅ Keep the standard WooCommerce/Astra "Sale!" badge
- ✅ No code needed!
- ✅ Works immediately

**Source:** [Woo Discount Rules Sale Badge Documentation](https://docs.flycart.org/en/articles/4179583-sale-tag-dynamic-sale-badge)

---

### Solution 2: Disable Astra's WooCommerce Integration

**Already added to `functions.php`:**
```php
add_filter( 'astra_enable_woocommerce_integration', '__return_false' );
```

**This will:**
- ✅ Remove Astra's "Sale!" badge
- ✅ Keep Woo Discount Rules "-20%!" badge
- ✅ Revert to standard WooCommerce styling

---

### Solution 3: Disable BOTH, Style Your Own (Best!)

**Step 1:** Disable Woo Discount Rules badge (in plugin settings)
**Step 2:** Disable Astra WooCommerce (via functions.php - already done!)
**Step 3:** Style standard WooCommerce `.onsale` badge

**Then our child theme CSS will work perfectly on the standard badge!**

---

## 📦 Your Installed Plugins (Found via Playwright)

1. **woo-discount-rules** ⚠️ (Adding green badges)
2. **customer-reviews-woocommerce**
3. **advanced-woo-search**
4. **woocommerce** (core)
5. **all-in-one-seo-pack**
6. **google-analytics-for-wordpress**
7. **astra-sites**
8. **jetpack**
9. **google-site-kit**
10. **wp-smushit**
11. **google-listings-and-ads**
12. **complianz-gdpr**

---

## 🔧 Ways to Give Claude Better WordPress Access

You asked how to give me better visibility into WordPress settings. Here are the options:

### Option 1: WordPress MCP (Model Context Protocol) ⭐⭐⭐⭐⭐

**What it does:**
- Lets me directly interact with WordPress
- View/modify plugin settings
- Create content programmatically
- Access database
- Full admin control via API

**Setup:**
1. Install [WordPress MCP Adapter](https://github.com/WordPress/mcp-adapter)
2. Configure in Claude Code settings
3. I can then query/modify WordPress directly

**Pros:**
- ✅ Complete visibility
- ✅ Can modify settings without GUI
- ✅ Automated workflows
- ✅ Future-proof

**Cons:**
- ⚠️ Requires setup (2-4 hours)
- ⚠️ Need to configure securely

**Sources:**
- [MCP for WordPress Documentation](https://mcp-wp.github.io/docs)
- [WordPress MCP Adapter](https://github.com/WordPress/mcp-adapter)
- [WordPress.com MCP Guide](https://developer.wordpress.com/docs/mcp/)

---

### Option 2: File System Access (Current) ⭐⭐⭐⭐

**What I can do now:**
- ✅ Read/write theme files
- ✅ Modify functions.php, style.css
- ✅ Git-tracked changes
- ✅ Use Playwright to inspect live site

**What I CAN'T do:**
- ❌ See plugin settings
- ❌ View WordPress admin pages
- ❌ Access database directly
- ❌ Know what plugins are installed (until now via Playwright)

**Improvement:**
- Set up SSH keys for easier access
- Share WordPress credentials (secure method)

---

### Option 3: Database Export/Dumps ⭐⭐⭐

**You could provide:**
- WordPress database export
- wp-config.php (with sensitive data redacted)
- Plugin configuration files

**Pros:**
- ✅ I can see all settings
- ✅ Understand plugin configurations
- ✅ No MCP setup needed

**Cons:**
- ⚠️ Manual process
- ⚠️ Security concerns
- ⚠️ Static snapshot (gets outdated)

---

### Option 4: Screenshot/Screen Share ⭐⭐

**You could:**
- Share screenshots of WordPress admin
- Show plugin settings pages
- Walk me through configuration

**Pros:**
- ✅ Quick and easy
- ✅ No technical setup

**Cons:**
- ❌ Not automated
- ❌ Time-consuming
- ❌ Not ideal for AI assistance

---

## 🎯 MY RECOMMENDATION

### Immediate Action (Next 5 Minutes):

**1. Disable Woo Discount Rules badge:**
```
WP Admin → WooCommerce → Discount Rules → Settings → Product → On-sale badge → "Do not show"
```

**2. We already added Astra disable filter to functions.php, so commit it:**

Let me commit the current changes now.

---

### Short-Term (This Week):

**Set up WordPress MCP** for better access:
- Install WordPress MCP Adapter plugin
- Configure in Claude Code
- Test connection
- Now I can see/modify WordPress settings directly

---

### Long-Term:

**Consider GeneratePress** if you want cleaner foundation:
- Fewer plugin conflicts
- Better performance
- Easier to customize
- But NOT urgent now that we found the issue!

---

## 🚀 UPDATED STRATEGY

With this new information, here's the best path:

### **KEEP ASTRA** (It's not the main problem!)

**The real issue was:**
- ❌ Woo Discount Rules adding green badges
- ❌ Astra adding redundant "Sale!" labels
- ❌ Two systems fighting each other

**The fix is:**
1. Disable Woo Discount Rules badges (plugin settings)
2. Disable Astra WooCommerce integration (functions.php - done!)
3. Style standard WooCommerce badge (our CSS will work!)

**No theme switch needed!**

---

## 📊 Why Our CSS Wasn't Working

**We were targeting the wrong elements!**

```css
/* We targeted standard WooCommerce */
.woocommerce span.onsale { display: none; }

/* But the green badge was from Woo Discount Rules! */
/* And it has different classes and higher specificity */
```

**Once you disable the plugin badges, our CSS will work perfectly!**

---

## ✅ FINAL ACTION PLAN

### Do This Right Now:

1. **Log into WordPress Admin**
2. **Go to:** WooCommerce → Discount Rules → Settings
3. **Find:** Product → On-sale badge setting
4. **Select:** "Do not show"
5. **Save Changes**

### Then Test:

1. Visit your shop page
2. Hard refresh (Ctrl+Shift+R)
3. You should see: **ONE clean badge** (or none if both disabled)

### Then We Can:

1. Style the badge however you want with simple CSS
2. No more fighting specificity wars
3. Claude Code can work normally!

---

## 🤖 WordPress MCP Next Steps (Optional)

If you want me to have better WordPress access:

1. **Install plugin:** [WordPress MCP Adapter](https://wordpress.org/plugins/mcp-adapter/)
2. **Or via command line:** `wp plugin install mcp-adapter --activate`
3. **Configure in Claude Code settings**
4. **I'll be able to:**
   - See all plugin settings
   - Modify configurations
   - View database
   - Automate WordPress tasks

**But this is optional** - the immediate fix is just disabling the badge in plugin settings!

---

## 📝 Sources

- [Woo Discount Rules Sale Badge Settings](https://docs.flycart.org/en/articles/4179583-sale-tag-dynamic-sale-badge)
- [Woo Discount Rules Plugin](https://wordpress.org/plugins/woo-discount-rules/)
- [WordPress MCP Documentation](https://mcp-wp.github.io/docs)
- [WordPress MCP Adapter GitHub](https://github.com/WordPress/mcp-adapter)
- [Astra WooCommerce Customization](https://wpastra.com/docs/remove-astra-customization-for-woocommerce/)

---

## 🎉 SUMMARY

**Problem:** Two sale badges (green + red)

**Culprits:**
- Woo Discount Rules plugin (green "-20%!")
- Astra theme (red "Sale!")

**Solution:**
- Disable plugin badge: WooCommerce → Discount Rules → Settings
- Disable Astra badge: functions.php filter (done!)
- Style standard badge: Our CSS will work!

**No theme switch needed!** 🎊

**WordPress MCP:** Great for future, but optional for this issue.

---

**Next step:** Please go disable the Woo Discount Rules badge in plugin settings and let me know what happens!
