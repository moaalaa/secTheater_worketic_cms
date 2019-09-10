<?php
/**
 * Class UserSeeder.
 *
 * @category Worketic
 *
 * @package Worketic
 * @author  Amentotech <theemail@gmail.com>
 * @license http://www.email.com Amentotech
 * @link    http://www.email.com
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Class UserSeeder
 */
class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                //Admin
                [
                    'first_name' => 'chris',
                    'last_name' => 'evans',
                    'slug' => 'chris-evans',
                    'email' => 'admin@email.com',
                    'password' => bcrypt('123123'),
                    'location_id' => 1,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                // User
                [
                    'first_name' => 'user',
                    'last_name' => 'test',
                    'slug' => 'user-test',
                    'email' => 'user@test.com',
                    'password' => bcrypt('123123'),
                    'location_id' => 1,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
