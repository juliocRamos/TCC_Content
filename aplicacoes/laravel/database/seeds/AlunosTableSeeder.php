<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AlunosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 80000; $i++) {
            DB::table('alunos')->insert(
                [
                    'nome' => $faker->name,
                    'email' => $faker->email,
                    'idade' => $faker->numberBetween(16, 100),
                    'sexo' => $faker->randomElement(['Masculino', 'Feminino']),
                    'created_at' => $faker->dateTimeBetween('-6 week', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-3 week', 'now'),
                ]
            );
        }

    }
}
