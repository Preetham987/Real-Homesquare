// Fetch Locations from dropdown
fetch("project_locations_api.php")
    .then((response) => response.json())
    .then((data) => {
        if (data.success) {
            const citySelect = document.getElementById("citySelect");
            data.data.forEach((city) => {
                const option = document.createElement("option");
                option.value = city;
                option.text = city;
                citySelect.appendChild(option);
            });
        } else {
            console.error("Error fetching data:", data.message);
        }
    })
    .catch((error) => {
        console.error("Fetch error:", error);
    });

// Sliders in Search Filters
$(document).ready(function () {
    // Area slider (already done)
    $("#areaSlider").ionRangeSlider({
        type: "double",
        min: 1,
        max: 10000,
        from: 100,
        to: 10000,
        step: 1,
        postfix: " ft²",
    });

    // Price Range slider
    $("#priceSlider").ionRangeSlider({
        type: "double",
        min: 100,
        max: 100000,
        from: 100,
        to: 100000,
        step: 100,
        prefix: "Rs. ",
    });
});
