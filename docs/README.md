# Canvas Nest Documentation

This directory contains all project documentation organized by type for easy navigation.

---

## 📁 Directory Structure

### `/sessions` - Session Progress & Summaries
Date-specific session logs and completion reports.

- **SESSION-PROGRESS-2025-12-12.md** - Detailed progress log from badge fix session
- **SESSION-SUMMARY-PHASE-3.md** - Phase 3 trust signals implementation summary
- **FINAL-STATUS-2025-12-12.md** - Badge optimization completion report

**When to add here:** After each major work session or phase completion

---

### `/guides` - Implementation Guides
Step-by-step guides for implementing features and understanding the codebase.

- **PHASE-2-COMPREHENSIVE-GUIDE.md** ⭐ **START HERE** - Complete manual task guide with step-by-step instructions
- **ui-ux-analysis.md** - Original comprehensive UI/UX audit with priority matrix
- **WEBHOOK-SETUP-GUIDE.md** - Git auto-deployment webhook configuration

**When to add here:** How-to guides, setup instructions, implementation references

---

### `/research` - Research & Analysis
Research findings, decision-making documentation, and strategic analysis.

- **RESEARCH-SALE-BADGE-STRATEGY.md** - E-commerce conversion research (7+ studies)
- **SOLUTION-SALE-BADGES.md** - Root cause analysis of badge issues
- **WORDPRESS-FRONTEND-STRATEGY.md** - Frontend architecture decisions

**When to add here:** Research reports, A/B test analysis, strategic recommendations

---

### `/archive` - Historical Documents
Older documents kept for reference but superseded by newer information.

- **PROJECT-STATUS.md** - Historical project status (superseded by session summaries)
- **STRATEGIC-RECOMMENDATION.md** - Theme vs MCP comparison (reference only)

**When to add here:** Outdated but potentially useful historical documentation

---

## 🚀 Quick Start

**New to this project?**
1. Read `/CLAUDE.md` in root (project overview & current status)
2. Read `/docs/guides/PHASE-2-COMPREHENSIVE-GUIDE.md` (what needs to be done)
3. Check `/docs/sessions/SESSION-SUMMARY-PHASE-3.md` (latest work completed)

**Want to understand a feature?**
- Check `/docs/research/` for decision rationale
- Check `/docs/guides/ui-ux-analysis.md` for UI/UX priorities

**Looking for session history?**
- Check `/docs/sessions/` for chronological progress

---

## 📊 Current Project Status

**Automated Improvements:** ✅ Complete (1,174 lines of CSS deployed)
**Manual Tasks:** Pending user action (see PHASE-2-COMPREHENSIVE-GUIDE.md)

**Latest Commit:** fb6e766
**Branch:** main
**Deployment:** Automatic via webhook

---

## 🔄 Documentation Best Practices

### When Creating New Documents:

**Session summaries** → `/docs/sessions/`
- Use format: `YYYY-MM-DD-description.md`
- Example: `2025-12-15-mobile-testing.md`

**Implementation guides** → `/docs/guides/`
- Use descriptive names: `feature-name-guide.md`
- Example: `newsletter-signup-guide.md`

**Research/analysis** → `/docs/research/`
- Use topic-based names: `topic-research.md`
- Example: `mobile-conversion-research.md`

**Old docs** → `/docs/archive/`
- Move here when superseded by newer docs
- Keep for historical reference

### Keep Updated:
- `/CLAUDE.md` in root - Always reflects current status
- `/docs/README.md` - This file, update when structure changes

---

## 📝 File Naming Conventions

✅ **Good:**
- `2025-12-12-session-summary.md` (date-prefixed for sessions)
- `comprehensive-manual-guide.md` (descriptive)
- `sale-badge-research.md` (topic-specific)

❌ **Avoid:**
- `doc1.md`, `notes.md` (too generic)
- `FINAL-FINAL-v2.md` (versioning in filename)
- `temp-notes-delete-later.md` (just delete it)

---

## 🗂️ Related Files in Root

**Project files:** (keep in root directory)
- `/CLAUDE.md` - Project instructions & current status
- `/README.md` - Repository overview (standard for GitHub)
- `/style.css` - Main stylesheet (1,174 lines)
- `/functions.php` - Theme functions & hooks

---

## 💡 Tips

1. **Before creating new docs:** Check if existing doc can be updated instead
2. **After major sessions:** Create summary in `/sessions` with date prefix
3. **When archiving:** Add note at top of archived doc pointing to replacement
4. **Link between docs:** Use relative paths like `../guides/ui-ux-analysis.md`

---

**Last Updated:** December 12, 2025
**Maintained By:** Claude Code + User
**Questions?** Check `/CLAUDE.md` or ask!
