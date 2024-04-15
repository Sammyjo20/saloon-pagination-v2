<?php

declare(strict_types=1);

namespace Saloon\PaginationPlugin\Tests\Fixtures\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\PaginationPlugin\Contracts\CreatesDtosFromPaginatedResponseItems;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\PaginationPlugin\Tests\Fixtures\Data\Superhero;

class DtoPagedRequest extends Request implements Paginatable, CreatesDtosFromPaginatedResponseItems
{
    protected Method $method = Method::GET;

    /**
     * Define the endpoint for the request.
     */
    public function resolveEndpoint(): string
    {
        return '/superheroes/per-page';
    }

    public function createDtoFromPaginatedResponseItem(array $items): object
    {
        return new Superhero(
            id: $items['id'],
            superhero: $items['superhero'],
            publisher: $items['publisher'],
            alter_ego: $items['alter_ego'],
            first_appearance: $items['first_appearance'],
            characters: $items['characters'],
        );
    }
}
