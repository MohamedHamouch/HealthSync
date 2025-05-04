<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FoodSearchController extends Controller
{
    /**
     * The API key for Food Data Central API
     */
    protected $apiKey;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->apiKey = config('services.fooddata.key');
    }
    
    /**
     * Show the food search page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('client.food-search.index');
    }
    
    /**
     * Search for food from the Food Data Central API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        if (empty($query)) {
            return response()->json([
                'success' => false,
                'message' => 'Search query is required'
            ]);
        }
        
        try {
            $response = Http::withoutVerifying()->get('https://api.nal.usda.gov/fdc/v1/foods/search', [
                'api_key' => $this->apiKey,
                'query' => $query,
                'pageSize' => 20,
                'dataType' => ['Foundation', 'SR Legacy', 'Branded']
            ]);
            
            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json()
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to retrieve data from Food Data Central API: ' . $response->status()
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
} 