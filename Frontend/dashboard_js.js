const hamburger = document.querySelector(".toggle-btn");
const toggler = document.querySelector("#icon");

hamburger.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
    toggler.classList.toggle("bx-chevrons-right");
    toggler.classList.toggle("bx-chevrons-left");
});

new Chart(document.getElementById("bar-chart-grouped"), {
    type: 'bar',
    data: {
        labels: ["2022", "2023", "2024", "2025"],
        datasets: [
            {
                label: "Elektronik",
                backgroundColor: "#3e95cd",
                data: [133, 221, 783, 2478]
            }, {
                label: "Perabotan",
                backgroundColor: "#8e5ea2",
                data: [408, 547, 675, 734]
            }
        ]
    },
    options: {
        title: {
            display: true,
            text: 'Population growth (millions)'
        }
    }
});

$(document).ready(function() {
    let currentPage = 1;
    let itemsPerPage = 5; 

    function loadTable(page) {
        $.ajax({
            url: "ambil_data.php",
            type: "GET",
            data: { page: page, itemsPerPage: itemsPerPage },
            success: function(data) {
                $("#tableBody").html(data);
                updatePagination(page);
            }
        });
    }

    function updatePagination(page) {
        $.ajax({
            url: "pagination.php",
            type: "GET",
            data: { page: page, itemsPerPage: itemsPerPage },
            success: function(data) {
                $("#pageNumbers").html(data);
                $("#prevPage").prop("disabled", page == 1);
            }
        });
    }

    $(document).on("click", ".pagination-btn", function() {
        currentPage = $(this).data("page");
        loadTable(currentPage);
    });

    $("#prevPage").click(function() {
        if (currentPage > 1) {
            currentPage--;
            loadTable(currentPage);
        }
    });

    $("#nextPage").click(function() {
        currentPage++;
        loadTable(currentPage);
    });

    loadTable(currentPage);
});
