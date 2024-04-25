<?php

declare(strict_types=1);

use Illuminate\Support\LazyCollection;
use Saloon\PaginationPlugin\Contracts\CreatesDtosFromPaginatedResponseItems;
use Saloon\PaginationPlugin\Tests\Fixtures\Connectors\PagedConnector;
use Saloon\PaginationPlugin\Tests\Fixtures\Data\Superhero;
use Saloon\PaginationPlugin\Tests\Fixtures\Requests\DtoPagedRequest;
use Saloon\PaginationPlugin\Tests\Fixtures\Requests\SuperheroPagedRequest;

test('you can iterate through the DTOs of a paginated resource', function () {
    $connector = new PagedConnector();
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
    $connector = new PagedConnector();
    $request = new DtoPagedRequest();
    $paginator = $connector->paginate($request);

    $superheroes = $paginator->collectDtos();

    expect($superheroes)
        ->toBeInstanceOf(LazyCollection::class)
        ->toContainOnlyInstancesOf(Superhero::class)
        ->toHaveCount(20);
});

test('throws an error when trying to iterate through the DTOs of a paginated resource without implementing the required interface', function () {
    $connector = new PagedConnector();
    $request = new SuperheroPagedRequest();
    $paginator = $connector->paginate($request);

    foreach ($paginator->dtos() as $ignored) {}
})->throws(
    LogicException::class,
    'The request must implement the ' . CreatesDtosFromPaginatedResponseItems::class . ' interface to be used on paginators.'
);
