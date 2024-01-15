<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection;

class Filter implements \JsonSerializable
{
    /**
     * All filter values (e.g. for build form).
     *
     * @var array<int, FilterValue>
     */
    private array $values = [];

    /**
     * Valid filter values.
     *
     * @var array<mixed>
     */
    private array $filtered = [];

    public function __construct(
        public readonly FilterType $type,
        public readonly string $name,
        public readonly string $title,
        public readonly string $description = '',
        public readonly string $suffix = '',
        array $values = [],
    ) {
        $this->setValues($values);
    }

    public function addValue(FilterValue $value): self
    {
        $this->values[] = $value;

        return $this;
    }

    /*
     * @param <int, FilterValue> $values
     */
    public function setValues(array $values): self
    {
        foreach ($values as $value) {
            $this->addValue($value);
        }

        return $this;
    }

    /**
     * @return array<int, FilterValue>
     */
    public function getValues(): array
    {
        return $this->values;
    }

    public function getFiltered(): array
    {
        return $this->filtered;
    }

    public function setFiltered(array $filtered): self
    {
        $this->filtered = $filtered;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type->value,
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
            'suffix' => $this->suffix,
            'values' => $this->values,
            'filtered' => $this->filtered,
        ];
    }
}
