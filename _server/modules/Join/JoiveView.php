<?php
    //////////////////////////////////////////////////////////////////////////
    require_once ('_server/models/DataResult_UserTypes.php');
    $inp_password = randomPassword(8);
    $inp_guid = GUIDv4();
    
?>
    <div class="signup">
    <form action="<?=Navi::GetUrl(Navi::Join,'try_join');?>" method="post">
        <input type="hidden" name="uuid" value="<?=$inp_guid?>">
        <h1><?php echo APP_NAME?></h1>
        <div class="box left_float">
            <h1>Register</h1>

            <fieldset>
                <legend>Type Information</legend>
                <label>Type : </label>
                <select id="memberType" name="type">
                <?php 
                    foreach((new DataResult_UserTypes(PDO::FETCH_ASSOC))->data as $key=>$value) {
                        echo '<option value="'.$value['code'].'">'.$value['type'].'</option>';
                    }; ?>
                </select><br>
                <div id="opt_1" class="hide">         
                    <label>Token# : </label><input type="text" class= name="token"><br>
                </div>
                <div id="opt_2" class="hide">         
                    <label>License# : </label><input type="text" name="license"><br>
                </div>
                <div id="opt_3" class="hide">         
                    <label>Ohip# : </label><input type="text" name="ohip"><br>
                </div>
            </fieldset>

            <fieldset>
                <legend>Member Information</legend>
                <label>User ID : </label><input type="text" name="user_id"><br>
                <label>Password : </label><input type="password" id="password" name="password" value="<?=$inp_password?>"> <br>
                <label>Pwd Confirm : </label><input type="password" id="password_cfm" name="password_cfm" value="<?=$inp_password?>"> 
                <label>Full Name : </label><input type="text" name="user_name"><br>
                <label>Tel Number : </label><input type="text" name="tel"><br>
                <label>Email : </label><input type="text" name="email"><br>
                <label>Address : </label><input type="text" name="address"><br>
            </fieldset>

        </div>

        <div style="text-align:center;">
            <button type="submit"> register</button> <br>
        </div> 
        <br><br>
        <?php if(isset($error_msg)) echo "<h2>".$error_msg.'</h2>';?>
    </form>
    </div>

<!-- local script functions -->
<script>
/*toggle between hiding and showing the dropdown content */
function selectOne(curr) {
    for(i=1;i<=3;++i) {
        if( i == curr)
            show('opt_'+i);
        else
            hide('opt_'+i);
    }
}

window.onload = function() {

    // var myselect = document.getElementById("memberType");
    // myselect.addEventListener('change', function () {
    //     selectOne(myselect.value);
    // });
    
    // show("opt_1");

    document.getElementById("back").addEventListener('click', function () {
        document.location.href = "<?=Navi::GetUrl(Navi::Login);?>";
    });

};
</script>

<?php /////////////////////////////////////////////////////////

?>