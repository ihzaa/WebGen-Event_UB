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
        data.forEach((el) => {
            innerBody += `
                <tr>
                    <td>${i++}</td>
                    <td>${el.title}</td>
                    <td>${el.poster}</td>
                    <td>${moment(el.date).format("dddd, D MMM YYYY")}</td>
                    <td>${el.category_name}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-danger btn_delete_event" data-id="${
                            el.id
                        }"><i class="fas fa-trash"></i></button>
                        <button class="btn btn-sm btn-info btn_edit_event" data-id="${
                            el.id
                        }"><i class="fas fa-pencil-alt"></i></button>
                    </td>
                  </tr>
                `;
        });
        this.tbody.innerHTML = innerBody;
        this.hideLoading();
    },
};

$(document).ready(() => {
    Event.init();
});
