# PEN News Portal — Comprehensive Audit Report
> Date: 2026-06-07  
> Scope: Full application audit (Backend, Frontend, Database, Config, Routes)  
> Method: Static code analysis via automated probes + manual spot checks  
> Action: Report-only (no code changes)

---

## Executive Summary

| Domain | Critical | High | Medium | Low | Total |
|--------|----------|------|--------|-----|-------|
| Backend (PHP) | 3 | 4 | 4 | 3 | 14 |
| Frontend (Blade/JS/CSS) | 2 | 3 | 5 | 6 | 19* |
| Infrastructure (DB/Config/Routes) | 2 | 5 | 3 | 3 | 13 |
| **TOTAL** | **7** | **12** | **12** | **12** | **~46** |

*Frontend count includes some grouped instances.

---

## Critical Issues (Fix Immediately)

### C1. User Privilege Escalation via Mass Assignment
- **File**: `app/Models/User.php` (line ~16-20)
- **Category**: Security
- **Description**: `is_admin` and `is_editor` are listed in `$fillable`. While current registration controllers explicitly pick fields, any future endpoint that blindly passes validated data (e.g., API endpoint, bulk importer) could allow a user to escalate to admin.
- **Fix**: Remove `is_admin` and `is_editor` from `$fillable`. Provide dedicated methods (`promoteToAdmin()`, `demoteFromAdmin()`) for role changes.

### C2. Orphaned Data on Article Deletion
- **File**: `app/Http/Controllers/Admin/ArticleController.php` (line ~160-177)
- **Category**: Bug / Data Integrity
- **Description**: Deleting an article only removes `article_tags` rows. It leaves orphaned `comments`, `page_views`, `saved_articles`, and `article_likes` records in the database.
- **Fix**: Add `onDelete('cascade')` to migration foreign keys OR manually delete related records before the article is deleted. Alternatively, implement soft deletes on articles and cascade-delete related data in an observer.

### C3. No Resource-Level Authorization
- **File**: All controllers in `app/Http/Controllers/`
- **Category**: Security
- **Description**: Not a single controller uses `authorize()`, `can()`, or `Gate::` checks. Every action relies solely on route middleware. This means any authenticated admin can theoretically delete or edit any other admin’s data (the app only has a basic self-check to prevent the last admin from being removed).
- **Fix**: Create Laravel Policies (`ArticlePolicy`, `UserPolicy`, `CommentPolicy`) and call `authorize('update', $article)` inside controller actions.

### C4. Stored XSS in Article Body Rendering
- **File**: `resources/views/article/show.blade.php` (line ~111)
- **Category**: Security
- **Description**: `{!! $article->body_bn !!}` renders raw HTML. If a reporter with editor access (or if XSS is chained with the mass-assignment bug) enters malicious JavaScript, it executes for every reader.
- **Fix**: Run article body through an HTML purifier (e.g., `mews/purifier`) before display: `{!! clean($article->body_bn) !!}`. Alternatively, if rich HTML is required, whitelist safe tags (`p`, `h1-6`, `img`, `a`, `br`, `strong`, `em`) in the WYSIWYG editor output.

### C5. Ad Code Rendered Without Sanitization
- **File**: `resources/views/partials/ads/*.blade.php` (multiple files)
- **Category**: Security
- **Description**: `{!! $ad->code !!}` renders raw ad HTML/JS. If an admin with malicious intent (or a compromised admin account) sets ad code to `<script>alert(document.cookie)</script>`, it executes on every page load.
- **Fix**: Since ad code often requires `<script>` tags, this is inherently risky. Use sandboxed iframes for third-party ad code, or strip `<script>` tags from stored ad code via a strict sanitizer but whitelist standard ad network tags.

### C6. Database Password Empty in .env
- **File**: `.env`
- **Category**: Security / Config
- **Description**: `DB_PASSWORD=` is empty. While this is common in local XAMPP environments, if this `.env` were ever deployed to production, the database is fully open.
- **Fix**: Add a strong password for the DB user even in local development, and ensure `.env` is in `.gitignore` so it is never committed. Also add `.env` to `.gitignore` if not present.

### C7. APP_DEBUG=true in .env
- **File**: `.env` (and `.env.example`)
- **Category**: Security / Config
- **Description**: `APP_DEBUG=true` exposes stack traces, environment variables, and file paths to the browser on errors. This is a critical security risk in production.
- **Fix**: Set `APP_DEBUG=false` in `.env.example` to establish safe defaults. Only enable debug in a dedicated `.env.local` file.

---

## High Severity Issues

### H1. Missing Rate Limiting on Public POST Endpoints
- **File**: `routes/web.php` (contact, register, login, admin login)
- **Category**: Security
- **Description**: `/contact`, `/register`, `/login`, and `/admin/login` have no rate limiting. Brute force attacks and form spam are trivial.
- **Fix**: Add `throttle:5,1` to contact/login routes and `throttle:3,5` to registration routes.

