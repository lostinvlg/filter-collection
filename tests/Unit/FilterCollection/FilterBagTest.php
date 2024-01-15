<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Tests;

use Lostinvlg\FilterCollection\Filter;
use Lostinvlg\FilterCollection\FilterBag;
use Lostinvlg\FilterCollection\FilterType;
use Lostinvlg\FilterCollection\FilterValue;
use PHPUnit\Framework\TestCase;

final class FilterBagTest extends TestCase
{
    public function testSomeFilters(): void
    {
        $bag = new FilterBag();
        $this->assertEmpty(\count($bag));
        $filter = new Filter(FilterType::BOOLEAN, 'boolean-slug', 'Boolean title', '', '', [
            new FilterValue(1, 'Yes'),
            new FilterValue(0, 'No'),
        ]);
        $bag->add($filter);
        $this->assertCount(1, $bag);
        $this->assertSame($filter, $bag->getOne('boolean-slug'));
        $this->assertNotEmpty($bag->getAll());
        $this->assertCount(1, $bag->getAll());
    }

    public function testSerialization(): void
    {
        $bag = new FilterBag();
        $filters = [
            new Filter(FilterType::BOOLEAN, 'boolean1', 'Boolean1 title', '', '', [
                new FilterValue(1, 'Yes'),
                new FilterValue(0, 'No'),
            ]),
            new Filter(FilterType::BOOLEAN, 'boolean2', 'Boolean2 title', '', '', [
                new FilterValue(1, 'Yes'),
                new FilterValue(0, 'No'),
            ]),
        ];
        $bag->add($filters);
        \json_encode($bag, JSON_THROW_ON_ERROR);
        $arr = $bag->jsonSerialize();
        $this->assertIsArray($arr);
        $this->assertArrayHasKey('items', $arr);
        $this->assertCount(2, $arr['items']);
    }
}
