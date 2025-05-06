<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiProperty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource(
    paginationItemsPerPage: 10,
    paginationMaximumItemsPerPage: 30,
    paginationClientItemsPerPage: true
)]
class Inventory extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    #[ApiProperty(writable: false)]
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
