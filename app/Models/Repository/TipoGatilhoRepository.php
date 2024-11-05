<?php

namespace App\Models\Repository;

use App\Models\Entity\TipoGatilho;

class TipoGatilhoRepository
{
    public static function getAll()
    {
        return TipoGatilho::all();
    }

    public static function find($id)
    {
        return TipoGatilho::find($id);
    }

    public function create(array $data)
    {
        return TipoGatilho::create($data);
    }

    public function update($id, array $data)
    {
        $tipoGatilho = TipoGatilho::find($id);
        return $tipoGatilho ? $tipoGatilho->update($data) : null;
    }

    public function delete($id)
    {
        $tipoGatilho = TipoGatilho::find($id);
        return $tipoGatilho ? $tipoGatilho->delete() : null;
    }

}
