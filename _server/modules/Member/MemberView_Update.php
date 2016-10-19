<?php
    //////////////////////////////////////////////////////////////////////////
    require_once ("_server/modules/member/MemberDoc.php");
    $userData = MemberDoc::ReqData_MemberInfo(GlobalData::GetUuid())->data;
    //var_dump($userData);
?>
        <div class="data_account">
        <form name="frmMember" action="<?=Navi::GetUrl(Navi::Member,'Update');?>" onsubmit="return validateForm()" method="post">
            <input type="hidden" name="confirm" value="">
            <input type="hidden" name="uuid" value="<?=$userData['uid']?>">
            <input type="hidden" name="type" value="<?=$userData['type']?>">
            <h1>Update Member Information</h1>
            <fieldset class="left_float">
                <legend>Account Information</legend>
                <label>User ID : </label><input type="hidden" name="user_id" value="<?=$userData['user_id']?>"><?=$userData['user_id']?><br>
                <label>Password(curr)</label><input type="text" id="password_cur" name="password_cur"><br>
                <label>Password(new) : </label><input type="password" id="password" name="password"> <br>
                <label>Password(confirm) : </label><input type="password" id="password_cfm" name="password_cfm"><br>
                <label>Reg Date : </label><span><?=$userData['reg_date']?></span><br>
                <label>Expire Date : </label><span><?=$userData['expire_date']?></span><br>
            </fieldset>

            <?php 
                // client or business
                if($userData['type'] == 1 || $userData['type'] == 2 )  { 
                ?>
                    <fieldset class="left_float">
                        <legend>Member Information</legend>
                        <label>Name : </label><input type="text" name="first_name" value="<?=$userData['member']['first_name']?>" placeholder="First Name">
                                <input type="text" name="last_name" value="<?=$userData['member']['last_name']?>" placeholder="Last Name"><br>
                        <label>Email : </label><input type="text" name="email" value="<?=$userData['member']['email']?>" placeholder="Email"></br>
                        <label>Tel Number : </label><input type="text" name="tel" value="<?=$userData['member']['tel']?>"><br>
                        <label>Address : </label><input type="text" name="address" value="<?=$userData['member']['address']?>"><br>
                    </fieldset>
                <?php
                }

                // client only
                if($userData['type'] == 1) {  
                ?>
                    <fieldset class="left_float">
                        <legend>Vehicles Information</legend>
                        <input type="hidden" name="vehicle[0]" value="1">
                        <label>Company : </label><input type="text" name="prod_company" placeholder="Chysler" value=""><br>
                        <label>Model Info : </label><input type="text" name="model_info" placeholder="town & contry"><br>
                        <label>Plate Number : </label><input type="text" name="plate_number"><br>
                    </fieldset>
                <?php
                }
                // business only
                else if($userData['type'] == 2) {
                    require_once ("_server/modules/service/ServicesDoc.php");
                ?>
                    <fieldset style="padding:10px 30px;">
                        <legend>Service Types</legend>
                        <?php 
                            foreach(ServicesDoc::GetDataResult_ServiceTypes()->data as $key=>$value) {
                                echo '<div style="width:150px; padding:0 10px; float:left;">';
                                echo '<input type="checkbox" id="'.$value['s_code'].'" name="services[]" value="'.$value['s_code'].'">';
                                echo '<label  for="'.$value['s_code'].'">'.$value['s_name'].'</label></div>';
                            }; ?>
                    </fieldset></div>
                <?php
                }
                else if($userData['type'] == 3) { // admin 
                ?>

                <?php
                }
            ?>
            </div>
            <div class="center_row">
                <button type="submit"> Update</button> <br><br>
            </div>
        </form>
    </div>

<!-- local script functions -->
<script>

function validateForm() {
    var x = document.forms["frmMember"]["password"].value;
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
    document.forms["frmMember"]["confirm"].value = "1";
}
</script>

<?php /////////////////////////////////////////////////////////

?>