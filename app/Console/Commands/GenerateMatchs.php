<?php

namespace App\Console\Commands;

use App\Models\Player;
use App\Models\PlayerMatch;
use Illuminate\Console\Command;

class GenerateMatchs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:match';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $players = Player::get();
        foreach ($players as $key => $homePlayer) {
            foreach ($players as $awayPlayer) {
                $newMatch = new PlayerMatch;
                $newMatch->home_id = $homePlayer->id;
                if ($awayPlayer->id != $homePlayer->id) {
                    $checkDuplicate = PlayerMatch::where('away_id', $homePlayer->id)->where('home_id', $awayPlayer->id)->first();
                    if (empty($checkDuplicate)) {
                        $newMatch->away_id = $awayPlayer->id;
                        // dd($newMatch);
                        $newMatch->save();
                    } else {
                        continue;
                    }
                } else {
                    continue;
                }
            }
        }
    }
}
