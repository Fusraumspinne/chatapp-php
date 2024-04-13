<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        
        if(isset($_POST['message']) || isset($_FILES['message'])){
            $text = mysqli_real_escape_string($conn, $_POST['message']);

            if(isset($_FILES['message'])){
                $file = $_FILES['message'];

                $fileName = mysqli_real_escape_string($conn, $file['name']);
                $fileTmpName = $file['tmp_name'];
                $fileSize = $file['size'];
                $fileError = $file['error'];

                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if($fileError === 0){
                    $fileDestination = "images/" . $fileName;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    $message = '<a href="http://localhost/chatapp/php/images/' . $fileName . '" class="link-color" target="_blank">Datei Anzeigen</a>';
                } else {
                    echo "Fehler beim Hochladen der Datei.";
                    exit();
                }
            } else {
                $message = $text;
            }

            date_default_timezone_set('Europe/Berlin');
            $currentDate = date('Y-m-d');
            $currentTime = date('H:i:s');

            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, date, time)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$currentDate}', '{$currentTime}')") or die(mysqli_error($conn));

            echo "Die Nachricht wurde erfolgreich gesendet.";

            if(isset($_FILES['message'])){
                $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, date, time)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$fileName}', '{$currentDate}', '{$currentTime}')") or die(mysqli_error($conn));

                $fileLink = "http://localhost/chatapp/php/" . $fileDestination;
                echo "<br/><a href='{$fileLink}' target='_blank'>Hier klicken, um die Datei anzuzeigen</a>";
            }
        } else {
            echo "Es wurde keine Nachricht oder Datei hochgeladen.";
        }
    } else {
        header("location: ../login.php");
    }
?>
