<?php namespace Nielsvandendries\Blacklistingbot\Components;

use Cms\Classes\ComponentBase;
use Nielsvandendries\Blacklistingbot\Models\Requests;
use Flash;

class Requests extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Requests Component',
            'description' => 'Where recorded usernames can be reviewd'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
}
