<?php

namespace App\Models\Repository;

use App\Models\Entity\TemplateEmail;

class TemplateEmailRepository
{
    public static function getAll()
    {
        return TemplateEmail::all();
    }

    public static function find($id)
    {
        return TemplateEmail::find($id);
    }

    public static function create(array $data)
    {
        return TemplateEmail::create($data);
    }

    public static function update($id, array $data)
    {
        $template = TemplateEmail::find($id);
        return $template ? $template->update($data) : null;
    }

    public static function delete($id)
    {
        $template = TemplateEmail::find($id);
        return $template ? $template->delete() : null;
    }

}
