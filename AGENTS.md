## Goal
- Transform PEN News Portal into a professional-grade Bangla news CMS with full editorial workflow, SEO, analytics, media management, monetization, and admin/editor user management.

## Constraints & Preferences
- PHP 8.2.12, Laravel 12.61.0, MySQL via XAMPP (127.0.0.1:3306, root/no password)
- Bangla-first: Playfair Display + Noto Sans Bengali, black/red/white NYT-inspired palette
- Admin must be fast, usable by non-technical editors, with proper dark mode and no emoji
- Google OAuth env vars in `.env` but no real credentials; `MAIL_MAILER=log`
- Tailwind v4 with `@custom-variant dark`

## Progress
### Done
- **Rebranded** to PEN News, removed all Training Hub, Events Calendar, Opinion/Teacher Voice, Newsletter models/controllers/views/migrations
- **Auth**: admin login at `/admin` with email+password, user registration, `MustVerifyEmail`
- **AdminMiddleware**: restricted to `is_admin` only — editors cannot access admin panel
- **Reporter access**: reporters (`is_editor=true`) can ONLY submit reports from their user dashboard (`/dashboard`); no admin panel, no staff portal
- **Demo credentials**: admin@penews.com/admin123 (admin), reporter@penews.com/reporter123 (reporter), user@penews.com/user123 (regular user)
- **Dashboard**: real-time stats, N+1 fixed for top-viewed articles, pending_approval replaced with submitted count
- **Page view tracking**: polymorphic `PageView` recorded on article show
- **Article CRUD**: category, district, staff, tags, breaking/featured/editor-pick/slider flags, submitted/scheduled status support
- **Scheduled publishing**: `articles:publish-scheduled` artisan command runs every minute
- **Professional Post Manager** (`/admin/posts`): tabbed (সব/প্রকাশিত/পর্যালোচনায়/খসড়া/নির্ধারিত) with live counts, search, category/author/date filters, bulk actions, quick AJAX flag toggles
- **Slider Manager**: drag-and-drop reorder with save
- **Breaking/Featured/Pending/Scheduled Managers**: dedicated filtered lists with quick actions
- **Category CRUD**: parent/child tree hierarchy, delete-blocked if articles or children exist
- **Comment moderation**: approve/reject/delete with status badges
- **Staff CRUD**: BN/EN name/designation, type, bio, photo, email, phone, order, active
- **Staff article workflow**: `is_editor` column, StaffArticleController, draft/submit/review/publish cycle
- **Article SEO fields**: `focus_keywords`, `canonical_url`, `indexable`, `og_image`
- **Media Library**: complete system with upload, folder filters, edit alt/credit, delete. **Critical bug fixed**: files now stored to `public` disk (`storage/app/public/…`) instead of `local` private disk. JSON endpoint for AJAX media library.
- **Custom WYSIWYG Editor**: replaced TinyMCE — built from scratch with `contentEditable` + `document.execCommand()`. Zero external dependencies, ~12 KB JS.
- **Settings**: tabbed (General, Social, Footer, Email, SEO) with file upload, SMTP, maintenance mode
- **Advertisements**: full CRUD with 6 positions, banner vs code, dimensions, schedule, order, impressions/clicks
- **Archive Documents**: CRUD for year/subcategory/file. **Bangla slug fallback fixed** (same pattern as ArticleController).
- **Comprehensive SEO Manager**: dashboard with health score, 7 issue categories, bulk SEO editor grid, sitemap.xml with news:news tags, robots.txt editor, 301 redirect manager with hit counter, per-article SEO analysis endpoint. **All emoji removed** from PHP data — replaced with text labels and severity-colored dots in dashboard view.
- **301 Redirect Middleware**: globally registered in `bootstrap/app.php`
- **Advertisement placement**: 6 partials (header, sidebar, article-top/bottom, footer, popup) included in frontend layouts
- **User & Admin Management**: full CRUD with `toggleRole()`, `toggleActive()`, self-protection and last-admin protection
- **ALL emoji removed** from admin views, controllers, and data (verified via grep: zero remaining)
- **ALL `&larr;` entities replaced** with SVG arrow icons
- **Consistent CSS classes**: `admin-card`, `admin-table-header`, `admin-hover-row`, `badge-*`, `btn-*`, `alert-*` applied across all admin views
- **Full dark mode coverage**: `dark:` variant classes and `.dark` CSS overrides on every admin view
- **Sidebar polished**: fixed flex layout, `sidebar-icon` class, `sidebar-link-new` with red tint, `badge-sidebar` pills, section dividers, `View::composer` for N+1-free counts
- **Admin layout**: dark mode toggle (sun/moon), user name/logout, SVG alert messages, validation error summary
- **Reusable SVG icon component**: `resources/views/components/icon.blade.php` with 40+ named icons
- **CSS refactoring**: comprehensive `app.css` with CSS custom properties, `.dark` overrides, editor toolbar/status bar/dialog styles, all admin component classes
- **Database seeder**: idempotent with `firstOrCreate`
- **Bug fixes**: scheduled page nested ternary, slider count filters `status=published`, article store respects user-provided `published_at`
- **Post manager cleanup**: removed `?flag=` duplicate tabs from index, removed flag filter from `PostController@index`
- **Slug critical fix**: Bangla titles no longer produce empty slugs — falls back to `article-{random}` (ArticleController + ArchiveDocumentController)
- **ArticleController `published_at` validation**: changed `after_or_equal:now` (which broke editing published articles) to conditional rule — only enforces future-only when `status=scheduled`
- **Article `status` enum fixed**: `submitted` was used by controllers but missing from DB enum — migration added
- **40+ database tables**, all migrations run
- **Frontend master-class overhaul**:
  - `HomeController` created — all homepage queries moved out of Blade
  - Category topic nav bar added — horizontal scrolling bar with all categories between breaking news and main content
  - Mobile hamburger menu with full category list and login button
  - Breaking news ticker with CSS `@keyframes` animation, pause on hover
  - Homepage refactored to use `layouts.app` (previously had standalone `<html>`)
  - Dark mode on ALL frontend pages (app layout, home, article, category, search, archive, dashboard)
  - Article page: sticky share sidebar (Facebook/Twitter/WhatsApp/Copy Link), better comments with avatar initials, better typography with `article-body` class, print styles, mobile share bar
  - Category page: redesigned with featured first article spanning 2 cols, 3-column grid for rest, empty state
  - Search page: dark mode inputs, card-based results, styled empty state
  - Archive page: document cards with file icon, download button, year/subcategory/chip display
  - Dashboard page: stats grid, saved articles + comments sections, dark mode
  - Custom pagination styled via `pagination` CSS classes (vendor blade overwritten)
  - Footer redesigned — matches header style, social link, copyright
  - Guest layout body fixed: `dark:bg-[#121212] dark:text-[#e0e0e0]`
  - Admin login page: all card/input/button dark mode classes added
  - `সাইট দেখুন` button: changed from dim text link to bordered button with hover effects
  - Staff portal (staff layout + staff index + articles create/edit/index): full dark mode
  - User-facing auth pages (login, register, verify-email): full dark mode
