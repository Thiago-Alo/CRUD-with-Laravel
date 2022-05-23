<?php

namespace App\Exports;

use App\Player;
use App\Models\Players;
use Maatwebsite\Excel\Concerns\FromCollection;

class PlayersExport implements FromCollection
{
    public function collection()
    {
        return Player::all();
    }
}
