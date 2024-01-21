<?php namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Musrenbang;

class WebMusrenbangController extends Controller
{
    public function index()
    {
       // $musrenbang = Musrenbang::where('status', 1)->latest()->paginate(10);
        //$page_title = 'Pertanyaan Yang Sering Diajukan';

        return view('pages.musrenbang.index');
    }
}
