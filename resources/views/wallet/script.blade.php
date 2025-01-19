<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script
    src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
    data-client-key="{{ config('services.midtrans.clientKey') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $("#topupForm").submit(function(event) {
        console.log("Form submitted");
        event.preventDefault();


        $.post("/api/topup", {
                _method: 'POST',
                _token: '{{ csrf_token() }}',
                name: $('#name').val(),
                email: $('#email').val(),
                nominal: $('#nominal').val(),
                user_id: $('#user_id').val(),
            },
            function(data, status) {
                console.log(data);
                snap.pay(data.snap_token, {
                    // Optional
                    onSuccess: function(result) {
                        location.reload();
                    },
                    // Optional
                    onPending: function(result) {
                        location.reload();
                    },
                    // Optional
                    onError: function(result) {
                        location.reload();
                    }
                });
                return false;
            }
        );
    });
</script>

<script>
    function modalFoto(url) {
        var modal = document.getElementById("modal-foto");
        var img = document.getElementById("foto");
        img.src = url;
        modal.classList.remove("hidden");
    }

    function closeModalFoto() {
        var modal = document.getElementById("modal-foto");
        modal.classList.add("hidden");
    }

    // sweet alert konfirmasi
    function confirmAction(formId, actionName) {
        Swal.fire({
            title: `Apakah anda yakin untuk ${actionName.toLowerCase()}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, ' + actionName,
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }

    // {{-- chart --}}
    var grade = {
        series: [
            {{ Auth::user()->wallet()->where('jenis', 'lainnya')->sum('nominal') }},
            {{ Auth::user()->wallet()->where('jenis', 'uang masuk')->whereNot('unique', '!=', null)->sum('nominal') }},
            {{ Auth::user()->wallet()->where('jenis', 'uang keluar')->sum('nominal') }}
        ],
        labels: ["other", "Uang Masuk", "Uang Keluar"],
        chart: {
            height: 170,
            type: "donut",
            fontFamily: "Plus Jakarta Sans', sans-serif",
            foreColor: "#c6d1e9",
        },

        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
        },

        colors: ["#e7ecf0", "#fb977d", "#0085db"],
        dataLabels: {
            enabled: false,
        },

        legend: {
            show: false,
        },

        stroke: {
            show: false,
        },
        responsive: [{
            breakpoint: 991,
            options: {
                chart: {
                    width: 150,
                },
            },
        }, ],
        plotOptions: {
            pie: {
                donut: {
                    size: '80%',
                    background: "none",
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontSize: "12px",
                            color: undefined,
                            offsetY: 5,
                        },
                        value: {
                            show: false,
                            color: "#98aab4",
                        },
                    },
                },
            },
        },
        responsive: [{
                breakpoint: 1476,
                options: {
                    chart: {
                        height: 120,
                    },
                },
            },
            {
                breakpoint: 1280,
                options: {
                    chart: {
                        height: 170,
                    },
                },
            },
            {
                breakpoint: 1166,
                options: {
                    chart: {
                        height: 120,
                    },
                },
            },
            {
                breakpoint: 1024,
                options: {
                    chart: {
                        height: 170,
                    },
                },
            },
        ],
    };

    // {{-- copy no unik --}}

    function copyToClipboard(element) {
        var text = element.innerText;
        navigator.clipboard.writeText(text).then(function() {
            console.log('Text copied to clipboard');
        });
    }

    // modal transfer
    function modalTransfer() {
        document.getElementById('modal-transfer').classList.remove('hidden');
    }

    function closeModaltransefer() {
        document.getElementById('modal-transfer').classList.add('hidden');
    }

    // modal TopUp
    function modalTopUp() {
        document.getElementById('modal-TopUp').classList.remove('hidden');
    }

    function closeModalTopUp() {
        document.getElementById('modal-TopUp').classList.add('hidden');
    }

    function modalTarikSaldo() {
        document.getElementById('modal-tarik-saldo').classList.remove('hidden');
    }

    function closeModalTarikSaldo() {
        document.getElementById('modal-tarik-saldo').classList.add('hidden');
    }
</script>
