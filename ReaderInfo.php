<?php
    include_once "connection.php";
    $sql = "SELECT RID, RNAME, PHONE_NO FROM READER";
    $result = $conn->query($sql);

        while ($row=$result->fetch_assoc()) {
            echo "Reader ID:" . $row['RID']." - Reader Name: " . $row["RNAME"]. " - Phone: ". $row["PHONE_NO"]. "<br>";
        }
    $conn->close();
?>
