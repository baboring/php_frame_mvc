<?php
   //////////////////////////////////////////////////////////////////////////
    $group = null;
    if(isset($_GET['group']))
        $group = $_GET['group'];
    $search = null;
    if(isset($_GET['search']))
        $search = $_GET['search'];

?>
    <div class="frame">
        <input type="text" name="search_key" value="<?=(isset($search))? $search : '';?>" length="25"></input>
        <button name="btnSearch" >Search</button>

        <?=DataMember::Fetch_UserTypes(null)[$userData['type']-1][1]?> &nbsp; / &nbsp;
        <?=$userData['user_name']?> &nbsp;
        <a href="<?=Navi::GetUrl(Navi::Login,'logout');?>" ><button>Logout</button></a> <br>

        <table width="900">
            <?php 
            $firstLine = "<thead>";
            foreach(DataMember::Fetch_MemberList($userData['type'],$group,$search) as $key=>$row) {
                $szLine = "<tr>";
                foreach($row as $key=>$value) {
                    $szLine .=" <td>".$value."</td>\n";
                    if(null != $firstLine)
                        $firstLine .=" <th>".$key."</th>\n";
                }
                    
                if(null != $firstLine) {
                    $firstLine.='<th>button</th>';
                    echo $firstLine.'</thead>';
                    $firstLine = null;
                }
                $szLine.='<td><button class="btnDelete" id="'.$row['idx'].'" name="'.$row['user_name'].'">delete</button></td>';
                echo $szLine.='</tr>';
            }; ?>
        </table>
    </div>

<style>
table{
  margin:10px auto;
  border: 0px solid black;
  border-spacing: 0px;
   text-align: left;
}

table thead tr{
  font-family: Arial, monospace;
  font-size: 14px;
}

table thead tr th{
  border-bottom: 2px solid black;
  border-top: 1px solid black;
  margin: 0px;
  padding: 2px;
  background-color: #cccccc;
}

table tr {
  font-family: arial, monospace;
  color: black;
  font-size:14px;
  background-color: white;
}

table tr.odd {
  background-color: #AAAAAA;
}

table tr td, th{
  border-bottom: 1px solid black;
  padding: 3px;
} 
.frame {
	display: block;
	width: 950px;
    height: 600px;
	margin: 20px auto;
    padding: 20px; 
	border: 1px solid darkblue;
	text-align: right;
}
.frame button{
	padding: 0 3px;
}
</style>

<!-- local script functions -->
<script>
window.onload = function() {

    function clickDelete( idx, user_name ) {
        //document.location = "<?=Navi::GetUrl(Navi::Join,'delete');?>/"+val;
        if(confirm("[Delete] Are you sure '" + user_name + "' ?")) {
            var params = {};
            params['idx'] = val;
            params['name'] = user_name;
            post("<?=Navi::GetUrl(Navi::Member,'delete');?>",params,"post");
        }
    }


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
    
    var buttons = document.getElementsByClassName("btnDelete");
    for(var i=0; i<buttons.length; i++) {
        (function(n) {
            buttons[n].addEventListener('click',function(event) {
                clickDelete(buttons[n].id, buttons[n].name);
            });
        })(i);
    }
};
</script>
<?php /////////////////////////////////////////////////////////

?>