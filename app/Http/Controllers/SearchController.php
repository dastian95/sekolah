<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Student;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (empty($query)) {
            return redirect()->back()->with('error', 'Kata kunci pencarian tidak boleh kosong.');
        }

        $students = Student::where('nama', 'like', "%{$query}%")
            ->orWhere('nis', 'like', "%{$query}%")
            ->orWhere('nisn', 'like', "%{$query}%")
            ->limit(10)
            ->get();

        $news = News::where('title', 'like', "%{$query}%")
            ->where('is_published', true)
            ->limit(10)
            ->get();

        return view('search.results', compact('students', 'news', 'query'));
    }
}
