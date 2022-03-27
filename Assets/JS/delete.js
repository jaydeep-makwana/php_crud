// delete recoreds 
function delete_data(id) {

    let alert = confirm('Are you sure for delete this record?');
    if (alert == true) {

        let xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                document.getElementById('row' + id).style.display = 'none';
            }
        }
        xhr.open("GET", "delete.php?id=" + id);
        xhr.send();


    }
}