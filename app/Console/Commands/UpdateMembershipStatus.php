<?php

namespace App\Console\Commands;

use App\Models\MembersTrack;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UpdateMembershipStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membership:update-status';
    protected $description = 'Update status membership based on end_membership date';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ambil data membership yang sudah expired dan aktif
        $expiredActiveMemberships = MembersTrack::where('end_membership', '<', Carbon::now())
            ->where('status', 'active') // Hanya ambil yang status 'active'
            ->get();

        foreach ($expiredActiveMemberships as $membership) {
            $membership->status = 'expired'; // Set status menjadi 'expired'
            $membership->save();
            $this->info("Membership ID {$membership->id} has been set to expired.");
        }

        // Ambil data membership yang sudah expired dan status 'waiting'
        $expiredWaitingMemberships = MembersTrack::where('end_membership', '<', Carbon::now())
            ->where('status', 'waiting') // Hanya ambil yang status 'waiting'
            ->get();

        foreach ($expiredWaitingMemberships as $membership) {
            $membership->status = 'expired'; // Set status menjadi 'expired'
            $membership->save();
            $this->info("Membership ID {$membership->id} with waiting status has been set to expired.");
        }

        $this->info('Membership status updated successfully.');
    }
}
