# WordPress Frontend Development Strategy
## Claude Code & Canvas Nest Analysis

**Date:** December 12, 2025
**Issue:** Fighting CSS specificity wars with Astra theme
**Question:** What's the best approach for frontend control with Claude Code?

---

## Current Situation Analysis

### What's Working ✅
- Child theme structure is correct
- Git workflow and auto-deployment functional
- CSS file is loading (verified via Playwright)
- Child theme loads AFTER parent (correct order)

### What's NOT Working ❌
- **CSS not being applied despite `!important` flags**
- Green circular badges still visible (`display: block`)
- "Sale!" labels still showing (`display: block`)
- Fighting specificity wars with Astra theme CSS
- Child theme CSS loads but gets overridden

### Root Cause (Verified via Playwright)
```javascript
// Child theme CSS IS loading:
childThemeCSSLoaded: true
childThemeCSSHref: "https://canvasnest.co.uk/.../astra-child-canvasnest/style.css?ver=1.0.0"

// BUT badges still render with:
greenBadge: { display: "block", background: "rgb(116, 168, 74)" }
saleBadge: { display: "block", background: "rgb(255, 255, 255)" }
```

**Why?** Astra theme has highly specific selectors + possible inline styles or JS-generated styles that override child theme CSS.

---

## Strategic Options for Frontend Control

### Option 1: Fix Current Child Theme Approach ⭐ **RECOMMENDED SHORT-TERM**

**Strategy:** Increase specificity + use better CSS techniques

**Pros:**
- No major changes needed
- Proper WordPress way
- Survives theme updates
- Git workflow stays intact

**Cons:**
- Requires deep CSS debugging
- May need to use hacky selectors
- Fighting against theme architecture

**Implementation:**
1. Use Playwright to inspect computed styles
2. Find exact selectors being applied
3. Use higher specificity (e.g., `body.woocommerce...`)
4. Consider using `functions.php` to dequeue problematic CSS
5. Add inline critical CSS via `wp_head` hook

**Best for:** Quick fixes, maintaining current setup

---

### Option 2: Use Astra Pro + Customizer 💎 **RECOMMENDED MID-TERM**

**Strategy:** Leverage Astra's built-in customization system

**Pros:**
- Direct control over theme features
- Can disable sale badges in settings
- Visual customizer interface
- No CSS specificity wars
- Professional support

**Cons:**
- Costs ~$59/year for Astra Pro
- Some features still need CSS
- Less version control for settings

**Implementation:**
1. Upgrade to Astra Pro
2. Use Customizer to disable sale badge features
3. Control colors/typography globally
4. Use child theme CSS only for custom additions

**Best for:** Long-term maintenance, professional sites

---

### Option 3: Switch to Minimal/Starter Theme 🔧

**Strategy:** Use a blank canvas theme for full control

**Recommended Themes:**
- **GeneratePress** (lightweight, developer-friendly)
- **Blocksy** (modern, flexible)
- **Neve** (fast, customizable)
- **Underscores/_s** (bare bones starter)

**Pros:**
- Clean slate, no fighting CSS
- Better performance (less bloat)
- Easier for Claude Code to work with
- More predictable structure

**Cons:**
- Need to rebuild existing customizations
- More initial setup time
- May lose current design elements

**Best for:** Sites willing to rebuild for better foundation

---

### Option 4: Page Builder Approach 🎨

**Strategy:** Use visual builders for WooCommerce

**Options:**
- **Elementor** + Elementor Pro (most popular)
- **Oxygen** (developer-focused)
- **Bricks** (performance-oriented)

**Pros:**
- Visual control over everything
- Can override all theme styles
- Great for WooCommerce templates
- No CSS knowledge needed

**Cons:**
- Learning curve
- Can be bloated/slow
- Claude Code works better with code than visual builders
- Vendor lock-in

**Best for:** Non-developers who want visual control

---

### Option 5: Custom Theme Development 🚀

**Strategy:** Build custom WordPress theme from scratch

**Pros:**
- Total control
- Optimized code
- Perfect for Claude Code
- No third-party dependencies

**Cons:**
- Time-intensive
- Requires WordPress theme expertise
- Ongoing maintenance burden
- Higher complexity

**Best for:** Long-term projects with specific needs

---

### Option 6: Block Theme (FSE - Full Site Editing) 🆕

**Strategy:** Use WordPress's modern block-based theme system

**Pros:**
- Future of WordPress
- JSON-based templates (great for Git)
- Visual editing with code backup
- Modern architecture

**Cons:**
- Newer technology, some rough edges
- WooCommerce support still maturing
- Steeper learning curve
- Fewer resources available

**Best for:** Forward-thinking projects

---

## Claude Code Compatibility Analysis

### What Works BEST with Claude Code:

