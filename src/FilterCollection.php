<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection;

use Lostinvlg\FilterCollection\Normalizer\NormalizerFactory;
use Lostinvlg\FilterCollection\Validator\ValidatorFactory;

final class FilterCollection implements \JsonSerializable
{
    private ValidatorFactory $validatorFactory;

    private NormalizerFactory $normalizerFactory;

    public function __construct(private FilterBag $filters)
    {
        $this->validatorFactory = new ValidatorFactory();
        $this->normalizerFactory = new NormalizerFactory();
    }

    public function getFilters(): FilterBag
    {
        return $this->filters;
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
                $filter->setFiltered(\is_array($value) ? $value : [$value]);
            }
        }
        unset($validators, $normalizers);

        return $this;
    }

    public function jsonSerialize(): FilterBag
    {
        return $this->filters;
    }
}
