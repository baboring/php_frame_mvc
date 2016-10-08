<?php
   //////////////////////////////////////////////////////////////////////////
?>
    <div class="frame">
        <?=Member::Fetch_UserTypes(null)[$userData['type']-1][1]?> &nbsp; / &nbsp;
        <?=$userData['user_name']?> &nbsp;
        <a href="<?php echo URL.Navi::MemberLogin; ?>/logout" ><button>Logout</button></a> 
        <table width="900">
            <?php 
            $firstLine = "<tr>";
            foreach(Member::Fetch_MemberList($userData['type']) as $key=>$row) {
                    $szLine = "<tr>";
                foreach($row as $key=>$value) {
                    $szLine .=" <td>".$value."</td>\n";
                    if(null != $firstLine)
                        $firstLine .=" <td>".$key."</td>\n";
                }
                    
                if(!empty($firstLine)) {
                    $firstLine.'<td></td>';
                    echo $firstLine.'</tr>';
                    $firstLine = null;
                }
                $szLine.='<td><button class="delButton" name="'.$row['idx'].'">delete</button></td>';
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
/*toggle between hiding and showing the dropdown content */
function clickDelete( idx ) {
    document.location = "?delete="+idx;

    post('?', {delete: idx});
}

window.onload = function() {

    var buttons = [];
    var buttons = document.getElementsByClassName("delButton");
    for(var i=0; i<buttons.length; i++) {
        var button = buttons[i];
        button.addEventListener('click',function() {
            clickDelete(button.name);
        });
    }
};
</script>
<?php /////////////////////////////////////////////////////////

?>