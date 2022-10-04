<?php

declare(strict_types=1);

namespace Companyservice\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Companybase\Models\Admin;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Builder;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'services';

    /**
     * @var array
     */
    protected $fillable = ['service_name', 'slug', 'price', 'package', 'effective_time', 'display_position', 're_top', 'job_alert', 'feature', 'warranty', 'user_id', 'status'];

    protected $dates 	= ['deleted_at'];

    /**
     *  Get the name record associated with the user.
     *
     * @param null
     * @return belongsTo
     */
    public function user() : belongsTo
    {
        return $this->belongsTo(Admin::class, 'user_id')->withDefault();
    }

    /**
     * Scope a query to only include tags of a given type.
     *
     * @param  $query
     * @return Builder
     */
    public function scopeActive($query) :Builder
    {
        return $query->where('status', 'active');
    }

    /**
     * Count model
     *
     * @param null
     * @return int
     */
    public static function countTag() : int
    {
        $counts = Service::active()->count();

        if($counts){
            return $counts;
        }

        return 0;
    }
}

