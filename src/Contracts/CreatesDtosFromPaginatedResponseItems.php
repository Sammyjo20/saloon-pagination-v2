<?php

declare(strict_types=1);

namespace Saloon\PaginationPlugin\Contracts;

interface CreatesDtosFromPaginatedResponseItems
{
    /**
     * Create DTOs from the paginated response items.
     *
     * @param array<array-key, mixed> $items
     */
    public function createDtoFromPaginatedResponseItem(array $items): object;
}
