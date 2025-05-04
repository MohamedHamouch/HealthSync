@extends('layouts.app')

@section('title', 'Food Search - HealthSync')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-primary-800">Nutritional Information Search</h1>
                <a href="{{ route('dashboard') }}" class="flex items-center text-sm text-primary-600 hover:text-primary-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>
            
            <div class="mb-8">
                <p class="text-gray-600 mb-4">
                    Search for foods to get detailed nutritional information. Powered by the USDA FoodData Central database.
                </p>
                
                <div class="search-container mt-6">
                    <form id="food-search-form" class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-grow">
                            <input 
                                type="text" 
                                id="food-query" 
                                placeholder="Enter food name (e.g., apple, chicken breast, olive oil)" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500"
                                required
                            >
                        </div>
                        <button 
                            type="submit" 
                            class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-6 rounded-md transition"
                        >
                            Search
                        </button>
                    </form>
                </div>
            </div>
            
            <div id="loading-indicator" class="hidden flex justify-center my-8">
                <svg class="animate-spin h-8 w-8 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            
            <div id="error-message" class="hidden bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p id="error-text"></p>
            </div>
            
            <div id="search-results" class="hidden">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Search Results</h2>
                <div id="results-count" class="text-sm text-gray-600 mb-4"></div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Food</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                            </tr>
                        </thead>
                        <tbody id="results-table" class="bg-white divide-y divide-gray-200">
                            <!-- Results will be inserted here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div id="food-details-modal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4 z-50">
                <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-gray-800" id="modal-title">Food Details</h3>
                        <button id="close-modal" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="px-6 py-4" id="modal-content">
                        <!-- Food details will be inserted here by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('food-search-form');
        const foodQuery = document.getElementById('food-query');
        const searchResults = document.getElementById('search-results');
        const resultsTable = document.getElementById('results-table');
        const resultsCount = document.getElementById('results-count');
        const loadingIndicator = document.getElementById('loading-indicator');
        const errorMessage = document.getElementById('error-message');
        const errorText = document.getElementById('error-text');
        const foodDetailsModal = document.getElementById('food-details-modal');
        const modalTitle = document.getElementById('modal-title');
        const modalContent = document.getElementById('modal-content');
        const closeModal = document.getElementById('close-modal');
        
        // Close modal when clicking the close button
        closeModal.addEventListener('click', () => {
            foodDetailsModal.classList.add('hidden');
        });
        
        // Close modal when clicking outside the modal content
        foodDetailsModal.addEventListener('click', (e) => {
            if (e.target === foodDetailsModal) {
                foodDetailsModal.classList.add('hidden');
            }
        });
        
        // Handle form submission
        searchForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const query = foodQuery.value.trim();
            if (!query) return;
            
            // Show loading indicator and hide previous results/errors
            loadingIndicator.classList.remove('hidden');
            searchResults.classList.add('hidden');
            errorMessage.classList.add('hidden');
            
            try {
                // Send AJAX request to the backend
                const response = await fetch('{{ route('food.search.query') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ query })
                });
                
                const jsonResponse = await response.json();
                
                // Hide loading indicator
                loadingIndicator.classList.add('hidden');
                
                if (!jsonResponse.success) {
                    // Show error message
                    errorText.textContent = jsonResponse.message || 'An error occurred while fetching data.';
                    errorMessage.classList.remove('hidden');
                    return;
                }
                
                // Process and display the results
                displaySearchResults(jsonResponse.data);
                
            } catch (error) {
                // Hide loading indicator and show error
                loadingIndicator.classList.add('hidden');
                errorText.textContent = 'An error occurred while fetching data. Please try again.';
                errorMessage.classList.remove('hidden');
                console.error('Error:', error);
            }
        });
        
        // Display search results in the table
        function displaySearchResults(data) {
            // Clear previous results
            resultsTable.innerHTML = '';
            
            const foods = data.foods || [];
            
            if (foods.length === 0) {
                resultsCount.textContent = 'No results found. Try a different search term.';
                searchResults.classList.remove('hidden');
                return;
            }
            
            // Update results count
            resultsCount.textContent = `Found ${data.totalHits} results. Showing ${foods.length} items.`;
            
            // Create table rows for each food item
            foods.forEach(food => {
                const row = document.createElement('tr');
                
                // Format the food description cell
                const descriptionCell = document.createElement('td');
                descriptionCell.className = 'px-6 py-4 whitespace-nowrap';
                descriptionCell.innerHTML = `
                    <div class="text-sm font-medium text-gray-900">${food.description}</div>
                    <div class="text-sm text-gray-500">${food.dataType}</div>
                `;
                
                // Format the brand cell
                const brandCell = document.createElement('td');
                brandCell.className = 'px-6 py-4 whitespace-nowrap';
                brandCell.innerHTML = food.brandOwner 
                    ? `<div class="text-sm text-gray-900">${food.brandOwner}</div>` 
                    : `<div class="text-sm text-gray-500">-</div>`;
                
                // Format the details button cell
                const detailsCell = document.createElement('td');
                detailsCell.className = 'px-6 py-4 whitespace-nowrap text-right text-sm font-medium';
                
                const detailsButton = document.createElement('button');
                detailsButton.className = 'text-primary-600 hover:text-primary-900';
                detailsButton.textContent = 'View Details';
                detailsButton.addEventListener('click', () => {
                    showFoodDetails(food);
                });
                
                detailsCell.appendChild(detailsButton);
                
                // Add all cells to the row
                row.appendChild(descriptionCell);
                row.appendChild(brandCell);
                row.appendChild(detailsCell);
                
                // Add row to the table
                resultsTable.appendChild(row);
            });
            
            // Show the results section
            searchResults.classList.remove('hidden');
        }
        
        // Display detailed information for a selected food
        function showFoodDetails(food) {
            // Set modal title
            modalTitle.textContent = food.description;
            
            // Start building the content
            let contentHTML = `
                <div class="mb-6">
                    <p class="text-sm text-gray-500">FDC ID: ${food.fdcId}</p>
                    <p class="text-sm text-gray-500">Data Type: ${food.dataType}</p>
                    ${food.brandOwner ? `<p class="text-sm text-gray-500">Brand: ${food.brandOwner}</p>` : ''}
                    ${food.ingredients ? `
                        <div class="mt-4">
                            <h4 class="text-md font-medium text-gray-700">Ingredients</h4>
                            <p class="text-sm text-gray-600 mt-1">${food.ingredients}</p>
                        </div>
                    ` : ''}
                </div>
            `;
            
            // Add nutrient information if available
            if (food.foodNutrients && food.foodNutrients.length > 0) {
                contentHTML += `
                    <div>
                        <h4 class="text-md font-medium text-gray-700 mb-3">Nutrition Facts</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nutrient</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                `;
                
                // Add the most common nutrients first (if available)
                const commonNutrients = [
                    'Energy', 'Protein', 'Total lipid (fat)', 'Carbohydrate, by difference', 
                    'Fiber, total dietary', 'Sugars, total', 'Sodium, Na', 'Calcium, Ca',
                    'Iron, Fe', 'Vitamin A', 'Vitamin C', 'Vitamin D', 'Cholesterol'
                ];
                
                const nutrientMap = {};
                food.foodNutrients.forEach(nutrient => {
                    if (nutrient.nutrientName) {
                        nutrientMap[nutrient.nutrientName] = nutrient;
                    }
                });
                
                // First add common nutrients if they exist
                commonNutrients.forEach(name => {
                    if (nutrientMap[name]) {
                        const nutrient = nutrientMap[name];
                        contentHTML += `
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">${nutrient.nutrientName}</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">${nutrient.value}</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">${nutrient.unitName}</td>
                            </tr>
                        `;
                        // Remove this nutrient so we don't display it twice
                        delete nutrientMap[name];
                    }
                });
                
                // Then add all remaining nutrients
                for (const name in nutrientMap) {
                    const nutrient = nutrientMap[name];
                    contentHTML += `
                        <tr>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">${nutrient.nutrientName}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">${nutrient.value}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">${nutrient.unitName}</td>
                        </tr>
                    `;
                }
                
                contentHTML += `
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
            } else {
                contentHTML += `<p class="text-sm text-gray-500">No detailed nutritional information available for this item.</p>`;
            }
            
            // Set the modal content
            modalContent.innerHTML = contentHTML;
            
            // Show the modal
            foodDetailsModal.classList.remove('hidden');
        }
    });
</script>
@endpush 