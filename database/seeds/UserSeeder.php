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
                    'password' => bcrypt('google'),
                    'location_id' => 1,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Employers
                [
                    'first_name' => 'Employer',
                    'last_name' => 'Nguyen',
                    'slug' => 'employer-nguyen',
                    'email' => 'employer@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 1,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Charlotte',
                    'last_name' => 'Morton',
                    'slug' => 'charlotte-morton',
                    'email' => 'Charlotte@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 1,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Cooper',
                    'last_name' => 'White',
                    'slug' => 'cooper-white',
                    'email' => 'white@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 1,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => Carbon::now()->addDays(10)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Elijah',
                    'last_name' => 'Johnson',
                    'slug' => 'elijah-johnson',
                    'email' => 'johnson@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 2,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Brooklyn',
                    'last_name' => 'Chan',
                    'slug' => 'brooklyn-chan',
                    'email' => 'chan@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 2,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => Carbon::now()->addDays(360)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Beau',
                    'last_name' => 'Simard',
                    'slug' => 'beau-simard',
                    'email' => 'beau@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 2,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Isobel',
                    'last_name' => 'Jones',
                    'slug' => 'isobel-jones',
                    'email' => 'isobel@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 3,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => Carbon::now()->addDays(10)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Kian',
                    'last_name' => 'Johnson',
                    'slug' => 'kian-johnson',
                    'email' => 'kian@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 3,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Sarah',
                    'last_name' => 'Chapman',
                    'slug' => 'sarah-chapman',
                    'email' => 'sarah@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 3,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => Carbon::now()->addDays(360)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Abhinav',
                    'last_name' => 'Balasubramanium',
                    'slug' => 'abhinav-balasubramanium',
                    'email' => 'balasubramanium@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 4,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Anika',
                    'last_name' => 'Gavde',
                    'slug' => 'anika-gavde',
                    'email' => 'anika@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 4,
                    'user_verified' => 1,
                    'badge_id' => 1,
                    'expiry_date' => Carbon::now()->addDays(10)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                // Freelancers
                [
                    'first_name' => 'Freelancer',
                    'last_name' => 'Malhotra',
                    'slug' => 'freelancer-malhotra',
                    'email' => 'freelancer@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 4,
                    'user_verified' => 1,
                    'badge_id' => 3,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Alara',
                    'last_name' => 'Tekin',
                    'slug' => 'alara-tekin',
                    'email' => 'tekin@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 5,
                    'user_verified' => 1,
                    'badge_id' => 1,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Sait',
                    'last_name' => 'Karaca',
                    'slug' => 'sait-karaca',
                    'email' => 'karaca@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 5,
                    'user_verified' => 1,
                    'badge_id' => 1,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Hüsnü',
                    'last_name' => 'Çomak',
                    'slug' => 'hüsnü-comak',
                    'email' => 'comak@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 5,
                    'user_verified' => 1,
                    'badge_id' => 2,
                    'expiry_date' => Carbon::now()->addDays(360)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Jack',
                    'last_name' => 'Mills',
                    'slug' => 'jack-mills',
                    'email' => 'mills@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 6,
                    'user_verified' => 1,
                    'badge_id' => 3,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Judy',
                    'last_name' => 'Dixon',
                    'slug' => 'judy-dixon',
                    'email' => 'dixon@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 6,
                    'user_verified' => 1,
                    'badge_id' => 2,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Ann',
                    'last_name' => 'Coleman',
                    'slug' => 'ann-coleman',
                    'email' => 'coleman@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 6,
                    'user_verified' => 1,
                    'badge_id' => 1,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Louis',
                    'last_name' => 'James',
                    'slug' => 'louis-james',
                    'email' => 'james@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 7,
                    'user_verified' => 1,
                    'badge_id' => 3,
                    'expiry_date' => Carbon::now()->addDays(360)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Kai',
                    'last_name' => 'Clarke',
                    'slug' => 'kai-clarke',
                    'email' => 'kai@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 7,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Georgia',
                    'last_name' => 'Baker',
                    'slug' => 'georgia-baker',
                    'email' => 'baker@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 7,
                    'user_verified' => 1,
                    'badge_id' => 2,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Ralph',
                    'last_name' => 'Davis',
                    'slug' => 'ralph-davis',
                    'email' => 'davis@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 8,
                    'user_verified' => 1,
                    'badge_id' => 3,
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'first_name' => 'Alexa',
                    'last_name' => 'Xavier',
                    'slug' => 'jhon-xavier',
                    'email' => 'jhon@email.com',
                    'password' => bcrypt('google'),
                    'location_id' => 8,
                    'user_verified' => 1,
                    'badge_id' => 2,
                    'expiry_date' => Carbon::now()->addDays(360)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
