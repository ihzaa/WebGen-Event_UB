$("#btn-simpan-pass").on("click", function () {
    let pass1 = $("#pass1").val();
    let pass2 = $("#pass2").val();
    let pass3 = $("#pass3").val();

    if (pass1 == "" || pass2 == "" || pass3 == "") {
        Swal.fire(
            "Maaf!",
            "Tidak boleh ada form password yang kosong!",
            "error"
        );
        return;
    }

    if (pass2 != pass3) {
        Swal.fire("Maaf!", "Password konfirmasi tidak sama!", "error");
        return;
    }
    $("#card_pass").append(`<div class="overlay dark" id="pass_load">
  <i class="fas fa-2x fa-sync-alt fa-spin"></i>
</div>`);
    axios
        .post(route.ps, {
            old: pass1,
            new: pass2,
        })
        .then(function (response) {
            if (response.data.status) {
                Swal.fire("Berhasil!", "Password berhasil diubah!", "success");
            } else {
                Swal.fire("Maaf!", "Password lama tidak benar!", "error");
            }
        })
        .catch(function (error) {
            console.log(error);
        })
        .finally(function () {
            $("#pass1").val("");
            $("#pass2").val("");
            $("#pass3").val("");
            $("#pass_load").remove();
        });
});

$("#btn-simpan-nama").on("click", function () {
    let nama = $("#nama").val();
    if (nama == "") {
        Swal.fire("Maaf!", "Kolom username tidak boleh kosong!", "error");
        return;
    }
    $("#card_nama").append(`<div class="overlay dark" id="nama_load">
  <i class="fas fa-2x fa-sync-alt fa-spin"></i>
</div>`);
    axios
        .post(route.nm, {
            nama: nama,
        })
        .then(function (response) {
            Swal.fire("Berhasil!", "Username berhasil diubah!", "success");
        })
        .catch(function (error) {
            console.log(error);
        })
        .finally(function () {
            $("#nama_load").remove();
        });
});
