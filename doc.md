Sador General Construction Website
(Everything in One Place – Nothing Left Out)

1. Project Overview

Company: Sador General Construction
Goal: Professional website to attract clients, showcase work, and allow easy management.
Design Style: Modern, clean, trustworthy (Blue + Orange + White colors, high-quality construction photos, smooth animations).
Tech Stack:
Backend: PHP + Laravel 11
Frontend: HTML (Blade) + Tailwind CSS + Alpine.js
Database: MySQL
Animations: AOS + GSAP
Hosting: Shared hosting (cPanel recommended)



2. Complete Page Structure
A. Public Pages (Visitor Side)
1. Home Page (/)

Hero Section: Full-screen video/image slider + Company name + Tagline + 3 Buttons (View Projects, Get Quote, Call Now)
Why Choose Us: 4 animated cards (Experience, Quality, Timely Delivery, Certified Team)
Our Services: 6 preview cards with images + short description + "Learn More" link
Featured Projects: 6 attractive cards with hover effect
Experience Stats: Animated counters (Years, Projects, Clients, Staff)
Awards & Recognitions: Grid/Carousel of award logos with year & title
Testimonials: Auto-playing slider with client photo, name, quote, and 5-star rating
Our Partners / Confidence: Logos of partners, certifications, insurance
Call-to-Action Banner
Footer

2. Services Page (/services)

Hero banner
All services in grid or accordion
Each service has: Big image, full description, benefits (bullets), materials used, related projects link, inquiry button

3. Projects Page (/projects)

Filter: Category, Year, Location
Masonry grid of project cards
Click → Detail page with:
Hero image
Info bar (Budget, Duration, Location, Client, Status)
Full description
Photo gallery (lightbox)
Videos (YouTube embed or direct)
Challenges & Solutions
Before/After images
Client testimonial


4. About Us (/about)

Company history & timeline
Vision, Mission, Values
Team members (photos + short bio)
Company gallery

5. Vacancies (/vacancies)

List of open jobs with details
Each job has "Apply Now" button → Form with CV upload

6. Contact (/contact)

Address, phones, emails, working hours
Google Map embed
Contact form (Name, Phone, Email, Service, Message)

Common on All Pages:

Sticky Navbar (Logo, Menu, Language switch, Call button)
Floating WhatsApp + Call button (bottom right)
Back to top button
Mobile responsive


3. Admin Panel (/admin) – Made Simple for Non-Technical Users
Login: Only admin can access (/admin/login)
Dashboard:

Welcome message
Quick stats cards
Recent messages & applications

Easy Management Sections (Big buttons, simple forms):

Projects
Add/Edit/Delete
Title, Slug, Category, Description, Budget, Duration, Location, Client
Multiple Image Upload (Drag & Drop)
Video upload or YouTube link
Featured checkbox

Services
Add/Edit services with image and full content

Vacancies
Post new job + Edit + Close

Testimonials (Very Easy)
Add New → Client Name, Position, Quote, Upload Photo, Star Rating, Save
List with edit/delete

Awards (Very Easy)
Add New → Award Title, Year, Organization, Description, Upload Logo/Image, Save

Messages
Inbox of contact form submissions

Applicants
View all job applications
Download CV
Change status (New, Reviewed, Interviewed, Hired)

Settings
Company name, phone, address, email, social links
Update hero images/videos


Important: All image uploads use simple "Choose File" or drag & drop. No technical knowledge needed.

4. Database Tables (All)

users (for admin login)
projects
project_images (multiple photos)
project_videos
services
vacancies
applicants (CVs)
messages
testimonials
awards
settings


5. File Upload System
All uploaded files go to:
textstorage/app/public/
Folders:

projects/images/
projects/videos/
services/images/
testimonials/
awards/
applicants/cvs/

After upload, run php artisan storage:link once.
Files accessible via: https://site.com/storage/projects/images/xxx.jpg
Admin only selects files from their computer — very simple.

6. SEO & Performance

Clean URLs (slug system)
Meta title & description for every page
Image alt texts
Fast loading (compressed images, lazy load)
Google Analytics & Search Console ready
Mobile-first design


7. Extra Features

Bilingual ready (English + Amharic)
Form validation + success messages
CAPTCHA on forms
Automatic email notification when new message/applicant arrives (optional)
Image compression on upload


8. Development Steps (Realistic Timeline – 4 Weeks)
Week 1: Laravel installation, Tailwind setup, Database, Admin login, Home page structure
Week 2: Services + Projects (CRUD + Gallery)
Week 3: About, Vacancies, Contact + Testimonials & Awards
Week 4: Animations, SEO, Testing, Polish, Deployment