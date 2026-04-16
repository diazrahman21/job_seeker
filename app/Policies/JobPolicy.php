<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Job;

class JobPolicy
{
    /**
     * Determine if the company can view the job
     */
    public function view(Company $company, Job $job): bool
    {
        // Allow viewing if company is the job owner
        return $company->id === $job->company_id;
    }

    /**
     * Determine if the company can update the job
     */
    public function update(Company $company, Job $job): bool
    {
        return $company->id === $job->company_id;
    }

    /**
     * Determine if the company can delete the job
     */
    public function delete(Company $company, Job $job): bool
    {
        return $user->id === $job->company_id;
    }
}
