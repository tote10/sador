---
name: Sador DB Admin v1
overview: Final blueprint to move from mock data + Unsplash to real MySQL content and admin uploads. Public site stays the same design; visitors never need accounts. We implement phase by phase together—you run commands and verify each step before the next.
todos:
  - id: phase-a-foundation
    content: "Phase A — Foundation (together): MySQL/.env, is_admin, migrations, models, AdminMiddleware, /admin shell, disable register, storage:link, seed admin user"
    status: pending
  - id: phase-b-projects
    content: "Phase B — Projects (together): admin CRUD + multi-image upload, public pages from DB, category-only filter, remove ProjectHelper"
    status: pending
  - id: phase-c-messages
    content: "Phase C — Contact & messages (together): messages table, wire contact form, admin inbox"
    status: pending
  - id: phase-d-services
    content: "Phase D — Services (together): services table, admin CRUD, public /services + home preview from DB"
    status: pending
  - id: phase-e-vacancies
    content: "Phase E — Vacancies & applicants (together): tables, apply form + CV, admin list + status"
    status: pending
  - id: phase-f-testimonials-awards
    content: "Phase F — Testimonials & awards (together): tables, admin CRUD, home sections from DB"
    status: pending
  - id: phase-g-settings
    content: "Phase G — Settings (together): company info, hero images, footer/contact from settings"
    status: pending
  - id: phase-h-polish
    content: "Phase H — Polish (together): SEO meta, CSV export, security hardening, deployment checklist"
    status: pending
isProject: false
---

# Sador — Database & Admin Master Plan

*(Planning locked — we code step by step together; no phase starts until you say so.)*

---

## How we work together (important)

| Rule | What it means |
|------|----------------|
| One phase at a time | Finish and test Phase A before Phase B |
| You run commands | I give exact steps; you run `php artisan`, check browser, report errors |
| I explain before each chunk | What file, why, what you should see after |
| You say **START PHASE X** | That is the only signal to begin coding that phase |
| No surprise big dumps | Small commits/steps per session |

**To begin implementation, reply:** `START PHASE A`

---

## 1. Big picture — what changes

| Today | After database + admin |
|--------|-------------------------|
| Projects in [`app/Helpers/ProjectHelper.php`](app/Helpers/ProjectHelper.php) | `projects` + `project_images` tables |
| Services / awards / testimonials hardcoded in Blade | Same content in DB, edited in admin |
| Images = Unsplash URLs | Files uploaded in admin → `storage/app/public/` |
| Contact form goes nowhere | Saved in `messages`, visible in admin inbox |
| Apply = link to contact | Real apply form → `applicants` + CV file |
| `/dashboard` = Breeze default | `/admin` = Sador control panel |
| Change content = edit code | Change content = admin forms |

**End state:** Public pages keep the **same design**. Only the **data source** changes. `ProjectHelper` is removed after Phase B when real uploads are in place.

---

## 2. Architecture — how everything connects

```mermaid
flowchart TB
    subgraph public [Public Website]
        Home[Home /]
        Projects[/projects]
        Detail[/projects/slug]
        Services[/services]
        Contact[/contact POST]
        Vacancies[/vacancies + apply]
    end
    subgraph admin [Admin Panel /admin]
        Login[Login]
        Dash[Dashboard]
        CRUD[CRUD Screens]
        Upload[File Uploads]
    end
    subgraph storage [Storage]
        MySQL[(MySQL)]
        Files[storage/app/public]
    end
    public --> MySQL
    public --> Files
    admin --> MySQL
    Upload --> Files
    Login --> MySQL
```

**What code will do (high level):**

- **Migrations** — create tables
- **Models** — relationships (e.g. Project has many ProjectImages)
- **Controllers** — load/save data, handle uploads
- **Admin views** — simple forms and lists
- **Public controllers** — replace mock arrays with DB queries (same Blade templates)
- **Seeders** — one-time copy of text from `ProjectHelper` (images uploaded by you in admin)

---

## 3. Who can access what

| Area | URL | Who |
|------|-----|-----|
| Public site | `/`, `/projects`, `/contact`, etc. | Everyone — **no login** |
| Register | `/register` | **Disabled** in v1 |
| Login | `/login` or `/admin/login` | Admin staff only |
| Admin panel | `/admin/*` | Logged-in user with `is_admin = true` |
| Old dashboard | `/dashboard` | Redirect to `/admin` or remove |

### Why `users` table still exists

Visitors **never** need an account. `users` is **only** for Sador staff who manage the site (like a key to the back office).

