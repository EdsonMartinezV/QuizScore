<?php

namespace App;

enum MatchType: string{
    case REGULAR = 'regular';
    case QUARTER_FINAL = 'quarter_final';
    case SEMI_FINAL = 'semi_final';
    case THIRD = 'third';
    case FINAL = 'final';
}
