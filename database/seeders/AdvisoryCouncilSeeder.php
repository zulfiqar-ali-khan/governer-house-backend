<?php

namespace Database\Seeders;

use App\Models\AdvisoryCouncil;
use Illuminate\Database\Seeder;

class AdvisoryCouncilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear previous placeholder data
        AdvisoryCouncil::truncate();

        $advisors = [
            [
                'order' => 1,
                'name' => 'Mr. Kifayat Ullah',
                'label' => 'Home & Tribal Affairs',
                'description' => 'Additional Portfolios: Food, Women Empowerment',
                'image' => null,
                'active' => 1,
            ],
            [
                'order' => 2,
                'name' => 'Mr. Tariq Mehmood Pasha',
                'label' => 'Finance, Revenue, Excise & Taxation',
                'description' => 'Additional Portfolios: Climate Change, Environment',
                'image' => null,
                'active' => 1,
            ],
            [
                'order' => 3,
                'name' => 'Mr. Amir Javed',
                'label' => 'Law & Parliamentary Affairs',
                'description' => 'Additional Portfolios: Labour, IPC',
                'image' => null,
                'active' => 1,
            ],
            [
                'order' => 4,
                'name' => 'Dr. Syed Amir Abdullah',
                'label' => 'Education',
                'description' => 'Additional Portfolios: Social Welfare',
                'image' => null,
                'active' => 1,
            ],
            [
                'order' => 5,
                'name' => 'Lieu. Gen. (Retd) Nigar Johar',
                'label' => 'Health',
                'description' => 'Additional Portfolios: Population Welfare',
                'image' => null,
                'active' => 1,
            ],
            [
                'order' => 6,
                'name' => 'Dr. Sarfaraz Ali',
                'label' => 'Mines & Minerals',
                'description' => 'Additional Portfolios: Culture, Tourism, Archaeology & Museums, Sports & Youth Affairs',
                'image' => null,
                'active' => 1,
            ],
            [
                'order' => 7,
                'name' => 'Dr. Muhammad Irshad',
                'label' => 'Industries & Commerce',
                'description' => 'Additional Portfolios: Irrigation, PHE',
                'image' => null,
                'active' => 1,
            ],
            [
                'order' => 8,
                'name' => 'Mr. Asif Rafiq',
                'label' => 'C&W, Local Government, Housing & Transport',
                'description' => 'Additional Portfolios: Agriculture, Livestock, Fisheries & Cooperative',
                'image' => null,
                'active' => 1,
            ],
            [
                'order' => 9,
                'name' => 'Moulana Tayyab Qureshi',
                'label' => 'Auqaf & Religious Affairs',
                'description' => 'Additional Portfolios: Zakat, Ushr',
                'image' => null,
                'active' => 1,
            ],
            [
                'order' => 10,
                'name' => 'Mr. Osman Saif Ullah Khan',
                'label' => 'Energy & Power and Planning & Development',
                'description' => 'Additional Portfolios: Science Technology & Information Technology',
                'image' => null,
                'active' => 1,
            ],
            [
                'order' => 11,
                'name' => 'Ms. Samar Bilour',
                'label' => 'Information & Public Relations',
                'description' => 'Additional Portfolios: Relief, Rehabilitation & Settlement',
                'image' => null,
                'active' => 1,
            ],
        ];

        foreach ($advisors as $advisor) {
            AdvisoryCouncil::create($advisor);
        }
    }
}
