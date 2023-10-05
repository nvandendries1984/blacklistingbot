<?php namespace Nielsvandendries\Blacklistingbot\Components;

use Cms\Classes\ComponentBase;
use Nielsvandendries\Blacklistingbot\Models\Database;
use Nielsvandendries\Blacklistingbot\Models\Privatedatabasemodel;

class Lookup extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Lookup Component',
            'description' => 'Look for registered'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onSearch()
    {
        $searchUsername = input('searchUsername');
    
        // Search for the username in the database
        $userFound = Database::whereRaw("BINARY username = ?", [$searchUsername])->first();
    
        return [
            '#searchResults' => $this->renderPartial('@search-results', ['userFound' => $userFound]),
            'js' => 'window.scrollTo(0, document.body.scrollHeight);', // Scroll to bottom of the page
        ];
    }
    
}
