<?php

namespace Tyondo\Cashflow\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'office_id', 'role_id', 'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function routeNotificationForSlack()
    {
        //  return $this->slack_webhook_url; //use this if you have slack_webhook_url
        //in database
        $webhookURL = 'https://musonikenya.slack.com/services/hooks/slackbot?token=wzk12tgwgBsAAHUIibDTUJ48&channel=cashflow-nofication';
      //  $webhookURL = 'https://musonikenya.slack.com/services/hooks/slackbot?token=wzk12tgwgBsAAHUIibDTUJ48';
        return $webhookURL;
    }
    public function role()
      {
        return $this->belongsTo('App\Role');
      }
    public function office()
      {
        return $this->belongsTo('App\Office');
      }
}
