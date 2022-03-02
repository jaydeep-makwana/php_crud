let select_col = () => {
    let srch_drop = document.getElementById("search_dropdown");
    let serch_input = document.getElementById("search");
    let serch_btn = document.getElementById("search-btn");

    if (srch_drop.value != "") {
        serch_input.style.display = "block";
        serch_btn.style.display = "block";

    }

}