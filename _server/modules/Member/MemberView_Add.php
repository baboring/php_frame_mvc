<?php
    //////////////////////////////////////////////////////////////////////////
    require_once ('_server/modules/service/ServicesDoc.php');
    require_once ('_server/models/DataResult_UserTypes.php');
    
    $inp_password = randomPassword(8);
    $inp_guid = GUIDv4();
?>
        <div class="data_account">
        <form name="frmMember" action="<?=Navi::GetUrl(Navi::Member,'add_account');?>" onsubmit="return validateForm()" method="post">
            <input type="hidden" name="confirm" value="">
            <h1>Register New User</h1>

            <fieldset class="left_float">
                <legend>Member information</legend>
                <label>Type : </label>
                <input type="hidden" name="uuid" value="<?=$inp_guid?>">
                <select id="memberType" name="type">
                <?php 
                    foreach((new DataResult_UserTypes(PDO::FETCH_ASSOC,GlobalData::GetAuthority()))->data as $key=>$value) {
                        echo '<option value="'.$value['code'].'">'.$value['type'].'</option>';
                    }; ?>
                </select><br>
                <label>Name : </label><input type="text" name="first_name" value="<?=$dataForm['first_name']?>" placeholder="First Name">
                                      <input type="text" name="last_name" value="<?=$dataForm['last_name']?>" placeholder="Last Name"><br>
                <label>Email : </label><input type="text" name="email" value="<?=$dataForm['email']?>"><br>
                <label>Password : </label><input type="password" id="password" name="password" value="<?=$inp_password?>" maxlenth="18"><br>
                <div class="hide" name="forBusiness">
                    <label>Business Name : </label><input type="text" name="businessName" value="<?=$dataForm['businessName']?>"><br></div>
                <label>Tel Number : </label><input type="text" name="tel" value="<?=$dataForm['tel']?>"><br>
                <label>Address : </label><input type="text" name="address" value="<?=$dataForm['address']?>"><br>
            </fieldset>

            <div class="hide" name="forBusiness">
            <fieldset style="padding:10px 30px;">
                <legend>Service Types</legend>
                <?php 
                    foreach(ServicesDoc::GetDataResult_ServiceTypes()->data as $key=>$value) {
                        echo '<div style="width:150px; padding:0 10px; float:left;">';
                        echo '<input type="checkbox" id="'.$value['s_code'].'" name="services[]" value="'.$value['s_code'].'">';
                        echo '<label  for="'.$value['s_code'].'">'.$value['s_name'].'</label></div>';
                    }; ?>
            </fieldset></div>

            <div class="hide" name="forBusiness">
            <fieldset class="left_float">
                <legend>Description Service</legend>
                <textarea type="text" length="100" name="desc_service" style="width:100%" rows="4" cols="50"></textarea><br>
            </fieldset></div>

            <div class="hide" name="forClient">
            <fieldset class="left_float">
                <legend>Vehicles Information</legend>
                <input type="hidden" name="vehicle[0]" value="1">
                <label>Company : </label><input type="text" name="prod_company" placeholder="Chysler"><br>
                <label>Model Info : </label><input type="text" name="model_info" placeholder="town & contry"><br>
                <label>Plate Number : </label><input type="text" name="plate_number"><br>
            </fieldset></div>

            <div style="width:100%;text-align: center;">
                <input type="submit" class="button" value="register"></input><br>
            </div> 
            <br><br>
            <?php if(isset($error_msg)) echo "<h2>".$error_msg.'</h2>';?>
        </form>
        </div>
    </div>

<!-- local script functions -->
<script>

function validateForm() {
    var x = document.forms["frmMember"]["first_name"].value;
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
    document.forms["frmMember"]["confirm"].value = "1";
}

window.onload = function() {

    OnSelected('1');

    var myselect = document.getElementById("memberType");
    myselect.addEventListener('change', function () {
        OnSelected(myselect.value);
    });

    document.getElementById("back").addEventListener('click', function () {
        document.location.href = "<?=Navi::GetUrl(Navi::Login);?>";
    });
};

// toggle between hiding and showing the dropdown content
function OnSelected(sel) {
    // using dictionary
    var lstTypes = {
        1:"forClient",
        2:"forBusiness"
    };

    for(var val in lstTypes) {
            var divs = document.getElementsByName(lstTypes[val]);
        for(var i=0;i<divs.length;++i) {
            divs[i].style.display = (sel == val)? "block" : "none";
        }
    }

    // using array 
    // var lstTypes = [
    //     "forClient",
    //     "forBusiness"
    // ];
    // lstTypes.forEach(function(curr,idx,arr) {
    //     var divs = document.getElementsByName(curr);
    //     for(var i=0;i<divs.length;++i) {
    //         divs[i].style.display = (sel == curr)? "block" : "none";
    //         alert(sel +'/'+idx);
    //     }
    // });
}
</script>

<?php /////////////////////////////////////////////////////////

?>