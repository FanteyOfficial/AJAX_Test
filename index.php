<html>

<head>
    <title>PHP Test</title>
</head>

<body>
    <?php echo '<p>Hello World</p>'; ?>

    <form>
        <p>Ricerca <input type="text" id="valore" name="name" /></p>
        <p><input type="submit" id="bottone"/></p>
    </form>

    <div id="tabella">
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            console.log("DOM fully loaded and parsed");
            var bottone = document.getElementById("bottone");
            bottone.addEventListener("click", sulClick);
            const ricerca = document.getElementById("valore");
            ricerca.addEventListener("input", function(event) {
                    event.preventDefault();
                    document.getElementById("bottone").click();
                
            });
        });

        function sulClick(e) {
            e.preventDefault();
            var contenuto = document.getElementById("valore").value;

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'api.php');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('t=' + contenuto);

            xhr.onload = function() {
                if (xhr.status != 200) {
                    alert(`Error ${xhr.status}: ${xhr.statusText}`);
                } else {
                    var t = document.getElementById("tabella");
                    t.innerHTML = "";

                    // display the users
                    var users = JSON.parse(xhr.response);
                    users.forEach(function(user) {
                        var userDiv = document.createElement('div');
                        userDiv.classList.add('user');
                        userDiv.innerHTML = user.user + ' <button class="delete-btn" data-id="' + user.id + '">Delete</button>';
                        t.appendChild(userDiv);
                    });

                    // Attach click event to delete buttons
                    var deleteButtons = document.querySelectorAll('.delete-btn');
                    deleteButtons.forEach(function(button) {
                        button.addEventListener('click', onDeleteClick);
                    });
                }
            };

            return false;
        }

        function onDeleteClick(e) {
            e.preventDefault();
            var userId = e.target.dataset.id;

            let deleteXhr = new XMLHttpRequest();
            deleteXhr.open('POST', 'delete.php');
            deleteXhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            deleteXhr.send('id=' + userId);

            deleteXhr.onload = function() {
                if (deleteXhr.status != 200) {
                    alert(`Error ${deleteXhr.status}: ${deleteXhr.statusText}`);
                } else {
                    // Remove the user's div from the DOM
                    e.target.parentNode.remove();
                }

                let response = JSON.parse(deleteXhr.response);
                alert(response.message);
            };
        }
    </script>

</body>

</html>
