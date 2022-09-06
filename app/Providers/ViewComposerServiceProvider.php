<?php

namespace App\Providers;

use App\Http\ViewComposers\AddressComposer;
use App\Http\ViewComposers\AttachmentComposer;
use App\Http\ViewComposers\AuthenticatedUserComposer;
use App\Http\ViewComposers\CompanyComposer;
use App\Http\ViewComposers\DueTaxComposer;
use App\Http\ViewComposers\InvoiceComposer;
use App\Http\ViewComposers\LocationComposer;
use App\Http\ViewComposers\OrderComposer;
use App\Http\ViewComposers\PaymentComposer;
use App\Http\ViewComposers\ProcessorComposer;
use App\Http\ViewComposers\ReportSectionComposer;
use App\Http\ViewComposers\ServiceComposer;
use App\Http\ViewComposers\SourceComposer;
use App\Http\ViewComposers\TaxSegmentComposer;
use App\Http\ViewComposers\TicketComposer;
use App\Http\ViewComposers\UserComposer;
use App\Http\ViewComposers\UtilityComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // States for address select
        View::composer('sources.partials.form', SourceComposer::class);
        View::composer('analysis.explore', SourceComposer::class);
        View::composer('analysis.ofert', SourceComposer::class);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
