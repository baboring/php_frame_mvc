<?php
    //////////////////////////////////////////////////////////////////////////
?>
    <form action="<?=Navi::GetUrl(Navi::Join,'try_join');?>" method="post">
    <div class="signup">
        <h1>Sign up</h1>
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
            <label>Password : </label><input type="text" name="password"><br>
            <label>Pwd Confirm : </label><input type="text" name="password"><br>
            <label>Tel Number : </label><input type="text" name="tel"><br>
            <label>Email : </label><input type="text" name="email"><br>

            <h3>Security information</h3>
            <label>Question : </label><input type="text" name="security_q"><br>
            <label>Answer : </label><input type="text" name="security_a"><br>
        </fieldset>

        <div style="text-align:center;">
            <button type="submit"> register</button> <br>
            <input id="back" type="button" value="return to login"></input>
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

window.onload = function() {

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