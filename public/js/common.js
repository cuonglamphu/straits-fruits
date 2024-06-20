// public/js/common.js

// Function to show toast and auto-hide after 3 seconds
function showToast(selector) {
    $(selector).removeClass("hidden").fadeIn(300);
    setTimeout(function () {
        $(selector).fadeOut(300, function () {
            $(this).addClass("hidden");
        });
    }, 3000);
}

// Function to hide toast
function hideToast() {
    $(".toast button").click(function () {
        $(this)
            .parent()
            .fadeOut(300, function () {
                $(this).addClass("hidden");
            });
    });
}

$(document).on("click", ".close-dialog", function () {
    $("#dialog").fadeOut(300);
});

// Function to hide spinner and enable button
function hideSpinner() {
    $("#spinner").addClass("hidden");
    $("#submitLable").removeClass("hidden");
    $("#submitBtn").prop("disabled", false);
}

// Function to show spinner and disable button
function showSpinner() {
    $("#submitLable").addClass("hidden");
    $("#spinner").removeClass("hidden");
    $("#submitBtn").prop("disabled", true);
}
