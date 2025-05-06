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
#[ApiProperty(property: 'name', example: 'Inventory 1')]
class Inventory extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    #[ApiProperty(writable: false, openapiContext: [
        'type' => 'array',
        'items' => [
            'type' => 'string',
            'format' => 'iri-reference',
            'example' => 'api/items/1'
        ]
    ])]
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
