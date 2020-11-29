function headerNoCache() {
    var myHeaders = new Headers();
    myHeaders.append("pragma", "no-cache");
    myHeaders.append("cache-control", "no-cache");

    var myInit = {
        method: "GET",
        headers: myHeaders,
    };
    return myInit;
}

function init() {
    fetch(URL.getLatesAd, headerNoCache())
        .then((resp) => resp.json())
        .then((data) => {
            if (data == "") {
                return;
            } else {
                $("#ads_poster").attr("src", baseImgUrlAds + data.image);
                $("#ads_desc").html(data.desc);
                $(".ads").show();
            }
        })
        .then(() => setTimeout(init, 90000))
        .catch((err) => console.log(err));
}

init();