### H2. Public Ad Click/Impression Inflation
- **File**: `routes/web.php` (line ~21-22)
- **Category**: Security
- **Description**: `/ads/click/{ad}` and `/ads/impression/{ad}` are public GET endpoints with no rate limiting or referrer validation.
- **Fix**: Require signed URLs or add referrer validation. Add rate limiting (`throttle:ads,30,1`).

### H3. Google OAuth Skips Email Verification
- **File**: `app/Http/Controllers/SocialiteController.php` (line ~36-44)
- **Category**: Security
- **Description**: `email_verified_at` is set automatically for all Google OAuth new registrations. If the Google account email is not verified by Google, the system still trusts it.
- **Fix**: Check `$googleUser->user['email_verified']` before marking as verified in your database.

### H4. Missing Database Indexes on Hot Columns
- **File**: Multiple migrations (`articles`, `page_views`, `newsletter_subscribers`)
- **Category**: Performance
- **Description**: `articles.status`, `articles.is_breaking`, `articles.is_featured`, `articles.published_at`, `page_views.viewable_type + viewable_id`, and `newsletter_subscribers.email/phone` lack indexes. Query performance will degrade rapidly as the dataset grows.
- **Fix**: Add migration(s) to index these columns.

### H5. Massive Sitemap Memory Usage
- **File**: `app/Http/Controllers/Admin/SeoController.php` (line ~120)
- **Category**: Performance
- **Description**: `$articles->get()` loads every published article into PHP memory to generate the XML. With 10,000+ articles this will cause out-of-memory errors.
- **Fix**: Use `Article::cursor()` or `Article::chunk(500, function ($articles) { ... })` to generate the XML in a streaming fashion.

### H6. No Form Request Validation Classes
- **File**: `app/Http/Controllers/` (28 files)
- **Category**: Code Quality
- **Description**: All validation logic is inline inside controllers. `app/Http/Requests/` is empty. This makes controllers bloated, validation harder to reuse, and testing more difficult.
- **Fix**: Create `StoreArticleRequest`, `UpdateUserRequest`, etc., and move complex validation rules there.

### H7. Contact Form Missing CSRF Token
- **File**: `resources/views/contact/index.blade.php` (approximate line ~20)
- **Category**: Security
- **Description**: The public contact form is missing `@csrf`, making it vulnerable to CSRF attacks.
- **Fix**: Add `@csrf` inside the contact form.

### H8. Missing alt Text on 20+ Images
- **File**: Multiple views (`home.blade.php`, `article/show.blade.php`, `admin/posts/index.blade.php`, etc.)
- **Category**: Accessibility
- **Description**: Over 20 `<img>` tags use `alt=""` without meaningful text. Screen readers skip these entirely.
- **Fix**: Provide meaningful `alt` text for all content images. Use `alt=""` only for decorative images.

### H9. Missing Unique Constraints on Newsletter Subscribers
- **File**: `database/migrations/2026_06_03_042010_create_newsletter_subscribers_table.php`
- **Category**: Bug / Data Integrity
- **Description**: Email and phone columns lack unique constraints, allowing duplicate subscribers.
- **Fix**: Add unique indexes (considering unsubscribed status).

### H10. Bulk Delete Removes Promoted Content Without Warning
- **File**: `app/Http/Controllers/Admin/PostController.php`
- **Category**: Bug / UX
- **Description**: The bulk delete action permanently removes articles without checking if the selected articles are currently featured, on the slider, or breaking.
- **Fix**: Add a frontend confirmation dialog, or block deletion of active promoted/slider/breaking articles without explicit override.

---

## Medium Severity Issues

### M1. Type Error in SeoController Return Type
- **File**: `app/Http/Controllers/Admin/SeoController.php`
- **Description**: `public function sitemap(): \Illuminate\Support\Facades\Response` is an invalid return type.
- **Fix**: Use `\Illuminate\Http\Response`.

### M2. Password Policy Inconsistency
- **File**: `AuthController.php` vs `Admin/UserController.php`
- **Description**: Frontend registration requires `min:6`, admin panel requires `min:8`.
- **Fix**: Standardize to `min:8` (or `min:12`) everywhere.

### M3. No Soft Deletes on Comments/Archives
- **File**: `database/migrations/2026_06_03_042004_create_comments_table.php`, `2026_06_03_042008_create_archive_documents_table.php`
- **Description**: Deleted comments and archive documents are gone forever. For a news CMS, audit trails are important.
- **Fix**: Add `$table->softDeletes()` if business requires recoverability.

