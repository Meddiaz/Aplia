<?php
require 'connection.php';
$conn = connectToDB()
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
</head>
<body style="line-height: 1.6;">
    <?php 
    
    if (empty($_POST)) {
        echo "Fill out the reservation form at <a href=\"reservation.php\">reservation.php</a>";
        exit();
    }

    $arrival = strtotime($_POST['arrival']);
    $departure = strtotime($_POST['departure']);

    $forename = $_POST['forename'];
    $surname = $_POST['surname'];
    $phone = str_replace(' ', '', $_POST['phone']);
    $email = $_POST['email'];
    $hotelid = $_POST['hotelid'];
    $arrival = date('Y-m-d H:i:s', $arrival);
    $departure = date('Y-m-d H:i:s', $departure);
    $rooms = $_POST['rooms'];

    if (!Is_Numeric($rooms) || $rooms <= 0) {
        echo "Error in room selection (must be positive integer)";
        exit();
    }
    if (!Is_Numeric($phone)) {
        echo "Error: Phone number is not numeric.";
        exit();
    }
    if (preg_match('/[0-9]/', $forename) || preg_match('/[0-9]/', $surname)) {
        echo "Error: Name contains number.";
        exit();
    }
    if ($departure <= $arrival) {
        echo "Error: Departure must be after arrival";
        exit();
    }
    if ($arrival < date('Y-m-d')) {
        echo "Error: Arrival must be after today's date.";
        exit();
    }

    $query = "INSERT INTO Reservations (forename, surname, phone, email, hotelid, arrival, departure, rooms) 
                VALUES ('$forename', '$surname', '$phone', '$email', $hotelid, '$arrival', '$departure', $rooms)";
    
    if (mysqli_query($conn, $query)) {
        $hotelquery = "SELECT name, city, price, rooms FROM Hotels where id = $hotelid";
        $result = mysqli_query($conn, $hotelquery);
        $hotel = mysqli_fetch_assoc($result);
        
        if ($hotel['rooms'] < $rooms) {
            echo "There are not enought rooms in the hotel! Maximum is {$hotel['rooms']}.";
            exit();
        }

        $days = date_diff(date_create($arrival), date_create($departure))->format("%a");
        
        echo "
        <h3>Reservation completed.</h3>
        <strong>Name:</strong> $forename $surname <br>
        <strong>Hotel:</strong> {$hotel['name']} <br>
        <strong>City:</strong> {$hotel['city']} <br>
        <strong>Rooms:</strong> $rooms <br>
        <strong>Days:</strong> $days <br>
        <strong>Total price:</strong> " . $days * $rooms * $hotel['price'] . "kr";
    }
    else {
        echo "Error: " . mysqli_error($conn);
    }
    ?>
</body>
</html>