<?php

namespace App\Models\Repository;

use App\Models\Entity\Negocio;

class NegocioRepository
{
    public static function getAll()
    {
        return Negocio::all();
    }

    public static function find($id)
    {
        return Negocio::find($id);
    }

    public function create(array $data)
    {
        return Negocio::create($data);
    }

    public function update($id, array $data)
    {
        $negocio = Negocio::find($id);
        return $negocio ? $negocio->update($data) : null;
    }

    public function delete($id)
    {
        $negocio = Negocio::find($id);
        return $negocio ? $negocio->delete() : null;
    }

}
