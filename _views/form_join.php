<?php
    //////////////////////////////////////////////////////////////////////////
?>
    <form action="<?=Navi::GetUrl(Navi::Join,'try_join');?>" method="post">
    <div class="signup">
        <h1>Sign up</h1>
        <div style="text-align:right;">
            <input style="padding:2px;margin-right:20px;" id="back" type="button" value="return to login"></input></div> 
        <fieldset>
            <h3>type information</h3>
            <label>Type : </label>
            <select id="memberType" name="type">
            <?php 
                foreach(DataMember::Fetch_UserTypes(PDO::FETCH_ASSOC) as $key=>$value) {
                    echo '<option value="'.$value['code'].'">'.$value['type'].'</option>';
                }; ?>
            </select><br>
            <div id="opt_1" class="hide">         
                <label>Token# : </label><input type="text" name="token"><br>
            </div>
            <div id="opt_2" class="hide">         
                <label>License# : </label><input type="text" name="license"><br>
            </div>
            <div id="opt_3" class="hide">         
                <label>Ohip# : </label><input type="text" name="ohip"><br>
            </div>

            <h3>member information</h3>
            <label>Full Name : </label><input type="text" name="user_name"><br>
            <label>User ID : </label><input type="text" name="user_id"><br>
            <label>Password : </label><input type="text" id="password" name="password"> &nbsp;
                                      <input type="button" id="random_pwd" value="Random"><br>
            <label>Pwd Confirm : </label><input type="text" id="password_cfm" name="password_cfm"><br>
            <label>Tel Number : </label><input type="text" name="tel"><br>
            <label>Email : </label><input type="text" name="email"><br>

            <h3>Security information</h3>
            <label>Question : </label><input type="text" name="security_q"><br>
            <label>Answer : </label><input type="text" name="security_a"><br>
        </fieldset>

        <div style="text-align:center;">
            <button type="submit"> register</button> <br>
        </div> 
        <br><br>
        <?php if(isset($error_msg)) echo "<h2>".$error_msg.'</h2>';?>
    </div>
    </form>

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

function generateRandPwd(digits) {

    var symbols = "~!@#$%^&*()-_=+[]{};:,.<>?";     // etc

    var pwd = "";
    for(i=0;i<digits;++i) {
        switch(getRandomInt(0,3)){
            case 0:
                pwd += String.fromCharCode(getRandomInt(48,57));    // number
                break;
            case 1:
                pwd += String.fromCharCode(getRandomInt(65,90));    // upper letter 
                break;
            case 2:
                pwd += String.fromCharCode(getRandomInt(97,122));   // lower letter
                break;
            case 3:
                pwd += symbols[getRandomInt(0,symbols.length-1)];
                break;
        }
    }
    return pwd;
}

window.onload = function() {

    document.getElementById("random_pwd")
    .addEventListener('click', function () {
        
        var ranPwd = generateRandPwd(8);
        document.getElementById("password").value = ranPwd  
        document.getElementById("password_cfm").value = ranPwd; 
    });
    

    var myselect = document.getElementById("memberType");
    myselect.addEventListener('change', function () {
        selectOne(myselect.value);
    });
    
    show("opt_1");

    document.getElementById("back").addEventListener('click', function () {
        document.location.href = "<?=Navi::GetUrl(Navi::Login);?>";
    });

};
</script>

<?php /////////////////////////////////////////////////////////

?>