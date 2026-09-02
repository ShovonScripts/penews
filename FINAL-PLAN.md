# PEN News Portal — Final Implementation Plan

## Environment
- PHP 8.2.12 | Composer 2.9.5 | Laravel 11.x | MySQL (XAMPP) | Node 24 + npm 11
- OS: Windows | Server: XAMPP Apache

---

## Phase 1 — Foundation (Steps 1-4)
| Step | Task | Details |
|------|------|---------|
| 1 | Install Laravel 11 | `laravel new penews` — no starter kit, no teams |
| 2 | Configure .env | Database (MySQL `penews_db`), app URL, Bangla locale |
| 3 | Auth system | Custom: mobile OTP (passwords) + Google login. Laravel Breeze + socialite |
| 4 | Layout & theme | NYT-inspired: Blade layouts, Playfair Display + Hind Siliguri, black/red/white |

## Phase 2 — Core Content (Steps 5-8)
| Step | Task | Details |
|------|------|---------|
| 5 | Database schema | All migrations: users, articles, categories, districts, etc. |
| 6 | Article system | CRUD, rich text, featured images, categories, districts, slugs |
| 7 | Homepage | Hero cluster, category sections, sidebar (most-read, events, district filter) |
| 8 | Category & Archive pages | Category listing, archive with year/subcategory filters |

## Phase 3 — Features (Steps 9-13)
| Step | Task | Details |
|------|------|---------|
| 9 | Search | Full-text Bangla+English, filters |
| 10 | Training Hub | Courses, lessons, progress bar, quizzes, PDF certificates |
| 11 | Events Calendar | Monthly view, district filter, iCal export |
| 12 | Opinion Section | Teacher submissions, editorial review, distinct layout |
| 13 | Comments | Moderated, login-only, upvotes |

## Phase 4 — Polish (Steps 14-18)
| Step | Task | Details |
|------|------|---------|
| 14 | Newsletter | Weekly digest, WhatsApp broadcast |
| 15 | Notifications | Push + in-app bell |
| 16 | Admin Panel | Dashboard, content management, analytics |
| 17 | Extras | PWA, dark mode, print view, social sharing, district filter |
| 18 | SEO & Performance | Meta tags, WebP, SSR, sitemap |

---

## Design Constants

**Colors:** `#0d0d0d` (black), `#E02020` (red accent), `#ffffff` (white bg), `#f5f5f5` (light gray), `#1a1a1a` (body text), `#999` (metadata), `#e0e0e0` (borders)

**Typography:** Playfair Display (headlines), Hind Siliguri (Bangla body), line-height 1.9

**Grid:** 12-column CSS grid (NYT-style flexible), single column on mobile

**NYT Design DNA:** Typography-driven, whitespace-heavy, minimal color, section rules, "লাইভ" badges not bars, centered article body, sticky share rail
