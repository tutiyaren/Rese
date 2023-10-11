<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail;
use App\Models\Reservation;

class Batch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description =  'laravel commandのtest';

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
     * @return int
     */
    public function handle()
    {
        // バッチ処理の誤差
        $from = now()->subSeconds(5);
        $to = now()->addSeconds(5);

        // 予約情報の取得
        $reservations = Reservation::where('date', '>=', $from->format('Y-m-d'))->where('date', '<=', $to->format('Y-m-d'))->get();

        //メール送信をする
        foreach ($reservations as $reservation) {
            $shop = $reservation->shop;
            $user = $shop->user;
            $representative = $shop->representative;

            Mail::to($user->email)->send(new ReminderMail($reservation));
        }
    }
}
