$(document).ready(function () {
    let smartId = 1;
    function prepareData(rowId = 1) {
        loadFruits(1, $(`#fruit_${rowId}`));
        loadPriceAndUnit(1, $(`#price_${rowId}`), $(`#unit_${rowId}`));
    }
    function loadFirstRow() {
        appendRow();
    }

    loadFirstRow();

    // Load categories from API
    function loadCategories(categorySelect) {
        $.ajax({
            url: "http://localhost/api/categories",
            type: "GET",
            success: function (response) {
                categorySelect.empty();
                response.data.forEach(function (category) {
                    categorySelect.append(
                        new Option(category.Category_Name, category.Category_Id)
                    );
                });
            },
            error: function () {
                // alert('Failed to load categories');
            },
        });
    }

    // Function to load fruits from API
    function loadFruits(categoryId, fruitSelect) {
        $.ajax({
            url: "http://localhost/api/fruits/category/" + categoryId,
            type: "GET",
            success: function (response) {
                fruitSelect.empty();
                response.data.forEach(function (fruit) {
                    fruitSelect.append(new Option(fruit.Fruit_Name, fruit.id));
                });
            },
            error: function () {
                alert("Failed to load fruits");
            },
        });
    }

    //append row
    function appendRow() {
        // Add new row with the smart id for each row
        let row = `<tr>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
            <div class="flex items-center">
            <div>
            <div class="text-sm leading-5 text-gray-800">#${smartId}</div>
            </div>
            </div>
            </td>
                <td class="px-6 py-5 whitespace-no-wrap border-b border-gray-500">
                    <div class="text-sm leading-5 text-blue-900">
                        <select id="category_${smartId}" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded leading-tight focus:outline-violet-500 focus:border-yellow-500 focus:ring-yellow-500  focus:shadow-yellow-500">
                            <option class="text-black" value="">Loading...</option>
                        </select>
                    </div>
                </td>
                <td class="px-1 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5    ">
                    <div class="text-sm leading-5 text-blue-900">
                        <select id="fruit_${smartId}" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded leading-tight focus:outline-violet-500 focus:border-yellow-500 focus:ring-yellow-500  focus:shadow-yellow-500">
                            <option class="text-black" value="">Loading...</option>
                        </select>
                    </div></td>
                <td class="px-1 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                    <input id="quantity_${smartId}" type="number" min="1" class="block appearance-none w-20 bg-white border border-gray-300 text-gray-700 rounded leading-tight focus:outline-violet-500 focus:border-yellow-500 focus:ring-yellow-500  focus:shadow-yellow-500">

                </td>
                <td class="px-3 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                                        <span id="unit_${smartId}" class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs"></span>
                                    </span>
                </td>
                <td id="price_${smartId}" class="px-1 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5"></td>
                <td id="amount_${smartId}" class="px-1 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5"></td>
                <td  class="px-1 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                    <button id="deleteBtn" class="px-5 py-2 border-red-900 border text-red-900 rounded transition duration-300 hover:bg-red-900 hover:text-white focus:outline-none"><i class="fa-solid fa-trash"></i></button>
                </td>
        </tr>`;

        $("tbody").append(row);
        prepareData(smartId);

        // Add event listeners to calculate amount

        let fruitSelect = $(`#fruit_${smartId}`);
        let categorySelect = $(`#category_${smartId}`);
        let priceField = $(`#price_${smartId}`);
        let unitField = $(`#unit_${smartId}`);
        let amountField = $(`#amount_${smartId}`);

        // Add event listeners to calculate amount
        let quantityField = $(`#quantity_${smartId}`);
        quantityField.on("input", function () {
            let quantity = parseFloat(quantityField.val()) || 0;
            let price = parseFloat(priceField.text()) || 0;
            let amount = quantity * price;
            amountField.text(amount.toFixed(2));
            updateTotal();
        });

        loadCategories(categorySelect);
        // Load fruits when category changes

        categorySelect.change(function () {
            let categoryId = $(this).val();
            loadFruits(categoryId, fruitSelect);
        });

        // Load price and unit when fruit changes
        fruitSelect.change(function () {
            let fruitId = $(this).val();
            console.log(fruitId);
            loadPriceAndUnit(fruitId, priceField, unitField);
            priceField.text(""); // Clear price field
            amountField.text(""); // Clear amount field
        });
        smartId++;
    }

    // Function to load price and unit
    function loadPriceAndUnit(fruitId, priceField, unitField) {
        $.ajax({
            url: "http://localhost/api/fruits/" + fruitId,
            type: "GET",
            success: function (response) {
                let fruit = response.data;
                priceField.text(fruit.Price);

                loadUnit(fruit.Unit_ID, unitField);
            },
            error: function () {
                console.log("Failed to load price and unit");
            },
        });
    }

    // Function to load unit from API
    function loadUnit(unitId, unitField) {
        $.ajax({
            url: "http://localhost/api/units/" + unitId,
            type: "GET",
            success: function (response) {
                console.log(response);
                unitField.text(response.data.Unit_Name);
            },
            error: function () {
                alert("Failed to load unit");
            },
        });
    }

    // Load fruits when category changes
    $("#category").change(function () {
        var categoryId = $(this).val();
        fruitbyCategory(categoryId);
    });

    // Function to update the total amount
    function updateTotal() {
        let total = 0; // Initialize the total amount to 0

        // Iterate over each row in the tbody
        $("tbody tr").each(function () {
            // Find the <td> element whose id starts with "amount_" within the current row
            let amount =
                parseFloat($(this).find('td[id^="amount_"]').text()) || 0;

            // Add the value of the amount (or 0 if it's not a number) to the total
            total += amount;
        });

        // Update the text content of the <td> with id "total_amount" with the calculated total, formatted to 2 decimal places
        $("#total_amount").text(total.toFixed(2));
    }

    //Add a new row when click on plus icon
    $("#addBtn").click(function () {
        appendRow();
    });

    // Remove row when click on trash icon with smart id automation for each row
    $("tbody").on("click", "#deleteBtn", function () {
        $(this).closest("tr").remove();
        //removie the id of this line and index again for all rows
        $("tbody tr").each(function (index) {
            $(this)
                .find("td:first")
                .html(
                    '<div class="text-sm leading-5 text-gray-800">#' +
                        (index + 1) +
                        "</div>"
                );
        });
        updateTotal();
        smartId--;
        //if the table is empty, add a new row with smart id = 1
        if (smartId == 0) {
            smartId = 1;
            appendRow();
        }
    });
});
