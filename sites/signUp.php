<?php $page_title = "Sign up"; ?>
<!DOCTYPE html>
<html lang="en" >
    <?php include '../inc/head.php'?>
<body>
    <!-- top header sign up page -->
    <div>
        <!-- logo area -->
    </div>
    <div>
        <div>
            <!-- Sign in -->
            <form class="sign-in-form">
                Email: <input type="email" class="input-primary">
                password: <input type="password" class="input-primary">
                remember me <input type="checkbox">
                <a href="#">Forgot password</a>
                <input type="submit" value="sign in" class="btn-primary"/>
            </form>
            <div class="container">
                <h1>Welcome to Code Challenge</h1>
                <p class="intro">
                    We offer free coding classes in <strong>C</strong>. Join and code in seconds.
                </p>
                <div class="sign-up-wrapper">
                    <img src="../assets/map.png" alt="map" width="300px" height="200px" style="float: left; margin-right: 10px;"/>
                    <!-- Sign up form -->
                    <form class="sign-up-form"
                          autocomplete="off" 
                          accept-charset="UTF-8" 
                          method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
                          name="sign_up_form">
                        <!-- php: implementation for registration form -->
                        <?php 
                        $email = $pwd = $re_enter_pwd = "";
                        $emailErr = $pwdErr = $re_enter_pwdErr = "";

                        //Function to validate input.
                        function test_input($data) {
                           $data = trim($data);
                           $data = stripslashes($data);
                           $data = htmlspecialchars($data);
                           return $data;
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (empty($_POST["user_email"])) {
                                $emailErr = "Email is required.";
                            } else {
                                $email = test_input($_POST["user_email"]);
                                // check if e-mail address is well-formed
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $emailErr = "Invalid email format";
                                }
                            }

                            if (empty($_POST["user_pwd"])) {
                                $pwdErr = "Password is required.";
                            } else {
                                 $pwd = test_input($_POST["user_pwd"]);
                                 // check if password only contains letters and whitespace
                                 if (strlen($pwd) < 3) {
                                   $pwdErr = "Password is too short.";
                                 }
                            }

                            if (empty($_POST["user_re_pwd"])) {
                                $re_enter_pwdErr = "Please re-enter password.";
                            } else {
                                $re_enter_pwd = test_input($_POST["user_re_pwd"]);
                                // check if password re-entered only contains letters and numbers, no whitespace
                                if (strcmp($re_enter_pwd, $pwd) != 0) {
                                    $re_enter_pwdErr = "Passwords do not match.";
                                }
                            }
                        }//End of if-statement
                        ?>
                        
                        <fieldset>
                            <legend>Sign up</legend>
                            <input type="email" placeholder="email" class="input-primary" 
                                   name="user_email" value="<?php echo $email;?>"><br>                            
                            <input type="password" placeholder="password" class="input-primary" 
                                   name="user_pwd" value="<?php echo $pwd;?>"><br>
                            <input type="password" placeholder="re-enter password" class="input-primary" 
                                   name="user_re_pwd" value="<?php echo $re_enter_pwd;?>"><br>
                            <input type="checkbox" name="read_conditions">I have read the conditions.<br>
                            <input type="submit" value="sign up" class="btn-primary" onclick="validateFormInputs()"/>                      
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <div class="errors">
        <span class="error"><?php echo $emailErr;?></span><br>
        <span class="error"><?php echo $pwdErr;?></span><br>
        <span class="error"><?php echo $re_enter_pwdErr;?></span><br>
    </div>
    <!-- footer -->
    <?php include '../inc/footer.php'?>
    <!-- scripts -->
    <script>
    //Create a function to validate form input
    function validateFormInputs() {
        var cnt_inputs = 0;     //Will count all the inputs filled by user.
        var email = document.forms["sign_up_form"]["user_email"].value;
        var pwd = document.forms["sign_up_form"]["user_pwd"].value;
        var re_pwd = document.forms["sign_up_form"]["user_re_pwd"].value;
        var condition = document.forms["sign_up_form"]["read_conditions"].value;
                                
        if (email == null || email == "") {  
        } else {
            if (email.indexOf(".") > 2 && email.indexOf("@") > 1) {
                cnt_inputs++;
            }                                    
        }                        
        if (pwd == null || pwd == "") {
        } else {
            if (pwd.length >= 3) {
            cnt_inputs++;
            }
        }                        
        if (re_pwd == null || re_pwd == "") {
        } else {
            if (re_pwd.localeCompare(pwd) == 0) {
            cnt_inputs++;
            }
        }
        if (condition == null || condition == "") {
        } else {
            if (re_pwd.localeCompare(pwd) == 0) {
            cnt_inputs++;
            }
        }
        if (cnt_inputs == 4) {
            document.sign_up_form.action="activation.php";
        }                        
    }
    </script>
</body>
</html>