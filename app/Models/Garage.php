<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Garage extends Model
{
    protected $fillable = [

        'name',
        'short_description',
        'description',
        'phone_number',
        'address',
        'website',
        'province_id',
        'district_id',
        'ward_id',
        'user_id',
        'working_time',
        'avatar',
    ];

    /**
     * Get full path for avatar.
     * @param $value
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        return config('common.path.image') . $value;
    }

    /**
     * Get all visits.
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function visits()
    {
        return $this->morphMany(Visit::class, 'visitable');
    }

    /**
     * Get all comments.
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    /**
     * Get user who had created.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get ratings.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get rating by current user.
     * @return rating.
     * @return null
     */
    public function ratingByCurrentAuth()
    {
        if (Auth::check()) {
            return $this->ratings()->where('user_id', Auth::user()->id);
        }
        return null;
    }
    /**
     * Get all services.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function province()
    {
        return $this->belongsTo(AdministrationUnit::class, 'province_id');
    }
    public function district()
    {
        return $this->belongsTo(AdministrationUnit::class, 'district_id');
    }

    public function getAdministrationUnits()
    {
        $provinceId = $this->province_id;
        $province = AdministrationUnit::find($provinceId);
        $district = $province->children()->where('id', $this->district_id)->first();
        $ward = $district->children()->where('id', $this->ward_id)->first();
        return [
            'province' => $province,
            'district' => $district,
            'ward' => $ward,
        ];
    }

    public function getAddressByUnits()
    {
        $units = $this->getAdministrationUnits();
        $address = '';
        foreach ($units as $unit) {
            $address .= $unit->name . ' ';
        }

        return $address;
    }

    public function getPlace($id)
    {
        return $this->administrationUnit();
    }
}
