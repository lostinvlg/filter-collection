<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection;

/**
 * @template-implements \IteratorAggregate<Filter>
 */
class FilterBag implements \Countable, \IteratorAggregate, \JsonSerializable
{
    private array $items = [];

    public function count(): int
    {
        return \count($this->items);
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator(\array_values($this->items));
    }

    /**
     * @param Filter|array<Filter> $filter
     */
    public function add(Filter|array $filter): self
    {
        if (\is_array($filter)) {
            foreach ($filter as $item) {
                $this->add($item);
            }

            return $this;
        }
        $this->items[$filter->name] = $filter;

        return $this;
    }

    public function getOne(string $slug): ?Filter
    {
        return $this->items[$slug] ?? null;
    }

    /**
     * @return array<Filter>
     */
    public function getAll(): array
    {
        return $this->items;
    }

    public function jsonSerialize(): array
    {
        return ['items' => \array_values($this->items)];
    }
}
