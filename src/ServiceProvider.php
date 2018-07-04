<?php

namespace Dreamfishers\SystemActionLog;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use ActionLog;

class ServiceProvider extends LaravelServiceProvider
{
  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
    // Publish configuration files

    $this->publishes([
      __DIR__ . '/migrations' => database_path('migrations'),
    ], 'migrations');


    $this->publishes([
      __DIR__ . '/config/system_action_log.php' => config_path('system_action_log.php'),
    ], 'config');

    $model = config("system_action_log");

    if ($model) {

      foreach ($model as $k => $v) {

        $v::updated(function ($data) {
          ActionLog::createActionLog('更新',$k, "更新的id:" . $data->id);
        });

        $v::saved(function ($data) {
          ActionLog::createActionLog('新建',$k, "添加的id:" . $data->id);
        });

        $v::deleted(function ($data) {
          ActionLog::createActionLog('删除',$k,"删除的id:" . $data->id);
        });

      }
    }

  }

  /**
   * Register the application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->singleton("ActionLog", function ($app) {
      return new \Dreamfishers\SystemActionLog\Repositories\ActionLogRepository();
    });
  }
}
