<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection;

final readonly class FilterValue implements \JsonSerializable
{
    public function __construct(
        public int|float|string $value,
        public ?string $title = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'v' => $this->value,
            't' => $this->title,
        ];
    }
}
