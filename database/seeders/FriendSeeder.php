<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Friend;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $friendsFile = fopen("./database/data/friends.csv", "r");

        while(! feof($friendsFile)) {
            $data = [];
            $friendsData = fgetcsv($friendsFile);

            foreach ($friendsData as $friend) {
                $item = str_getcsv($friend);
                $data[] = $item[0];
            }

            $fdata = [
                'first_name' => $data[0],
                'last_name' => $data[1],
                'nick_name' => $data[2],
                'birthdate' => $data[3],
            ];

            $friends = new Friend();
            $friends->fill($fdata);
            $friends->save();
        }
        fclose($friendsFile);
    }
}
