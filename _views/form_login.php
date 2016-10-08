<?php
    //////////////////////////////////////////////////////////////////////////
    if(empty($inp_userid))
        $inp_userid = '';
    if(empty($inp_password))
        $inp_password = '';
?>
    <form action="<?php echo URL.Navi::MemberLogin; ?>/try_login" method="POST">
    <div class="login">
        <h1>Sign in</h1>
        <fieldset>
            <br><br>
            <label>User ID : </label><input type="text" name="userid" value="<?=$inp_userid?>"><br>
            <label>Password : </label><input type="text" name="password" value="<?=$inp_password?>"><br>
            
            <label></label><button type="submit"> Login</button> <br>

            <a href="<?php echo URL.Navi::MemberJoin; ?>" ><p>Sign up</p></a> 
            <br>
            <?php if(isset($error_msg)) echo $error_msg; ?>
            <br>
        </fieldset>
    </div>
    </form>
<?php /////////////////////////////////////////////////////////

?>