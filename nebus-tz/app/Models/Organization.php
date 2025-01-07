<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Organization",
 *     type="object",
 *     required={"id", "name"},
 *     @OA\Property(property="id", type="integer", description="Organization ID"),
 *     @OA\Property(property="name", type="string", description="Organization Name"),
 *     @OA\Property(property="building_id", type="integer", description="Building ID"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Creation date"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Last update date")
 * )
 */
class Organization extends Model
{
    protected $fillable = ['name', 'phone_numbers', 'building_id'];

    protected $casts = [
        'phone_numbers' => 'array',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }
}
