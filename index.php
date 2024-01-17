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
        
        //on document ready
        document.addEventListener("DOMContentLoaded", function(event) {
            console.log("DOM fully loaded and parsed");
            var bottone = document.getElementById("bottone");
            bottone.addEventListener("click", sulClick);

        });

        function sulClick(e) {
            e.preventDefault();
            var contenuto = document.getElementById("valore").value;
            
            console.log(e);

            let xhr = new XMLHttpRequest();
            xhr.open('GET', '/www/api.php?t=' + contenuto);
            xhr.send();

            xhr.onload = function() {
                if (xhr.status != 200) { // analyze HTTP status of the response
                    alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
                } else { // show the result
                    console.log(`Done, got ${xhr.response.length} bytes`); // response is the server
                    //var res = JSON.parse(xhr.response);
                    res = xhr.response;
                    console.log(res);
                    var t = document.getElementById("tabella");
                    t.innerHTML = res;
                    
                }
            };

            return false;
        }

    </script>

</body>

</html>


