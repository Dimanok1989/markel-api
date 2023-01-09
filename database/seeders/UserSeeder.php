<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Sanctum\PersonalAccessToken;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'firstname' => "Дмитрий",
            'lastname' => "Маркелов",
            'patronymic' => "Маркович",
            'name' => "Маркелов Дмитрий Маркелович",
            'email' => decrypt("eyJpdiI6ImdVeVpQOHU5T2o5NjI1RVdUSEx3NUE9PSIsInZhbHVlIjoiWnJoVFhHV2JRMGZvTjhsRGlycDcrb3EvQUdjUTFRZEppYzdUdkVLWmtpND0iLCJtYWMiOiIwMmE0NTI2OTU3NThiZGZjMjQ4ZjA2NTk2MDI5MTA4MjYxZmNkNmVmNzMyZGVmOWM4MDljNjAxMGNlNTAyOTRhIiwidGFnIjoiIn0="),
            'phone' => decrypt("eyJpdiI6Ind1cmVMUSttWEsvV2c0em5QenNnS0E9PSIsInZhbHVlIjoia3U4enIreldheXhDdUpDNlQ0NEM1dU4xV2pONk5NZUVrM0xYdlp3Y0Y0RT0iLCJtYWMiOiI5MWUzOWMwNzJkNjA4NjQ0NjVmMzhmOWYwNDQxNGZlZWQ5ZWQ0Y2RiZGZkNmQwNWQyMjQ0NmQ0YzBmYTE4NDQ0IiwidGFnIjoiIn0="),
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'is_admin' => true,
            'password' => '$2y$10$G9UI1o6gTvF3DBSJs2vwpuvBTu1qWg8TjaMzEVcKGx/0fhlyPfSDm',
        ]);

        $user->roles()->attach(1);

        PersonalAccessToken::create([
            'tokenable_type' => "App\Models\User",
            'tokenable_id' => 1,
            'name' => "Auto-generated",
            'token' => decrypt("eyJpdiI6ImNwMVZ5a0dTYzUyWVRmSXVEUnlheXc9PSIsInZhbHVlIjoiNTBrbXNoakEweXVGRE91TEpQNkR3MWFJWHU0VHhTRmg0aWJ3d29MQTNMK21UMDc5SmdBL0FnajI2azFuNFE5UCtCM1NNbG0yMHRSRCt2THFGNXdrYmJhNXZCUG4wdDZHbm0vTjNKOC9QQmc9IiwibWFjIjoiNTQ4ZWQ5OGI1NjY3MTkyZmEzMzdiMjczMTlkYTBkYjMzOTg2NmVlN2ZlNDA1ZDc3ZDNkZTc4MGU1YzkxYzNjMiIsInRhZyI6IiJ9"),
            'abilities' => ["*"],
        ]);
    }
}
