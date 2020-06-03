<?php

namespace Masterix21\LaravelBoilerplate;

use Illuminate\Support\ServiceProvider;

class BoilerplateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/boilerplate'),
            ], 'views');

            if (! class_exists('CreateStoryStatusesTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_tags_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_tags_table.php'),
                    __DIR__ . '/../database/migrations/alter_table_users.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_alter_table_users.php'),
                    __DIR__ . '/../database/migrations/create_addresses_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_addresses_table.php'),
                    __DIR__ . '/../database/migrations/create_contacts_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_contacts_table.php'),
                    __DIR__ . '/../database/migrations/create_story_statuses_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_story_statuses_table.php'),
                    __DIR__ . '/../database/migrations/create_stories_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_stories_table.php'),
                ], 'migrations');
            }
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'boilerplate');
    }

    public function register()
    {
        // $this->mergeConfigFrom(__DIR__.'/../config/skeleton.php', 'boilerplate');
    }
}
