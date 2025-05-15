<?php

namespace App\Models;

enum Turn: string
{
    case X = 'X';
    case O = 'O';
    case Empty = '';
}