### Admin not visible on public website

- No Admin link in [`resources/views/components/navbar.blade.php`](resources/views/components/navbar.blade.php) or footer
- Bookmark `/admin/login` privately
- **`AdminMiddleware`** on every `/admin/*` route (`auth` + `is_admin`)

---

## 4. Database — every table (v1)

### 4.1 `users` (exists — extend)

| Column | Purpose |
|--------|---------|
| id, name, email, password | Breeze login |
| **is_admin** | boolean — only `true` can access admin |

### 4.2 `projects` (simplified — your spec)

| Column | Type | Required | Used for |
|--------|------|----------|----------|
| id | auto | yes | internal |
| title | string | yes | title, SEO title |
| slug | string unique | yes | `/projects/{slug}` |
| category | string | yes | badge + **only public filter** |
| location | string | yes | cards + detail |
| year | string | yes | display on detail/cards |
| budget | string | yes | detail specs |
| duration | string | yes | detail specs |
| client_name | string | yes | detail specs |
| status | string | yes | e.g. Completed / Ongoing |
| description | longtext | yes | full description on detail |
| is_featured | boolean | yes | home page (max 6) |
| is_published | boolean | yes | hide drafts from public |
| created_at, updated_at | timestamps | yes | default sort newest first |

**Filtering (locked):** Public [`projects.blade.php`](resources/views/projects.blade.php) uses **category only** (Commercial, Residential, Infrastructure, All). Remove year and location dropdown filters when we wire DB.

**Optional detail content (Phase B+ — not in v1 table unless you want later):**

Current detail page shows challenges, solutions, testimonial. Options:

- **A)** Fold into `description` for v1 (simplest admin form), or
- **B)** Add `challenges`, `solutions`, `testimonial_quote`, `testimonial_name`, `testimonial_role` on admin Tab 2 (keeps current detail layout)

*Default for v1 unless you change before Phase B: **Option B** on Tab 2 so public detail page does not lose sections.*

**Not in v1:** `scale`, `city`, `meta_*`, `project_videos`, year/location filters.

### 4.3 `project_images`

| Column | Purpose |
|--------|---------|
| id | |
| project_id | FK → projects |
| image_path | relative path under `projects/images/` |
| sort_order | gallery order |
| is_cover | main thumbnail + detail hero |

**Image rules (explicit):**

- Upload: jpg/png/webp only, max size enforced
- Delete image: remove DB row + delete file on disk
- Delete project: delete all images + files
- Reorder in admin; public uses `Project::with('images')` eager load

### 4.4 `services`

| Column | Purpose |
|--------|---------|
| id | |
| title | |
| slug | optional future detail URL |
| short_description | home preview |
| full_description | services page |
| image_path | one main image |
| is_featured | home (grow to 6 later) |
| is_published | |
| sort_order | optional |

### 4.5 `vacancies`

| Column | Purpose |
|--------|---------|
| id | |
| title, type, location, experience, education, salary | job card |
| description | full text |
| is_open | hide when closed |
| timestamps | |

### 4.6 `applicants`

| Column | Purpose |
|--------|---------|
| id | |
| vacancy_id | nullable FK |
| full_name, phone, email, message | |
| cv_path | `applicants/cvs/` |
| status | new, reviewed, interviewed, hired |
| created_at | |

### 4.7 `messages`

| Column | Purpose |
|--------|---------|
| id | |
| name, phone, email | |
| service_requested | |
| message | |
| is_read | admin inbox |
| created_at | |

### 4.8 `testimonials`

| Column | Purpose |
|--------|---------|
| id | |
| client_name, position, quote | |
| photo_path | |
| rating | 1–5 |
| is_published, sort_order | |

### 4.9 `awards`

| Column | Purpose |
|--------|---------|
| id | |
| title, year, organization, description | |
| logo_path | |
| is_published, sort_order | |

### 4.10 `settings` (key-value)

| Key examples | Purpose |
|--------------|---------|
| company_name, company_phone, company_email, company_address, working_hours | contact + footer |
| hero_images | JSON array of up to 4 paths |
| google_maps_embed | contact map |
| whatsapp_number | floating button (Phase H) |
| default_meta_description | SEO fallback |

---

## 5. File storage

```
storage/app/public/
├── projects/images/
├── services/images/
├── testimonials/
├── awards/
└── applicants/cvs/
```

After setup: `php artisan storage:link` once → public URL `/storage/projects/images/xxx.jpg`

---

