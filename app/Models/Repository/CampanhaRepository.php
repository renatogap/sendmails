<?php

namespace App\Models\Repository;

use App\Models\Entity\Campanha;

class CampanhaRepository
{
    public static function getAll()
    {
        return Campanha::all();
    }

    public static function find($id)
    {
        return Campanha::find($id);
    }

    public static function create(array $data)
    {
        return Campanha::create($data);
    }

    public static function update($id, array $data)
    {
        $campanha = Campanha::find($id);
        return $campanha ? $campanha->update($data) : null;
    }

    public static function delete($id)
    {
        $campanha = Campanha::find($id);
        return $campanha ? $campanha->delete() : null;
    }

}