1. **Direct File Access** ✅
   - themes/child-theme/style.css
   - themes/child-theme/functions.php
   - Git-tracked changes

2. **Playwright Integration** ✅✅✅
   - Inspect live site DOM
   - Get computed CSS
   - Test changes in real-time
   - Screenshot comparison

3. **Clear Code Structure** ✅
   - Minimal theme = easier to understand
   - Well-commented code
   - Predictable file structure

4. **Programmatic Control** ✅
   - PHP functions for CSS manipulation
   - WP hooks and filters
   - No GUI dependencies

### What's DIFFICULT for Claude Code:

1. **Visual Builders** ❌
   - Database-stored settings
   - GUI-only configuration
   - Hard to inspect/modify programmatically

2. **Complex Parent Themes** ⚠️
   - Deep CSS specificity
   - Many layers of abstraction
   - Unpredictable selectors

3. **Inline Styles** ❌
   - JS-generated CSS
   - Database-stored CSS
   - Not in Git-tracked files

---

## Recommended Strategy for Canvas Nest

### Immediate Action (Next 24 Hours):

**Use `functions.php` to inject ultra-specific CSS**

```php
// Add to functions.php
function canvasnest_critical_css() {
    ?>
    <style id="canvasnest-critical">
        /* Ultra-specific selectors to override Astra */
        body.woocommerce-shop ul.products li.product .astra-shop-thumbnail-wrap span.onsale,
        body.woocommerce ul.products li.product .astra-shop-thumbnail-wrap span.onsale {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
        }

        body.woocommerce-shop .ast-on-card-button.ast-onsale-card,
        body.woocommerce .ast-on-card-button.ast-onsale-card {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'canvasnest_critical_css', 999);
```

**Why this works:**
- Inline CSS in `<head>` has high priority
- Body classes add specificity
- Triple-layered hiding (display, visibility, opacity)
- Priority 999 loads very late

---

### Short-Term (Next Week):

1. **Audit Astra Customizer settings**
   - Appearance → Customize → WooCommerce
   - Look for "Sale Badge" options
   - Disable at theme level if possible

2. **Consider Astra Pro upgrade** ($59)
   - More control over WooCommerce
   - Can disable features entirely
   - Better long-term investment

3. **Document all customizations**
   - Keep CLAUDE.md updated
   - Track what works and what doesn't

---

### Mid-Term (Next Month):

**Evaluate theme switch to GeneratePress or Blocksy**

**Criteria for decision:**
- Time investment: 8-12 hours to rebuild
- Cost: GeneratePress Pro ~$59/year
- Benefit: Clean foundation for future changes
- Risk: Low (can test on staging)

**Migration plan:**
1. Set up staging site
2. Install new theme
3. Rebuild current design
4. Test thoroughly
5. Switch when confident

---

### Long-Term (Ongoing):

**Establish best practices for WordPress + Claude Code:**

1. **Always use Playwright first** before CSS changes
   - Inspect computed styles
   - Find exact selectors
   - Test changes live

2. **Keep CSS simple**
   - Minimal nesting
   - Clear comments
   - BEM or similar methodology

3. **Use functions.php strategically**
   - Dequeue conflicting CSS
   - Add high-priority inline styles
   - Hook into WordPress properly

4. **Git workflow**
   - Continue current auto-deployment
   - Test locally when possible
   - Document all changes

---

## Immediate Fix to Try RIGHT NOW

I recommend adding inline CSS via `functions.php` with maximum specificity. This is the fastest way to get control back while we evaluate longer-term options.

### Action Plan:

1. **Add ultra-specific CSS to functions.php** (now)
2. **Test with Playwright** (verify it works)
3. **Audit Astra settings** (this week)
4. **Consider Astra Pro or theme switch** (next month)

---

## Questions for User:

1. **Budget:** Willing to spend $59 for Astra Pro or new theme license?
2. **Time:** Willing to invest 8-12 hours for theme switch?
3. **Priority:** Quick fix (functions.php) vs. proper rebuild?
4. **Risk tolerance:** Comfortable switching themes or prefer safer path?
5. **Long-term:** Planning to scale site or keep current size?

---

## Claude Code's Assessment:

**Current approach (child theme) IS correct** - the problem is execution, not strategy.

**Best immediate fix:** Use `functions.php` to inject inline CSS with higher priority.

**Best long-term fix:** Either upgrade to Astra Pro OR switch to cleaner theme like GeneratePress.

**Why:** Claude Code works best with:
- Clean, minimal themes
- Direct file access
- Predictable CSS structure
- Playwright for testing

Astra (free) is fighting us because it's designed for non-coders using the Customizer. That's not wrong - just not optimal for our workflow.

---

**Next Steps:** Let's implement the `functions.php` fix RIGHT NOW and see if it works!
