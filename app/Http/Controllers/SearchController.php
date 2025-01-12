<?php

namespace App\Http\Controllers;

use App\Models\BusRoute;
use App\Models\Location;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class SearchController extends Controller
{
    public function searchForm()
    {
        // Fetch all locations for the search form
        $locations = Location::all();
        return view('home', compact('locations'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query'); // Get the search query
        $departure_id = $request->input('departure'); // Get the departure location if provided, it can be null

        // Fetch the latest news
        $news = News::latest()->take(5)->get();

        // Fetch all locations
        $locations = Location::all();

        // Excluded tables for search
        $excludedTables = [
            'users', 'cache', 'cache_locks', 'bookings', 'contacts', 'about_infos',
            'failed_jobs', 'job_batches', 'jobs', 'bus_routes', 'photos',
            'migrations', 'password_reset_tokens', 'personal_access_tokens',
            'sessions'
        ];

        // Get all tables from the database
        $tables = DB::select('SHOW TABLES');
        $tables = array_map(function ($table) {
            return (array) $table;
        }, $tables);
        $tables = array_column($tables, key($tables[0]));

        // Filter out the excluded tables
        $tables = array_diff($tables, $excludedTables);

        // Perform the search across all tables
        $results = [];
        foreach ($tables as $table) {
            $searchResults = DB::table($table)
                ->where(function ($queryBuilder) use ($query, $table) {
                    $columns = DB::getSchemaBuilder()->getColumnListing($table);
                    foreach ($columns as $column) {
                        if (!in_array($column, ['id', 'created_at', 'updated_at'])) {
                            $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
                        }
                    }
                })
                ->get();

            if ($searchResults->isNotEmpty()) {
                $results[$table] = $searchResults->map(function ($result) use ($table, $departure_id) {
                    $filteredResult = (array) $result;
                    unset($filteredResult['id'], $filteredResult['created_at'], $filteredResult['updated_at']);

                    if ($table == 'news') {
                        $filteredResult['link'] = url("/news/{$result->id}");
                    } elseif ($table == 'festivals') {
                        $filteredResult['link'] = url("/festivals/");
                    } elseif ($table == 'locations') {
                        // Modify the link for locations to handle both departure and destination search
                        if ($departure_id) {
                            $filteredResult['link'] = url("search/results?departure={$departure_id}&destination={$result->id}");
                        } else {
                            $filteredResult['link'] = url("search/results?departure={$result->id}");
                        }
                        $filteredResult['name'] = $filteredResult['name'] ?? 'Unnamed Location';
                    } elseif ($table == 'faqs') {
                        $filteredResult['link'] = url("/faq/");
                        $filteredResult['question'] = Str::limit($filteredResult['question'], 100);
                        $filteredResult['answer'] = Str::limit($filteredResult['answer'], 150);
                    }

                    if (isset($filteredResult['image'])) {
                        $filteredResult['image'] = '<img src="' . asset($filteredResult['image']) . '" alt="Image" style="width:100px;height:auto;">';
                    }

                    return (object) $filteredResult;
                });
            }
        }

        // If a departure is selected, fetch associated bus routes
        $routes = [];
        if ($departure_id) {
            $destination_id = $request->input('destination'); // Get the destination if provided
            $routes = BusRoute::where('departure_id', $departure_id)
                ->when($destination_id, function ($query, $destination_id) {
                    return $query->where('destination_id', $destination_id);
                })
                ->get();
        }

        // Search for pages (routes and views) that contain the query
        $pages = [];
        $allRoutes = Route::getRoutes();

        foreach ($allRoutes as $route) {
            if (str_contains($route->getName(), $query) || str_contains($route->getActionName(), $query)) {
                $view = $route->getAction('view');
                if ($view && View::exists($view)) {
                    $pageContent = View::make($view)->render();
                    if (str_contains($pageContent, $query)) {
                        $pages[] = $route->getName();
                    }
                }
            }
        }

        // Pass all data to the view
        return view('search.results', compact('results', 'query', 'news', 'locations', 'routes', 'pages'));
    }
}
