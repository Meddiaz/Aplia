<?php
require 'connection.php';
$conn = connectToDB()
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
</head>

<body style="line-height: 1.6;">
    <h3>Hotel Reservation</h3>

    <form name="reservationForm" action="reservation_confirmation.php" method="post">
        First name: <input type="text" name="forename"><br><br>
        Surname: <input type="text" name="surname"><br><br>
        Phone number: <input type="text" name="phone"><br><br>
        E-mail address: <input type="text" name="email"><br><br>
        Hotel: <select name="hotelid">

        <?php
            $get_id = (isset($_GET['hotelid'])) ? $_GET['hotelid'] : -1;
            $hotels = mysqli_query($conn, "SELECT name, city, id FROM Hotels ORDER BY city");

            while ($hotel = mysqli_fetch_assoc($hotels)) 
                echo "<option value=\" {$hotel['id']} \"" . (($hotel['id'] == $get_id) ? "selected" : "") . "> {$hotel['name']} ({$hotel['city']})</option>";

        ?>

        </select><br><br>
        Arrival: <input type="date" name="arrival" <?php echo (isset($_GET['arrival'])) ? "value=\"{$_GET['arrival']}\"" : "" ?> ><br><br>
        Departure: <input type="date" name="departure" <?php echo (isset($_GET['departure'])) ? "value=\"{$_GET['departure']}\"" : "" ?> ><br><br>
        Number of rooms: <input type="text" name="rooms" <?php echo (isset($_GET['rooms'])) ? "value=\"{$_GET['rooms']}\"" : "" ?> ><br><br>
        <input type="submit" value="Confirm Reservation">
    </form>
    
</body>
</html>