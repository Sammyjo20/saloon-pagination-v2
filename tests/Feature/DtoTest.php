<?php

declare(strict_types=1);

use Illuminate\Support\LazyCollection;
use Saloon\PaginationPlugin\Tests\Fixtures\Connectors\PagedConnector;
use Saloon\PaginationPlugin\Tests\Fixtures\Data\Superhero;
use Saloon\PaginationPlugin\Tests\Fixtures\Requests\DtoPagedRequest;

test('you can iterate through the DTOs of a paginated resource', function () {
    $connector = new PagedConnector;
    $request = new DtoPagedRequest();
    $paginator = $connector->paginate($request);

    $superheroes = [];

    foreach ($paginator->dtos() as $dto) {
        $superheroes[] = $dto;
    }

    expect($superheroes)
        ->toContainOnlyInstancesOf(Superhero::class)
        ->toHaveCount(20);
});

test('you can iterate through the DTOs of a paginated resource using a lazy collection', function () {
    $connector = new PagedConnector;
    $request = new DtoPagedRequest();
    $paginator = $connector->paginate($request);

    $superheroes = $paginator->collectDtos();

    expect($superheroes)
        ->toBeInstanceOf(LazyCollection::class)
        ->toContainOnlyInstancesOf(Superhero::class)
        ->toHaveCount(20);
});
