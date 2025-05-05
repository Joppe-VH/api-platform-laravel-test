<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\RequestBody;
use ApiPlatform\Laravel\Eloquent\Filter\PartialSearchFilter;
use ApiPlatform\Metadata\QueryParameter;

#[ApiResource(
    paginationItemsPerPage: 2,
    paginationMaximumItemsPerPage: 10,
    paginationClientItemsPerPage: true
)]
#[GetCollection(
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
#[Get()]
#[Patch()]
#[Delete()]
#[Post(
    openapi: new Operation(
        requestBody: new RequestBody(
            content: new \ArrayObject([
                'application/ld+json' => [
                    'example' => [
                        'name' => 'Item 1',
                        'description' => 'Description 1'
                    ]
                ]
            ])
        )
    )
)]
class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];
}
