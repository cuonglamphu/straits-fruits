<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fruit Registration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="md:px-64">
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
                                <p id="notice" class="  hidden text-xs italic"></p>
                            </div>


                            <!-- Submit Button -->
                            <div class="flex justify-end">
                                <button type="submit" class="relative float-right mb-5 rounded px-4 py-2 overflow-hidden group bg-yellow-400 relative hover:bg-gradient-to-r hover:from-yellow-400 hover:to-yellow-300 text-white hover:ring-2 hover:ring-offset-2 hover:ring-violet-950 transition-all ease-out duration-300">
                                    <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                                    <span class="relative">{{ __("Submit") }}</span>
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
            // Function to load categories from API
            function loadCategories() {
                $.ajax({
                    url: 'http://localhost/api/categories',
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
                    url: 'http://localhost/api/units',
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
                    url: 'http://localhost/api/fruits',
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
                            //notice
                            $('#notice').removeClass('hidden').addClass('block text-green-500').text('Fruit registered successfully');
                        } else {
                            //notice
                            let errors = response.data;
                            let firstKey = Object.keys(errors)[0];
                            let firstError = errors[firstKey][0];
                            $('#notice').removeClass('hidden').addClass('block text-red-500').text(firstError);
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>

</x-app-layout>