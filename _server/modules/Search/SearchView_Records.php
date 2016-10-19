<?php
    require_once ('_server/modules/service/ServicesDoc.php');

?>
        <div style="height:300px;">
        <table width="99%">
            <?php 
            $res = ServicesDoc::GetDataResult_RecordList();
            $firstLine = "<thead>";
            foreach($res->data as $key=>$row) {
                $szLine = "<tr>";
                foreach($row as $head=>$value) {
                    if($head != 'u_uid') {
                        $szLine .=" <td>".$value."</td>\n";
                        if(null != $firstLine)
                            $firstLine .=" <th>".$head."</th>\n";
                    }
                }
                // end of column                    
                if(null != $firstLine) {
                    $firstLine.='<th width="60"  align="center">Etc</th>'."\n";
                    echo $firstLine .='</thead>';
                    $firstLine = null;
                }
                $szLine.='<td>';
                // only allowed to admin
                if(GlobalData::IsAuthority(99))
                    $szLine.='<button class="btnDelete" id="'.$row['r_uid'].'" name="'.$row['r_uid'].'">delete</button>';
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
        alert('Not Allowed');
    }
    function clickSelect( uid, user_name ) {
        //call_API('?func=SetClientInfo&uid=' + uid + '&name=' + user_name);
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