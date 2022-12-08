<?php

declare(strict_types=1);

namespace App\Jobs\Reports;

use App\Mail\Reports\CertExpiryMail;
use App\Models\Member;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GenerateCertExpiryReport implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function handle(): void
    {
        $members = $this->getMembers();
        $users = $this->getUsers();

        foreach ($users as $user) {
            Mail::to($user->email)->queue(new CertExpiryMail($members));
        }
    }

    public function getMembers(): Collection
    {
        return Member::query()
            ->where('cfr_certificate_expiry', '<', now()->addMonths(2))
            ->get();
    }

    public function getUsers(): Collection
    {
        return User::query()
            ->where('receive_reports', '=', true)
            ->get();
    }
}
