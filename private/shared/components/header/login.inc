<div id="logIn-container" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeLogIn()">&times;</a>
    <div class="overlay-content">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="<?php echo urlFor('images/form/pottery.jpg') ?>" alt="sing up image"></figure>
                    
                    <a onclick="closeLogIn(); openRegister()" class="signup-image-link" href="javascript:void(0)">Become Member</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Log In</h2>
                    <form method="POST" class="register-form" id="login-form" action="<?php echo urlFor('/html/signIn/login.php'); ?>">
                        <div class="form-group">
                            <label for="your_username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="your_username" id="your_username" placeholder="Username"/ required>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="your_pass" id="your_pass" placeholder="Password"/ required>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>