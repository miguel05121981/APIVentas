<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\License;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        // Obtener una licencia existente
        $license = License::first();
        if (!$license) {
            $license = License::create([
                'code' => 'INFINITE',
                'amount' => 0,
                'start_date' => now(),
            ]);

            $license2 = License::create([
                'code' => 'BRONCE001',
                'amount' => 100000,
                'start_date' => now(),
                'end_date' => now()->addMonths(6),
            ]);
        }

        Company::create([
            'name' => 'NovaCodeSoft',
            'licenses_id' => $license->id,
        ]);

        Company::create([
            'name' => 'Empresa test',
            'licenses_id' => $license2->id,
        ]);
    }
}