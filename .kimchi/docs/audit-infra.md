# Laravel Infrastructure Audit Report

## Critical Issues

### Security Vulnerabilities

**File: .env**
- **Line:** APP_DEBUG=true
- **Severity:** Critical
- **Category:** Security
- **Description:** APP_DEBUG is set to true in environment configuration. This exposes sensitive debugging information and stack traces to users in production environments, which can lead to information disclosure and potential security vulnerabilities.
- **Suggested Fix:** Set APP_DEBUG=false in production environments. Use environment-specific configuration to ensure debug is only enabled in local/development environments.

**File: .env**
- **Line:** DB_PASSWORD= (empty)
- **Severity:** Critical
- **Category:** Security
- **Description:** Database root password is empty, which allows unrestricted access to the database server. This is a critical security vulnerability that could lead to complete data breach.
- **Suggested Fix:** Set a strong, unique password for the database user and update the DB_PASSWORD field in .env.

**File: .env**
- **Line:** MAIL_PASSWORD="anarjo%shofiq"
- **Severity:** Critical
- **Category:** Security
- **Description:** Mail password is hardcoded in the .env file. While .env files are not committed, this represents a credential that should be rotated regularly and managed through proper secret management systems.
- **Suggested Fix:** Rotate the mail password immediately and consider using Laravel's encrypted credentials or a secret management service for production.

## High Issues

### Missing Rate Limiting on Public Endpoints

**File: routes/web.php**
- **Line:** Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
- **Severity:** High
- **Category:** Security
- **Description:** Public POST endpoint for contact form lacks rate limiting, allowing potential spam and abuse through unlimited submission attempts.
- **Suggested Fix:** Add rate limiting middleware to the contact form route: `Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:5,1');`

**File: routes/web.php**
- **Line:** Route::post('/register', [AuthController::class, 'register']);
- **Severity:** High
- **Category:** Security
- **Description:** Public user registration endpoint lacks rate limiting, enabling account creation spam and potential resource exhaustion.
- **Suggested Fix:** Add rate limiting to registration route: `Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:3,5');`

**File: routes/web.php**
- **Line:** Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
- **Severity:** High
- **Category:** Security
- **Description:** Public login endpoint lacks rate limiting, making it vulnerable to brute force attacks.
- **Suggested Fix:** Add rate limiting to login route: `Route::post('/login', [AuthController::class, 'login'])->name('login.attempt')->middleware('throttle:5,1');`

### Missing Indexes on Frequently Queried Columns

