<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(isset($invoiceInfo))
            {{ __('Edit Invoice') }}
            @else
            {{ __('Make Invoice') }}
            @endif
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
        <div class="ms-3 text-sm font-normal">Congrats ! invoice created successfully ️🎉</div>
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
                    <div class="container mx-auto p-4">
                        <div class="flex justify-center">
                            <h1 class="flex items-center font-sans font-bold break-normal text-blue-500 hover:text-blue-80 py-4 text-xl md:text-2xl">
                                @if(isset($invoiceInfo))
                                Edit Invoice
                                @else
                                Make Invoice
                                @endif
                            </h1>
                            <hr>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="col-span-2 md:col-span-1 "><label class="font-bold text-blue-500 ">Customer Name</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-violet-500 focus:border-yellow-500 focus:ring-yellow-500  focus:shadow-yellow-500 my-2" placeholder="Enter Customer Name" id="customer_name" require>
                            </div>
                        </div>
                        <hr class="color-violet-500">
                        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">

                            <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                                <input type="hidden" id="invoiceId" value="{{ $invoiceInfo['id'] ?? '' }}">
                                <input type="hidden" id="customerName" value="{{ $invoiceInfo->Customer_Name ?? '' }}">
                                <table class="min-w-full">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">ID</th>
                                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">CateGory</th>
                                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Fruit</th>
                                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Quantity</th>
                                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider pl-4">Unit</th>
                                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Price</th>
                                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Amount</th>
                                            <th class="px-1 py-3 border-b-2 border-gray-300"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">

                                    </tbody>

                                </table>
                                <div class="my-3">
                                    <button id="addBtn" class="px-5 py-1 border-violet-900 border text-violet-900 rounded transition duration-300 hover:bg-violet-900 hover:text-yellow-500 focus:outline-none font-bold"> <i class="fa-solid fa-plus"></i></button>
                                </div>
                                <div class="my-3 flex justify-center">
                                    <label class="text-blue-500 font-bold mr-2">Total Amount:</label>
                                    <span id="total_amount" class="text-black font-bold">0.00</span>
                                </div>
                                <!-- notice  with italic style-->
                                <div class="my-3">
                                    <p id="notice" class=" text-xxl italic hidden text-red-500"></p>
                                </div>
                                <div class="my-3 flex justify-end">
                                    <button type="submit" id="saveBtn" class="px-6 py-3 border-violet-900 border text-violet-900 rounded transition duration-300 hover:bg-violet-900 hover:text-yellow-500 focus:outline-none font-bold">
                                        <i id='submitLable' class="fa-solid fa-floppy-disk"></i>
                                        <div id="spinner" class=" mx-auto  h-6 w-6 animate-spin rounded-full border-b-2 border-yellow-500" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($invoiceItems))
    <script>
        window.invoiceItems = <?php echo json_encode($invoiceItems); ?>;
    </script>
    @endif
    <script src="/js/invoice.js"></script>
</x-app-layout>