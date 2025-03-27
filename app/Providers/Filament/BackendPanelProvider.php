<?php

namespace App\Providers\Filament;

use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use App\Filament\Resources\SchoolResource;

class BackendPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('backend')
            ->path('backend')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->navigationGroups([
                '網站管理',
                '合作學校',
                '學生管理',
                '會員管理',
                '系統設定'
            ])
            ->defaultThemeMode(ThemeMode::Light)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                // Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
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
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder
                    ->groups([
                        NavigationGroup::make('網站管理')
                            ->items([
                                ...NavigationItem::getNavigationItems(),
                            ])
                            ->collapsible(),
                    ]);
            })
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth('full')
            ->brandName('飛師特留學')
            ->favicon(asset('images/favicon.ico'))
            ->navigationItems([
                NavigationItem::make('合作學校')
                    ->icon('heroicon-o-academic-cap')
                    ->isActiveWhen(fn (): bool => request()->routeIs(['filament.backend.resources.schools.*']))
                    ->url(fn (): string => SchoolResource::getUrl())
                    ->sort(1),
                // 其他導航項目...
            ])
            ->defaultUrl(fn (): string => SchoolResource::getUrl());
    }
}
