<?php

namespace App\Models\Repository;

use App\Models\Entity\Lead;

class LeadRepository
{
    public static function getAll()
    {
        return Lead::with('campanha')->with('leadTags')->orderBy('email')->get();
    }

    public static function find($id)
    {
        return Lead::find($id);
    }

    public static function create(array $data)
    {
        return Lead::create($data);
    }

}
