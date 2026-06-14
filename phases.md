Total Estimated Time: 4 Weeks (24 working days)


PhaseDurationWorking DaysStatusPhase 14 daysSetup-Phase 25 daysCore Structure-Phase 36 daysMain Features-Phase 45 daysAdmin Panel-Phase 54 daysPolish + SEO-

PHASE 1: Project Setup (4 Days)
Goal: Have a working Laravel project with Tailwind and basic design.
Day 1 (6 hrs)

Install Laravel 11 (composer create-project laravel/laravel sador-construction)
Setup database (MySQL) + configure .env
Install Laravel Breeze for authentication (php artisan breeze:install)
Install Tailwind CSS + Alpine.js + Vite
Run npm install && npm run dev
Test: Open homepage and see default Laravel page

Day 2 (6 hrs)

Design color scheme (Blue #003087, Orange #FF6600, Gray, White)
Create resources/css/app.css with Tailwind
Setup basic layouts:
layouts/main.blade.php (for public)
layouts/admin.blade.php

Create Navbar + Footer components
Make homepage skeleton (home.blade.php)

Day 3 (6 hrs)

Add AOS animation library
Create reusable components folder (components/)
Setup storage link: php artisan storage:link
Add basic routes in web.php

Day 4 (6 hrs)

Test on mobile and desktop
Clean up unnecessary files
Milestone: Clean, modern blank website with Tailwind working


PHASE 2: Frontend Public Pages – Structure (5 Days)
Goal: All public pages ready with design (no real data yet)
Day 5–6: Home Page

Hero section with image slider (use Swiper.js or simple JS)
Why Choose Us (4 cards with AOS animation)
Services preview cards
Featured projects grid
Stats counters (animated numbers)
Testimonials slider (static for now)
Awards grid (static for now)

Day 7–8: Other Pages

Services page (grid + detail style)
Projects page (grid with filters)
About Us page
Vacancies page
Contact page

Day 9

Make navbar sticky + mobile menu (Alpine.js)
Add floating Call + WhatsApp buttons
Make all pages fully responsive

Milestone: Beautiful, smooth, modern frontend design complete (looks professional)

PHASE 3: Dynamic Data + Backend Logic (6 Days)
Goal: Make website dynamic (data from database)
Day 10–11: Database & Models

Create all migrations:
projects, project_images, services, vacancies, testimonials, awards, messages, applicants, settings

Create Models with relationships
Add seeders (sample data)

Day 12–13: Controllers & Pages

HomeController, ServiceController, ProjectController, etc.
Connect frontend pages to real data (projects, services, testimonials, awards)
Make project detail page with gallery

Day 14

Contact form submission (save to database + email)
Vacancy application with CV upload

Day 15

Image upload system for projects (multiple)
YouTube video embed support

Milestone: Website is now dynamic. You can add projects/services from code.

PHASE 4: Admin Panel (5 Days) – Most Important for Client
Goal: Simple, easy-to-use admin panel
Day 16–17: Admin Setup

Protect admin routes with middleware
Create admin dashboard layout
Dashboard with stats cards

Day 18–19: CRUD Operations

Projects CRUD (with multiple image upload + drag & drop)
Services CRUD
Vacancies CRUD

Day 20

Testimonials CRUD (very simple form)
Awards CRUD (very simple form)
Messages inbox
Applicants management (view + download CV)

Milestone: Non-technical person can easily manage everything

PHASE 5: Polish, SEO, Testing & Deployment (4 Days)
Day 21

Smooth animations (AOS + custom)
Lightbox for image gallery
Form validation + success messages

Day 22

SEO optimization (meta tags, slugs, schema markup)
Page speed optimization (image compression)
Add bilingual support structure (English + Amharic)

Day 23

Full testing (mobile, forms, admin, uploads)
Bug fixing

Day 24

Prepare for deployment
Write documentation for client (how to use admin panel)
Deploy on shared hosting

Final Milestone: Complete, professional, client-ready website

Daily Schedule Suggestion (6 hours)

1 hour → Planning / Research
4 hours → Coding
1 hour → Testing + Fixing


Important Tips

Commit to Git every day.
Take screenshots of each completed section and show your client for feedback.
Use Laravel Debugbar for development.
Focus on mobile experience — most users in Ethiopia use phones.
Make admin panel as simple as possible.