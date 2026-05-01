<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    public function run(): void
    {
        $empleados = [
            ['nombre'=>'María',  'apellido'=>'González', 'email'=>'maria@empresa.com',  'cargo'=>'Gerente',    'sueldo'=>3500000],
            ['nombre'=>'Carlos', 'apellido'=>'López',    'email'=>'carlos@empresa.com', 'cargo'=>'Vendedor',   'sueldo'=>2000000],
            ['nombre'=>'Ana',    'apellido'=>'Martínez', 'email'=>'ana@empresa.com',    'cargo'=>'Contador',   'sueldo'=>2800000],
        ];

        foreach ($empleados as $e) {
            Empleado::firstOrCreate(['email' => $e['email']], array_merge($e, [
                'fecha_ingreso' => now()->subMonths(rand(1, 24)),
            ]));
        }
    }
}
