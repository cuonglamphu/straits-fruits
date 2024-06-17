<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto p-4">
                        <label>Customer Name</label>
                        <input type="text" class="w-full border-2 border-gray-300 p-2 rounded mb-2" placeholder="Enter Customer Name" id="customer_name">
                        <hr>
                        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">

                            <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                                <table class="min-w-full">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">ID</th>
                                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">CateGory</th>
                                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Fruit</th>
                                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Quantity</th>
                                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Unit</th>
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
                                <div class="my-3 flex justify-end">
                                    <button id="saveBtn" class="px-6 py-3 border-violet-900 border text-violet-900 rounded transition duration-300 hover:bg-violet-900 hover:text-yellow-500 focus:outline-none font-bold">
                                        <i class="fa-solid fa-floppy-disk"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/invoice.js"></script>
</x-app-layout>