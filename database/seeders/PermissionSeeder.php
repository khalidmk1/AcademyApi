<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Creation Contenu',
            'Modifier Contenu',
            'Suprimer Contenu',
            'Gestion Tickets',
            'Manager Emails',
            'Manager Spearks',
            'Manager Role'
        ];

        // Loop through each permission and insert it into the database
        foreach ($permissions as $permission) {
            Permission::create([
                'permission_name' => $permission
            ]);
        }
    }
}
