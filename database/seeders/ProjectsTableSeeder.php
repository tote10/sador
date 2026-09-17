<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('projects')->delete();
        
        \DB::table('projects')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Industrial Shade & Condominium',
                'slug' => 'industrial-shade-condominium',
                'category' => 'commercial',
                'location' => 'Addis Ababa',
                'year' => '2023',
                'budget' => 'ETB 130,000,000',
                'duration' => '3 Months',
                'client_name' => 'Addis Ababa City Design & Construction Bureau',
                'status' => 'Completed',
            'description' => 'A five-storey (G+4) building on a 750 sq.m plot, initially designed for industrial use and re-purposed into a condominium. Delivered in just three months for the Addis Ababa City Design & Construction Bureau.',
                'is_featured' => 1,
                'is_published' => 1,
                'created_at' => '2026-06-16 13:48:04',
                'updated_at' => '2026-06-16 13:48:04',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Fitawrari Administration Complex',
                'slug' => 'fitawrari-administration-complex',
                'category' => 'commercial',
                'location' => 'Addis Ketema, Addis Ababa',
                'year' => '2025',
                'budget' => 'ETB 68,082,828',
                'duration' => '35 Days',
                'client_name' => 'Addis Ketema Sub City Design & Construction Office',
                'status' => 'Completed',
            'description' => 'A three-storey (G+2) administration building on a 400 sq.m plot with 2,500 sq.m of landscaping works for Fitawrari Habtegiorgis School, completed in 35 days.',
                'is_featured' => 1,
                'is_published' => 1,
                'created_at' => '2026-06-16 13:48:04',
                'updated_at' => '2026-06-16 13:48:04',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Low-Cost 55 Homes & Playground',
                'slug' => 'low-cost-55-homes',
                'category' => 'residential',
                'location' => 'Addis Ketema, Addis Ababa',
                'year' => '2025',
                'budget' => 'ETB 104,200,041',
                'duration' => '44 Days',
                'client_name' => 'Addis Ketema Sub City Design & Construction Office',
                'status' => 'Completed',
            'description' => 'A five-storey (G+4) apartment development comprising 55 homes on 600 sq.m, together with an 800 sq.m playground. Completed in 44 days.',
                'is_featured' => 1,
                'is_published' => 1,
                'created_at' => '2026-06-16 13:48:04',
                'updated_at' => '2026-06-16 13:48:04',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Nefas Silk Administration Cladding',
                'slug' => 'nefas-silk-administration-cladding',
                'category' => 'commercial',
                'location' => 'Nefas Silk Lafto, Addis Ababa',
                'year' => '2025',
                'budget' => 'ETB 91,000,000',
                'duration' => '36 Days',
                'client_name' => 'Nefas Silk Sub City Woreda 2 Administration',
                'status' => 'Completed',
                'description' => 'Aluminium cladding and finishing works for the G+7 Woreda 2 administration building, completed in 36 days.',
                'is_featured' => 1,
                'is_published' => 1,
                'created_at' => '2026-06-16 13:48:04',
                'updated_at' => '2026-06-16 13:48:04',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Jimma Corridor Development',
                'slug' => 'jimma-corridor-development',
                'category' => 'infrastructure',
                'location' => 'Jimma',
                'year' => '2025',
                'budget' => 'ETB 81,000,000',
                'duration' => '64 Days',
                'client_name' => 'Addis Ababa City Design & Construction Bureau',
                'status' => 'Completed',
                'description' => 'Corridor development works delivered for Jimma city within a tight 64-day programme, improving urban mobility and streetscape infrastructure.',
                'is_featured' => 0,
                'is_published' => 1,
                'created_at' => '2026-06-16 13:48:04',
                'updated_at' => '2026-06-16 13:48:04',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'R&G Family Real Estate',
                'slug' => 'rg-family-real-estate',
                'category' => 'residential',
                'location' => 'Addis Ababa',
                'year' => '2025',
                'budget' => 'ETB 138,548,002',
                'duration' => 'On Schedule',
                'client_name' => 'R&G Family',
                'status' => 'Completed',
                'description' => 'A G+8 mixed residential real-estate development built to high finishing standards for the R&G Family.',
                'is_featured' => 0,
                'is_published' => 1,
                'created_at' => '2026-06-16 13:48:04',
                'updated_at' => '2026-06-16 13:48:04',
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'Tati Real Estate Tower',
                'slug' => 'tati-real-estate-tower',
                'category' => 'commercial',
                'location' => 'Addis Ababa',
                'year' => '2025',
                'budget' => 'ETB 160,009,654',
                'duration' => 'On Schedule',
                'client_name' => 'Tati Real Estate',
                'status' => 'Completed',
                'description' => 'A landmark G+11 high-rise tower — among Sador\'s tallest builds — delivered with structural glazing and modern curtain-wall finishing.',
                'is_featured' => 0,
                'is_published' => 1,
                'created_at' => '2026-06-16 13:48:04',
                'updated_at' => '2026-06-16 13:48:04',
            ),
        ));
        
        
    }
}