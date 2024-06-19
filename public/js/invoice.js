const MAIN_URL = "http://localhost";

//Hide spinner and enable button
function hideSpinner() {
    $("#spinner").addClass("hidden");
    $("#submitLable").removeClass("hidden");
    $("#saveBtn").removeClass("bg-violet-900");
}

//Show spinner and disable button
function showSpinner() {
    $("#submitLable").addClass("hidden");
    $("#saveBtn").removeClass("bg-violet-900");
    $("#spinner").removeClass("hidden");
}

$(document).ready(function () {
    hideSpinner();
    let smartId = 1;

    function prepareData(rowId = 1) {
        loadFruits(1, $(`#fruit_${rowId}`));
        loadPriceAndUnit(1, $(`#price_${rowId}`), $(`#unit_${rowId}`));
    }

    function loadFirstRow() {
        appendRow();
    }

    loadFirstRow();

    function loadCategories(categorySelect) {
        $.ajax({
            url: MAIN_URL + "/api/categories",
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
                console.error("Failed to load categories");
            },
        });
    }

    function loadFruits(categoryId, fruitSelect) {
        $.ajax({
            url: MAIN_URL + "/api/fruits/category/" + categoryId,
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

    function appendRow() {
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
                    <select id="category_${smartId}" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded leading-tight focus:outline-violet-500 focus:border-yellow-500 focus:ring-yellow-500 focus:shadow-yellow-500">
                        <option class="text-black" value="">Loading...</option>
                    </select>
                </div>
            </td>
            <td class="px-1 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                <div class="text-sm leading-5 text-blue-900">
                    <select id="fruit_${smartId}" class="fruit_value block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded leading-tight focus:outline-violet-500 focus:border-yellow-500 focus:ring-yellow-500 focus:shadow-yellow-500">
                        <option class="text-black" value="">Loading...</option>
                    </select>
                </div>
            </td>
            <td class="px-1 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                <input id="quantity_${smartId}" type="number" min="1" class="quantity_value block appearance-none w-20 bg-white border border-gray-300 text-gray-700 rounded leading-tight focus:outline-violet-500 focus:border-yellow-500 focus:ring-yellow-500 focus:shadow-yellow-500">
            </td>
            <td class="px-3 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                <span id="unit_${smartId}" class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                    <span class="relative text-xs"></span>
                </span>
            </td>
            <td id="price_${smartId}" class="px-1 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5"></td>
            <td id="amount_${smartId}" class="amount px-1 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5"></td>
            <td class="px-1 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                <button id="deleteBtn" class="px-5 py-2 border-red-900 border text-red-900 rounded transition duration-300 hover:bg-red-900 hover:text-white focus:outline-none"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>`;

        $("tbody").append(row);
        prepareData(smartId);

        let fruitSelect = $(`#fruit_${smartId}`);
        let categorySelect = $(`#category_${smartId}`);
        let priceField = $(`#price_${smartId}`);
        let unitField = $(`#unit_${smartId}`);
        let amountField = $(`#amount_${smartId}`);
        let quantityField = $(`#quantity_${smartId}`);

        quantityField.on("input", function () {
            let quantity = parseFloat(quantityField.val()) || 0;
            let price = parseFloat(priceField.text()) || 0;
            let amount = quantity * price;
            amountField.text(amount.toFixed(2));
            updateTotal();
        });

        loadCategories(categorySelect);

        categorySelect.change(function () {
            let categoryId = $(this).val();
            loadFruits(categoryId, fruitSelect);
        });

        fruitSelect.change(function () {
            let fruitId = $(this).val();
            loadPriceAndUnit(fruitId, priceField, unitField);
            priceField.text("");
            amountField.text("");
        });
        smartId++;
    }

    function updateTotal() {
        let total = 0;
        $("tbody tr").each(function () {
            let amount =
                parseFloat($(this).find('td[id^="amount_"]').text()) || 0;
            total += amount;
        });
        $("#total_amount").text(total.toFixed(2));
    }

    function loadUnit(unitId, unitField) {
        $.ajax({
            url: MAIN_URL + "/api/units/" + unitId,
            type: "GET",
            success: function (response) {
                unitField.text(response.data.Unit_Name);
            },
            error: function () {
                alert("Failed to load unit");
            },
        });
    }

    function loadPriceAndUnit(fruitId, priceField, unitField) {
        $.ajax({
            url: MAIN_URL + "/api/fruits/" + fruitId,
            type: "GET",
            success: function (response) {
                let fruit = response.data;
                priceField.text(fruit.Price);
                loadUnit(fruit.Unit_ID, unitField);
            },
            error: function () {
                console.error("Failed to load price and unit");
            },
        });
    }

    function checkAndMergeFruits() {
        let fruitQuantities = {};
        $("tbody tr").each(function () {
            let fruitId = $(this).find(".fruit_value").val();
            let quantity =
                parseFloat($(this).find(".quantity_value").val()) || 0;

            if (fruitQuantities[fruitId]) {
                fruitQuantities[fruitId].quantity += quantity;
                $(this).remove();
            } else {
                fruitQuantities[fruitId] = {
                    row: $(this),
                    quantity: quantity,
                };
            }
        });

        for (let fruitId in fruitQuantities) {
            let fruitInfo = fruitQuantities[fruitId];
            fruitInfo.row.find(".quantity_value").val(fruitInfo.quantity);
            let price =
                parseFloat(fruitInfo.row.find('td[id^="price_"]').text()) || 0;
            let amount = fruitInfo.quantity * price;
            fruitInfo.row.find('td[id^="amount_"]').text(amount.toFixed(2));
        }

        updateRowNumbers();
        updateTotal();
    }

    function updateRowNumbers() {
        $("tbody tr").each(function (index) {
            $(this)
                .find("td:first")
                .html(
                    '<div class="text-sm leading-5 text-gray-800">#' +
                        (index + 1) +
                        "</div>"
                );
        });
    }

    $("#saveBtn").click(function () {
        showSpinner();
        checkAndMergeFruits();
        $("#notice")
            .removeClass("block text-red-500")
            .addClass("hidden")
            .text("");

        let customerName = $("#customer_name").val();
        let total = parseFloat($("#total_amount").text()) || 0;
        let items = [];

        $("table tbody tr").each(function () {
            let fruitId = $(this).find(".fruit_value").val();
            let quantity = $(this).find(".quantity_value").val();
            let amount = parseFloat($(this).find(".amount").text()) || 0;

            items.push({
                Customer_Name: customerName,
                Fruit_ID: fruitId,
                Quantity: quantity,
                Amount: amount,
            });
        });

        let csrf_token = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            url: MAIN_URL + "/api/invoices",
            type: "POST",
            data: {
                _token: csrf_token,
                Customer_Name: customerName,
                Total: total,
                items: items,
            },
            success: function (response) {
                if (response.success) {
                    hideSpinner();
                    alert("Invoice saved successfully");
                    let invoiceId = parseInt(response.data.id);
                    //opne the invoice
                    window.open(MAIN_URL + "/pdf/" + invoiceId);
                } else {
                    hideSpinner();
                    let errors = response.data;
                    let firstKey = Object.keys(errors)[0] || "";
                    let firstError = errors[firstKey][0];
                    $("#notice")
                        .removeClass("hidden")
                        .addClass("block text-red-500")
                        .text(firstError);
                }
            },
            error: function (response) {
                console.error(response);
            },
        });
    });

    $("#addBtn").click(function () {
        appendRow();
    });

    $("tbody").on("click", "#deleteBtn", function () {
        $(this).closest("tr").remove();
        updateRowNumbers();
        updateTotal();
        smartId--;
        if (smartId == 0) {
            smartId = 1;
            appendRow();
        }
    });
});
