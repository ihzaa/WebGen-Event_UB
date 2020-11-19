const Event = {
    loading: document.getElementById("eventloading"),
    tbody: document.querySelector("#tabelevent tbody"),
    hideLoading() {
        this.loading.style.display = "none";
    },
    showLoading() {
        this.loading.style.display = "";
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

        fetch(URL.getEvent, myInit)
            .then((resp) => resp.json())
            .then((data) => this.render(data))
            .catch((err) => alert("terjadi error :" + err));
    },
    render(data) {
        let innerBody = "";
        let i = 1;
        const dateNow = moment();
        data.forEach((el) => {
            tmpUrl = URL.editEvent;
            tmpUrl = tmpUrl.replace("astaga", el.id);
            let date = moment(el.date, "YYYY-M-D HH:mm:ss").format(
                "dddd, D MMM YYYY"
            );

            innerBody += `
                <tr ${dateNow.isAfter(el.date) ? 'class="bg-dark"':''}>
                    <td>${i++}</td>
                    <td>${el.title}</td>
                    <td><img class="lazyload img-fluid" data-src="${storagePath}/${
                el.poster
            }"></td>
                    <td>${date}</td>
                    <td>${el.category_name}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-danger btn_delete_event" data-id="${
                            el.id
                        }" data-name="${
                el.title
            }"><i class="fas fa-trash"></i></button>
                        <a class="btn btn-sm btn-info btn_edit_event" href="${tmpUrl}"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                  </tr>
                `;
        });
        this.tbody.innerHTML = innerBody;
        let images = document.querySelectorAll(".lazyload");
        lazyload(images);
        this.hideLoading();

        this._tabel = $("#tabelevent").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: true,
            responsive: true,
        });
    },
    btnDeleteClick(data) {
        this._data = data;
        Swal.fire({
            title: `Yakin ingin menghapus event ${this._data.name}?`,
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
        fetch(URL.delEvent, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            method: "post",
            body: JSON.stringify({ id: this._data.id }),
        })
            .then((resp) => resp.json())
            .then((data) => {
                this.reinit(data);
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: "Event Berhasil Dihapus.",
                });
            })
            .catch((err) => alert("terjadi error :" + err));
    },
    reinit(data) {
        this._tabel.clear().destroy();
        this.render(data);
    },
};

$(document).ready(() => {
    Event.init();
    $(document).on("click", ".btn_delete_event", function () {
        Event.btnDeleteClick({
            id: $(this).data("id"),
            name: $(this).data("name"),
        });
    });
    $(document).on("click", "#btn_trigger_event", function () {
        if (category._length == 0) {
            event.preventDefault();
            Swal.fire({
                icon: "error",
                title: "Maaf!",
                text: "Untuk Menambahkan Event Minimal Terdapat 1 Kategori.",
            });
            return;
        }
    });
});
