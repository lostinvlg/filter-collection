# Filter Collection

## Usage
```php
$bag = new FilterBag();
$bag
    ->add(new Filter(FilterType::RANGE, 'price', 'Price', '', 'rub.', [
        new FilterValue(1000, null),
        new FilterValue(2999, null),
    ]))
    ->add(new Filter(FilterType::BOOLEAN, 'in-stock', 'Only available', '', '', [
        new FilterValue(1, 'Yes'),
        new FilterValue(0, 'No'),
    ]))
    ->add(new Filter(FilterType::SINGLE, 'brand', 'Manufacturer', '', '', [
        new FilterValue(10, 'LG'),
        new FilterValue(20, 'Samsung'),
        new FilterValue(30, 'Toshiba'),
    ]))
    ->add(new Filter(FilterType::MULTI, 'model', 'Model', '', '', [
        new FilterValue(110, 'LG Model-1'),
        new FilterValue(120, 'LG Model-2'),
        new FilterValue(112, 'Samsung Super Model'),
        new FilterValue(113, 'Toshiba Old Model'),
    ]))
    ->add(new Filter(FilterType::COLOR, 'color', 'Model', '', '', [
        new FilterValue(25, 'White'),
        new FilterValue(26, 'Black'),
        new FilterValue(26, 'Gray'),
    ]));

$filterCollection = new FilterCollection($bag);
$query = $request->query->all(); // $_GET
$filterCollection->parse($query);
$allFilters = $filterCollection->getFilters();
$validFilters = $filterCollection->getValidFilters();
```

Valid query string:
```
price=1000;2000&in-stock=1&brand=20&model=110,120,&color=25,26
```

Range query string can contain zeros:
```
price=1000   // from 1000
price=0;2000 // from 0 to 2000
price=;2000  // from 0 to 2000
price=1000;0 // from 1000
```
