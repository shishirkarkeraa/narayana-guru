document.addEventListener("DOMContentLoaded", function() {
    window.addEventListener('beforeunload', function(event) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'logout.php', false); 
        xhr.send();
    });
});
