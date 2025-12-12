# GitHub Webhook Setup Guide - Canvas Nest

## Problem Diagnosis

Your webhook is failing with a 403 error because:

1. ❌ **Wrong URL**: GitHub webhook points to `https://canvasnest.co.uk/deploy.php`
2. ❌ **Wrong location**: The webhook.php is in the theme directory, which may not be web-accessible
3. ❌ **Wrong path**: Even if the file name matched, the URL doesn't include the full path to the theme directory

## Solution: Step-by-Step Fix

### Step 1: Upload the Webhook File to the Correct Location

1. **Download the file**: I've created `deploy-webhook.php` in your local repo
2. **Upload to Hostinger**:
   - Go to Hostinger File Manager
   - Navigate to `/public_html/` (your site root, NOT the theme directory)
   - Upload `deploy-webhook.php` to `/public_html/deploy-webhook.php`

**Important**: The file should be at:
```
/public_html/deploy-webhook.php
```

NOT in:
```
/public_html/wp-content/themes/astra-child-canvasnest/
```

### Step 2: Set File Permissions

In Hostinger File Manager:
1. Right-click on `deploy-webhook.php`
2. Select "Permissions" or "Change Permissions"
3. Set to **644** or **755** (make sure it's readable and executable)

### Step 3: Test File Accessibility

1. Open your browser
2. Go to: `https://canvasnest.co.uk/deploy-webhook.php`
3. You should see an error message (that's normal - it means the file is accessible)
4. If you get a 404, the file isn't in the right place

### Step 4: Update GitHub Webhook URL

1. Go to your GitHub repo: https://github.com/okillli/astra-child-canvasnest
2. Click **Settings** → **Webhooks**
3. Click **Edit** on your existing webhook
4. Change **Payload URL** from:
   ```
   https://canvasnest.co.uk/deploy.php
   ```
   To:
   ```
   https://canvasnest.co.uk/deploy-webhook.php
   ```

5. Verify these settings:
   - **Content type**: `application/json`
   - **Secret**: `oki123xyz789def456lli` (exactly as shown)
   - **SSL verification**: Enable SSL verification
   - **Which events**: "Just the push event"
   - **Active**: ✓ Checked

6. Click **Update webhook**

### Step 5: Test the Webhook

**Option A: Manual test from GitHub**
1. In GitHub webhook settings, scroll down
2. Click on the "Recent Deliveries" tab
3. Click "Redeliver" on the most recent delivery
4. Check the response - should show 200 OK

**Option B: Push a test commit**
1. Make a small change locally (we can do this)
2. Commit and push to GitHub
3. Check if files update on Hostinger

### Step 6: Check the Logs

After testing, check the logs on Hostinger:

1. Go to File Manager → `/public_html/`
2. Look for these files:
   - `webhook-deploy.log` - Deployment activity log
   - `webhook-errors.log` - PHP errors (if any)

3. Download and check these logs to see what happened

## Common Issues & Fixes

### Issue: "403 Forbidden"
**Cause**: Secret mismatch or signature verification failed
**Fix**:
- Verify the secret in GitHub matches exactly: `oki123xyz789def456lli`
- Make sure there are no extra spaces
- Check that Content-type is `application/json`

### Issue: "File not found" / 404
**Cause**: File is in wrong location
**Fix**: Make sure `deploy-webhook.php` is in `/public_html/` (site root)

### Issue: "Git pull failed"
**Cause**: Git repository not initialized or SSH key issues
**Fix**: SSH into your server and run:
```bash
cd /home/u977687187/domains/canvasnest.co.uk/public_html/wp-content/themes/astra-child-canvasnest
git pull origin main
```

If this works manually but not via webhook, check file permissions.

### Issue: "Permission denied"
**Cause**: Web server user doesn't have permission to run git
**Fix**:
1. Check file ownership: Files should be owned by the web server user
2. You may need to configure SSH keys for the web server user
3. Contact Hostinger support if needed

## Verification Checklist

Before pushing changes, verify:

- [ ] `deploy-webhook.php` is at `/public_html/deploy-webhook.php`
- [ ] File permissions are 644 or 755
- [ ] File is accessible at `https://canvasnest.co.uk/deploy-webhook.php`
- [ ] GitHub webhook URL is `https://canvasnest.co.uk/deploy-webhook.php`
- [ ] Secret in GitHub matches: `oki123xyz789def456lli`
- [ ] Content type is `application/json`
- [ ] Webhook is set to "Active"
- [ ] Git is working in the theme directory (test manually via SSH)

## Testing the Setup

Once everything is configured, let's test:

1. I'll make a small test change to `test-deployment.txt`
2. Commit and push to GitHub
3. Check webhook delivery in GitHub (should show 200 OK)
4. Check Hostinger file manager - `test-deployment.txt` should update
5. Check `webhook-deploy.log` for deployment details

## Need Help?

If you still get errors:
1. Share the content of `webhook-deploy.log`
2. Share the GitHub webhook delivery response
3. Verify you can manually run `git pull` via SSH

---

**Current Status:**
- ❌ Webhook not working (403 error)
- 🔧 Ready to fix with these instructions

**Next Steps:**
1. Upload `deploy-webhook.php` to `/public_html/`
2. Update GitHub webhook URL
3. Test the deployment
