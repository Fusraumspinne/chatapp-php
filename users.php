<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
    <div class="wrapper usersPanel">
        <section class="users">
            <header>
                <div class="content">
                    <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                        if(mysqli_num_rows($sql) > 0){
                            $row = mysqli_fetch_assoc($sql);
                        }
                    ?>
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
                        <p><?php echo $row['status']; ?></p>
                    </div>
                </div>
                <button class="settings"><i class="fa-solid fa-gear"></i></button>
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
                
            </div>
        </section>
    </div>
    
    <div class="wrapper settingsPanel disabled">
        <div class="form-container">
            <form action="php/update-profil.php" method="post" class="updateForm">
                <header>Flopper Chat App | Update Profil</header>
                <label for="newFname">New First Name</label>
                <input type="text" id="newFname" name="newFname" placeholder="<?php echo $row['fname']; ?>" required>
                <label for="newLname">New Last Name</label>
                <input type="text" id="newLname" name="newLname" placeholder="<?php echo $row['lname']; ?>" required>
                <label for="newEmail">New Email Adress</label>
                <input type="email" id="newEmail" name="newEmail" placeholder="<?php echo $row['email']; ?>" required>
                <label for="newPassword">New Password</label>
                <input type="number" id="newPassword" name="newPassword" placeholder="<?php echo $row['password']; ?>" required>
                <button type="submit">Update</button>
            </form>
            <button class="usersBack">Back</button>
        </div>
    </div>

    <script>
        window.onload = function(){
            const newFnameInput = document.querySelector("#newFname"),
            newLnameInput = document.querySelector("#newLname"),
            newEmailInput = document.querySelector("#newEmail"),
            newPasswordInput = document.querySelector("#newPassword");

            newFnameInput.value = newFnameInput.placeholder;
            newLnameInput.value = newLnameInput.placeholder;
            newEmailInput.value = newEmailInput.placeholder;
            newPasswordInput.value = newPasswordInput.placeholder;
        };

        window.addEventListener('unload', async function() {
            await logoutAsync();
        });

        async function logoutAsync() {
            try {
                await fetch("php/logout.php?logout_id=<?php echo $row['unique_id'] ?>", {
                    method: 'GET',
                    mode: 'cors',
                    credentials: 'include'
                });
            } catch (error) {
                console.error('Logout failed:', error);
            }
        }
    </script>

    <script src="javascript/users.js"></script>
</body>
</html>