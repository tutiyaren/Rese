<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Mail\ReservationConfirmationMail;
use App\Models\Shop;

class SendReservationEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservation:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reservation confirmation email to users';

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
        $today = Carbon::now();
        $reservations = Reservation::whereDate('date', $today)
        ->get();

        foreach ($reservations as $reservation) {
            // 予約に関連する店舗を取得
            $shop = $reservation->shop;

            // 店舗代表者のメールアドレスを取得
            $representativeEmail = $shop->representative->email;

            // メールを送信するコード
            Mail::to($reservation->user->email)->send(new ReservationConfirmationMail($representativeEmail));
        }

        $this->info('Reservation confirmation emails sent successfully.');
    }
}
