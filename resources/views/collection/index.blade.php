@extends('layouts.sidebar')

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                        <h6>Data table</h6>
                        <a href="{{ route('book.create') }}" class="btn add-new btn-success m-1 float-end"><i
                                class="fa-solid fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                            No
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">
                                            Title
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">
                                            Writer
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">
                                            publisher
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($data) --}}
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $no++ }}</td>
                                            <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $item->book->title }}</td>
                                            <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $item->book->writer }}</td>
                                            <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $item->book->publisher }}</td>
                                            <td>
                                                {{-- <form action="{{ route('borrow.returnBook') }}" method="POST">
                                                    @method('POST')
                                                    @csrf
                                                    <input type="hidden" name="book_id" value="{{ $item->book->id }}">
                                                    <button type="submit" class="btn btn-warning"><i
                                                            class="fa-solid fa-pen-to-square"></i></button>
                                                </form> --}}
                                                <button data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-book="{{ $item->book->id }}"
                                                    data-url="{{ route('borrow.returnBook') }}"
                                                    data-auth="{{ Auth::user()->id }}" type="button"
                                                    class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" id="modal-content">

                    {{-- content here --}}

                </div>
            </div>
        </div>
        <!-- End Modal Edit -->

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
        function validateInput(input) {
            const value = input.value;

            const isValid = /^[1-5]$/.test(value);

            if (!isValid) {
                input.value = '';
            }
        }
    </script>

    <script>
        $('#editModal').on('shown.bs.modal', function(e) {
            var html = `
            <div class="modal-content" id="modal-content">
                    <div class="modal-body">
                        <form method="post" action="${$(e.relatedTarget).data('url')}">
                            @csrf
                            <div class="form-group w-100 mb-0">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Rate</label>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/img/star.png') }}" alt="" class="me-2" style="width: 32px; height: 32px">
                                        <input type="number" name="rating" class="ms-1 form-control w-25" min="1" max="5" oninput="validateInput(this)">
                                    </div>
                                </div>
                                <label for="exampleInputEmail1" class="form-label">Comment</label>
                                <div class="form-floating">
                                    <textarea class="form-control" name="review" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Comments</label>
                                </div>
                                <input type="hidden" name="user_id" value="${$(e.relatedTarget).data('auth')}">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                                </div>
                            </div>
                            <input type="hidden" name="book_id" value="${$(e.relatedTarget).data('book')}">
                           <div class="d-flex justify-content-end">
                            </div>
                        </form>
                    </div>
                </div>
                `;

            $('#modal-content').html(html);

        });
    </script>
@endsection
