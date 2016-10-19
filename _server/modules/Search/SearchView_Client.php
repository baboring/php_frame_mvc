<?php
    require_once ('_server/modules/member/MemberDoc.php');
    $search_key = GetSafeValueGet('search_key','');
    $search_val = GetSafeValueGet('search_val','');
?>
        <div style="height:300px;">
        <table width="99%">
            <?php 
            $res = MemberDoc::ReqData_ClientList($search_key,$search_val);
            $firstLine = "<thead>";
            foreach($res->data as $key=>$row) {
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
                    $firstLine.='<th width="100" align="center">Etc</th>'."\n";
                    echo $firstLine .='</thead>';
                    $firstLine = null;
                }
                $szLine.='<td>';
                $szLine.='<button class="btnSelect" id="'.$row['u_uid'].'" name="'.$row['first_name'].'">Select</button>';
                // only allowed to admin
                if(GlobalData::IsAuthority(99))
                    $szLine.='&nbsp;<button class="btnDelete" id="'.$row['u_uid'].'" name="'.$row['first_name'].'">delete</button>';
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

window.onload = function() {

    var btnSearch = document.getElementsByName("btnSearch");
    btnSearch[0].addEventListener('click',function(event) {

        var group = "phone";
        var keyword = document.getElementsByName("search_key")[0].value;
        var params = {};
        params['search'] = keyword;
        params['group'] = group;
        post("<?=Navi::GetUrl(Navi::Member);?>",params,"get");
        
    });
    //btnSearch.addEventListener('click',function (event) {});
    
    function clickDelete( idx, user_name ) {
        //document.location = "<?=Navi::GetUrl(Navi::Join,'delete');?>/"+val;
        if(confirm("[Delete] Are you sure '" + user_name + "' ?")) {
            var params = {};
            params['idx'] = val;
            params['name'] = user_name;
            post("<?=Navi::GetUrl(Navi::Member,'delete');?>",params,"post");
        }
    }
    function clickSelect( uid, user_name ) {
        call_API('?func=SetClientInfo&uid=' + uid + '&name=' + user_name);
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