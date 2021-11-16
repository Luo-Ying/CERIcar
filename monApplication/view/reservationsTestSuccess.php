<?php
    $i = 0;
    foreach ($context->reservations as $reservation) {
        $i++;
        echo "<br><br><br><br><br><br>";
        echo "reservation ", " :<br>";
        echo "id: ", $reservation->id, "<br>";
        echo "id voyage : ", $reservation->voyage->id, "<br>";
        // echo "<br>ok<br>";
        echo "id voyageur: ", $reservation->voyageur->id, "<br>";
    }
?>