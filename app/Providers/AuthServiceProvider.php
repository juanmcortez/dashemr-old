<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Patients\Patient' => 'App\Policies\Patients\PatientPolicy',
        'App\Models\Patients\Demographic' => 'App\Policies\Patients\DemographicPolicy',
        'App\Models\Invoices\Encounter' => 'App\Policies\Invoices\EncounterPolicy',
        'App\Models\Invoices\Charge' => 'App\Policies\Invoices\ChargePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