- **Dark mode CSS**: global `.dark` overrides for `border-[#e0e0e0]`, `border-[#0d0d0d]`, `divide-[#e0e0e0]`, `focus:border-[#0d0d0d]`, `focus:border-[#E02020]` added. Global `input/select/textarea` rule sets dark bg/text/border for all form elements without explicit classes. `admin-card` has built-in `.dark` bg/border.

### In Progress
- *(none)*

### Blocked
- *(none)*

## Key Decisions
- **Noto Sans Bengali over SutonnyMJ**: Google Fonts standard, clean Unicode support for both Bangla and Latin scripts, served via fonts.bunny.net privacy proxy; declared via `<link>` in layout heads (not CSS `@import`) to avoid Vite/Tailwind CSS ordering warnings
- **YouTube embed component two modes**: `embed` (actual iframe) on article detail page; `thumb` (thumbnail + play overlay) on list views (homepage, category, search) to avoid loading heavy iframes on index pages
- **HomeController N+1 fix**: Single query `->get()->groupBy('category_id')` instead of per-category DB loop; eager-loads `staffs` relation once
- **Slider enhancements**: Pure vanilla JS (touch, keyboard, progress bar) keeps zero-dependency approach consistent with codebase; `IntersectionObserver` for scroll-reveal same pattern
- **Homepage redesign**: 4 rounds executed sequentially — Quick Fixes → Structural → Visual Polish → Premium Features
- Admin panel uses CSS `.dark` overrides rather than `dark:` Tailwind prefixes on every element — reduces churn
- SVG icons via Blade component (`<x-icon name="..." />`) with 40+ named icons — consistent, no emoji
- Sidebar counts passed via `View::composer` in `AppServiceProvider` — eliminates N+1
- Custom editor built from scratch — zero external dependencies, ~12 KB JS
- Media files stored on `public` disk so symlink serves them correctly
- `Str::slug()` fallback guards against empty slugs from Bangla-only titles (applied in `ArticleController` + `ArchiveDocumentController`)
- `View::composer` used for header/footer category nav — one query shared across all pages instead of inline `@foreach(\App\Models\Category::…)`
- Frontend homepage logic moved to `HomeController` — Blade no longer contains inline queries
- Global `input/select/textarea` CSS rule in `.dark` avoids need to add `dark:bg-*` to every form element across all admin and frontend views
- Category topic nav uses horizontal scroll (`overflow-x-auto scrollbar-none`) instead of wrapping or dropdown — keeps all categories visible on any screen width
- Global `.dark .border-[#e0e0e0]` CSS rule handles ALL admin/frontend borders automatically — no need for `dark:border-[#333]` on every instance

