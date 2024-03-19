@extends('layouts.sidebar')

@section('content')
    <div>
        @if (auth()->user()->role === 'admin')
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                            <h6>Data table</h6>
                            <a href="{{ route('dashboard.createUser') }}" class="btn add-new btn-success m-1 float-end"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NO</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Name</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Email</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Address</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp

                                        @foreach ($dataOffice as $officer)
                                            <tr>
                                                <td
                                                    class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">
                                                    {{ $no++ }}</td>
                                                <td
                                                    class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">
                                                    {{ $officer['name'] }}</td>
                                                <td
                                                    class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">
                                                    {{ $officer['username'] }}</td>
                                                <td
                                                    class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">
                                                    {{ $officer['email'] }}</td>
                                                <td
                                                    class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">
                                                    {{ $officer['address'] }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('officer.edit', $officer->id) }}" class="btn btn-warning" style="margin-right: 5px"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <form action="/delete-officer/{{ $officer->id }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="fa-solid fa-trash"></i></button>
                                                    </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->role === 'user')
            <div class="mt-4">
                <div class="w-100 container" style="margin-top: 6rem">
                    <div>
                        <h3 class="text-center text-light fw-bold">List Book</h1>
                    </div>

                    <div class="d-flex flex-wrap">
                        {{-- @dd(Auth::user()) --}}
                        {{-- @dd($bookFilter) --}}
                        @foreach ($bookFilter as $item)
                            <div class="w-25 d-flex justify-content-center align-items-center">
                                <div class="card p-1" style="width: 95%">
                                    <div class="w-100 overflow-hidden d-flex rounded position-relative"
                                        style="max-height: 275px; min-height: 275px">
                                        <img src="{{ url('assets/img/data/' . $item->image) }}"
                                            class="position-absolute min-w-100 max-w-100 "
                                            style="transform: translate(-50%, -50%); top: 50%; left: 50%;" alt="...">
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-0 fw-bold" style="color: #1A1C19; font-size: 24px">
                                            {{ $item->title }}
                                        </p>
                                        <div class="mb-1 d-flex align-items-center">
                                            <p class="me-1 mb-0" style="color: #828282; font-size: 14px">
                                                {{ $item->writer }}
                                            </p>
                                            <p class="mb-0" style="color: #1A1C19; font-size: 14px">|</p>
                                            <i class="ms-1" style="color: #1A1C19; font-size: 14px">
                                                {{ $item->publisher }}
                                            </i>
                                        </div>
                                        <div class="mb-0 d-flex align-items-center">
                                            <img src="{{ asset('assets/img/star.png') }}" alt=""
                                                style="width: 24px; height: 24px">
                                            <p class="ms-1 mb-0" style="color: #1A1C19; font-size: 14px">
                                                {{ \App\Models\Review::with('book')->where('book_id', $item->id)->avg('rating') ?? 'Not Rated' }}
                                            </p>
                                        </div>
                                        <button class="btn btn-primary mt-3 mb-0" style="width: 100%" data-bs-toggle="modal"
                                            data-bs-target="#editModal" data-url="{{ route('borrow.borrowBook') }}"
                                            data-auth="{{ Auth::user()->id }}" data-book="{{ $item->id }}"
                                            data-img="{{ url('assets/img/data/' . $item->image) }}"
                                            data-review="{{ htmlspecialchars(json_encode(DB::table('reviews')->where('book_id', $item->id)->get()),ENT_QUOTES,'UTF-8') }}"
                                            data-title="{{ $item->title }}">
                                            Borrow
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content" id="modal-content">

                                {{-- content here --}}

                            </div>
                        </div>
                    </div>
                    <!-- End Modal Edit -->

                </div>
            </div>
        @endif
    </div>
    <!--   Core JS Files   -->
    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
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
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ url('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#5e72e4",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
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
                            color: '#fbfbfb',
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
                            color: '#ccc',
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
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>
        $('#editModal').on('shown.bs.modal', function(e) {

            var encodedReviewData = $(e.relatedTarget).data('review');

            // Decode HTML entities back to their original characters
            var decodedReviewData = $("<div/>").html(encodedReviewData).text();

            // Parse the JSON string to an actual JavaScript object
            var reviewData = JSON.parse(decodedReviewData);

            // Now you can use `reviewData` as a JavaScript object
            console.log(reviewData); // For debugging, to see the parsed data

            var html = `
        <div class="modal-content" id="modal-content">
                <div class="modal-body" style="height: 600px">
                    <form method="post" action="${$(e.relatedTarget).data('url')}">
                        @csrf
                        <div class="w-100">
                            <img src="${$(e.relatedTarget).data('img')}" class="" style="width: 100%; height: 400px" alt="...">
                            <p class="mb-0 fw-bold" style="color: #1A1C19; font-size: 24px">
                                ${$(e.relatedTarget).data('title')}
                            </p>
                            <div class="my-1 fw-bold" style="width: 100%; height: 1px; background-color: #1A1C19" />
                            <p class="pt-2" style="color: #1A1C19">List Comment</p>
                            <div id="review">

                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mt-3">Pinjam</button>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="${$(e.relatedTarget).data('auth')}">
                        <input type="hidden" name="book_id" value="${$(e.relatedTarget).data('book')}">
                        <input type="hidden" name="status" value="Dipinjam">
                       <div class="d-flex justify-content-end">
                        </div>
                    </form>
                </div>
            </div>
            `;

            $('#modal-content').html(html);
            reviewData.forEach(function(review) {
                var reviewElement = `
                <div class="d-flex align-items-center mb-2">
                    <img src="{{ asset('assets/img/user.png') }}" alt="" style="width: 24px; height: 24px">
                    <p class="ms-2 mb-0" style="color: #1A1C19; font-size: 14px">
                        ${review.review}
                    </p>
                </div>
                `;
                $('#review').append(reviewElement);
            });

        });
    </script>
@endsection


