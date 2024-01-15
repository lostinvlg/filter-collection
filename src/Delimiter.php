<?php

declare(strict_types=1);

namespace Lostinvlg\FilterCollection;

enum Delimiter: string
{
    case RANGE = ';';

    case MULTI = ',';
}
