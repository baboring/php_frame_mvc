<?php
 //////////////////////////////////////////////////////////////////////////
?>
    <div class="top">
        <div class="head">
        <a href="<?php echo (GlobalData::IsLoggedIn())? Navi::GetUrl(Navi::Dashboard) : URL;?>" ><?=APP_NAME?></a>
        <div class="head_right">
        <?php if(GlobalData::IsLoggedIn() ) { ?>

            <?=GlobalData::GetUserType();?> &nbsp; | &nbsp;
            <a href="<?=Navi::GetUrl(Navi::Member,'Update');?>" ><?=GlobalData::GetUserName();?></a> &nbsp; | &nbsp;
            <a href="<?=Navi::GetUrl(Navi::Login,'logout');?>" >Logout</a>
        <?php }  else { ?>
            &nbsp;<?=date("Y-m-d H:i:s",strtotime('+30 seconds'));?> &nbsp; | &nbsp;
            <a href="<?=Navi::GetUrl(Navi::Login,'logout');?>" >login</a>  &nbsp; | &nbsp;
            <a href="<?=Navi::GetUrl(Navi::Join);?>" >Register</a>
        
        <?php } ?>
        </div>
        </div>
    </div>
    <div class="contents">

<?php   

?>