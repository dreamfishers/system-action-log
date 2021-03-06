<?php

namespace Dreamfishers\SystemActionLog\Repositories;

use Dreamfishers\SystemActionLog\Services\clientService;

class ActionLogRepository
{


  /**
   * 记录用户操作日志
   * @param $type
   * @param $content
   * @param ActionLog $actionLog
   * @return bool
   */
  public function createActionLog($type,$model, $content)
  {
    $actionLog = new \Dreamfishers\SystemActionLog\Models\SystemActionLog();
    if ( auth()->check() ) {
      $actionLog->uid = auth()->user()->id;
      $actionLog->username = auth()->user()->name;
    } else {
      $actionLog->uid = 0;
      $actionLog->username = "访客";
    }

    if(array_key_exists('HTTP_USER_AGENT',$_SERVER)){
      $actionLog->browser = clientService::getBrowser($_SERVER['HTTP_USER_AGENT'], true);
      $actionLog->system = clientService::getPlatForm($_SERVER['HTTP_USER_AGENT'], true);
    }else{
      $actionLog->browser = null;
      $actionLog->system = null;
    }

    $actionLog->url = request()->getRequestUri();
    $actionLog->ip = request()->getClientIp();
    $actionLog->type = $type;
    $actionLog->model = $model;
    $actionLog->content = $content;
    $res = $actionLog->save();

    return $res;
  }
}
