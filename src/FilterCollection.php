<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection;

use Lostinvlg\FilterCollection\Normalizer\NormalizerFactory;
use Lostinvlg\FilterCollection\Validator\ValidatorFactory;

class FilterCollection
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
        return $this->filters;
    }

    public function getValidFilters(): FilterBag
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
            try {
                $value = $normalizer->normalize($query[$filter->name]);
                if ($validator->validate($value)) {
                    $filter->setFiltered(\is_array($value) ? $value : [$value]);
                    $this->validFilters->add(clone $filter);
                }
            } catch (\InvalidArgumentException) {
            }
        }
        unset($validators, $normalizers);

        return $this;
    }
}
