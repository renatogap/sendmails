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

    public function create(array $data)
    {
        return Tag::create($data);
    }

    public function update($id, array $data)
    {
        $tag = Tag::find($id);
        return $tag ? $tag->update($data) : null;
    }

    public function delete($id)
    {
        $tag = Tag::find($id);
        return $tag ? $tag->delete() : null;
    }

}
