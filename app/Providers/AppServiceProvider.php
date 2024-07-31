<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        $categories = Category::with('sub_categories')->where('status', 1)->orderBy('order_by','asc')->get();
        $tags = Tag::where('status', 1)->orderBy('order_by', 'asc')->get();
        View::share(["categories"=>$categories, "tags"=>$tags]);
    }
}
