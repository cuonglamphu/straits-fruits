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
                        <div class="relative z-0 mb-5 group">
                            <input type="text" name="floating_Category_Name" id="floating_Category_Name" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label id="floating_Category_Name_Lable" for="floating_Category_Name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"> {{ __("Category Name") }}</label>
                            <!-- /handle erro -->
                            <div id="notice" class="text-red-500 mt-1 hidden text-xs italic">{{__("Category name is required")}}</div>
                        </div>
                        <button type="submit" class="relative float-right mb-5 rounded px-4 py-2 overflow-hidden group bg-yellow-400 relative hover:bg-gradient-to-r hover:from-yellow-400 hover:to-yello-300 text-white hover:ring-2 hover:ring-offset-2 hover:ring-violet-950 transition-all ease-out duration-300">
                            <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                            <span class="relative">{{ __("Submit") }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
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
                            //notice green color and show message
                            $('#notice').removeClass('hidden').addClass('block text-green-500').text(response.message);
                            //clear input
                            $('#floating_Category_Name').val('');
                        } else {
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
                        console.log(response);
                    }
                });
            });
        })
    </script>



</x-app-layout>
