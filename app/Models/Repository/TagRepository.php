<?php

namespace App\Models\Repository;

use App\Models\Entity\Tag;

class TagRepository
{
    public static function getAll()
    {
        return Tag::all();
    }

    public static function find($id)
    {
        return Tag::find($id);
    }

    public static function create(array $data)
    {
        return Tag::create($data);
    }

    public static function update($id, array $data)
    {
        $tag = Tag::find($id);
        return $tag ? $tag->update($data) : null;
    }

    public static function delete($id)
    {
        $tag = Tag::find($id);
        return $tag ? $tag->delete() : null;
    }

}
