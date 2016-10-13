<?php
    //////////////////////////////////////////////////////////////////////////
    if(empty($inp_password))
        $inp_password = '';
?>
    <form action="<?=Navi::GetUrl(Navi::Member,'update');?>" method="POST">
    <div class="signup">
        <h1>Update Member Information</h1>
        <fieldset>
            <br><br>
             <h3>member information</h3>
            <label>User ID : </label><input type="hidden" name="user_id" value="<?=$userData['user_id']?>"><?=$userData['user_id']?><br>
            <!--label>Password(curr)</label><input type="text" id="password_cur" name="password_cur"><br-->
            <label>Password : </label><input type="password" id="password" name="password"> &nbsp;
            <label>Pwd Confirm : </label><input type="password" id="password_cfm" name="password_cfm"><br>
            <label>Full Name : </label><input type="text" name="user_name" value="<?=$userData['user_name']?>" readonly><br>
            <label>Tel Number : </label><input type="text" name="tel" value="<?=$userData['tel']?>"><br>
            <label>Email : </label><input type="text" name="email" value="<?=$userData['email']?>"><br>

            <h3>Security information</h3>
            <label>Question : </label><input type="text" name="security_q" value="<?=$userData['security_q']?>"><br>
            <label>Answer : </label><input type="text" name="security_a" value="<?=$userData['security_a']?>"><br>
            
            <label></label><button type="submit"> Update</button> <br>
            <br>
            <?php if(isset($error_msg)) echo $error_msg; ?>
            <br>
        </fieldset>
    </div>
    </form>
<?php /////////////////////////////////////////////////////////

?>