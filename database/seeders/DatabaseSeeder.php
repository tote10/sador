<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Service;
use App\Models\Vacancy;
use App\Models\Testimonial;
use App\Models\Award;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with real Sador company data
     * (sourced from the official company profile).
     */
    public function run(): void
    {
        // 1. Admin user — credentials come from .env so no weak default ships to production.
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');

        if (blank($adminEmail) || blank($adminPassword)) {
            $this->command?->warn('Skipping admin user: set ADMIN_EMAIL and ADMIN_PASSWORD in .env first.');
        } else {
            User::updateOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => env('ADMIN_NAME', 'Sador Admin'),
                    'password' => bcrypt($adminPassword),
                    'is_admin' => true,
                ]
            );
        }

        $user = User::where('email', 'motialemu9@gmail.com')->first();
        if ($user) {
            $user->is_admin = true;
            $user->save();
        }

        // 2. Settings (real contact details)
        $settings = [
            ['key' => 'company_name', 'value' => 'Sador General Construction', 'group' => 'contact'],
            ['key' => 'company_phone', 'value' => '+2519 11 70 81 75 / +2519 76 80 80 76', 'group' => 'contact'],
            ['key' => 'company_email', 'value' => 'Sadorgcsador@gmail.com', 'group' => 'contact'],
            ['key' => 'company_address', 'value' => 'ADDISABABA, ALEMNESH plaza building 13TH floor, Room No.1303', 'group' => 'contact'],
            ['key' => 'working_hours', 'value' => 'Mon - Sat: 8:00 AM - 5:30 PM', 'group' => 'contact'],
            ['key' => 'whatsapp_number', 'value' => '+251911708175', 'group' => 'contact'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 3. Projects (real, from the company profile). Cover photos live under storage/app/public/projects/images.
        ProjectImage::query()->delete();
        Project::query()->delete();

        $projectsData = [
            [
                'slug' => 'industrial-shade-condominium',
                'title' => 'Industrial Shade & Condominium',
                'category' => 'commercial',
                'location' => 'Addis Ababa',
                'year' => '2023',
                'budget' => 'ETB 130,000,000',
                'duration' => '3 Months',
                'client_name' => 'Addis Ababa City Design & Construction Bureau',
                'status' => 'Completed',
                'description' => 'A five-storey (G+4) building on a 750 sq.m plot, initially designed for industrial use and re-purposed into a condominium. Delivered in just three months for the Addis Ababa City Design & Construction Bureau.',
                'is_featured' => true,
                'is_published' => true,
                'cover' => 'projects/images/project-apartment-building.jpg',
            ],
            [
                'slug' => 'fitawrari-administration-complex',
                'title' => 'Fitawrari Administration Complex',
                'category' => 'commercial',
                'location' => 'Addis Ketema, Addis Ababa',
                'year' => '2025',
                'budget' => 'ETB 68,082,828',
                'duration' => '35 Days',
                'client_name' => 'Addis Ketema Sub City Design & Construction Office',
                'status' => 'Completed',
                'description' => 'A three-storey (G+2) administration building on a 400 sq.m plot with 2,500 sq.m of landscaping works for Fitawrari Habtegiorgis School, completed in 35 days.',
                'is_featured' => true,
                'is_published' => true,
                'cover' => 'projects/images/project-blue-admin-block.jpg',
            ],
            [
                'slug' => 'low-cost-55-homes',
                'title' => 'Low-Cost 55 Homes & Playground',
                'category' => 'residential',
                'location' => 'Addis Ketema, Addis Ababa',
                'year' => '2025',
                'budget' => 'ETB 104,200,041',
                'duration' => '44 Days',
                'client_name' => 'Addis Ketema Sub City Design & Construction Office',
                'status' => 'Completed',
                'description' => 'A five-storey (G+4) apartment development comprising 55 homes on 600 sq.m, together with an 800 sq.m playground. Completed in 44 days.',
                'is_featured' => true,
                'is_published' => true,
                'cover' => 'projects/images/generic-site-1.jpg',
            ],
            [
                'slug' => 'nefas-silk-administration-cladding',
                'title' => 'Nefas Silk Administration Cladding',
                'category' => 'commercial',
                'location' => 'Nefas Silk Lafto, Addis Ababa',
                'year' => '2025',
                'budget' => 'ETB 91,000,000',
                'duration' => '36 Days',
                'client_name' => 'Nefas Silk Sub City Woreda 2 Administration',
                'status' => 'Completed',
                'description' => 'Aluminium cladding and finishing works for the G+7 Woreda 2 administration building, completed in 36 days.',
                'is_featured' => true,
                'is_published' => true,
                'cover' => 'projects/images/project-clad-highrise.jpg',
            ],
            [
                'slug' => 'jimma-corridor-development',
                'title' => 'Jimma Corridor Development',
                'category' => 'infrastructure',
                'location' => 'Jimma',
                'year' => '2025',
                'budget' => 'ETB 81,000,000',
                'duration' => '64 Days',
                'client_name' => 'Addis Ababa City Design & Construction Bureau',
                'status' => 'Completed',
                'description' => 'Corridor development works delivered for Jimma city within a tight 64-day programme, improving urban mobility and streetscape infrastructure.',
                'is_featured' => false,
                'is_published' => true,
                'cover' => 'projects/images/generic-site-2.jpg',
            ],
            [
                'slug' => 'rg-family-real-estate',
                'title' => 'R&G Family Real Estate',
                'category' => 'residential',
                'location' => 'Addis Ababa',
                'year' => '2025',
                'budget' => 'ETB 138,548,002',
                'duration' => 'On Schedule',
                'client_name' => 'R&G Family',
                'status' => 'Completed',
                'description' => 'A G+8 mixed residential real-estate development built to high finishing standards for the R&G Family.',
                'is_featured' => false,
                'is_published' => true,
                'cover' => 'projects/images/project-stone-clad-building.jpg',
            ],
            [
                'slug' => 'tati-real-estate-tower',
                'title' => 'Tati Real Estate Tower',
                'category' => 'commercial',
                'location' => 'Addis Ababa',
                'year' => '2025',
                'budget' => 'ETB 160,009,654',
                'duration' => 'On Schedule',
                'client_name' => 'Tati Real Estate',
                'status' => 'Completed',
                'description' => 'A landmark G+11 high-rise tower — among Sador\'s tallest builds — delivered with structural glazing and modern curtain-wall finishing.',
                'is_featured' => false,
                'is_published' => true,
                'cover' => 'projects/images/project-glass-tower.jpg',
            ],
        ];

        foreach ($projectsData as $proj) {
            $cover = $proj['cover'];
            unset($proj['cover']);

            $project = Project::create($proj);

            ProjectImage::create([
                'project_id' => $project->id,
                'image_path' => $cover,
                'sort_order' => 0,
                'is_cover' => true,
            ]);
        }

        // 4. Services (real local imagery)
        $servicesData = [
            [
                'title' => 'Commercial Buildings',
                'slug' => 'commercial-towers',
                'short_description' => 'High-rise office towers, administration complexes, and mixed-use commercial buildings.',
                'full_description' => 'Sador General Construction delivers structural concrete and modern architectural builds for large-scale commercial contracts — from G+4 complexes to G+11 high-rise towers — featuring deep foundations, curtain-wall facades, and aluminium cladding and finishing.',
                'image_path' => 'services/images/service-commercial.jpg',
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'title' => 'Residential Estates',
                'slug' => 'residential-estates',
                'short_description' => 'Apartment blocks, condominiums, and affordable housing developments.',
                'full_description' => 'From multi-storey apartment blocks to large affordable-housing schemes such as our 55-home development, Sador combines durable construction with efficient delivery — completing residential projects on time and within budget.',
                'image_path' => 'services/images/service-residential.jpg',
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'title' => 'Civil Infrastructure',
                'slug' => 'civil-infrastructure',
                'short_description' => 'Corridor development, landscaping, and heavy civil works for public clients.',
                'full_description' => 'Sador executes civil infrastructure contracts for government and municipal clients — including city corridor development, site and landscaping works, and finishing — delivered to schedule even under tight programmes.',
                'image_path' => 'services/images/service-civil.jpg',
                'is_featured' => true,
                'is_published' => true,
            ],
        ];

        foreach ($servicesData as $serv) {
            Service::updateOrCreate(['slug' => $serv['slug']], $serv);
        }

        // 5. Vacancies
        $vacanciesData = [
            [
                'title' => 'Senior Project Manager',
                'type' => 'Full-Time',
                'location' => 'Addis Ababa',
                'experience' => '8+ Years',
                'education' => 'M.Sc. or B.Sc. in Civil Engineering / Construction Management',
                'salary' => 'Attractive & Negotiable',
                'description' => 'We are seeking an experienced Senior Project Manager to lead major building contracts in Addis Ababa. The ideal candidate has a strong track record in critical-path planning, structural safety management, and subcontractor coordination.',
                'deadline' => now()->addDays(30),
                'is_open' => true,
            ],
            [
                'title' => 'Civil Site Engineer',
                'type' => 'Full-Time',
                'location' => 'Addis Ababa',
                'experience' => '4+ Years',
                'education' => 'B.Sc. in Civil Engineering',
                'salary' => 'Based on Company Scale',
                'description' => 'Responsible for day-to-day site supervision, reinforcement checking, concrete testing, and survey validation. Experience in cladding, finishing, or corridor works is highly valued.',
                'deadline' => now()->addDays(20),
                'is_open' => true,
            ],
            [
                'title' => 'HSE Safety Officer',
                'type' => 'Contract',
                'location' => 'Addis Ababa',
                'experience' => '3+ Years',
                'education' => 'B.Sc. in Environmental Health & Safety',
                'salary' => 'Fixed Contract Fee',
                'description' => 'Develop and implement occupational safety guidelines across active sites, ensure compliance with federal site-safety laws, and run regular tool-box drills in line with our Safety-First culture.',
                'deadline' => now()->addDays(15),
                'is_open' => true,
            ],
        ];

        foreach ($vacanciesData as $vac) {
            Vacancy::updateOrCreate(['title' => $vac['title']], $vac);
        }

        // 6. Testimonials (attributed to real client institutions; no stock photos)
        Testimonial::query()->delete();

        $testimonialsData = [
            [
                'client_name' => 'Addis Ababa City Design & Construction Bureau',
                'position' => 'Client — Industrial Shade & Corridor Works',
                'quote' => 'Sador delivered our G+4 industrial-to-condominium project in just three months, with strong attention to safety and quality throughout.',
                'photo_path' => null,
                'rating' => 5,
                'is_published' => true,
            ],
            [
                'client_name' => 'Addis Ketema Sub City C&C Office',
                'position' => 'Client — Fitawrari Complex & 55 Homes',
                'quote' => 'Both the Fitawrari administration complex and our 55-home housing block were handed over ahead of schedule and to a high finishing standard.',
                'photo_path' => null,
                'rating' => 5,
                'is_published' => true,
            ],
            [
                'client_name' => 'Nefas Silk Sub City Woreda 2 Administration',
                'position' => 'Client — G+7 Cladding Project',
                'quote' => 'The aluminium cladding and finishing works on our G+7 administration building were completed quickly and professionally.',
                'photo_path' => null,
                'rating' => 5,
                'is_published' => true,
            ],
        ];

        foreach ($testimonialsData as $test) {
            Testimonial::updateOrCreate(['client_name' => $test['client_name']], $test);
        }

        $awardsData = [
            [
                'title' => 'Best Commercial Contractor',
                'year' => '2024',
                'organization' => 'Ethiopian Construction Authority',
                'description' => 'Awarded for excellence in commercial high-rise development.',
                'logo_path' => null,
                'is_published' => true,
            ],
            [
                'title' => 'Excellence in Civil Infrastructure',
                'year' => '2025',
                'organization' => 'Addis Ababa City Administration',
                'description' => 'Recognized for outstanding delivery of the Jimma Corridor Development.',
                'logo_path' => null,
                'is_published' => true,
            ],
            [
                'title' => 'Safety First Award',
                'year' => '2023',
                'organization' => 'National Safety Council',
                'description' => 'For maintaining zero major incidents across all active sites.',
                'logo_path' => null,
                'is_published' => true,
            ],
        ];

        foreach ($awardsData as $award) {
            Award::updateOrCreate(['title' => $award['title']], $award);
        }
    }
}
