<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('emonevuser')->insert([
                'name' => 'Ricky Resky Ananda',
                'username' => 'superadmin',
                'password' => bcrypt('superadmin'),
                'level' => 'superadmin',
                'sts' => 0,
                'created_by' => '1',
                'updated_by' => '1',
                // 'updated_at'=>date('Y-m-d h:i:s'),
                // 'created_at'=>date('Y-m-d h:i:s'),
            ]);

        for ($i=1; $i < 3; $i++) { 
            DB::table('emonevuser')->insert([
                'name' => 'Ricky Resky Ananda',
                'username' => 'admin'.$i,
                'password' => bcrypt('admin'.$i),
                'level' => 'admin',
                'sts' => 0,
                'created_by' => '1',
                'updated_by' => '1',
                // 'updated_at'=>date('Y-m-d h:i:s'),
                // 'created_at'=>date('Y-m-d h:i:s'),
            ]);
        }
    }
}
