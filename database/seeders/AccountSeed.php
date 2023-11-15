<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'user_id' => 1,
                'platform' => 'twitter',
                'consumer_key' => 'X3jC4zlQOLghHf6VUi638HllZ',
                'consumer_secret' => 'j3UhGocCyRXKzvZdbva28zmy2ZtiNPsoSdQ1ZTqaXjv15Njrxt',
                'bearer_token' => 'AAAAAAAAAAAAAAAAAAAAAByyqgEAAAAAotOeoQRAKexbyLBFCE8bgqSDW9Q%3D46aG7qVqAW2NxkP6HTw1hK8RFKL2NpdZSa2Ci1m5wOyJ3c9WKP',
                'access_token' => '1713798306512752640-naLgw2jXypPhDN8gKAJn68LQsCImy0',
                'refresh_token' => 'RyT9eItBSRyQEUakeuZ9EqgWN8UXDgSav4Qi0iZ7XSLNM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'platform' => 'twitter',
                'consumer_key' => 'EaOlEJkloxXtcl0h8jw8j7REn',
                'consumer_secret' => 'AqkGA1oZIVWpwYY0WpEQHPG1KJKtpse3TawMu3YUQei5rFGcFZ',
                'bearer_token' => 'AAAAAAAAAAAAAAAAAAAAABZvqgEAAAAARfKNyaGLLKclRU2PiSfHBBlOuPU%3D5A8qTBcAvld4o2JJRz7h5ZsJNgqhQG2raVsmAXscLZxNQuJHjg',
                'access_token' => '1502465858844917762-dwdJMUacdJZzwzqd06ifzCkGmWZR1B',
                'refresh_token' => 'cg5aoOgnoUfsjb3naeYRPkUF06H6TSzr8qeNfKHe9qp1U',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        foreach ($data as $record) {
            Account::create($record);
        }

    }
}