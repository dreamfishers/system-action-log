<?php
namespace Dreamfishers\SystemActionLog\Models;

use Illuminate\Database\Eloquent\Model;

class SystemActionLog extends Model {

    protected $table = "system_action_log";

    protected $fillable = ['uid','username','type','ip','content'];
}
