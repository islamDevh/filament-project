<?php

namespace App\Providers\Filament;

use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class BorrowerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        // dd(get_class_methods($panel)); // show all available methods

        return $panel
            ->id('borrower')
            ->path('borrower')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->login()
            ->discoverResources(in: app_path('Filament/Borrower/Resources'), for: 'App\Filament\Borrower\Resources')
            ->discoverPages(in: app_path('Filament/Borrower/Pages'), for: 'App\Filament\Borrower\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Borrower/Widgets'), for: 'App\Filament\Borrower\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->profile()
            ->simpleProfilePage()
            ->spa()
            ->spaUrlExceptions([
                'admin/profile',
            ])
            ->unsavedChangesAlerts()
            ->databaseTransactions()
            ->brandName('Filament Admin Panel')
            ->brandLogo(asset('images/image.jpg'))  // but it do override on the brand name, if you want both use ->brandLogo(function () { return view(...); })
            ->brandLogoHeight('10px')
            ->favicon(asset('favicon.ico'))
            ->darkMode(false) // dont show mode toggle switch
            ->defaultThemeMode(ThemeMode::class::Dark) // light, dark, system (default)
            ->darkModeBrandLogo(asset('images/image.jpg'))
            ->font('poppins') // available fonts google
            ->sidebarWidth('500px')
            ->sidebarCollapsibleOnDesktop()
            ->sidebarFullyCollapsibleOnDesktop()
            ->navigation(false) // disable navigation
            // ->topNavigation()
            // ->topbar(false)
        ;
    }
}
