function saveAnime(id) {
    console.log(id);

    // Make an AJAX request
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Handle the response from PHP
            console.log(this.responseText);
        }
    };
    // Replace 'your_php_script.php' with the path to your PHP script
    xhttp.open("POST", "application/models/lol.php", true);
    xhttp.send();
}