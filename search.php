<?php
require 'connection.php';
$conn = connectToDB()
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Search</title>
</head>
<body style="line-height: 1.6;">
    <h3>Hotel Search</h3>

    <form action="" method="post">
        
        City: <select name="city">                  <!-- Byene er "hardkodet" inn, ikke ideelt. Burde lagres og hentes fra database -->
            <option value="Skien">Skien</option>
            <option value="Porsgrunn">Porsgrunn</option>
            <option value="Berlin">Berlin</option>
        </select> <br>
        
        Arrival: <input type="date" name="arrival"> <br>
        Departure: <input type="date" name="departure"> <br>
        Rooms: <input type="text" name="rooms"> <br>
        Max price (optional): <input type="text" name="maxprice"> <br>
        <input type="submit" value="Search">
    </form>

    <?php
    if (!empty($_POST)) {
        $rooms = $_POST['rooms'];
        $city = $_POST['city'];
        $arrival = $_POST['arrival'];
        $departure = $_POST['departure'];

        $query = "SELECT id, name, price FROM Hotels WHERE city = '$city' AND rooms >= $rooms";
        if ($_POST['maxprice'] > 0) {
            $query .= " AND price <= {$_POST['maxprice']}";
        }
        $query .= " ORDER BY price";

        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "SQL Error: " . mysqli_error($conn);
            exit();
        }

        while($hotel = mysqli_fetch_assoc($result)) {
            $id = $hotel['id'];
            $name = $hotel['name'];
            $price = $hotel['price'];
            echo "<a href=\"reservation.php?hotelid=$id&rooms=$rooms&arrival=$arrival&departure=$departure\">$name</a>  -  $price kr <br>";
        }

    }
    ?>
    
</body>
</html>