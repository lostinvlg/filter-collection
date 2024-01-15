<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection;

class FilterValue implements \JsonSerializable
{
    public function __construct(
        public readonly int|float|string $value,
        public readonly ?string $title = null,
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
