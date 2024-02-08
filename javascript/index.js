window.addEventListener('load', function() {
    document.body.classList.add('loaded');
  });
  
window.addEventListener('load', function() {

    if (window.location.href.includes("sangha.php")) {
        var element = document.getElementById('btn1');
        if (element) {
            element.classList.add('active');
        }
    }
});


window.addEventListener('load', function() {

    if (window.location.href.includes("gallery.php")) {
        var element = document.getElementById('btn3');

        if (element) {
            element.classList.add('active');
        }
    }
});
window.addEventListener('load', function() {

    if (window.location.href.includes("samiti.php")) {
        var element = document.getElementById('btn2');

        if (element) {
            element.classList.add('active');
        }
    }
});

window.addEventListener('load', function() {

    if (window.location.href.includes("index.php")) {
        var element = document.getElementById('btn4');
        if (element) {
            element.classList.add('active');
        }
    }
});

window.addEventListener('load', function() {

    if (window.location.href.includes("donation.php")) {
        var element = document.getElementById('btn5');

        if (element) {
            element.classList.add('active');
        }
    }
});

window.addEventListener('load', function() {

    if (window.location.href.includes("donationentry.php")) {
        var element = document.getElementById('btn6');

        if (element) {
            element.classList.add('active');
        }
    }
});


window.addEventListener('load', function() {

    if (window.location.href.includes("seva.php")) {
        var element = document.getElementById('btn7');

        if (element) {
            element.classList.add('active');
        }
    }
});


window.addEventListener('load', function() {

    if (window.location.href.includes("getseve.php")) {
        var element = document.getElementById('btn10');

        if (element) {
            element.classList.add('active');
        }
    }
});

window.addEventListener('load', function() {

    if (window.location.href.includes("ledger.php")) {
        var element = document.getElementById('btn11');

        if (element) {
            element.classList.add('active');
        }
    }
});

window.addEventListener('load', function() {

    if (window.location.href.includes("ledgerentry.php")) {
        var element = document.getElementById('btn12');

        if (element) {
            element.classList.add('active');
        }
    }
});

function checkUsername() {
    const username = document.getElementById('username').value;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'check_username.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.exists) {
                const loginForm = document.getElementById('login-form');
                loginForm.innerHTML = `
                    <input type="hidden" name="username" value="${username}">
                    <input type="password" name="password" id="password" placeholder="Password" required oninput="restrictInput6(event)">
                    <input type="submit" id="login" value="Login">
                `;
                loginForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    loginForm.submit();
                });
            } else {
                document.getElementById('error').innerHTML = 'Username does not exist.';
                const delay = 4000;
                setTimeout(() => {
                document.getElementById('error').innerHTML = ' ';
                }, delay);
            }
        } else {
            console.error('Error:', xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Network error occurred.');
    };
    xhr.send('username=' + username);
}


function toggleDropdown() {
    var dropdownMenu = document.getElementById("myDropdown");
    if (dropdownMenu.style.display === "block") {
      dropdownMenu.style.display = "none";
    } else {
      dropdownMenu.style.display = "block";
    }
  }

