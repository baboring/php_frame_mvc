<?php
    //////////////////////////////////////////////////////////////////////////
    if(empty($inp_userid))
        $inp_userid = '';
    if(empty($inp_password))
        $inp_password = '';
?>
    <div class="login">
        <h1><?php echo APP_NAME?></h1>
        <div class="box">
            <h1>Login</h1>
            <br>
        <form action="<?=Navi::GetUrl(Navi::Login,'try_login');?>" method="POST">
            <span>User ID</span><br>
            <input type="text" class ="textbox" name="userid" value="<?=$inp_userid?>"><br>
            <span>Password</span><br>
            <input type="password" class ="textbox" name="password" value="<?=$inp_password?>"><br>
            <a><button type="submit" class="button primary">Login</button></a><br>
            <br>
            <div class="row">
            <p>
                <a href="javascript:alert('[This function is not completed yet] \n Sent temp password to Mail !!');" >Forgot login?</a>&nbsp; | &nbsp; 
                <a href="<?=Navi::GetUrl(Navi::Join);?>" >Register for an account</a>
            </p>
            </div>
            <br>
        </form>
        </div>
            <br>
            <?php if(isset($error_msg)) echo $error_msg; ?>
            <br>
            </div>
<?php /////////////////////////////////////////////////////////

?>