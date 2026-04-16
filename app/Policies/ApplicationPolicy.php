<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\Company;

class ApplicationPolicy
{
    /**
     * Determine if the company can view the application
     */
    public function view(Company $company, Application $application): bool
    {
        // Allow viewing if company is the recruiter that posted the job
        return $company->id === $application->job->company_id;
    }

    /**
     * Determine if the company can update the application
     */
    public function update(Company $company, Application $application): bool
    {
        return $company->id === $application->job->company_id;
    }
}
