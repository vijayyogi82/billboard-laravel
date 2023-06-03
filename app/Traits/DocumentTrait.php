<?php

namespace App\Traits;

use App\Models\Document;
use App\Models\User;

trait DocumentTrait
{
    /*
    * Type
    *
    customer => 1, quotation => 2, invoice => 3, payment => 4, job => 5, visit => 6, closer => 7, engineer => 8, product => 9, service => 10
    *
    */

    protected static function documentUpdate(int $document, int $type, int $parent, int $added_by)
    {
        Document::where('id', $document)->update([
            'type' => $type,
            'parent' => $parent,
            'added_by' => $added_by,
        ]);
    }

}
