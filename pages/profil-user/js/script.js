// javascript untuk menampilkan gambar sebelum submit

var loadFile = function(event) {
    var output = document.getElementById('image');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src)
    }
};