// search bar 
let searchbar = document.getElementById("search");
let search_drop = document.getElementById("search_dropdown");



function placeholder() {

    searchbar.placeholder = 'search by ' + search_drop.value;
    searchbar.disabled = false;

}


function searchData() {
    let str = {
        srch_input: searchbar.value,
        field: search_drop.value
    }
    str = JSON.stringify(str);
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("rows").innerHTML = this.response;
        }
    }

    xhr.open("GET", "search_data.php?q=" + str, true);
    xhr.send();
}