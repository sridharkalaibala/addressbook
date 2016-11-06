

function confirmDelete() {
    var result = confirm("Are you sure you want to delete this record?");
    if (result) {
       return true;
    }
    return false;
}
