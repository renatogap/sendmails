<?php

namespace App\Http\Controllers\MailMarketin;

use App\Http\Controllers\Controller;
use App\Models\Repository\TagRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('mail-marketing.tag.index');
    }

    public function getAll()
    {
        $tags = TagRepository::getAll();
        return response()->json($tags);
    }
}
