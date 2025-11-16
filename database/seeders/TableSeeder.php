<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            // 4 tables capacity 2 (Meja 1-4)
            ['name' => 'Meja 1', 'capacity' => 2, 'position_x' => 100, 'position_y' => 100, 'is_active' => true],
            ['name' => 'Meja 2', 'capacity' => 2, 'position_x' => 250, 'position_y' => 100, 'is_active' => true],
            ['name' => 'Meja 3', 'capacity' => 2, 'position_x' => 400, 'position_y' => 100, 'is_active' => true],
            ['name' => 'Meja 4', 'capacity' => 2, 'position_x' => 550, 'position_y' => 100, 'is_active' => true],

            // 6 tables capacity 4 (Meja 5-10)
            ['name' => 'Meja 5', 'capacity' => 4, 'position_x' => 100, 'position_y' => 250, 'is_active' => true],
            ['name' => 'Meja 6', 'capacity' => 4, 'position_x' => 250, 'position_y' => 250, 'is_active' => true],
            ['name' => 'Meja 7', 'capacity' => 4, 'position_x' => 400, 'position_y' => 250, 'is_active' => true],
            ['name' => 'Meja 8', 'capacity' => 4, 'position_x' => 550, 'position_y' => 250, 'is_active' => true],
            ['name' => 'Meja 9', 'capacity' => 4, 'position_x' => 100, 'position_y' => 400, 'is_active' => true],
            ['name' => 'Meja 10', 'capacity' => 4, 'position_x' => 250, 'position_y' => 400, 'is_active' => true],

            // 3 tables capacity 6 (Meja 11-13)
            ['name' => 'Meja 11', 'capacity' => 6, 'position_x' => 400, 'position_y' => 400, 'is_active' => true],
            ['name' => 'Meja 12', 'capacity' => 6, 'position_x' => 550, 'position_y' => 400, 'is_active' => true],
            ['name' => 'Meja 13', 'capacity' => 6, 'position_x' => 175, 'position_y' => 550, 'is_active' => true],

            // 2 tables capacity 8 (Meja 14-15)
            ['name' => 'Meja 14', 'capacity' => 8, 'position_x' => 325, 'position_y' => 550, 'is_active' => true],
            ['name' => 'Meja 15', 'capacity' => 8, 'position_x' => 475, 'position_y' => 550, 'is_active' => true],
        ];

        foreach ($tables as $table) {
            Table::create($table);
        }
    }
}
