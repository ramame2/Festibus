<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

public function index(Request $request)
{
// FAQ Search & Filtering Logic
$query = Faq::query();

if ($request->has('search')) {
$query->where('question', 'like', '%' . $request->search . '%');
}

if ($request->has('category')) {
$query->where('category', $request->category);
}

$faqs = $query->get();

return view('faq.index', compact('faqs'));
}

public function create()
{
return view('faq.create');
}

public function store(Request $request)
{
$request->validate([
'question' => 'required|string|max:255',
'answer' => 'required|string',
'category' => 'required|in:Algemeen,Specifiek,Services,Bereikbaarheid',
]);

Faq::create($request->all());

return redirect()->route('faq.index')->with('success', 'FAQ added successfully');
}

public function edit(Faq $faq)
{
return view('faq.edit', compact('faq'));
}

public function update(Request $request, Faq $faq)
{
$request->validate([
'question' => 'required|string|max:255',
'answer' => 'required|string',
'category' => 'required|in:Algemeen,Specifiek,Services,Bereikbaarheid',
]);

$faq->update($request->all());

return redirect()->route('faq.index')->with('success', 'FAQ updated successfully');
}

public function destroy(Faq $faq)
{
$faq->delete();

return redirect()->route('faq.index')->with('success', 'FAQ deleted successfully');
}
}
