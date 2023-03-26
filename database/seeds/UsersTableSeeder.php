<?php
  
use Illuminate\Database\Seeder;
use App\User;
   
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('adminadmin'),
            'level' =>'admin',
        ]); 
        User::create([
            'name' => 'Darwin Sibarani',
            'id_vendor' => 2011000155,            
            'email' => 'sibaranidarwin32@gmail.com',
            'npwp' => '4444444444444444',
            'password' => bcrypt('adminadmin'),
            'level' =>'pengunjung',
        ]); 
    }
}