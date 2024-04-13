<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<style>
    .disable{
        display: none !important;
    }
</style>

<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php 
                    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                    if(mysqli_num_rows($sql) > 0){
                        $row = mysqli_fetch_assoc($sql);
                    }
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="php/images/<?php echo $row['img']; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
            </header>
            <div class="chat-box">
                
            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." style="display: block;">
                <input type="file" name="nichts" class="input-file disable" id="file">
                <button class="file-lable" onclick="toggleClasses()" style="border-radius: 0 !important;">
                    <i class="fa-solid fa-upload"></i>
                    <i class="fa-solid fa-keyboard disable"></i>
                </button>
                <button class="send-btn"><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    
    <script>
        window.addEventListener('unload', async function() {
            await logoutAsync();
        });

        async function logoutAsync() {
            try {
                await fetch("php/logout.php?logout_id=<?php echo $_SESSION['unique_id']; ?>", {
                    method: 'GET',
                    mode: 'cors',
                    credentials: 'include'
                });
            } catch (error) {
                console.error('Logout failed:', error);
            }
        }

        function toggleClasses() {
            let firstIcon = document.querySelector('.fa-upload');
            let secondIcon = document.querySelector('.fa-keyboard');
            let textInput = document.querySelector('.input-field');
            let fileInput = document.querySelector('.input-file');


            firstIcon.classList.toggle('disable');
            secondIcon.classList.toggle('disable');
            textInput.classList.toggle('disable');
            fileInput.classList.toggle('disable');

            if(textInput.classList.contains('disable')){
                textInput.name = "nichts";
                fileInput.name = "message";
            }else{
                textInput.name = "message";
                fileInput.name = "nichts";
            }
        }
    </script>

    <script src="javascript/chat.js"></script>
</body>
</html>