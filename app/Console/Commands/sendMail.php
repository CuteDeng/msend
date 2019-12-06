<?php

namespace App\Console\Commands;

use App\Mail\MovieMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class sendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send qq mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $movie = new MovieMail(base_path('data/movie/[心中的阳光原创][08年伊朗剧情][背马鞍的男孩][DVD-RMVB][中文字幕].rmvb'));
        Mail::to('1030104698@qq.com')->send($movie);
        // 判断邮件是否发送失败
        if(count(Mail::failures())) {
            return '邮件发送失败';
        }
    }
}
