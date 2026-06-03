<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        // Fitur Search sederhana
        $query = Article::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Ambil data artikel, urutkan dari terbaru, dan kasih pagination (misal 9 per halaman)
        $articles = $query->latest()->paginate(9);

        // Kirim data $articles ke view lu
        return view('informasi.gaya-hidup', compact('articles'));
    }

    // Fungsi buat nampilin detail artikel pas diklik "Baca Selengkapnya"
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('informasi.gaya-hidup-detail', compact('article'));
    }
}