<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['name' => 'Cerveja'],
            ['name' => 'Carne'],
            ['name' => 'Pão de Alho'],
            ['name' => 'Refrigerante'],
            ['name' => 'Guardanapo'],
            ['name' => 'Carvão'],
            ['name' => 'Alcool'],
            ['name' => 'Churrasqueira']
        ]);

        $this->command->info('Products imported with success!');
    }
}
