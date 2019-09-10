<?php
/**
 * Class ModelRoleSeeder
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

/**
 * Class ModelRoleSeeder
 */
class ModelRoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_has_roles')->insert(
            [
                [
                    'role_id' => '1',
                    'model_id' => '1',
                    'model_type' => 'App\User',
                ],
                // User
                [
                    'role_id' => '2',
                    'model_id' => '2',
                    'model_type' => 'App\User',
                ],
            ]
        );
    }
}
