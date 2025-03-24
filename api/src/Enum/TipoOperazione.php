<?php

// src/Enum/TipoOperazione.php
namespace App\Enum;

enum TipoOperazione: string
{
    case SOMMA = 'somma';
    case SOTTRAZIONE = 'sottrai';
    case MOLTIPLICAZIONE = 'moltiplica';
    case DIVISIONE = 'dividi';
}
