<?php
   //////////////////////////////////////////////////////////////////////////
?>
    <div class="left_navi">
    <br>
    <?php if(GlobalData::IsAuthority(1)) { ?>
    <a href="<?php echo Navi::GetUrl(Navi::Member,'add_account')?>">
        <img src="<?=URL.'public/images/ico_add.png'?>" style="width:50px;height:50px"/><br>Add Account</a>
        <br><br>
    <?php } ?>
    <a href="<?php echo Navi::GetUrl(Navi::Search)?>">
        <img src="<?=URL.'public/images/ico_search.png'?>" style="width:50px;height:50px"/><br>Search</a>
        <br><br>
    <a href="<?php echo Navi::GetUrl(Navi::Report)?>">
        <img src="<?=URL.'public/images/ico_report.png'?>" style="width:50px;height:50px"/><br>Report</a>
        <br><br>
    <a href="<?php echo Navi::GetUrl(Navi::Export)?>">
        <img src="<?=URL.'public/images/ico_export.png'?>" style="width:50px;height:50px"/><br>Export</a>
        <br><br>
    <?php if(GlobalData::GetUserType() == UserType::Business) { ?>
    <a href="<?php echo Navi::GetUrl(Navi::Service)?>">
        <img src="<?=URL.'public/images/ico_service.png'?>" style="width:50px;height:50px"/><br>Add Service</a>
        <br><br>
    <?php } ?>
    </div>

<?php /////////////////////////////////////////////////////////

?>