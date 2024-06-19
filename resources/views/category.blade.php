<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Registration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form>
                    <div class="p-6 text-gray-900">
                        <div class="p-6 text-gray-900 grid md:grid-cols-3">
                            <div class="md:col-start-2 col-span-1">
                                <div class="relative z-0 mb-5 group">


                                    <label id="floating_Category_Name_Lable" for="floating_Category_Name" class="font-bold"> {{ __("Category Name") }}</label>
                                    <input type="text" id="floating_Category_Name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-violet-500 focus:border-yellow-500 focus:ring-yellow-500  focus:shadow-yellow-500 mt-2" placeholder="Enter category name">

                                    <!-- /handle erro -->
                                    <div id="notice" class="text-red-500 mt-1 hidden text-xl italic">{{__("Category name is required")}}</div>
                                </div>
                            </div>

                        </div>
                        <div>
                            <button id="submitBtn" type="submit" class="relative float-right mb-5 rounded px-4 py-2 overflow-hidden group bg-yellow-400 relative hover:bg-gradient-to-r hover:from-yellow-400 hover:to-yello-300 text-white hover:ring-2 hover:ring-offset-2 hover:ring-violet-950 transition-all ease-out duration-300">
                                <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                                <span id="submitLable" class="relative">{{ __("Submit") }}</span>
                                <div id="spinner" class="mx-auto  h-6 w-6 animate-spin rounded-full border-b-2 border-current" />
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const MAIN_URL = "http://localhost";

        //Hide spinner and enable button
        function hideSpinner() {
            $('#spinner').addClass('hidden');
            $('#submitLable').removeClass('hidden');
            $('#submitBtn').prop('disabled', false);
        }

        //Show spinner and disable button
        function showSpinner() {
            $('#submitLable').addClass('hidden');
            $('#spinner').removeClass('hidden');
            $('#submitBtn').prop('disabled', true);
        }
        $(document).ready(function() {
            hideSpinner();
            //remove error message
            $('#floating_Category_Name').focus(function() {
                $('#notice').removeClass('block');
                $('#notice').removeClass('text-green-500');
                $('#notice').addClass('hidden');
                $('#floating_Category_Name').removeClass('border-red-500');
                $('#floating_Category_Name').addClass('border-gray-300');
                $('#floating_Category_Name_Lable').removeClass('text-red-500');
                $('#floating_Category_Name_Lable').addClass('text-gray-500');
            });

            $('form').submit(function(e) {
                e.preventDefault();
                showSpinner();
                var Category_Name = $('#floating_Category_Name').val();
                $.ajax({
                    url: "{{ route('categories.store') }}",
                    type: "POST",
                    data: {
                        Category_Name: Category_Name,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {

                        if (response.success == true && response.message == "Category created successfully") {
                            hideSpinner();
                            //notice green color and show message
                            $('#notice').removeClass('hidden').addClass('block text-green-500').text(response.message);
                            //clear input
                            $('#floating_Category_Name').val('');
                        } else {
                            hideSpinner();
                            //chang color of label and input
                            $('#floating_Category_Name').addClass('border-red-500');
                            $('#floating_Category_Name').removeClass('border-gray-300');
                            $('#floating_Category_Name_Lable').addClass('text-red-500');
                            $('#floating_Category_Name_Lable').removeClass('text-gray-500');
                            //show error message
                            $('#notice').removeClass('hidden').addClass('block text-red-500').text(response.data.Category_Name[0]);
                        }
                    },
                    error: function(response) {
                        hideSpinner();
                        console.log(response);
                    }
                });
            });
        })
    </script>



</x-app-layout>