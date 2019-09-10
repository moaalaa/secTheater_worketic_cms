<?php
/**
 * Class ProfileSeeder.
 *
 * @category Worketic
 *
 * @package Worketic
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Class ProfileSeeder
 */
class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert(
            [
                //Admin
                [
                    'user_id' => '1',
                    'department_id' => null,
                    'no_of_employees' => null,
                    'freelancer_type' => null,
                    'english_level' => null,
                    'hourly_rate' => null,
                    'experience' => null,
                    'education' => null,
                    'projects' => null,
                    'awards' => null,
                    'saved_jobs' => null,
                    'saved_employers' => null,
                    'ratings' => null,
                    'address' => null,
                    'longitude' => null,
                    'latitude' => null,
                    'avater' => 'a.jpg',
                    'banner' => 'b.jpg',
                    'gender' => null,
                    'tagline' => null,
                    'description' => null,
                    'delete_reason' => null,
                    'delete_description' => null,
                    'profile_searchable' => null,
                    'profile_blocked' => null,
                    'weekly_alerts' => null,
                    'message_alerts' => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                // User
                [
                    'user_id' => '2',
                    'department_id' => 1,
                    'no_of_employees' => 1,
                    'freelancer_type' => 'agency',
                    'english_level' => 'fluent',
                    'hourly_rate' => null,
                    'experience' => null,
                    'education' => null,
                    'projects' => null,
                    'awards' => null,
                    'saved_jobs' => null,
                    'saved_employers' => null,
                    'ratings' => null,
                    'address' => 'Larapinta Dr Alice Springs NT 0870 Australia',
                    'longitude' => '133.368101',
                    'latitude' => '-24.004758',
                    'avater' => 'a.jpg',
                    'banner' => 'b.jpg',
                    'gender' => null,
                    'tagline' => 'Excepteur sint occaecat cupidatat non proident',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.
Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.',
                    'delete_reason' => null,
                    'delete_description' => null,
                    'profile_searchable' => null,
                    'profile_blocked' => null,
                    'weekly_alerts' => null,
                    'message_alerts' => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
