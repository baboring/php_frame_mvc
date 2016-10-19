<?php
 //////////////////////////////////////////////////////////////////////////
 if(empty($display_contents))
    $display_contents = "";
 if(empty($display_title))
    $display_title = "";
 if(empty($button))
    $button = "Button";
?>
<style> 
.layout {
    width:100%; 
	text-align: center;
    border:0px solid black;
}
.box2 {
	display: block;
	width: 90%;
    height: 200px;
	border: 0px solid darkblue;
	text-align: center;
    padding-top: 50px;

    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
}
.box2 p {
    font-size:1.5em;
	text-align: left;
    padding: 10px 10px;
    line-height : 100%;
}
</style>
        <div style="padding:30px;">
            <div class="box">
            <h1 class="center_row"><?=$display_title?></h1>
            <div class="box2">
                <br>
                <p><?=$display_contents?></p>
                <br><br>
                <br>
                <input type="button" class="button" onclick="<?=$onClick?>" value="<?=$button?>"></input> 
                <br>
            </div>
            </div>
        </div>
    </div>
    
<?php   

?>