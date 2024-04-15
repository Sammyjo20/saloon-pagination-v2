<?php

declare(strict_types=1);

namespace Saloon\PaginationPlugin\Tests\Fixtures\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\PaginationPlugin\Tests\Fixtures\Data\Superhero;

class DtoPagedRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    /**
     * Define the endpoint for the request.
     */
    public function resolveEndpoint(): string
    {
        return '/superheroes/per-page';
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $items = $response->json()['data'];

        return array_map(function ($item) {
            return new Superhero(
                id: $item['id'],
                superhero: $item['superhero'],
                publisher: $item['publisher'],
                alter_ego: $item['alter_ego'],
                first_appearance: $item['first_appearance'],
                characters: $item['characters'],
            );
        }, $items);
    }
}
