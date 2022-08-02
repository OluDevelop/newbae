<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery</title>

    <!-- jquery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            
            $("button").click(function(){
                
                $.post("ajax.php",
                
                    {
                        name: "Olumide",
                        age: "24"
                    },

                    function(data, status){
                        alert(data);
                    }
                );

            });

        });
    </script>

</head>
<body>
    
        
    <p class="p"></p>

    <button>Click Me</button>

</body>
</html>