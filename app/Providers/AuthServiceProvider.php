<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\SKPengajuan;
use App\Models\Anggota;
use App\Policies\PostPolicy;
use App\Policies\SKPengajuanPolicy;
use App\Policies\AnggotaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        SKPengajuan::class => SKPengajuanPolicy::class,
        Anggota::class => AnggotaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
