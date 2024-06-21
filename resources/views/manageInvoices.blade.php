@php
use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mange Invoices') }}
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
        <div class="ms-3 text-sm font-normal">Invoice deleted successfully.</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>

    <div id="toast-failure" class="toast hidden flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">Invoice deletion failed.</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-failure" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>

    <div id="dialog" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Delete invoice</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Are you sure you want to delete the invoice with id is <strong id="invoiceDelID"></strong> of customer <strong id="customerName"></strong> ? All of your data will be permanently removed. This action cannot be undone.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button id="confirmDel" type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                            <span id="submitLable">Delete</span>
                            <div id="spinner" class=" mx-auto  h-6 w-6 animate-spin rounded-full border-b-2 border-while-500" />
                        </button>
                        <button type="button" id="close-dialog" class="close-dialog mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-100 text-gray-900 tracking-wider leading-normal">
                    <!--Container-->
                    <div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">
                        <!--Title-->
                        <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
                            Manage Invoices
                        </h1>
                        <!--Card-->
                        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th data-priority="1">ID </th>
                                        <th data-priority="2">Customer Name</th>
                                        <th data-priority="3">Total</th>
                                        <th data-priority="4">Invoice Date</th>
                                        <th col-span="3" data-priority="4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!--/Card-->
                    </div>
                    <!--/container-->
                </div>
            </div>
        </div>
    </div>

    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            hideSpinner();
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            const toast = document.getElementById('toast-danger');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // DataTable
            let table = $('#example').DataTable({
                ajax: {
                    url: 'api/invoices',
                    dataSrc: 'data'
                },
                columns: [{
                        data: 'id',
                        className: 'text-center'
                    },
                    {
                        data: 'Customer_Name',
                        className: 'text-center'
                    },
                    {
                        data: 'Total',
                        className: 'text-center',
                        render: function(data, type, row) {
                            if (typeof data === 'number') {
                                return `$${data.toFixed(2)}`;
                            } else {
                                return '$0.00';
                            }
                        }
                    },
                    {
                        data: 'created_at',
                        className: 'text-center',
                        render: function(data, type, row) {
                            let date = new Date(data);
                            let day = String(date.getDate()).padStart(2, '0');
                            let month = String(date.getMonth() + 1).padStart(2, '0');
                            let year = date.getFullYear();
                            return `${month}-${day}-${year}`;
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                            <button class="open-print btn bg-green-500 hover:bg-red-800 text-white border rounded px-2 py-1" data-id="${data.id}"><i class="fa-solid fa-print"></i></button>
                            <button class="open-edit btn bg-cyan-500 hover:bg-red-800 text-white border rounded px-2 py-1" data-id="${data.id}"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="open-dialog btn bg-red-500 hover:bg-red-800 text-white border rounded px-2 py-1" data-id="${data.id}" data-customer="${data.Customer_Name}"><i class="fa-solid fa-trash"></i></button>
                            `;
                        }
                    }
                ],
                columnDefs: [{
                    targets: '_all',
                    className: 'text-center'
                }],
                responsive: true
            });

            $(document).on('click', '.open-dialog', function() {
                let invoiceId = $(this).data('id');
                let customerName = $(this).data('customer');
                // Update dialog content
                $('#invoiceDelID').text(invoiceId);
                $('#customerName').text(customerName);
                $('#dialog').fadeIn(300);

                //confirm delete
                $('#confirmDel').click(function() {
                    showSpinner();
                    $.ajax({
                        url: 'api/invoices/' + invoiceId,
                        type: 'DELETE',
                        success: function(response) {
                            hideSpinner();
                            console.log(response)
                            $('#dialog').fadeOut(300);
                            if (response.success) {
                                table.ajax.reload();
                                showToast('#toast-success');

                            } else {
                                hideSpinner();
                                showToast('#toast-failure');
                            }
                        },
                        error: function(response) {
                            hideSpinner()
                            console.log(response)
                            $('#dialog').fadeOut(300);
                            showToast('#toast-failure');
                        }
                    });
                });
            });

            $(document).on('click', '.open-print', function() {
                let invoiceId = $(this).data('id');
                window.open('pdf/' + invoiceId, '_blank');
            });

            $(document).on('click', '.open-edit', function() {
                let invoiceId = $(this).data('id');
                window.location.href = 'invoices/' + invoiceId + '/edit';
            });
        });
    </script>
</x-app-layout>