**File: database/migrations/2026_06_03_042003_create_articles_table.php**
- **Line:** Schema::create('articles', function (Blueprint $table) {
- **Severity:** High
- **Category:** Performance
- **Description:** Articles table lacks indexes on frequently queried columns: status, is_breaking, is_featured, is_editor_pick, published_at. This will cause slow query performance as the table grows.
- **Suggested Fix:** Add indexes: 
  ```php
  $table->index('status');
  $table->index('is_breaking');
  $table->index('is_featured');
  $table->index('is_editor_pick');
  $table->index('published_at');
  ```

**File: database/migrations/2026_06_03_052628_create_page_views_table.php**
- **Line:** Schema::create('page_views', function (Blueprint $table) {
- **Severity:** High
- **Category:** Performance
- **Description:** Page views table lacks indexes on polymorphic columns (viewable_id, viewable_type) and timestamp column (created_at), which are critical for analytics queries.
- **Suggested Fix:** Add indexes:
  ```php
  $table->index(['viewable_type', 'viewable_id']);
  $table->index('created_at');
  $table->index('ip');
  ```

### Missing Unique Constraints

**File: database/migrations/2026_06_03_042010_create_newsletter_subscribers_table.php**
- **Line:** Schema::create('newsletter_subscribers', function (Blueprint $table) {
- **Severity:** High
- **Category:** Bug
- **Description:** Newsletter subscribers table lacks unique constraints on email (for email channel) and phone (for whatsapp channel), allowing duplicate subscriptions which could lead to sending multiple messages to the same user.
- **Suggested Fix:** Add partial unique indexes:
  ```php
  $table->unique('email', 'newsletter_subscribers_email_unique')->whereNull('unsubscribed_at')->where('channel', 'email');
  $table->unique('phone', 'newsletter_subscribers_phone_unique')->whereNull('unsubscribed_at')->where('channel', 'whatsapp');
  ```

### Missing Names on Routes

**File: routes/web.php**
- **Line:** Route::post('/register', [AuthController::class, 'register']);
- **Severity:** High
- **Category:** Config
- **Description:** User registration POST route is missing a name, making it impossible to reference via route() helper or generate URLs programmatically.
- **Suggested Fix:** Add a name: `Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');`

## Medium Issues

### Missing Soft Deletes Where Appropriate

**File: database/migrations/2026_06_03_042004_create_comments_table.php**
- **Line:** Schema::create('comments', function (Blueprint $table) {
- **Severity:** Medium
- **Category:** Config
- **Description:** Comments table does not use soft deletes, which may be inappropriate if comment deletion needs to be reversible or auditable.
- **Suggested Fix:** Consider adding soft deletes: `$table->softDeletes();` if business requirements call for recoverable comment deletion.

**File: database/migrations/2026_06_03_042008_create_archive_documents_table.php**
- **Line:** Schema::create('archive_documents', function (Blueprint $table) {
- **Severity:** Medium
- **Category:** Config
- **Description:** Archive documents table lacks soft deletes, which may be needed for recoverable document deletion.
- **Suggested Fix:** Consider adding soft deletes: `$table->softDeletes();`

### Incomplete Foreign Key Constraints

**File: database/migrations/2026_06_03_052628_create_media_table.php**
- **Line:** $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
- **Severity:** Medium
- **Category:** Bug
- **Description:** Media table's uploaded_by foreign key uses nullOnDelete() which sets the field to NULL when user is deleted. This may not be the desired behavior - consider whether media should be deleted or retained when user is removed.
- **Suggested Fix:** Review business requirements and change to cascadeOnDelete() or restrict() as appropriate.

### Missing Default Values

**File: database/migrations/2026_06_03_042006_create_training_tables.php**
- **Line:** $table->integer('total_duration_minutes')->nullable();
- **Severity:** Medium
- **Category:** Bug
- **Description:** Courses table has nullable total_duration_minutes without a default, which may cause issues if code expects an integer value.
- **Suggested Fix:** Add a default value: ->default(0);

## Low Issues

### Inconsistent Timestamps Usage

**File: database/migrations/2026_06_03_050621_create_staff_table.php**
- **Line:** $table->timestamps();
- **Severity:** Low
- **Category:** Config
- **Description:** Staff table only has timestamps without specifying useCurrent() or other options. While functional, being explicit improves clarity.
- **Suggested Fix:** Consider being explicit: $table->timestamps(); (current implementation is acceptable)

### Missing Comment on Migration Purpose

**File: database/migrations/2026_06_03_070000_add_submitted_to_articles_status.php**
- **Line:** DB::statement("ALTER TABLE articles MODIFY COLUMN status ENUM('draft', 'published', 'scheduled', 'submitted', 'archived') DEFAULT 'draft'");
- **Severity:** Low
- **Category:** Config
- **Description:** Migration lacks explanatory comment about why 'submitted' status is being added, making future maintenance harder to understand.
- **Suggested Fix:** Add a comment explaining the business reason for the 'submitted' status.

### Environment Example Not Reflecting Production

**File: .env.example**
- **Line:** APP_DEBUG=true
- **Severity:** Low
- **Category:** Config
- **Description:** Example environment file shows APP_DEBUG=true, which may mislead developers about appropriate production settings.
- **Suggested Fix:** Update .env.example to show APP_DEBUG=false to reflect proper production defaults.

### Missing Mail Configuration Validation

**File: config/mail.php** (not directly audited but implied from .env)
- **Severity:** Low
- **Category:** Config
- **Description:** Mail configuration uses encryption setting that may be redundant. MAIL_ENCRYPTION=ssl is set while MAIL_SCHEME=ssl is also set - one may be sufficient.
- **Suggested Fix:** Review mail configuration to remove redundant settings.

## Summary

The audit revealed several critical security issues primarily related to environment configuration (debug mode enabled, empty database password) that require immediate attention. High-priority issues include missing rate limiting on public endpoints and performance concerns due to missing database indexes. Medium and low issues cover areas like missing constraints, inconsistent timestamp usage, and documentation improvements.

**Immediate Actions Required:**
1. Set APP_DEBUG=false in production
2. Set a strong database password
3. Rotate the mail password
4. Implement rate limiting on public POST endpoints
5. Add necessary database indexes for performance
