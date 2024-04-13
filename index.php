<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        header("location: users.php");
    }
?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Flopper Chat App</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Email Adress</label>
                    <input type="text" name="email" placeholder="Email Adress" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Select Image</label>
                    <input type="file" name="image" id="imageInput" required>
                    <img id="bildVorschau" style="max-width: 100%; display: none;">
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Already signed up? <a href="login.php">Login now</a></div>
        </section>
    </div>

    <script>
        window.onload = function() {
            var confirmation = "Das sind die Nutzungsbedingungen, welche man akzeptieren muss, um diese Website nutzen zu dürfen.\n\nDatenschutz:\n- Ich kann auf alle Nachrichten zugreifen, genauso wie auf Bilder und Dateien.\n- Passwörter sind nicht verschlüsselt.\n\nBerechtigung:\n- Der Link darf nicht weitergeschickt werden, und die Website bleibt im Klassenverband.\n- Kein Spam.\n\nMit Klicken auf den Button akzeptierst du die Nutzungsbedingungen.";

            alert(confirmation);
        };
    </script>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>
</body>
</html>
