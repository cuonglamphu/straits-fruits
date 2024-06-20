@php
use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
<style>
    @import url(https://fonts.bunny.net/css?family=alata:400);

    body {
        background-color: #f3f4f6;
        font-family: "Alata", sans-serif;
    }
</style>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<title>Straits Fiance | Invoice</title>

<body>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow-sm my-6" id="invoice">
        <div class="grid grid-cols-2 items-center">
            <div>
                <!--  Company logo  -->
                <img src="https://mxv.com.vn/thumb/41/0/0/straitsfinancial.png" alt="company-logo" width="150">
            </div>

            <div class="text-right">
                <p>
                    Straits Financial Services Pte Ltd
                </p>
                <p class="text-gray-500 text-sm">
                    info@straitsfinancial.com
                </p>
                <p class="text-gray-500 text-sm mt-1">
                    Tel: +65 6672 9668
                </p>
                <p class="text-gray-500 text-sm mt-1">
                    Fax: +65 6672 9670
                </p>
            </div>
        </div>

        <!-- Client info -->
        <div class="grid grid-cols-2 items-center mt-8">
            <div>
                <p class="font-bold text-gray-800">
                    Bill to : {{$invoiceInfo['Customer_Name']}}
                </p>
                <p id="customerName" class="text-gray-500">
                    Archer Daniels Midland Company

                    <br />
                    102, San-Fransico, CA, USA
                </p>
                <p class="text-gray-500">
                    contact@ADM.com
                </p>
            </div>

            <div class="text-right">
                <p class="">
                    Invoice number:
                    <span id="invoiceId" class="text-gray-500">SF00000{{$invoiceInfo['id']}}</span>
                </p>
                <p>
                    Invoice date: <span id="invoiceDate" class="text-gray-500">{{ Carbon::parse($invoiceInfo->created_at)->format('d/m/Y') }}</span>
                    <br />
                    Due date:<span class="text-gray-500">31/10/2024</span>
                </p>
            </div>
        </div>

        <!-- Invoice Items -->
        <div class="-mx-4 mt-8 flow-root sm:mx-0">
            <table class="min-w-full">
                <colgroup>
                    <col class="w-full sm:w-1/2">
                    <col class="sm:w-1/6">
                    <col class="sm:w-1/6">
                    <col class="sm:w-1/6">
                </colgroup>
                <thead class="border-b border-gray-300 text-gray-900">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Items</th>
                        <th scope="col" class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">Quantity</th>
                        <th scope="col" class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">Unit</th>
                        <th scope="col" class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">Price</th>
                        <th scope="col" class="py-3.5 pl-3 pr-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoiceItems as $item)
                    <tr class="border-b border-gray-200">
                        <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                            <div id="fruitName" class="font-medium text-gray-900">{{$item->Fruit_Name}}</div>
                            <div id="category" class="mt-1 truncate text-gray-500">{{$item->Category_Name}}</div>
                        </td>
                        <td id="quantity" class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">{{$item->Quantity}}</td>
                        <td id="unit" class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">{{$item->Unit_Name}}</td>
                        <td id="price" class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">{{$item->Price}}</td>
                        <td id="amount" class="py-5 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-0">{{$item->Amount}}</td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-6 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">Subtotal</th>
                        <th scope="row" class="pl-6 pr-3 pt-6 text-left text-sm font-normal text-gray-500 sm:hidden">Subtotal</th>
                        <td id="subTotal" class="pl-3 pr-6 pt-6 text-right text-sm text-gray-500 sm:pr-0">${{ number_format($invoiceInfo['Total'],2)}}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">Tax</th>
                        <th scope="row" class="pl-6 pr-3 pt-4 text-left text-sm font-normal text-gray-500 sm:hidden">Tax</th>
                        <td id="tax" class="pl-3 pr-6 pt-4 text-right text-sm text-gray-500 sm:pr-0">${{ number_format(($invoiceInfo['Total']/10),2) }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">Discount</th>
                        <th scope="row" class="pl-6 pr-3 pt-4 text-left text-sm font-normal text-gray-500 sm:hidden">Discount</th>
                        <td class="pl-3 pr-6 pt-4 text-right text-sm text-gray-500 sm:pr-0">- 0%</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-4 text-right text-sm font-semibold text-gray-900 sm:table-cell sm:pl-0">Total</th>
                        <th scope="row" class="pl-6 pr-3 pt-4 text-left text-sm font-semibold text-gray-900 sm:hidden">Total</th>
                        <td id="total" class="pl-3 pr-4 pt-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">${{number_format(($invoiceInfo['Total'] + $invoiceInfo['Total']/10),2)}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!--  Footer  -->
        <div class="border-t-2 pt-4 text-xs text-gray-500 text-center mt-16">
            Please pay the invoice before the due date. You can pay the invoice by logging in to your account from our client portal.
        </div>
    </div>
</body>
<!-- <button type="button" id="btn" class="">Print</button> -->
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        window.print();
    });
</script>

</html>