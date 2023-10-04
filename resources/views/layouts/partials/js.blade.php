<script src="//code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('sweetalert::alert')
{{-- Sweet Alert Confirmation --}}
<script>
    $(document).ready(function() {
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data ini akan terhapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();

                }
            })
        });

    });
</script>
<script>
    const container = document.getElementById("container");
    container.style.border = "1px dashed #007BFF"

    function previewImg(event) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("preview");
        var labelUpload = document.getElementById("labelPreview");
        var container = document.getElementById("container");
        var filename = event.target.files[0].name;
        if (event.target.files.length > 0) {
            labelUpload.querySelector('p').textContent = filename;
            preview.src = src;
            preview.style.display = "block";
            container.style.borderStyle = "solid"
        }
    }
</script>

{{-- Calculate Harga Jual  --}}
<script>
    const hargaBeliInput = document.getElementById('harga_beli');
    const hargaJualInput = document.getElementById('harga_jual');

    function HitungHargaJual() {
        const hargaBeli = parseFloat(hargaBeliInput.value);
        if (!isNaN(hargaBeli)) {
            const hargaJual = hargaBeli * 1.3;
            hargaJualInput.value = hargaJual;
        } else {
            hargaJualInput.value = '';
        }
    }
    hargaBeliInput.addEventListener('input', HitungHargaJual);
</script>
