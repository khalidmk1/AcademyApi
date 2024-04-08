<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $domains =[
            'Argent et Carrière',
            'Santé et bien être',
            'Relations humaines',
            'Epanouissement personnel'
        ];

        foreach ($domains as $key => $doamin) {
            Domain::create([
                'domain' => $doamin
            ]);
        }
    }
}
