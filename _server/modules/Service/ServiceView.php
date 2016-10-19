<?php
    //////////////////////////////////////////////////////////////////////////

?>
        <div class="data_account">
        <fieldset class="left_float">
            <legend>Client information</legend>
            <label>Name : </label><p><?=$cDetail['first_name'].'&nbsp'.$cDetail['last_name'];?></p>
            <label>Email : </label><p><?=$cDetail['email']?></p>
            <label>Tel Number : </label><p><?=$cDetail['tel']?></p>
            <label>Address : </label><p><?=$cDetail['address']?></p>
        </fieldset>

        <?php if(false) { ?>
        <fieldset style="padding:10px 30px;">
            <legend>Service Records</legend>
            <table width="99%">
                <?php 
                $firstLine = "<thead>";
                foreach($cDetail['records'] as $key=>$row) {
                    $szLine = "<tr>";
                    foreach($row as $key=>$value) {
                        if($key != 'u_uid') {
                            $szLine .=" <td>".$value."</td>\n";
                            if(null != $firstLine)
                                $firstLine .=" <th>".$key."</th>\n";
                        }
                    }
                    // end of column                    
                    if(null != $firstLine) {
                        echo $firstLine.'</thead>';
                        $firstLine = null;
                    }
                    echo $szLine.='</tr>';
                }; ?>
            </table>
        </fieldset>
        <?php }?>
        
        <form name="frmRecord" action="<?=Navi::GetUrl(Navi::Service,'add');?>" onsubmit="return validateForm()" method="post">
            <input type="hidden" name="confirm" value="">
            <input type="hidden" name="u_uid" value="<?=GlobalData::GetClientInfo()['uid']?>">
            <input type="hidden" name="s_uid" value="<?=GlobalData::GetUuid()?>">

            <fieldset style="padding:10px 30px;">
                <legend>Vehicles Information</legend>
                <?php 
                    foreach($cDetail['vehicles'] as $key=>$row) {
                        $displayName = 'vid: ['.$row['v_uid'] .'] '.$row['v_company'] .' / '.$row['v_model'];
                        echo '<input type="radio" id="'.$row['v_uid'].'" name="v_uid" value="'.$row['v_uid'].'"> ';
                        echo '<label  for="'.$row['v_uid'].'" > '.$displayName.'</label><br>';
                    }
                ?>
            </fieldset>

            <fieldset style="padding:10px 30px;">
                <legend>Service Items</legend>
                <?php 
                    require_once ('_server/models/DataResult_AvailableServices.php');
                    $cServiceItems = (new DataResult_AvailableServices(GlobalData::GetUuid()))->data;
                    if(null != $cServiceItems){
                        foreach($cServiceItems as $key=>$value) {
                            echo '<div style="width:150px; padding:0 10px; float:left;">';
                            echo '<input type="checkbox" id="'.$value['s_code'].'" name="services[]" value="'.$value['s_uid'].'">';
                            echo '<label  for="'.$value['s_code'].'">'.$value['s_name'].'</label></div>';
                        };
                    }
                ?>
                <div class="clear"></div></br>
                <textarea type="text" length="100" name="r_desc" style="width:100%" rows="4" cols="50"></textarea><br>
                
            </fieldset>

            <div style="width:100%;text-align: center;">
                <input type="submit" class="button" value="Submit"></input><br>
            </div> 
            <br><br>
            <?php if(isset($error_msg)) echo "<h2>".$error_msg.'</h2>';?>
        </form>
        </div>
    </div>

<!-- local script functions -->
<script>

function validateForm() {
    var x = document.forms["frmRecord"]["first_name"].value;
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
    document.forms["frmRecord"]["confirm"].value = "1";
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