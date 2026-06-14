Ready to code?

 Here is Claude's plan:╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌
 Deep SEO Plan — Sador General Construction
 Context

 A baseline SEO pass already exists: per-page <title> + @yield('meta_description'), Open Graph,
 Twitter cards, canonical, theme-color, one GeneralContractor JSON-LD block
 (resources/views/layouts/main.blade.php), and dynamic /sitemap.xml + /robots.txt (routes/web.php).
 Alt text, heading hierarchy, and a custom 404 are already good.

 This plan covers the deeper layer: per-page social images, richer structured data (so Google can show
 rich results / a knowledge panel), sitemap freshness signals, measurement (Analytics + Search
 Console), installable icons, and light performance wins. Goal: maximize how well the site is
 understood and ranked by search engines, without fabricating data.

 Decisions (chosen for you)

 - Analytics/Search Console: wired via .env config, inert until IDs are added. No tracking happens
 until you paste real IDs.
 - Social profiles: omitted from schema sameAs (no real URLs yet); footer # links left as-is.
 - Images: keep JPGs; add width/height to key images to cut layout shift (CLS). No WebP/srcset this
 pass.

 ---
 Work items

 1. Per-project Open Graph image  (why: correct thumbnail when a project link is shared)

 resources/views/project-details.blade.php — add after the existing title/description sections:
 @section('og_image', $project->cover_url)
 Title ($project->title) and meta description are already dynamic — only the image is missing.

 2. Reusable JSON-LD stack  (why: per-page structured data without duplicating the layout)

 - In main.blade.php <head>, add @stack('schema') once.
 - Pages push page-specific JSON-LD via @push('schema') ... @endpush.

 3. Enrich the site-wide Organization schema — main.blade.php

 Extend the existing GeneralContractor block with:
 - geo (Addis Ababa: lat 9.0042, lng 38.7835 — from the maps embed already in settings),
 - openingHoursSpecification (Mon–Sat 08:00–17:30, from the footer/working hours),
 - priceRange, telephone second number, email, areaServed: ET.
 - Skip aggregateRating on the Organization (Google flags self-serving ratings).

 4. BreadcrumbList schema  (why: breadcrumb rich result in Google)

 - project-details.blade.php: push BreadcrumbList → Home › Projects › {project title}.
 - projects.blade.php: push BreadcrumbList → Home › Projects.

 5. Service + ItemList schema — services.blade.php  (why: richer services listing)

 Push an ItemList of Service items (name + description) built from the $services collection already
 passed to the view.

 6. Per-project richer markup — project-details.blade.php

 Push a lightweight CreativeWork/WebPage node (name, image=cover_url, description,
 dateCreated=$project->year, locationCreated=$project->location, provider=Organization). Keep it
 factual — no ratings.

 7. Sitemap freshness — routes/web.php (/sitemap.xml)

 Add <lastmod> (use $project->updated_at->toAtomString() for project URLs; a passed-in build date for
 static pages) and <changefreq> (weekly for listings, monthly for projects). Keep priorities.

 8. Analytics + Search Console (env-driven, inert)

 - config/services.php: add 'google' => ['analytics_id' => env('GOOGLE_ANALYTICS_ID'),
 'site_verification' => env('GOOGLE_SITE_VERIFICATION')].
 - .env.example: document GOOGLE_ANALYTICS_ID= and GOOGLE_SITE_VERIFICATION= (empty).
 - main.blade.php: @if(config('services.google.site_verification')) → verification <meta>;
 @if(config('services.google.analytics_id')) → GA4 gtag snippet. Both render nothing while empty.

 9. Icons + web manifest  (why: installable/mobile presentation, minor SEO/PWA signal)

 - public/site.webmanifest (name, short_name, theme #003087, background, icon = logo.png).
 - main.blade.php: add apple-touch-icon, <link rel="manifest">, keep theme-color. Reuse
 images/logo.png; add favicon.ico copy.

 10. OG/Twitter polish + geo meta — main.blade.php

 Add og:image:alt, twitter:image:alt, og:image:width/height, and geo.region/geo.placename meta. Small,
 high-confidence additions.

 11. Light performance — main.blade.php + key views

 - Make AOS CSS non-render-blocking (preload + onload swap).
 - Add width/height to hero + card images to reduce CLS.

 12. (Optional) Branded error pages

 resources/views/errors/500.blade.php, 503.blade.php, 403.blade.php mirroring the existing 404 style.
 Low SEO impact; nice-to-have.

 ---
 Files touched

 - resources/views/layouts/main.blade.php (head: schema stack, enriched Org schema,
 analytics/verification, icons/manifest, OG/geo meta, AOS preload)
 - resources/views/project-details.blade.php (og_image, breadcrumb + project schema)
 - resources/views/projects.blade.php (breadcrumb schema)
 - resources/views/services.blade.php (service ItemList schema)
 - routes/web.php (sitemap lastmod/changefreq)
 - config/services.php, .env.example (analytics/verification config)
 - public/site.webmanifest, public/favicon.ico (new)
 - Optional: resources/views/errors/{500,503,403}.blade.php

 Production note

 Set APP_URL to the real domain in production .env — canonical, og:url, and the sitemap all derive
 absolute URLs from it.

 Verification

 1. php -l on PHP files.
 2. php artisan serve then curl home, a project detail, /services, /sitemap.xml:
   - confirm each JSON-LD block is present and valid (paste into Google Rich Results Test).
   - project detail og:image = that project's cover.
   - sitemap entries now include <lastmod>.
 3. With empty env vars, confirm no gtag/verification markup renders; set a dummy GOOGLE_ANALYTICS_ID
 and confirm the snippet appears.
 4. Confirm /site.webmanifest and /favicon.ico return 200.
 5. All public pages still 200.
╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌╌
─────────────────────────────────────────────────────────────────────────────────────────────────────── Claude has written up a plan and is ready to execute. Would you like to proceed?

 ❯ 1. Yes, and use auto mode
   2. Yes, manually approve edits
   3. Tell Claude what to change
      shift+tab to approve with this feedback

 ctrl+g to edit in  Notepad  · ~\.claude\plans\purring-prancing-marshmallow.md