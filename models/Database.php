<?php namespace NielsVanDenDries\Blacklistingbot\Models;

use Model;
use Carbon\Carbon;

/**
 * Model
 */
class Database extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    /**
     * @var array dates to cast from the database.
     */
    protected $dates = ['deleted_at'];

    /**
     * @var string table in the database used by the model.
     */
    protected $table = 'nielsvandendries_blacklistingbot_database';
    protected $fillable = ['username', 'description', 'tags'];

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

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