<?php namespace Nielsvandendries\Blacklistingbot\Components;

use Cms\Classes\ComponentBase;
use Nielsvandendries\Blacklistingbot\Models\Requests;

class Unlistingrequest extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Unlisting Request Form',
            'description' => 'Form for unlisting'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
}
