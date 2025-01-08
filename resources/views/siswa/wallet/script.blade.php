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
            {{ Auth::user()->wallet()->where('jenis', 'lainnya')->sum('nominal')  }},
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
</script>
