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

            
            <fieldset style="padding:10px 30px;">
                <legend>Vehicles Information</legend>
                <?php 
                    foreach($cDetail['vehicles'] as $key=>$row) {
                        $displayName = 'vid: ['.$row['v_uid'] .'] '.$row['v_company'] .' / '.$row['v_model'];
                        echo '<input type="radio" id="'.$row['v_uid'].'" name="vehicle" value="'.$row['v_company'].'"> ';
                        echo '<label  for="'.$row['v_uid'].'" > '.$displayName.'</label><br>';
                    }
                ?>
            </fieldset>

            
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
                </table></fieldset>


            <div style="width:100%;text-align: center;">
                <button >Print</button><br>
            </div> 
            <br><br>
            <?php if(isset($error_msg)) echo "<h2>".$error_msg.'</h2>';?>
        </div>
    </div>

<!-- local script functions -->
<script>

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