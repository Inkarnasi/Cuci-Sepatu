<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Promosi;
use Carbon\Carbon;

class UpdatePromotionStatus extends Command
{
    protected $signature = 'promotion:update-status';
    protected $description = 'Update the status of promotions based on their start and end date';

    public function handle()
    {
        $today = Carbon::today();

        // Update upcoming promotions
        Promosi::where('start_date', '>', $today)
            ->update(['status' => 'upcoming']);

        // Update active promotions
        Promosi::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->update(['status' => 'active']);

        // Update expired promotions
        Promosi::where('end_date', '<', $today)
            ->update(['status' => 'expired']);

        $this->info('Promotion statuses updated successfully!');
    }
}
