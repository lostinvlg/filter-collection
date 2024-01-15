<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection;

enum FilterType: int
{
    case BOOLEAN = 1;

    case SINGLE = 2;

    case MULTI = 3;

    case RANGE = 4;

    case COLOR = 5;
}
