<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection;

use Lostinvlg\FilterCollection\Normalizer\NormalizerFactory;
use Lostinvlg\FilterCollection\Validator\ValidatorFactory;

class FilterCollection implements \JsonSerializable
{
    private ValidatorFactory $validatorFactory;

    private NormalizerFactory $normalizerFactory;

    private FilterBag $validFilters;

    public function __construct(private FilterBag $filters)
    {
        $this->validatorFactory = new ValidatorFactory();
        $this->normalizerFactory = new NormalizerFactory();
        $this->validFilters = new FilterBag();
    }

    public function getFilters(): FilterBag
    {
        return $this->validFilters;
    }

    public function parse(array $query): self
    {
        $validators = [];
        $normalizers = [];
        foreach ($this->filters as $filter) {
            if (!isset($query[$filter->name])) {
                continue;
            }
            $normalizer = $normalizers[$filter->type->value] ?? null;
            if (null === $normalizer) {
                $normalizer = $this->normalizerFactory->make($filter->type);
                $normalizers[$filter->type->value] = $normalizer;
            }
            $validator = $validators[$filter->type->value] ?? null;
            if (null === $validator) {
                $validator = $this->validatorFactory->make($filter);
                $validators[$filter->type->value] = $validator;
            }
            $value = $normalizer->normalize($query[$filter->name]);
            if ($validator->validate($value)) {
                $valid = (clone $filter)->setFiltered(\is_array($value) ? $value : [$value]);
                $this->validFilters->add($valid);
            }
        }
        unset($validators, $normalizers);

        return $this;
    }

    public function jsonSerialize(): FilterBag
    {
        return $this->validFilters;
    }
}
