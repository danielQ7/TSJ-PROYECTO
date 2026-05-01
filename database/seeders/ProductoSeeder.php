<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $cat1 = Categoria::firstOrCreate(['nombre' => 'Electrónica'],  ['descripcion' => 'Dispositivos electrónicos']);
        $cat2 = Categoria::firstOrCreate(['nombre' => 'Oficina'],      ['descripcion' => 'Suministros de oficina']);
        $cat3 = Categoria::firstOrCreate(['nombre' => 'Herramientas'], ['descripcion' => 'Herramientas y equipos']);

        $productos = [
            ['nombre'=>'Laptop HP 14"',     'codigo'=>'LAP-001', 'categoria_id'=>$cat1->id, 'stock'=>12, 'precio'=>3200000],
            ['nombre'=>'Mouse Inalámbrico', 'codigo'=>'MOU-001', 'categoria_id'=>$cat1->id, 'stock'=>30, 'precio'=>85000],
            ['nombre'=>'Resma A4 500h',     'codigo'=>'PAP-001', 'categoria_id'=>$cat2->id, 'stock'=>4,  'precio'=>25000],
            ['nombre'=>'Taladro Bosch',     'codigo'=>'TAL-001', 'categoria_id'=>$cat3->id, 'stock'=>8,  'precio'=>450000],
        ];

        foreach ($productos as $p) {
            Producto::firstOrCreate(['codigo' => $p['codigo']], $p);
        }
    }
}
