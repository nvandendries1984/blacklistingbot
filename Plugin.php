<?php namespace NielsVanDenDries\Blacklistingbot;

use System\Classes\PluginBase;

/**
 * Plugin class
 */
class Plugin extends PluginBase
{
    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return [
            'NielsVanDenDries\Blacklistingbot\Components\Registration' => 'Registration',
            'NielsVanDenDries\Blacklistingbot\Components\Lookup' => 'Lookup',
            'NielsVanDenDries\Blacklistingbot\Components\Unlistingrequest' => 'Unlistingrequest',
        ];
    }

    /**
     * registerSettings used by the backend.
     */
    public function registerSettings()
    {
    }
}
