<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\PemeriksaanGigi;
use App\Models\Dokter;

class SendPemeriksaanGigiNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // $dokter = Dokter::get();
        // Notification::send($dokter, new PemeriksaanGigiNotification($event->pemeriksaan));
    }
}
