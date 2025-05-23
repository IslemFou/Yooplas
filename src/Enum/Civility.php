<?php

namespace App\Enum;

enum Civility: string
{
    case MADAME = 'f';
    case MONSIEUR = 'h';

    public function label(): string
{
    return match ($this) {
        self::MONSIEUR => 'M.',
        self::MADAME => 'Mme',
    };
}
}
