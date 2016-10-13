<?php
 //////////////////////////////////////////////////////////////////////////
?>
    <div class="top">
    <?php if(GlobalData::IsLoggedIn() ) { ?>

        <?=GlobalData::GetUserName();?> &nbsp;
        <a href="<?=Navi::GetUrl(Navi::Login,'logout');?>" ><button>Logout</button></a>
    <?php } ?>
        &nbsp;<?=randomPassword(6);?>/
        &nbsp;<?=date("Y-m-d H:i:s",strtotime('+30 seconds'));?>/
        &nbsp;<?=GlobalData::GetDebug();?>/
    </div>

<?php   

?>