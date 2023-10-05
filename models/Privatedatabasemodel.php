<?php namespace NielsVanDenDries\Blacklistingbot\Models;

use Model;
use RainLab\User\Facades\Auth; // Voeg deze regel bovenaan je bestand toe om de Auth-facade te gebruiken.
use Carbon\Carbon;

class Privatedatabasemodel extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    protected $table = 'nielsvandendries_blacklistingbot_privatedatabase';
    protected $fillable = ['username', 'description', 'tags'];

    public $rules = [
    ];
    
    public $belongsTo = [
        'user' => ['RainLab\User\Models\User', 'key' => 'user_id']
    ];
    
    public function getPrivateDataForCurrentUser()
    {
        $user = Auth::getUser();
        if ($user) {
            // Haal privégegevens op voor de ingelogde gebruiker
            $privateData = Privatedatabasemodel::where('user_id', $user->id)->get();
            return $privateData;
        } else {
            // Gebruiker is niet ingelogd, retourneer lege set of geef een foutmelding terug
            return [];
        }
    }

    public function getWarningAttribute()
    {
        $registrationDate = Carbon::parse($this->created_at);
        $now = Carbon::now();
        $daysDifference = $registrationDate->diffInDays($now);
    
        if ($daysDifference > 30) {
            return 'Username registered for more than 30 days';
        } else {
            $daysLeft = 30 - $daysDifference;
            return "$daysLeft days left, before removal";
        }
    }
}