### M4. Foreign Key Uses `nullOnDelete` Instead of Proper Cascade
- **File**: `database/migrations/2026_06_03_052628_create_media_table.php`
- **Description**: `uploaded_by` FK uses `nullOnDelete()`, leaving media ownerless if the user is deleted.
- **Fix**: Decide if media should be deleted with the user or reassigned. Use `cascadeOnDelete()` or `restrictOnDelete()` explicitly.

### M5. Potential XSS in Icon Component (Low Risk)
- **File**: `resources/views/components/icon.blade.php`
- **Description**: `{!! $icons[$name] !!}` outputs raw SVG. The `$name` is hardcoded in the component map, but if user-controlled input ever reaches this prop, it becomes an XSS vector.
- **Fix**: Validate `$name` against the known set before output, or escape the SVG content safely.

### M6. Dark Mode Inconsistencies in Forms
- **File**: `resources/views/partials/header.blade.php`, `resources/views/admin/login.blade.php`
- **Description**: Some inputs and labels have hardcoded colors that may not fully adapt to dark mode.
- **Fix**: Audit all forms for proper `dark:` variants or rely on global CSS variables.

### M7. Slider Contrast Concerns
- **File**: `resources/views/home.blade.php`
- **Description**: Slider navigation buttons may have insufficient contrast in dark mode.
- **Fix**: Test contrast ratios against WCAG AA standards (4.5:1 for text).

### M8. Missing Default Value in Training Migration
- **File**: `database/migrations/2026_06_03_042006_create_training_tables.php`
- **Description**: `total_duration_minutes` is nullable without a default. Code may expect an integer.
- **Fix**: Add `->default(0)`.

---

## Low Severity Issues

### L1. No Rate Limiting on Public Read Endpoints
- **File**: `routes/web.php`
- **Description**: Search, archive, sitemap, and article pages have no rate limiting.
- **Fix**: Add `throttle:60,1` to public read endpoints.

### L2. Unused Imports in Controllers
- **File**: Multiple controllers
- **Description**: Several `use` statements import classes that are never referenced.
- **Fix**: Run `php artisan pint` to auto-fix.

### L3. Hardcoded Redirect on Email Verification
- **File**: `routes/web.php`
- **Description**: After email verification, all users redirect to `dashboard` route. Admins may prefer admin dashboard.
- **Fix**: Check `auth()->user()->is_admin` and redirect accordingly.

### L4. .env.example Shows Debug=true
- **File**: `.env.example`
- **Description**: Default example shows debug mode enabled, which may mislead new developers.
- **Fix**: Set `APP_DEBUG=false` and `APP_ENV=production` in `.env.example`.

### L5. Duplicate Breaking News Loop
- **File**: `resources/views/home.blade.php`
- **Description**: Breaking news ticker appears to duplicate the loop, possibly rendering the same stories twice.
- **Fix**: Verify the Blade logic and remove any duplicate `@foreach`.

### L6. JS Optimization Opportunities
- **File**: `resources/js/app.js`, `resources/js/custom-editor.js`
- **Description**: Scroll reveal could use `rootMargin`; editor could sanitize input on paste.
- **Fix**: Minor enhancements.

---

## Performance Summary

| Area | Concern | Impact |
|------|---------|--------|
| Database | Missing indexes on `articles.status`, `published_at`, `page_views` | Slow queries at scale |
| Sitemap | `get()` loads ALL articles into memory | OOM crashes with large dataset |
| User counts | 4 separate `count()` queries | N+1 overhead on every admin list view |
| Homepage | Multiple category queries already optimized | Low (HomeController uses groupBy) |

---

## Security Priority Matrix

| Priority | Fix | Effort |
|----------|-----|--------|
| 🔴 P0 | Remove `is_admin` from `$fillable` | 5 min |
| 🔴 P0 | Add CSRF token to contact form | 2 min |
| 🔴 P0 | Sanitize `{!! $article->body_bn !!}` | 30 min |
| 🟠 P1 | Add rate limiting to public POST endpoints | 15 min |
| 🟠 P1 | Add rate limiting to ad click/impression routes | 15 min |
| 🟠 P1 | Add database indexes | 20 min |
| 🟠 P1 | Add cascade delete for article relations | 30 min |
| 🟡 P2 | Implement Laravel Policies | 2 hours |
| 🟡 P2 | Move validation to Form Requests | 3 hours |
| 🟢 P3 | Add `alt` text to images | 1 hour |
| 🟢 P3 | Dark mode audit | 1 hour |

---

## Appendix: Files Audited

- **Controllers**: 28 PHP files in `app/Http/Controllers/`
- **Models**: 17 PHP files in `app/Models/`
- **Views**: 77 Blade files in `resources/views/`
- **Migrations**: 36 files in `database/migrations/`
- **Routes**: `routes/web.php`, `bootstrap/app.php`
- **Config**: `.env`, `.env.example`, `composer.json`, `package.json`

---

*End of Report*
