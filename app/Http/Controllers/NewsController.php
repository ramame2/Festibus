<?php
namespace App\Http\Controllers;

use App\Models\News; // Make sure to import the News model
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Show a specific news article
    public function show($id)
    {
        // Fetch the news item by its ID
        $newsItem = News::findOrFail($id); // If the news item doesn't exist, it will throw a 404 error

        // Return the view with the news item
        return view('news.show', compact('newsItem'));
    }

    public function index()
    {
        $news = News::paginate(10);
        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        News::create($request->all());

        return redirect()->route('news.index')->with('success', 'Niews item succesvol toegevoegd.');
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $news->update($request->all());

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }
}
