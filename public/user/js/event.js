const Event = {
    addLoading() {
        $("#pagination-container")
            .html(`<div class="spinner-border" id="loadingEvent" role="status">
        <span class="sr-only">Loading...</span>
      </div>`);
    },
    removeLoading() {
        $("#loadingEvent").remove();
    },
    init() {
        this.addLoading();
        var myHeaders = new Headers();
        myHeaders.append("pragma", "no-cache");
        myHeaders.append("cache-control", "no-cache");

        var myInit = {
            method: "GET",
            headers: myHeaders,
        };
        fetch(URL.allEvent, myInit)
            .then((resp) => resp.json())
            .then((resp) => {
                this.paginate(resp);
            })
            .catch((err) => console.log(err));
    },
    paginate(data) {
        $("#pagination-container").pagination({
            dataSource: data,
            pageSize: 15,
            callback: function (data, pagination) {
                var html = Event.render(data);
                $("#data-container").html(html);
                Event.removeLoading();
                let images = document.querySelectorAll(".poster");
                lazyload(images);
            },
        });
    },
    render(data) {
        if (data == "") {
            return `
                <div class="col-md-12 text-center mb-2"><h3>Maaf, Tidak ada event dengan kategori ${$(
                    "#seachByCat  option:selected"
                ).text()}.</h3></div>
            `;
        }
        var html = "";
        data.forEach((element) => {
            html += `
            <div class="col-md-4 list-event">
                <div class="card card-event mb-4 shadow-sm">
                    <img class="img-responsive poster" data-src="${baseImgUrl}${
                element.poster
            }" style="object-fit: cover !important;max-height:200px;" alt="">
                    <div class="card-body">
                        <p class="card-text">${element.title}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" data-ev="${
                                    element.id
                                }" class="btn btn-sm btn-outline-secondary btn_detail">Detail</button>
                            </div>
                            <small class="text-muted" id="tgl">
                                <i class="far fa-calendar-alt"></i>
                                ${moment(
                                    element.date,
                                    "YYYY-M-D HH:mm:ss"
                                ).format("dddd, D MMM YYYY")}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            `;
        });
        return html;
    },
    seachByCat(cat) {
        if (cat == "all") {
            this.init();
            return;
        }
        var myHeaders = new Headers();
        myHeaders.append("pragma", "no-cache");
        myHeaders.append("cache-control", "no-cache");

        var myInit = {
            method: "GET",
            headers: myHeaders,
        };
        fetch(URL.getEventByCat.replace("ahaha", cat), myInit)
            .then((resp) => resp.json())
            .then((resp) => {
                this.paginate(resp);
            })
            .catch((err) => console.log(err));
    },
    openModalDetail(id) {
        $("#page_loader").addClass("d-flex");
        fetch(URL.getEventById.replace("nungguin_ya?", id))
            .then((resp) => resp.json())
            .then((data) => {
                $("#event_poster").attr("src", baseImgUrl + "" + data.poster);
                $("#event_title").html(data.title);
                $("#event_date").html(
                    moment(data.date, "YYYY-M-D HH:mm:ss").format(
                        "dddd, D MMM YYYY HH:mm"
                    )
                );
                $("#event_cat").html(data.category);
                $("#event_desc").html(data.desc);
                $("#page_loader").removeClass("d-flex");
                $("#modal_detail").modal("show");
            });
    },
};

$(document).ready(function () {
    Event.init();
    $("#seachByCat").on("change", function () {
        Event.seachByCat($(this).val());
    });
    $(document).on("click", ".btn_detail", function () {
        Event.openModalDetail($(this).data("ev"));
    });
});
