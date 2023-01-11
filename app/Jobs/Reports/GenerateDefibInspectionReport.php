<?php

declare(strict_types=1);

namespace App\Jobs\Reports;

use App\Mail\Reports\DefibInspectionMail;
use App\Models\Defib;
use App\Traits\GetsReportRecipients;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GenerateDefibInspectionReport implements ShouldQueue
{
    use Dispatchable;
    use GetsReportRecipients;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public string $key = 'defib_inspection';

    public function handle(): void
    {
        $defibs = $this->getDefibs();
        $recipients = $this->getRecipients();

        foreach ($recipients as $recipient) {
            Mail::to($recipient->user->email)->queue(new DefibInspectionMail($defibs));
        }
    }

    public function getDefibs(): Collection
    {
        return Defib::query()
            ->where('last_inspected_at', '<', now()->subMonths(1))
            ->orWhereNull('last_inspected_at')
            ->get();
    }
}
