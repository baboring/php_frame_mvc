<?php
    require_once ('_server/models/DataResult_BusinessList.php');

?>
        <div style="height:300px;">
        <table width="99%">
            <?php
            // fill table records
            $res = new DataResult_BusinessList();
            $firstLine = "<thead>";
            foreach($res->data as $key=>$row) {
                $szLine = "<tr>";
                foreach($row as $key=>$value) {
                    $szLine .=" <td>".$value."</td>\n";
                    if(null != $firstLine)
                        $firstLine .=" <th>".$key."</th>\n";
                }
                    
                if(null != $firstLine) {
                    $firstLine.='<th width="100" align="center">Etc</th>'."\n";
                    echo $firstLine .='</thead>';
                    $firstLine = null;
                }
                $szLine.='<td>';
                $szLine.='<button class="btnSelect" id="'.$row['u_uid'].'" name="'.$row['Business Name'].'">Select</button>';
                // only allowed to admin
                if(GlobalData::IsAuthority(99))
                    $szLine.='&nbsp;<button class="btnDelete" id="'.$row['u_uid'].'" name="'.$row['Business Name'].'">delete</button>';
                $szLine.='</td>';
                echo $szLine.='</tr>';
            }; ?>
        </table> </div>
        <div style="text-align:center;">
            <?php //print
                echo $res->pageNumbers();
                //echo $res->itemsPerPage(); ?>
        </div>
    </div>

<!-- local script functions -->
<script>
function DeleteBusiness(res, uid, user_name) {
    //alert(res+'/'+uid);
    var obj = document.location.reload();
}

window.onload = function() {

    function clickDelete( uid, user_name ) {
        if(confirm("[Delete] Are you sure '" + user_name + "' ?")) {
            // var params = {};
            // params['uid'] = uid;
            // params['name'] = user_name;
            // post("<?=Navi::GetUrl(Navi::Member,'delete');?>",params,"post");
            call_API('?func=DeleteBusiness&uid=' + uid + '&name=' + user_name);
        }
    }
    function clickSelect( uid, user_name ) {
        call_API('?func=SetBusinessInfo&uid=' + uid + '&name=' + user_name);
    }
    
    var buttons = document.getElementsByClassName("btnDelete");
    for(var i=0; i<buttons.length; i++) {
        (function(n) {
            buttons[n].addEventListener('click',function(event) {
                clickDelete(buttons[n].id, buttons[n].name);
            });
        })(i);
    }
    var buttons = document.getElementsByClassName("btnSelect");
    for(var i=0; i<buttons.length; i++) {
        (function(n) {
            buttons[n].addEventListener('click',function(event) {
                clickSelect(buttons[n].id, buttons[n].name);
            });
        })(i);
    }
};
</script>
<?php /////////////////////////////////////////////////////////

?>