const category = {
    loading: document.getElementById("kategoriloading"),
    hideLoading() {
        this.loading.style.display = "none";
    },
    showLoading() {
        this.loading.style.display = "";
    },
    _data: "",
    _condition: "",
    tbody: document.querySelector("#tabelkategori tbody"),
    _length: 0,
    render(data) {
        this._length = data.length;
        let innerBody = "";
        let i = 1;
        data.forEach((el) => {
            innerBody += `
                <tr>
                    <td>${i++}</td>
                    <td>${el.name}</td>
                    <td>${el.event_count}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-danger btn_delete_cat" data-id="${
                            el.id
                        }" data-name="${
                el.name
            }"><i class="fas fa-trash"></i></button>
                        <button class="btn btn-sm btn-info btn_edit_cat" data-id="${
                            el.id
                        }" data-name="${
                el.name
            }"><i class="fas fa-pencil-alt"></i></button>
                    </td>
                  </tr>
                `;
        });
        this.tbody.innerHTML = innerBody;
        this.hideLoading();

        this._tabel = $("#tabelkategori").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: true,
            responsive: true,
        });
    },
    init() {
        this.showLoading();
        var myHeaders = new Headers();
        myHeaders.append("pragma", "no-cache");
        myHeaders.append("cache-control", "no-cache");

        var myInit = {
            method: "GET",
            headers: myHeaders,
        };

        fetch(URL.getCat, myInit)
            .then((resp) => resp.json())
            .then((data) => this.render(data))
            .catch((err) => alert("terjadi error :" + err));
    },
    insert() {
        const input_nama = $("#nama_kategori_input");
        let token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        fetch(URL.insertCar, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            method: "post",
            body: JSON.stringify({ name: input_nama.val() }),
        })
            .then((resp) => {
                if (resp.status == 222) {
                    Swal.fire({
                        icon: "error",
                        title: "Maaf, Kategori Tidak Ditambahkan!",
                        text: "Kategori Sudah Ada.",
                    });
                    this.hideLoading();
                    return "";
                } else if (resp.status == 200) {
                    return resp.json();
                }
            })
            .then((data) => {
                if (data == "") {
                    return;
                } else {
                    this.reinit(data);
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: "Kategori Berhasil Ditambahkan.",
                    });
                }
            })
            .catch((err) => alert("terjadi error :" + err));
    },
    reinit(data) {
        this._tabel.clear().destroy();
        this.render(data);
    },
    showModalEdit(data) {
        $("#modal_kategori_title").html("Edit Kategori");
        $("#nama_kategori_input_error").hide();
        $("#modal_kategori").modal("show");
        const input_nama = $("#nama_kategori_input");
        input_nama.removeClass("is-invalid");
        input_nama.val(data.name);
        this._data = data;
        this._condition = "edit";
    },
    edit() {
        const input_nama = $("#nama_kategori_input");
        let token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        let tmpURL = URL.editCat;
        tmpURL = tmpURL.replace("__asd", this._data.id);
        fetch(tmpURL, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            method: "post",
            body: JSON.stringify({ name: input_nama.val() }),
        })
            .then((resp) => {
                if (resp.status == 222) {
                    return "";
                } else {
                    return resp.json();
                }
            })
            .then((data) => {
                if (data == "") {
                    Swal.fire({
                        icon: "error",
                        title: "Maaf!",
                        text: "Nama Kategori Sudah Ada.",
                    });
                    this.hideLoading();
                } else {
                    this.reinit(data);
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: "Kategori Berhasil Diedit.",
                    });
                }
            })
            .catch((err) => alert("terjadi error :" + err));
    },
    deleteButtonClick(data) {
        this._data = data;
        Swal.fire({
            title: `Yakin ingin menghapus kategori ${this._data.name}?`,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: `Ya, Hapus!`,
            cancelButtonText: `Batal!`,
        }).then((result) => {
            if (result.value) {
                this.showLoading();
                this.delete();
            }
        });
    },
    delete() {
        let token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        // let tmpURL = URL.deleteCat;
        // tmpURL = tmpURL.replace("__asd", this._data.id);
        fetch(URL.deleteCat, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            method: "post",
            body: JSON.stringify({ id: this._data.id }),
        })
            .then((resp) => {
                if (resp.status == 234) {
                    return "stop";
                } else {
                    return resp.json();
                }
            })
            .then((data) => {
                if (data == "stop") {
                    Swal.fire({
                        icon: "error",
                        title: "Maaf!",
                        text:
                            "Kategori Tidak Dihapus Karna Masih Memiliki Event.",
                    });
                    this.hideLoading();
                } else {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: "Kategori Berhasil Dihapus.",
                    });
                    this.reinit(data);
                }
            })
            .catch((err) => alert("terjadi error :" + err));
    },
};

$(document).ready(() => {
    category.init();
    $("#btn_trigger_kategori").on("click", () => {
        category._condition = "tambah";
        $("#modal_kategori_title").html("Tambah Kategori");
        $("#nama_kategori_input_error").hide();
        $("#modal_kategori").modal("show");
        const input_nama = $("#nama_kategori_input");
        input_nama.removeClass("is-invalid");
        input_nama.val("");
    });
    $("#btn_simpan_modal_category").on("click", () => {
        const input_nama = $("#nama_kategori_input");
        if (input_nama.val() != "") {
            category.showLoading();
            $("#modal_kategori").modal("hide");
            if (category._condition == "tambah") category.insert();
            else category.edit();
        } else {
            $("#nama_kategori_input_error").show();
            input_nama.addClass("is-invalid");
        }
    });
    $(document).on("click", ".btn_edit_cat", function () {
        category.showModalEdit({
            id: $(this).data("id"),
            name: $(this).data("name"),
        });
    });
    $(document).on("click", ".btn_delete_cat", function () {
        category.deleteButtonClick({
            id: $(this).data("id"),
            name: $(this).data("name"),
        });
    });
});
