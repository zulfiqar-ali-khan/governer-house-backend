<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $visitors = [
            [
                'name' => 'Sardar Masood Khan',
                'description' => 'President Azad Jammu and Kashmir',
                'image' => null,
                'date' => '2017-04-01',
            ],
            [
                'name' => 'Makhdum Syed Ahmad Mahmood',
                'description' => 'Governor of Punjab',
                'image' => null,
                'date' => '2013-05-01',
            ],
            [
                'name' => 'Syed Yusuf Raza Gilani',
                'description' => 'Prime Minister',
                'image' => null,
                'date' => '2012-03-01',
            ],
            [
                'name' => 'Pervez Musharraf',
                'description' => 'General & President',
                'image' => null,
                'date' => '2008-08-01',
            ],
            [
                'name' => 'Mr. Suleyman Demird',
                'description' => 'President of Republic of Turkeyia',
                'image' => null,
                'date' => '1996-02-01',
            ],
            [
                'name' => 'Lady Diana Spencer',
                'description' => null,
                'image' => null,
                'date' => '1988-01-01',
            ],
            [
                'name' => 'Muhammad Ali',
                'description' => 'Boxing Champion',
                'image' => null,
                'date' => '1987-11-01',
            ],
            [
                'name' => 'Dulip Kumar (Yousaf Khan)',
                'description' => 'Actor',
                'image' => null,
                'date' => '1985-09-01',
            ],
            [
                'name' => 'Zia-ul Haq',
                'description' => 'President',
                'image' => null,
                'date' => '1983-01-01',
            ],
            [
                'name' => 'Faisal Bin Abdul Aziz',
                'description' => 'King of Saudi Arabia',
                'image' => null,
                'date' => '1974-02-01',
            ],
            [
                'name' => 'Benazir Bhutto',
                'description' => null,
                'image' => null,
                'date' => '1972-09-01',
            ],
            [
                'name' => 'Muammar Al Qaddafi',
                'description' => 'President of Libya',
                'image' => null,
                'date' => '1974-12-01',
            ],
            [
                'name' => 'Zulfiqar Ali Bhutto',
                'description' => 'Prime Minister',
                'image' => null,
                'date' => '1972-02-01',
            ],
            [
                'name' => 'Noor-ul-Amin',
                'description' => 'Deputy Prime Minister',
                'image' => null,
                'date' => '1971-12-01',
            ],
            [
                'name' => 'Agha Muhammad Yahya Khan',
                'description' => 'President',
                'image' => null,
                'date' => '1970-01-01',
            ],
            [
                'name' => 'Jacqueline Kennedy Onassis',
                'description' => null,
                'image' => null,
                'date' => '1962-01-01',
            ],
            [
                'name' => 'Iskander Mirza',
                'description' => 'Prime Minister',
                'image' => null,
                'date' => '1955-03-01',
            ],
            [
                'name' => 'Muhammad Ayub Khan',
                'description' => 'Field Marshal',
                'image' => null,
                'date' => '1961-11-01',
            ],
            [
                'name' => 'Nawabzada Liaqat Ali Khan',
                'description' => 'Prime Minister',
                'image' => null,
                'date' => '1950-10-01',
            ],
            [
                'name' => 'Ibrahim Ismail Chundrigar',
                'description' => 'Prime Minister',
                'image' => null,
                'date' => '1957-11-01',
            ],
            [
                'name' => 'Muhammad Ali Jinnah',
                'description' => 'Quaid-e-Azam',
                'image' => null,
                'date' => '1948-12-01',
            ],
        ];

        foreach ($visitors as $item) {
            Visitor::updateOrCreate(
                ['name' => $item['name'], 'date' => $item['date']],
                $item
            );
        }
    }
}
