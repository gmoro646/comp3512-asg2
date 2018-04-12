<!DOCTYPE html>
<html lang="en">

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script>
        // BETTER FUNCTION TO ACCESS DATA 
        $(document).ready(function() {
                                var options = [];
                                $.get("print-services.php", function(data) {
                                    for (var i = 0; i < data.sizes.length; i++) {
                                        options.push('<option value="',
                                            data.sizes[i].id, '">',
                                            data.sizes[i].name, '</option>');
                                    }
                                    console.log(options);
                                    $("#dropdown").html(options.join(''));
                                });
                    });
       
                                
    </script>
  
</head>


<body>

    <h2>Get data as JSON from a PHP file on the server.</h2>

    <p id="test"></p>
    <form>
        <select id="dropdown">
        
    </select>
    </form>

    <button>Send an HTTP GET request to a page and get the result back</button>

</body>

</html>