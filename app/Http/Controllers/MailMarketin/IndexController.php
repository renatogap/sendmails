<?php

namespace App\Http\Controllers\MailMarketin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('mail-marketing.index');
    }
}
