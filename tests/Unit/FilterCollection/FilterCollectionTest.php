<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection\Tests;

use Lostinvlg\FilterCollection\Filter;
use Lostinvlg\FilterCollection\FilterBag;
use Lostinvlg\FilterCollection\FilterCollection;
use Lostinvlg\FilterCollection\FilterType;
use Lostinvlg\FilterCollection\FilterValue;
use PHPUnit\Framework\TestCase;

final class FilterCollectionTest extends TestCase
{
    public function testEmptyFilters(): void
    {
        $filterCollection = new FilterCollection($this->createAllowedFilters());
        $filterCollection->parse([]);
        foreach ($filterCollection->getFilters() as $filter) {
            $this->assertEmpty($filter->getFiltered());
        }
    }

    public function testAllFilters(): void
    {
        $filterCollection = new FilterCollection($this->createAllowedFilters());
        // emulates $_GET
        $query = [
            'price' => '101;2999',
            'stock' => '1',
            'brand' => '1',
            'model' => '10,11',
            'color' => '36',
        ];
        $filterCollection->parse($query);
        foreach ($filterCollection->getFilters() as $filter) {
            $this->assertNotEmpty($filter->getValues());
            $this->assertIsArray($filter->jsonSerialize());
        }
    }

    public function testSerialization(): void
    {
        $filterCollection = new FilterCollection($this->createAllowedFilters());
        $json = \json_encode($filterCollection);
        $this->assertJson($json);
    }

    private function createAllowedFilters(): FilterBag
    {
        $bag = new FilterBag();
        $bag
            ->add(new Filter(FilterType::RANGE, 'price', 'Цена', '', 'руб.', [
                new FilterValue(100, null),
                new FilterValue(3000, null),
            ]))
            ->add(new Filter(FilterType::BOOLEAN, 'stock', 'В наличии', '', '', [
                new FilterValue(1, 'Да'),
                new FilterValue(0, 'Нет'),
            ]))
            ->add(new Filter(FilterType::SINGLE, 'brand', 'Производитель', '', '', [
                new FilterValue(1, 'LG'),
                new FilterValue(2, 'Samsung'),
                new FilterValue(3, 'Toshiba'),
            ]))
            ->add(new Filter(FilterType::MULTI, 'model', 'Модель', '', '', [
                new FilterValue(10, 'LG Model-1'),
                new FilterValue(11, 'LG Model-2'),
                new FilterValue(21, 'Samsung Model-1'),
                new FilterValue(22, 'Toshiba Model-1'),
            ]))
            ->add(new Filter(FilterType::COLOR, 'color', 'Цвет', '', '', [
                new FilterValue(35, 'Белый'),
                new FilterValue(36, 'Черный'),
            ]));

        return $bag;
    }
}
