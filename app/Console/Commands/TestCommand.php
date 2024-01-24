<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = 'https://cdn.learnku.com//uploads/communities/WtC3cPLHzMbKRSZnagU9.png';
        if (!strpos($url, config('filesystems.disks.doge.url'))) {
            $aurl = parse_url($url, PHP_URL_PATH);
            $ext = pathinfo($aurl, PATHINFO_EXTENSION);
            $fileName = 'posts/images/' . md5($url) . '.' . $ext;
            Storage::disk('doge')->put($fileName, file_get_contents($url));
            $url = Storage::disk('doge')->url($fileName);
        }
        dd($url);
    }
}
