<?php

namespace App\Http\Controllers\MailMarketin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Entity\Lead;
use App\Models\Entity\Tag;
use App\Models\Regras\TagRegras;
use App\Models\Repository\LeadRepository;
use Exception;

class LeadController extends Controller
{
    public function index()
    {
        return view('mail-marketing.lead.index');
    }

    public function search()
    {
        $leads = LeadRepository::getAll();
        return response()->json($leads);
    }
}
