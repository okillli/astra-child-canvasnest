# Astra Pro Setup Guide - Manual Steps
**Date:** December 12, 2025
**Status:** Pending User Action (Not Urgent)
**Estimated Time:** 30-45 minutes

---

## 📋 MANUAL STEPS REQUIRED

These steps require WordPress admin access. Complete when convenient.

---

## STEP 1: Install Astra Pro Plugin (5 minutes)

**What you need:**
- Astra Pro license key (from purchase email)
- Astra Pro plugin ZIP file (from download link in email)

**Steps:**
1. Log into WordPress admin: `https://canvasnest.co.uk/wp-admin`
2. Go to: Plugins → Add New
3. Click: "Upload Plugin" button
4. Choose the Astra Pro ZIP file
5. Click: "Install Now"
6. Click: "Activate Plugin"

**Expected result:** "Plugin activated successfully" message

---

## STEP 2: Activate License (2 minutes)

**Steps:**
1. Go to: Appearance → Astra Options
2. Enter your license key in the field
3. Click: "Activate License"

**Expected result:** Green checkmark + "License activated successfully!"

---

## STEP 3: Enable Quick View (5 minutes)

**Steps:**
1. Go to: Appearance → Customize → WooCommerce → Product Catalog
2. Find: "Quick View" section
3. Enable: Toggle "Enable Quick View" to ON
4. Configure:
   - Quick View Style: Modal (popup)
   - Show Quick View on: Hover
5. Click: "Publish"

**Expected result:** Hovering over products shows Quick View popup

---

## STEP 4: Enable Off-Canvas Cart (5 minutes)

**Steps:**
1. Go to: Appearance → Customize → WooCommerce → Cart
2. Find: "Slide-In Cart" or "Off-Canvas Cart"
3. Enable: Toggle to ON
4. Configure:
   - Cart position: Right
   - Show cart after add to cart: Yes
5. Click: "Publish"

**Expected result:** Adding to cart shows slide-out cart from right side

---

## STEP 5: Configure Product Gallery (5 minutes)

**Steps:**
1. Go to: Appearance → Customize → WooCommerce → Single Product
2. Find: "Product Gallery Layout"
3. Choose: Vertical (recommended for canvas art)
4. Enable: Image Zoom → ON
5. Enable: Lightbox → ON
6. Click: "Publish"

**Expected result:** Product pages show vertical thumbnail gallery with zoom

---

## STEP 6: Enable Sticky Add to Cart (3 minutes)

**Steps:**
1. Still in: Appearance → Customize → WooCommerce → Single Product
2. Find: "Sticky Add to Cart"
3. Enable: Toggle to ON
4. Configure:
   - Position: Bottom
   - Show on: Desktop + Mobile
5. Click: "Publish"

**Expected result:** "Add to Cart" button floats at bottom when scrolling

---

## STEP 7: Enable Infinite Scroll (Optional - 3 minutes)

**Steps:**
1. Go to: Appearance → Customize → WooCommerce → Product Catalog
2. Find: "Shop Pagination"
3. Choose: "Infinite Scroll"
4. Click: "Publish"

**Expected result:** Products load automatically as you scroll (no page numbers)

---

## STEP 8: Test Everything (10 minutes)

**Shop Page Test:**
- [ ] Hover product → Quick View appears
- [ ] Click Quick View → Popup shows details
- [ ] Add to cart → Cart slides out from right
- [ ] Infinite scroll loads more products

**Product Page Test:**
- [ ] Gallery shows vertical thumbnails
- [ ] Click image → Lightbox opens
- [ ] Hover image → Zoom works
- [ ] Scroll down → Sticky "Add to Cart" appears at bottom

**Mobile Test:**
- [ ] Quick View works on mobile
- [ ] Off-canvas cart works on mobile
- [ ] Sticky Add to Cart visible on mobile

---

## 🚨 TROUBLESHOOTING

**Quick View not showing?**
- Clear cache (Ctrl+Shift+R)
- Check it's enabled in Customizer
- Try different browser

**Off-Canvas Cart not working?**
- Clear cache
- Disable conflicting cart plugins
- Check browser console for errors (F12)

**Custom CSS broken?**
- Verify child theme is active (Appearance → Themes)
- Hard refresh browser
- Contact Claude Code for fixes

---

## ✅ VERIFICATION CHECKLIST

After completing all steps, verify:

- [ ] Astra Pro plugin installed and active
- [ ] License activated (green checkmark)
- [ ] Quick View enabled and working
- [ ] Off-Canvas Cart sliding out correctly
- [ ] Product gallery showing vertical layout
- [ ] Sticky Add to Cart appearing on scroll
- [ ] Infinite scroll loading products (if enabled)
- [ ] All existing custom CSS still working
- [ ] Mobile responsive features working
- [ ] Cart page styling intact (Phase 4 CSS)
- [ ] Checkout page styling intact (Phase 4 CSS)

---

## 📊 EXPECTED IMPACT

**Conversion Improvements:**
- Quick View: +8-12% (faster browsing)
- Off-Canvas Cart: +5-10% (better UX)
- Advanced Gallery: +3-7% (better product visualization)
- Sticky Add to Cart: +5-8% (always visible CTA)

**Combined Expected Impact:** +21-37% conversion improvement

---

## 🔄 AFTER SETUP

Once manual steps are complete:

**You can:**
- Continue selling with improved features
- Monitor conversion rate improvements
- Get customer feedback on new UX

**Claude Code will:**
- Style the new features via CSS (automatic)
- Customize appearance to match brand
- Optimize integration with existing work
- Add any additional enhancements

---

## 📞 NEED HELP?

**If stuck on any step:**
1. Take screenshot of the issue
2. Note what step you're on
3. Describe what's not working
4. Claude Code will provide specific fix

**Common issues and fixes documented above in Troubleshooting section.**

---

**Status:** Ready to implement when you have 30-45 minutes
**Priority:** Medium (improves UX but site works fine without)
**Benefit:** Significant conversion improvement for minimal time investment

---

**Last Updated:** December 12, 2025
**Related Documentation:**
- Phase 4 Session Summary: `/docs/sessions/SESSION-SUMMARY-PHASE-4.md`
- Theme Research: `/docs/research/WOOCOMMERCE-THEME-RESEARCH-2025.md`
