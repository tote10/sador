# SEO Setup & Deployment Guide — Sador General Construction

This document explains **what SEO work is already built into the site (by code)** and **what you still need to do manually** (the parts only you can do, because they need your real domain and Google account). It ends with a **deployment checklist**.

---

## Part 1 — What's already done (in the code)

These are live in the project. You don't need to touch them; they work automatically.

### Baseline (earlier commit)
- **Per-page `<title>` and meta descriptions** — every page has its own title and search-result description.
- **Open Graph + Twitter cards** — link previews when the site is shared on Facebook, WhatsApp, Telegram, LinkedIn, X.
- **Canonical URLs** — tells Google the "official" URL of each page (avoids duplicate-content issues).
- **`robots.txt`** (dynamic, at `/robots.txt`) — allows search engines, blocks `/admin` and `/login`, points to the sitemap.
- **`sitemap.xml`** (dynamic, at `/sitemap.xml`) — lists every public page + every published project.
- **One `GeneralContractor` JSON-LD block** — structured data describing the business to Google.
- Good alt text, heading structure, and a custom 404 page.

### Deeper layer (this round of work)
- **Per-project social image** — sharing a specific project link now shows *that project's* cover photo, not a generic one.
- **Reusable schema stack** — pages can inject their own structured data cleanly.
- **Enriched Organization schema** — now includes geo coordinates (Addis Ababa), opening hours (Mon–Sat 08:00–17:30), price range, both phone numbers, email, and service area.
- **Breadcrumb structured data** — on Projects and project detail pages (can produce breadcrumb rich results in Google).
- **Service list structured data** — the Services page exposes a machine-readable list of your services.
- **Per-project structured data** — each project detail page describes itself (name, image, year, location, provider).
- **Sitemap freshness** — every sitemap entry now has `<lastmod>` (last-updated date) and `<changefreq>`.
- **Geo meta tags** — region/coordinates for local search.
- **Icons + web manifest** — `site.webmanifest`, apple-touch-icon, favicon (installable / better mobile presentation).
- **Performance** — the animation CSS (AOS) no longer blocks page rendering.
- **Analytics + Search Console hooks** — wired and ready, but **inert until you add your IDs** (see Part 2). No tracking happens until then.

---

## Part 2 — What YOU need to do (manual, one-time)

The code can't do these for you because they require your real domain and a Google account.

### 1. Set the real domain in production `.env` ⚠️ REQUIRED
On the live server, edit `.env`:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```
**Why it matters:** canonical tags, the sitemap, and social-share URLs are all built from `APP_URL`. If it's wrong, Google indexes broken links. `APP_DEBUG=false` is also a security requirement (otherwise errors leak internal details).

### 2. Google Search Console (most important) — free
This is how Google reports how your site is doing: what you rank for, impressions, clicks, indexing errors.
1. Go to <https://search.google.com/search-console> and add your domain.
2. Choose verification → it gives you a code.
3. Put it in `.env`:
   ```env
   GOOGLE_SITE_VERIFICATION=the-code-they-give-you
   ```
4. Deploy / clear cache, then finish verification in Search Console.
5. In Search Console, submit your sitemap: `https://yourdomain.com/sitemap.xml`

### 3. Google Analytics 4 (visitor stats) — free, optional
1. Create a GA4 property at <https://analytics.google.com> → get a Measurement ID like `G-XXXXXXXXXX`.
2. Put it in `.env`:
   ```env
   GOOGLE_ANALYTICS_ID=G-XXXXXXXXXX
   ```
3. Done — the tracking snippet activates automatically.

### 4. Google Business Profile (BIGGEST win for a construction company) — free
Construction is a *local* business. This is what makes you appear in Google Maps and the local "businesses near me" results — often more valuable than the website for getting calls.
- Create it at <https://business.google.com>
- Add: real address (Addis Ababa), phone numbers, hours, service area, and lots of project photos.
- Keep the name/address/phone **identical** to what's on the website.

### 5. Optional extras
- **Bing Webmaster Tools** (<https://www.bing.com/webmasters>) — same as Search Console, for Bing.
- Get listed on Ethiopian business directories with consistent name/phone/address.
- Add real social media profile URLs to the footer (currently placeholder `#` links).

---

## Part 3 — How to check if the SEO is working

| Tool | What it checks | URL |
|------|----------------|-----|
| **Rich Results Test** | Is the structured data valid? | <https://search.google.com/test/rich-results> |
| **PageSpeed Insights** | SEO score + speed + layout shift | <https://pagespeed.web.dev> |
| **Search Console** | Real rankings, clicks, indexing | <https://search.google.com/search-console> |
| **Mobile-Friendly check** | Inside PageSpeed / Search Console | — |

**Reality check:** SEO is not instant. After deploying and submitting the sitemap, Google takes **days to a few weeks** to crawl and start ranking pages. Don't expect same-day results.

---

## Part 4 — Deployment checklist (shared cPanel hosting / Yegara)

Run/verify these when deploying to the live server:

- [ ] Upload project files (exclude `node_modules`, `.env`, local `database/database.sqlite`).
- [ ] Create the live `.env` with production values (see Part 2.1) + a generated `APP_KEY` (`php artisan key:generate`).
- [ ] Set up the **MySQL database** in cPanel and put the credentials in `.env` (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, `DB_HOST=localhost`).
- [ ] `composer install --no-dev --optimize-autoloader`
- [ ] `npm install && npm run build` (or upload the local `public/build` folder).
- [ ] `php artisan migrate --force`
- [ ] `php artisan db:seed --force` (only if you want the seeded starter content).
- [ ] `php artisan storage:link` (so uploaded project/service images at `/storage/...` work). On some shared hosts symlinks are restricted — if so, ask Yegara support or use a manual copy.
- [ ] Point the domain's document root to the **`/public`** folder (Laravel requirement). If cPanel won't allow it, use the standard public_html→public workaround.
- [ ] Cache for production:
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```
- [ ] Confirm HTTPS is active (SSL) — Google ranks secure sites higher and OG/canonical use `https`.
- [ ] Visit `/sitemap.xml` and `/robots.txt` on the live domain to confirm they return real URLs.

---

## Quick summary

- ✅ **Code/technical SEO: done.** Nothing more to write for the baseline.
- ⬜ **Your manual steps:** set `APP_URL` + production env, Search Console, (optional) Analytics, and **Google Business Profile**.
- ⏳ **Then wait** — Google needs time to crawl and rank.