## Next Steps
1. Add loading/disabled state on all form submit buttons
2. Consider comprehensive E2E test suite for admin CRUD operations

## Critical Context
- PHP 8.2.12, Laravel 12.61.0, MySQL, XAMPP
- `MAIL_MAILER=log` — all emails go to `storage/logs/laravel.log`
- Admin user: `admin@penews.com` / `admin123`, has `is_editor=true`
- Frontend built via Vite + Tailwind v4 with `@custom-variant dark`
- Article status enum: `draft`, `submitted`, `published`, `scheduled`, `archived`
- Schedule: `php artisan articles:publish-scheduled` registered in `bootstrap/app.php`
- Settings stored as key-value — no `.env` modification
- Sitemap auto-generates at `/sitemap.xml`; robots.txt editable from admin, served at `/robots.txt`
- RedirectMiddleware registered globally in `bootstrap/app.php`
- Editor auto-initialized on any `<textarea data-editor>` via `custom-editor.js` in `resources/js/app.js`
- Media library modal functions (`openMediaLibraryForEditor`, etc.) defined in `<x-head.editor-config/>` component
- Editor image button calls `window.mediaEditorCallback(url)` — shared for editor insertion and featured image URL field
- Frontend category nav and footer categories both use `View::composer` in `AppServiceProvider` — passes `$navCategories` and `$footerCategories`
- Homepage uses `HomeController::index` route — not a Closure route anymore
- Breaking news ticker uses CSS `@keyframes ticker` animation with `ticker-track` class — pauses on hover
- Article page has sticky share sidebar on desktop (LG+) via `sticky top-24` positioning
- YouTube ID extraction regex: `/(?:youtube\.com\/(?:watch\?v=|embed\/|v\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/`
- `image_url` column in `advertisements` table is now TEXT type (migration run) — accommodates long placehold.co URLs
- Vite build clean with no warnings (Google Fonts loaded via `<link>` in layout, not CSS `@import`)
- Homepage uses `.reveal` CSS class + `IntersectionObserver` for scroll-reveal animations, `.hover-border` for card hover effect, `.breaking-pulse` for breaking badge animation
- Homepage slider has touch/swipe support, keyboard navigation (← →), autoplay progress bar animation

