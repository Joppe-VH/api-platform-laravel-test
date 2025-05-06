<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\RequestBody;
use ApiPlatform\Laravel\Eloquent\Filter\PartialSearchFilter;
use ApiPlatform\Metadata\QueryParameter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ApiPlatform\Metadata\Link;

#[Get()]
#[Patch()]
#[Delete()]
#[Post()]
// using api resource attribute to group the two get collection operations
// this way we can use the same parameters for both operations
#[ApiResource(
    operations: [
        new GetCollection(),
        new GetCollection(
            uriTemplate: '/inventories/{id}/items',
            uriVariables: [
                'id' => new Link(fromClass: Inventory::class, toProperty: 'inventory')
            ],
        )
    ],
    paginationItemsPerPage: 2,
    paginationMaximumItemsPerPage: 10,
    paginationClientItemsPerPage: true,
    parameters: [
        'name' => new QueryParameter(
            filter: PartialSearchFilter::class,
            description: 'Search by name'
        ),
        'description' => new QueryParameter(
            filter: PartialSearchFilter::class,
            description: 'Search by description'
        )
    ]
)]
#[ApiProperty(property: 'name', example: 'Item 1')]
#[ApiProperty(property: 'description', example: 'Description 1')]
class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    #[ApiProperty(example: 'api/inventories/1')]
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
}
