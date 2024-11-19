<?php

namespace App\Jobs;

use App\Contracts\Interfaces\ManagerInterface;
use App\Enums\RoleEnum;
use App\Models\Company;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ManagerAccountCreated implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly Company          $company,
        public readonly ManagerInterface $manager)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->manager->store([
            'name' => "manager-" . strtolower(str_replace(' ', '-', $this->company->name)),
            'email' => "manager-" . strtolower(str_replace(' ', '-', $this->company->name)) . '@gmail.com',
            'password' => bcrypt('password'),
            'role' => RoleEnum::MANAGER->value,
            'company_id' => $this->company->id,
        ]);
    }
}
