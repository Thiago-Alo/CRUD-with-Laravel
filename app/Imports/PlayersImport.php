<?php

namespace App\Imports;

use App\Player;
use App\Models\Players;
use Maatwebsite\Excel\Concerns\ToModel;

class PlayersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Player([
            'name'     => $row[2],
           'address' => $row[3],
           'description' => $row[4],
        ]);
    }
}
