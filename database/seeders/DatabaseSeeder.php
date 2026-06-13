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
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin User
        User::updateOrCreate(
            ['email' => 'admin@sador.com'],
            [
                'name' => 'Sador Admin',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

        // Promote motialemu9@gmail.com if exists
        $user = User::where('email', 'motialemu9@gmail.com')->first();
        if ($user) {
            $user->is_admin = true;
            $user->save();
        }

        // 2. Seed Settings
        $settings = [
            ['key' => 'company_name', 'value' => 'Sador General Construction', 'group' => 'contact'],
            ['key' => 'company_phone', 'value' => '+2519 11 70 81 75 / +2519 76 80 80 76', 'group' => 'contact'],
            ['key' => 'company_email', 'value' => 'Sadorgcsador@gmail.com', 'group' => 'contact'],
            ['key' => 'company_address', 'value' => 'ADDISABABA, ALEMNESH plaza building 13TH floor, Room No.1303', 'group' => 'contact'],
            ['key' => 'working_hours', 'value' => 'Mon - Sat: 8:00 AM - 6:00 PM', 'group' => 'contact'],
            ['key' => 'whatsapp_number', 'value' => '+251911708175', 'group' => 'contact'],
            ['key' => 'default_meta_description', 'value' => 'Sador General Construction is Ethiopia\'s premier civil engineering, residential estate, and commercial tower builder.', 'group' => 'seo'],
            ['key' => 'google_maps_embed', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.547000570396!2d38.7834575!3d9.0042456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b85aaf5555555%3A0x5555555555555555!2sAddis%20Ababa!5e0!3m2!1sen!2set!4v1622999999999!5m2!1sen!2set', 'group' => 'contact'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 3. Seed Projects & Images
        $projectsData = [
            [
                'slug' => 'noah-heights-tower',
                'title' => 'Noah Heights Tower',
                'category' => 'commercial',
                'location' => 'Bole Sub City, Addis Ababa',
                'year' => '2025',
                'budget' => '$14.2M USD',
                'duration' => '18 Months',
                'client_name' => 'Noah Real Estate',
                'status' => 'Completed',
                'description' => 'Noah Heights Tower stands as a premier Class 1 commercial complex in the heart of Addis Ababa\'s Bole financial district. The structure provides 12 stories of state-of-the-art office spaces, underground parking, and high-end luxury retail showrooms on the ground floor. Engineered with high-strength reinforced concrete frames and high-performance structural glazing, the tower sets a new standard for local engineering precision, seismic resistance, and aesthetic appeal.',
                'is_featured' => true,
                'is_published' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1541888086925-920a0b777bd3?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1504307651254-35680f356f58?q=80&w=800&auto=format&fit=crop'
                ]
            ],
            [
                'slug' => 'cmc-luxury-apartments',
                'title' => 'CMC Luxury Apartments',
                'category' => 'residential',
                'location' => 'CMC Zone, Addis Ababa',
                'year' => '2024',
                'budget' => '$9.5M USD',
                'duration' => '14 Months',
                'client_name' => 'Zola Real Estate',
                'status' => 'Completed',
                'description' => 'This premium residential development features forty high-end luxury villas and townhouses, integrated with shared community parks, recreation areas, and solar-powered smart utilities. Designed to match contemporary architectural aesthetics, each villa features open layouts, sustainable insulation systems, and premium concrete craftsmanship.',
                'is_featured' => true,
                'is_published' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1582485565167-75055e5e6b5b?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&w=800&auto=format&fit=crop'
                ]
            ],
            [
                'slug' => 'hawassa-arterial-bridge',
                'title' => 'Hawassa Arterial Bridge',
                'category' => 'infrastructure',
                'location' => 'Southern Federal Corridor',
                'year' => '2025',
                'budget' => '$22.0M USD',
                'duration' => '24 Months',
                'client_name' => 'Federal Road Authority',
                'status' => 'Completed',
                'description' => 'The Hawassa Arterial Bridge is a major 1.2 KM overpass over the Southern Federal Corridor. This heavy civil infrastructure project was built to accommodate high-volume freight traffic and improve transit speeds between crucial regional industrial corridors.',
                'is_featured' => true,
                'is_published' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1541888086925-920a0b777bd3?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1504307651254-35680f356f58?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800&auto=format&fit=crop'
                ]
            ],
            [
                'slug' => 'lebu-multi-family-condos',
                'title' => 'Lebu Multi-family Condos',
                'category' => 'residential',
                'location' => 'Lebu Zone, Addis Ababa',
                'year' => '2023',
                'budget' => '$8.1M USD',
                'duration' => '16 Months',
                'client_name' => 'Addis Ababa Housing Dev',
                'status' => 'Completed',
                'description' => 'Designed to support high-density residential requests, the Lebu Multi-family Condos project consists of six structural blocks featuring modern spaces, utility networks, and public zones. The build focused on material economy and foundation durability.',
                'is_featured' => false,
                'is_published' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1582485565167-75055e5e6b5b?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=800&auto=format&fit=crop'
                ]
            ],
            [
                'slug' => 'kazanchis-plaza-complex',
                'title' => 'Kazanchis Plaza Complex',
                'category' => 'commercial',
                'location' => 'Kazanchis District, Addis Ababa',
                'year' => '2024',
                'budget' => '$19.8M USD',
                'duration' => '20 Months',
                'client_name' => 'Ministry of Trade & Tourism',
                'status' => 'Completed',
                'description' => 'This 18-story government and administrative headquarters features smart thermal insulation systems, high-efficiency mechanical venting, and double-glazed low-emissivity glass curtain walls to lower HVAC loads.',
                'is_featured' => false,
                'is_published' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800&auto=format&fit=crop'
                ]
            ],
            [
                'slug' => 'adama-industrial-drainage',
                'title' => 'Adama Industrial Drainage',
                'category' => 'infrastructure',
                'location' => 'Adama Free Trade Zone',
                'year' => '2023',
                'budget' => '$5.4M USD',
                'duration' => '10 Months',
                'client_name' => 'Industrial Parks Dev Corp',
                'status' => 'Completed',
                'description' => 'A comprehensive 8.4 KM heavy concrete storm water drainage canal network built to control flash flood flows and safeguard logistics infrastructure inside the Adama Free Trade Zone.',
                'is_featured' => false,
                'is_published' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1504307651254-35680f356f58?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1541888086925-920a0b777bd3?q=80&w=800&auto=format&fit=crop'
                ]
            ]
        ];

        foreach ($projectsData as $proj) {
            $images = $proj['images'];
            unset($proj['images']);

            $project = Project::updateOrCreate(['slug' => $proj['slug']], $proj);

            // clear old images
            $project->images()->delete();

            // add new ones
            foreach ($images as $index => $img) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $img,
                    'sort_order' => $index,
                    'is_cover' => $index === 0,
                ]);
            }
        }

        // 4. Seed Services
        $servicesData = [
            [
                'title' => 'Commercial Towers',
                'slug' => 'commercial-towers',
                'short_description' => 'Engineering mixed-use commercial office towers, industrial warehouses, and large complexes.',
                'full_description' => 'Sador General Construction excels in structural concrete and high-performance architectural design for large scale commercial building contracts. Our towers are built with deep pile foundations, double curtain wall facades, and modern HVAC integration.',
                'image_path' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'title' => 'Residential Estates',
                'slug' => 'residential-estates',
                'short_description' => 'Developing luxury apartment complexes, villa compounds, and custom houses.',
                'full_description' => 'From luxury high-rise condos to master-planned gated villa communities, Sador brings architectural craftsmanship and premium landscape design. We deploy energy-efficient roofing, thermal block layers, and high-end marble details.',
                'image_path' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=800&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'title' => 'Civil Infrastructure',
                'slug' => 'civil-infrastructure',
                'short_description' => 'Executing heavy engineering contracts including highway roads and bridges.',
                'full_description' => 'Sador delivers robust infrastructural support for governmental and public assets, featuring asphalt highway grading, drainage box culverts, overpasses, and structural span bridges using post-tensioned beam casting.',
                'image_path' => 'https://images.unsplash.com/photo-1541888086925-920a0b777bd3?q=80&w=800&auto=format&fit=crop',
                'is_featured' => true,
            ]
        ];

        foreach ($servicesData as $serv) {
            Service::updateOrCreate(['slug' => $serv['slug']], $serv);
        }

        // 5. Seed Vacancies
        $vacanciesData = [
            [
                'title' => 'Senior Project Manager',
                'type' => 'Full-Time',
                'location' => 'Addis Ababa',
                'experience' => '8+ Years',
                'education' => 'M.Sc. or B.Sc. in Civil Engineering / Construction Management',
                'salary' => 'Attractive & Negotiable',
                'description' => 'We are seeking an experienced Senior Project Manager to orchestrate major multi-million commercial towers in Addis Ababa. The ideal candidate has an outstanding track record in critical path planning, structural safety management, and subcontractor coordination.',
                'deadline' => now()->addDays(30),
                'is_open' => true,
            ],
            [
                'title' => 'Civil Site Engineer',
                'type' => 'Full-Time',
                'location' => 'Hawassa Corridor',
                'experience' => '4+ Years',
                'education' => 'B.Sc. in Civil Engineering',
                'salary' => 'Based on Company Scale',
                'description' => 'Responsible for day-to-day site supervision, reinforcement bar checking, concrete slump testing, and surveying validation. Experience in bridge building or road paving is highly valued.',
                'deadline' => now()->addDays(20),
                'is_open' => true,
            ],
            [
                'title' => 'HSE Safety Officer',
                'type' => 'Contract',
                'location' => 'Adama',
                'experience' => '3+ Years',
                'education' => 'OSHA certification or B.Sc. in Environmental Health & Safety',
                'salary' => 'Fixed Contract Fee',
                'description' => 'Develop and implement occupational safety guidelines across active civil excavations. Ensure 100% compliance with federal site safety laws and run regular tool-box drills.',
                'deadline' => now()->addDays(15),
                'is_open' => true,
            ]
        ];

        foreach ($vacanciesData as $vac) {
            Vacancy::updateOrCreate(['title' => $vac['title']], $vac);
        }

        // 6. Seed Testimonials
        $testimonialsData = [
            [
                'client_name' => 'Dr. Elias Tekle',
                'position' => 'Commercial Director, Noah Real Estate',
                'quote' => 'Sador General Construction delivered Noah Heights Tower six weeks ahead of schedule. Their technical competence, dedication to engineering precision, and safety standards are unmatched in Ethiopia.',
                'photo_path' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=200&auto=format&fit=crop',
                'rating' => 5,
            ],
            [
                'client_name' => 'Martha Girma',
                'position' => 'Managing Partner, Zola Luxury Apartments',
                'quote' => 'The aesthetic execution and attention to structural details on our luxury villa complex was phenomenal. Sador’s engineering team was responsive, consultative, and highly professional throughout the build.',
                'photo_path' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&auto=format&fit=crop',
                'rating' => 5,
            ],
            [
                'client_name' => 'Eng. Solomon Belay',
                'position' => 'Infrastructure Consultant, Federal Road Authority',
                'quote' => 'Managing complex civil grading and heavy asphalt paving requires high-capacity equipment and absolute safety control. Sador has consistently proven to be a premier partner for municipal works.',
                'photo_path' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&auto=format&fit=crop',
                'rating' => 5,
            ]
        ];

        foreach ($testimonialsData as $test) {
            Testimonial::updateOrCreate(['client_name' => $test['client_name']], $test);
        }

        // 7. Seed Awards
        $awardsData = [
            [
                'title' => 'East Africa Structural Excellence',
                'year' => '2024',
                'organization' => 'Regional Builders Congress',
                'description' => 'Awarded for architectural complexity and structural engineering safety standards on commercial high-rise towers.',
                'logo_path' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?q=80&w=150&auto=format&fit=crop',
            ],
            [
                'title' => 'Federal HSE Safety Gold Medal',
                'year' => '2025',
                'organization' => 'Ministry of Labour & Skills',
                'description' => 'Recognized for executing over 1 million consecutive safe man-hours across municipal and civil site operations.',
                'logo_path' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?q=80&w=150&auto=format&fit=crop',
            ],
            [
                'title' => 'National Housing Partner',
                'year' => '2023',
                'organization' => 'Federal Housing Corporation',
                'description' => 'Acknowledged for timely delivery and material quality standards in luxury residential and housing estates development.',
                'logo_path' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?q=80&w=150&auto=format&fit=crop',
            ],
            [
                'title' => 'Urban Development Catalyst',
                'year' => '2026',
                'organization' => 'Ethiopian Civil Association',
                'description' => 'Presented for significant contributions to national roadway connections and civil engineering development infrastructure.',
                'logo_path' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?q=80&w=150&auto=format&fit=crop',
            ]
        ];

        foreach ($awardsData as $awd) {
            Award::updateOrCreate(['title' => $awd['title']], $awd);
        }
    }
}
