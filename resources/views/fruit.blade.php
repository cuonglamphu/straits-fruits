<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fruit Registration') }}
        </h2>
    </x-slot>
    <!-- Toats -->
    <div id="toast-success" class="toast hidden flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">Congrats ! your fruit is added ️🎉</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="md:px-64">
                        <div class="flex justify-center">
                            <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 py-4 text-xl md:text-2xl">
                                🍇 Fruits Registration 🍇
                            </h1>
                        </div>
                        <hr>
                        <!--Card-->
                        <form>
                            <!-- Category -->
                            <div class="mb-4">
                                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                                <select id="category" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded leading-tight focus:outline-violet-500 focus:border-yellow-500 focus:ring-yellow-500  focus:shadow-yellow-500">
                                    <option class="text-black" value="">Loading...</option>
                                </select>
                            </div>

                            <!-- Fruits Name -->
                            <div class="mb-4">
                                <label for="fruitsName" class="block text-gray-700 text-sm font-bold mb-2">Fruits Name</label>
                                <input type="text" id="fruitsName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-violet-500 focus:border-yellow-500 focus:ring-yellow-500  focus:shadow-yellow-500" placeholder="Enter fruit name">
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                                <input type="number" step="0.01" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-violet-500 focus:border-yellow-500 focus:ring-yellow-500  focus:shadow-yellow-500" placeholder="Enter price" value="0.01">
                            </div>

                            <!-- Unit -->
                            <div class="mb-4">
                                <label for="unit" class="block text-gray-700 text-sm font-bold mb-2">Unit</label>
                                <select id="unit" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded leading-tight focus:outline-violet-500 focus:border-yellow-500 focus:ring-yellow-500  focus:shadow-yellow-500">
                                    <option class="text-black" value="">Loading...</option>
                                </select>
                            </div>
                            <!-- Notice -->
                            <div class="mb-4">
                                <p id="notice" class="  hidden text-xl italic"></p>
                            </div>


                            <!-- Submit Button -->
                            <div class="flex justify-end">
                                <button id="submitBtn" type="submit" class="relative float-right mb-5 rounded px-4 py-2 overflow-hidden group bg-yellow-400 relative hover:bg-gradient-to-r hover:from-yellow-400 hover:to-yellow-300 text-white hover:ring-2 hover:ring-offset-2 hover:ring-violet-950 transition-all ease-out duration-300">
                                    <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                                    <span id="submitLable" class="relative">{{ __("Save") }}</span>
                                    <div id="spinner" class="mx-auto  h-6 w-6 animate-spin rounded-full border-b-2 border-current" />
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            hideSpinner();
            // Function to load categories from API
            function loadCategories() {
                $.ajax({
                    url: "api/categories",
                    type: 'GET',
                    success: function(response) {
                        var categorySelect = $('#category');
                        categorySelect.empty(); // Xóa các option cũ
                        response.data.forEach(function(category) {
                            categorySelect.append(new Option(category.Category_Name, category.Category_Id));
                        });
                    },
                    error: function() {
                        alert('Failed to load categories');
                    }
                });
            }

            // Function to load units from API
            function loadUnits() {
                $.ajax({
                    url: "api/units",
                    type: 'GET',
                    success: function(response) {
                        var unitSelect = $('#unit');
                        unitSelect.empty(); // Xóa các option cũ
                        response.data.forEach(function(unit) {
                            unitSelect.append(new Option(unit.Unit_Name, unit.id));
                        });
                    },
                    error: function() {
                        alert('Failed to load units');
                    }
                });
            }

            // Load categories and units on document ready
            loadCategories();
            loadUnits();

            // Submit form
            $('form').submit(function(e) {
                showSpinner();
                //handle notice
                $('#notice').removeClass('block');
                $('#notice').removeClass('text-red-500');
                $('#notice').removeClass('text-green-500');
                $('#notice').addClass('hidden');
                $('#notice').text('');

                e.preventDefault();
                let category = $('#category').val();
                let fruitsName = $('#fruitsName').val();
                let price = $('#price').val();
                let unit = $('#unit').val();
                $.ajax({
                    url: "api/fruits",
                    type: 'POST',
                    data: {
                        //token
                        _token: "{{ csrf_token() }}",
                        Fruit_Name: fruitsName,
                        Price: price,
                        Category_ID: category,
                        Unit_ID: unit
                    },

                    success: function(response) {
                        console.log(fruitsName);
                        if (response.success) {
                            //reset form
                            loadCategories();
                            loadUnits();
                            $('#fruitsName').val('');
                            $('#price').val('0.01');
                            //show toast
                            showToast('#toast-success');
                        } else {
                            //notice
                            let errors = response.data;
                            let firstKey = Object.keys(errors)[0];
                            let firstError = errors[firstKey][0];
                            $('#notice').removeClass('hidden').addClass('block text-red-500').text('Opp! ' + firstError);
                        }
                        hideSpinner();
                    },
                    error: function(response) {
                        console.log(response);
                        hideSpinner();
                    }
                });
            });
        });
    </script>

</x-app-layout>