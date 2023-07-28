<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            [
                'name' => 'Proceso',
                'active' => '1',
            ],
            [
                'name' => 'Pagado',
                'active' => '1',
            ],
            [
                'name' => 'Rechazado',
                'active' => '1',
            ],
            [
                'name' => 'Cancelado',
                'active' => '1',
            ],
        ];
       State::insert($states);
    }
}