## 6. Admin panel (hidden from public site)

| Section | Purpose |
|---------|---------|
| Dashboard | stats + recent messages/applicants |
| Projects | CRUD + multi-image upload, cover, reorder |
| Services | CRUD + image |
| Vacancies | CRUD + open/close |
| Testimonials | CRUD + photo |
| Awards | CRUD + logo |
| Messages | inbox, mark read |
| Applicants | list, download CV, change status |
| Settings | company + hero images |

**UX:** Short forms, success flashes, validation errors, no jargon.

---

## 7. Implementation phases (your order A–H)

### Phase A — Foundation

**Goal:** MySQL works, tables exist, admin login works, storage linked.

**Together steps:**

1. Verify MySQL + `.env` (`DB_*`; use `SESSION_DRIVER=file` temporarily if needed)
2. Migration: `is_admin` on users
3. Migrations: `projects`, `project_images`, `settings` (others in later phases)
4. Models + relationships
5. `AdminMiddleware` + `/admin` routes + layout shell
6. Disable register in [`routes/auth.php`](routes/auth.php)
7. `php artisan storage:link`
8. Seed your admin user (email/password you choose)

**You verify:** Can open `/admin/login`, log in, see empty dashboard. Public site still works.

---

### Phase B — Projects (highest priority)

**Goal:** Real projects with uploaded images; no mock helper.

**Together steps:**

1. Admin: list / create / edit / delete projects
2. Multi-image upload, set cover, reorder, delete files
3. Public: `/projects`, `/projects/{slug}`, home featured — from DB
4. Projects filter: **category only**
5. Remove [`ProjectHelper`](app/Helpers/ProjectHelper.php) after you upload real photos

**You verify:** Add Noah Heights with your photos; public card and detail match; no Unsplash.

---

### Phase C — Contact & messages

**Goal:** Contact form saves; admin inbox works.

**Together steps:**

1. Migration `messages`
2. Contact POST controller + validation + success message
3. Admin messages list + mark read
4. Rate limit contact form (security)

**You verify:** Submit contact form → appears in admin.

---

### Phase D — Services

**Goal:** Services page and home preview from DB.

**Together steps:**

1. Migration `services`
2. Admin CRUD + image upload
3. Update [`services.blade.php`](resources/views/services.blade.php) + home services section

---

### Phase E — Vacancies & applicants

**Goal:** Jobs from DB; real apply with CV.

**Together steps:**

1. Migrations `vacancies`, `applicants`
2. Admin vacancies CRUD + close job
3. Apply form on [`vacancies.blade.php`](resources/views/vacancies.blade.php) + CV upload
4. Admin applicants list + status + download CV

---

### Phase F — Testimonials & awards

**Goal:** Home slider and awards from DB.

**Together steps:**

1. Migrations + admin CRUD + uploads
2. Update [`welcome.blade.php`](resources/views/welcome.blade.php) sections

---

### Phase G — Settings

**Goal:** Phone, address, hero images editable without code.

**Together steps:**

1. Admin settings form
2. Footer, contact, hero slider read from `settings`

---

### Phase H — Polish, SEO & deployment

- Per-page meta tags
- CSV export messages/applicants
- WhatsApp button from settings
- Optional image resize, CAPTCHA, email notifications
- Deployment checklist (cPanel, `.env` production)

---

## Security & quality (built in across phases)

| Item | When |
|------|------|
| AdminMiddleware | Phase A |
| Disable public register | Phase A |
| File type/size validation on uploads | Phase B+ |
| Delete orphan files on image/project delete | Phase B |
| Eager load `images` on project queries | Phase B |
| Rate limit contact form | Phase C |
| CSRF on all forms | All phases |

---

## Environment prerequisite (before Phase A)

Earlier error `SQLSTATE[HY000] [2002]` = MySQL not running or wrong `.env`.

1. Start MySQL (XAMPP/WAMP/service)
2. Create database `sador`
3. Set `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` in `.env`
4. `php artisan migrate` (after Phase A migrations exist)

---

## Decisions locked for v1

- No project videos
- Admin not linked on public site
- No public registration
- English only
- Category-only project filter
- Before/after images: defer
- About team: static Blade for v1

---

## Success criteria (v1 complete)

- Login at private `/admin/login` URL
- Manage projects with **your** uploaded images
- Public site uses DB; no `ProjectHelper`; no Unsplash on projects
- Contact + applications saved in admin
- Company info and hero images editable in settings

---

**Plan status: READY — waiting for you to say `START PHASE A`**
