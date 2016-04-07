<?php
/**
 * Created by PhpStorm.
 * User: gys
 * Date: 16/4/1
 * Time: 下午4:40
 */

use Illuminate\Database\Seeder;
use App\App;

class AppTableSeeder extends Seeder {

    public function run()
    {
        DB::table('Apps')->delete();

        for ($i=1; $i <= 20; $i++) {
            App::create([
                'name'   => 'App '.$i
            ]);
        }
    }

}