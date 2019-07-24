<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DeliverySlipPDFService;
use DateTime;

class SendDeliverySlipsEmail extends Command
{

    private const FIRST_BATCH  = '11:30';
    private const SECOND_BATCH = '15:30';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:senddeliveryslip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        date_default_timezone_set('Asia/Manila');
        $currentTime = date("H:i");

        if (in_array($currentTime, [self::FIRST_BATCH, self::SECOND_BATCH])) {
            $DeliverySlipPDFService = new DeliverySlipPDFService();
            $DeliverySlipPDFService->sendDeliverySlips();        
        }
    }
}