## Relevant Files
- `resources/js/custom-editor.js`: full `CustomEditor` class (~300 lines) with toolbar, execCommand, source toggle, fullscreen, link dialog, image callback
- `resources/views/components/head/editor-config.blade.php`: global media library functions
- `resources/views/admin/articles/create.blade.php` + `edit.blade.php`: use `<textarea data-editor>` and `<x-head.editor-config/>`
- `resources/views/components/icon.blade.php`: 40+ reusable SVG icons
- `resources/css/app.css`: CSS variable system, `.dark` overrides, `.custom-editor-*` classes, `sidebar-link`, `admin-card`, `badge-*`, `btn-*`, `admin-input`, `admin-select`, `admin-table-header`, `admin-hover-row`, **frontend styles** (`section-label`, `section-rule`, `article-body`, `ticker-track`, `scrollbar-none`, `pagination` print styles)
- `resources/views/layouts/admin.blade.php`: dark mode toggle, `@stack('editor')` before `</head>`
- `resources/views/layouts/app.blade.php`: frontend layout — `dark:bg dark:text` on body, max-w-7xl main
- `resources/views/layouts/guest.blade.php`: guest layout — dark mode body classes added
- `resources/views/layouts/staff.blade.php`: staff layout — full dark mode with sidebar/header/main
- `resources/views/admin/partials/sidebar.blade.php`: emoji-free, SVG icons, `View::composer` counts
- `resources/views/admin/posts/index.blade.php`: 5 status tabs, bulk actions, quick AJAX toggles
- `resources/views/partials/header.blade.php`: primary nav + **category topic nav bar** + mobile menu with categories + dark mode toggle JS
- `resources/views/partials/footer.blade.php`: redesigned footer with social, copyright
- `resources/views/home.blade.php`: refactored to use `layouts.app`, breaking ticker, lead+featured hero, category sections, sidebar (most-read + newsletter)
- `resources/views/article/show.blade.php`: sticky share sidebar (desktop), inline share (mobile), avatar comments, article-body typography, related grid, print-friendly
- `resources/views/article/category.blade.php`: featured first article spanning 2 cols, 3-col grid
- `resources/views/search/index.blade.php`: dark mode inputs, card results, empty state
- `resources/views/archive/index.blade.php`: document cards with file icon, download, filter form
- `resources/views/dashboard/index.blade.php`: stats grid, saved articles + comments
- `resources/views/auth/login.blade.php` + `register.blade.php` + `verify-email.blade.php`: user auth pages with full dark mode
- `resources/views/staff/index.blade.php` + `articles/*.blade.php`: staff portal with full dark mode
- `resources/views/admin/login.blade.php`: admin login — dark mode classes on card/inputs/button
- `resources/views/vendor/pagination/tailwind.blade.php` + `simple-tailwind.blade.php`: custom styled pagination
- `app/Http/Controllers/HomeController.php`: homepage logic extracted from Blade — lead, featured, breaking, most-read, categories with articles
- `app/Http/Controllers/Admin/AuthController.php`: login fixed to allow `is_editor` users, showLoginForm redirects editors to dashboard
- `app/Http/Controllers/Admin/PostController.php`: status-only filters, `toggleFlag()`, `updateStatus()`, dedicated methods
- `app/Http/Controllers/Admin/ArticleController.php`: full CRUD, slug fallback, conditional `published_at` validation
- `app/Http/Controllers/Admin/MediaController.php`: `public` disk, JSON endpoint
- `app/Http/Controllers/Admin/SeoController.php`: emoji-free issue data
- `app/Http/Controllers/Admin/DashboardController.php`: N+1 fixed
- `app/Http/Controllers/Admin/ArchiveDocumentController.php`: slug fallback fixed
- `app/Http/Controllers/Admin/SearchController.php`: search with category/district/date filters
- `app/Http/Controllers/Admin/UsersController.php`: admin user management with role/active toggle
- `app/Models/Media.php`: `url` and `thumbnail` accessors
- `app/Providers/AppServiceProvider.php`: `View::composer` for sidebar counts, header categories (`$navCategories`), footer categories (`$footerCategories`)
- `routes/web.php`: 80+ routes, `HomeController::index` for `/`
- `database/migrations/2026_06_03_070000_add_submitted_to_articles_status.php`: adds `submitted` to articles.status enum
