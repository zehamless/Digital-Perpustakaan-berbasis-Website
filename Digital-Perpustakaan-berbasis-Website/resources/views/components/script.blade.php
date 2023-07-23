<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.js"></script>

<script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Sales",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "#fff",
                data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                maxBarThickness: 6
            }, ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 500,
                        beginAtZero: true,
                        padding: 15,
                        font: {
                            size: 14,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                        color: "#fff"
                    },
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false
                    },
                    ticks: {
                        display: false
                    },
                },
            },
        },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Mobile apps",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#cb0c9f",
                borderWidth: 3,
                backgroundColor: gradientStroke1,
                fill: true,
                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

            },
                {
                    label: "Websites",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3A416F",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
                    fill: true,
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    maxBarThickness: 6
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#b2b9bf',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script>
    // your-script.js
    document.addEventListener("DOMContentLoaded", function () {
        const imageInput = document.getElementById("cover");
        const imagePreview = document.getElementById("coverPreview");
        const cropButton = document.getElementById("crop");
        const submitButton = document.getElementById("submit");
        let cropper;

        imageInput.addEventListener("change", function (event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function () {
                imagePreview.src = reader.result;
                cropper = new Cropper(imagePreview, {
                    aspectRatio: 9 / 16,
                    viewMode: 1,
                });
            };

            reader.readAsDataURL(file);
        });

        cropButton.addEventListener("click", function () {
            const croppedCanvas = cropper.getCroppedCanvas();
            const croppedImage = croppedCanvas.toDataURL();
            const hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "croppedImage";
            hiddenInput.value = croppedImage;
            const form = document.querySelector("form");
            form.appendChild(hiddenInput);

            // Submit the form to the controller
            submitButton.click();
        });
    });

</script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset("assets/js/soft-ui-dashboard.min.js?v=1.0.7")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        let currentPage = 1;
        const itemsPerPage = 10;

        $('#category-filter').on('change', function () {
            let id = $(this).val();
            fetchDataByCategory(id);
        });

        function fetchDataByCategory(id) {
            $.ajax({
                url: "{{ route('books.userIndex') }}",
                type: 'GET',
                dataType: 'json',
                data: { category_id: id },
                success: function (books) {
                    const totalPages = Math.ceil(books.length / itemsPerPage);
                    updatePagination(totalPages);

                    var tableBody = $('#filteredData');
                    tableBody.empty();

                    const startIndex = (currentPage - 1) * itemsPerPage;
                    const endIndex = startIndex + itemsPerPage;

                    for (let i = startIndex; i < endIndex; i++) {
                        if (i < books.length) {
                            var book = books[i];
                            var row = '<tr>' +
                                '<td class="align-middle text-center">' + book.title + '</td>' +
                                '<td class="align-middle text-center">' + book.category.name + '</td>' +
                                '<td class="align-middle text-center">' + book.amount + '</td>' +
                                '<td class="align-middle text-center"><a href="/books/' + book.id + '/edit" class="btn btn btn-outline-warning">Edit</a></td>' +
                                '</tr>';

                            tableBody.append(row);
                        }
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }

        function updatePagination(totalPages) {
            const paginationContainer = $('#paginationContainer ul');
            paginationContainer.empty();

            for (let i = 1; i <= totalPages; i++) {
                const listItem = $('<li class="page-item"><a class="page-link">' + i + '</a></li>');
                listItem.on('click', function () {
                    currentPage = i;
                    fetchDataByCategory($('#category-filter').val());
                });
                paginationContainer.append(listItem);
            }
        }

        fetchDataByCategory('');
    });
</script>
<script>
    $(document).ready(function() {
        var currentUrl = window.location.href;

        $(".navbar-nav .nav-link").each(function() {
            var linkUrl = $(this).attr("href");

            if (currentUrl === linkUrl) {
                $(this).addClass("active");
            }
        });
    });
</script>


