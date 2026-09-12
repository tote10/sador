# Uncommitted Changes — Explained

This documents every uncommitted file in the working tree. They fall into two groups:
**(A)** the email-reply / settings work done in this session, and **(B)** a pre-existing SEO baseline that was already uncommitted before this session.

---

## A. Email replies, bulk actions & live settings (this session)

### Auto thank-you + reply emails
| File | What changed |
|------|--------------|
| `app/Mail/` *(new)* | Three Mailables: `ApplicationReceived` (auto thank-you when someone applies), `ContactReceived` (auto thank-you for contact form), `AdminReply` (generic admin-written reply with editable subject/body). |
| `resources/views/emails/` *(new)* | Email templates: `application-received`, `contact-received`, `admin-reply`. |
| `resources/views/components/mail-layout.blade.php` *(new)* | Shared branded email shell (header/footer, inline styles for email clients). |
| `routes/web.php` | Sends `ApplicationReceived` on `/vacancies/{id}/apply` & `/careers/apply`, and `ContactReceived` on `/contact` (wrapped in try/catch so a mail failure never breaks the form). Also adds the new admin reply + bulk routes. |
| `.env.example` | Added commented SMTP guidance (how to switch from `log` to real Gmail/SMTP sending). *(Note: live `.env` was set to Gmail SMTP but `.env` is git-ignored, so it's not in this list.)* |

### Applicant replies + status flow
| File | What changed |
|------|--------------|
| `app/Http/Controllers/Admin/ApplicantController.php` | Added `reply()` (emails the candidate + updates status in one action), `markAllReviewed()` (bulk), `destroyAll()` (bulk delete + remove CV files). |
| `resources/views/admin/applicants/index.blade.php` | Changing the **Recruitment Status** dropdown now opens an editable, status-specific email (Interview/Hired/Rejected/Reviewed); **Send** emails the candidate and updates status. Added **Mark all reviewed** / **Delete all** toolbar buttons. |

### Contact-message replies + bulk
| File | What changed |
|------|--------------|
| `app/Http/Controllers/Admin/MessageController.php` | Added `reply()` (in-app reply email), `markAllRead()`, `destroyAll()`. |
| `resources/views/admin/messages/show.blade.php` | Replaced the `mailto:` button with a real in-app reply composer (editable subject/body, sends through the app). |
| `resources/views/admin/messages/index.blade.php` | Added **Mark all read** / **Delete all** toolbar buttons. |

### Settings now actually drive the public site
| File | What changed |
|------|--------------|
| `app/Providers/AppServiceProvider.php` | Shares all site settings to every Blade view as `$settings`, so editing admin → Settings changes the live site. |
| `app/Http/Controllers/Admin/SettingController.php` | Accepts 4 new homepage stat fields (years, projects, clients, staff). |
| `resources/views/admin/settings/edit.blade.php` | Added a **Homepage Statistics** section (4 number inputs). |
| `resources/views/welcome.blade.php` | Stats band + "Direct Call" button now read from settings. |
| `resources/views/contact.blade.php` | Address, phone, email, working hours, and Google map now read from settings. |
| `resources/views/components/footer.blade.php` | Address, phone, email, hours read from settings. |
| `resources/views/components/floating-buttons.blade.php` | Floating call button reads phone from settings. |

### Bug fix + tests
| File | What changed |
|------|--------------|
| `database/migrations/2026_06_15_214850_make_messages_phone_nullable.php` *(new)* | Makes `messages.phone` nullable — contact submissions without a phone number no longer crash. |
| `tests/Feature/ApplicantReplyTest.php` *(new)* | Verifies a status-reply emails the applicant and updates status. |
| `tests/Feature/AdminBulkAndStatsTest.php` *(new)* | Verifies dashboard render + the bulk actions. |

---

## B. Pre-existing SEO baseline (already uncommitted before this session)

| File | What it is |
|------|-----------|
| `config/services.php` | Adds `google.analytics_id` + `google.site_verification` config (inert until env vars set). |
| `resources/views/layouts/main.blade.php` | SEO/meta additions: favicon + web manifest links, geo meta tags, richer Open Graph/Twitter image tags, Google Search Console verification, schema `@stack`. |
| `resources/views/project-details.blade.php` | Adds JSON-LD structured data (BreadcrumbList + CreativeWork) and OG image. |
| `resources/views/projects.blade.php` | Adds BreadcrumbList JSON-LD. |
| `resources/views/services.blade.php` | Adds ItemList/Service JSON-LD. |
| `resources/views/dashboard.blade.php` *(deleted)* | Legacy Breeze dashboard view removed (admin uses `admin/dashboard`). |
| `resources/views/frontend/home.blade.php` *(deleted)* | Old homepage removed (replaced by `welcome.blade.php`). |
| `public/site.webmanifest` *(new)* | PWA/web app manifest referenced by the layout. |
| `SEO-SETUP.md` *(new)* | Notes on the SEO setup. |
