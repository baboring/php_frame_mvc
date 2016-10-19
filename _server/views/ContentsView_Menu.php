<?php
   //////////////////////////////////////////////////////////////////////////
    $key = GetSafeValueGet('key');
    if($key == null) {
        switch(GlobalData::GetUserType()) {
            case UserType::Admin:
                break;
            case UserType::Client: $key = 'records';
                break;
            case UserType::Business:  $key = 'client';
                break;
        } 
    }
    $search_key = GetSafeValueGet('search_key','');
    $search_val = GetSafeValueGet('search_val','');

    function SetActiveIf($content) {
        if($content == Application::$action)
            echo 'class="active"';
    }

    require_once ('_server/views/ContentsView_API.php');
?>
<!-- local script functions -->
<script type='text/javascript'>

function ClickMenu(num) {
    document.location.href = "<?=Navi::GetUrl(Navi::Search);?>/" + num;
}

function SetClientInfo(uid, user_name) {
    var obj = document.getElementById("UserInfo");
    if(null != obj)
        obj.innerHTML = user_name + '(' + uid + ')';
}

function SetBusinessInfo(uid, user_name) {
    var obj = document.getElementById("UserInfo");
    if(null != obj)
        obj.innerHTML = user_name + '(' + uid + ')';
}

</script>

<!-- local script functions -->
    <div class="frame">

        <!-- Category -->
        <div style="float:left; width:50%">
            <h1 class="center_row"><?=Application::$section?></h1></div>

        <div style="float:right; width:50%; background-color: #cfcfcf;">
            <?php 
                // sub cate
                $type = Application::$action.' information';
                switch(Application::$action) {
                    case 'Business':
                        $info = GlobalData::GetBusinessInfo();  
                        break;
                    case 'Client':
                        $info = GlobalData::GetClientInfo();  
                        break;
                    default:
                        $info = null;
                        break;
                }
                ?>
            <label >&nbsp;[<?=$type;?>]</label><br>
            <label id="UserInfo" style="font-weight:bold; font-size:1.2em;padding:0 2px;"><?php
                if(null != $info)
                    echo $info['name'].'('.$info['uid'].')'; 
                else
                    echo '&nbsp;';
                ?>
            </label></div>

        <div class="clear">
            <ul class='horizontal'>
            <?php
                $isSearchable = false;
                if(Application::$section == Navi::Search) { 
                    $isSearchable = true; ?>
                    <?php if(GlobalData::GetUserType() == UserType::Admin || GlobalData::GetUserType() == UserType::Business) { ?>
                        <li>
                            <a <?php SetActiveIf('Client');?> href="javascript:ClickMenu('Client');" >Client</a></li>
                    <?php } ?>
                    <?php if(GlobalData::GetUserType() == UserType::Admin) { ?>
                        <li>
                            <a <?php SetActiveIf('Business');?> href="javascript:ClickMenu('Business');">Business</a></li>
                    <?php } ?>
                        <li>
                            <a <?php SetActiveIf('Records');?> href="javascript:ClickMenu('Records');">Records</a></li>
                    <?php if(false) { ?>
                        <li>
                            <a <?php SetActiveIf('Services');?> href="javascript:ClickMenu('Services');">Services</a></li>
                    <?php } ?>
            <?php
            }
            else if(Application::$section == Navi::Member) {
                    $isSearchable = false; ?>
                <li>
                    <a href="#">Help</a></li>
            <?php
            }
            else if(Application::$section == Navi::Service) {
                    $isSearchable = false; ?>
                <li>
                    <a href="#">Help</a></li>
            <?php
            }
            else if(Application::$section == Navi::Report) {
                    $isSearchable = false; ?>
                <li>
                    <a href="#">Help</a></li>
            <?php
            }
            else if(Application::$section == Navi::Dashboard) {
                    $isSearchable = false; ?>
                <li>
                    <a href="#">Help</a></li>
            <?php
            }
            else if(Application::$section == Navi::Export) {
                    $isSearchable = false; ?>
                <li>
                    <a href="#">Help</a></li>
            <?php
            }?>
            <!-- Search Form -->
            <div style="text-align:right;padding:4px;"> 
            <?php if($isSearchable) { ?>
                <form action="#">
                <span style="color:yellow;">Search Key</span>
                <select name="search_key">
                    <option value="name" <?php if($search_key=='name') echo 'selected'?> />Name</option>
                    <option value="email" <?php if($search_key=='email') echo 'selected'?> >Email</option>
                </select>
                <input type="text" class="" name="search_val" value="<?=$search_val;?>" length="25"></input>
                <input type="submit" class="" value="Search">
                </form>
            <?php } ?>
            </div>

            <div id="s_key" class="hide">
                <input  type="text" name="search_key" value="<?=(isset($search))? $search : '';?>" maxlength="25"></input></div>
            <div id="s_date"  class="hide">
                <input  type="text" name="date_from" value="<?=(isset($search))? $search : '';?>" maxlength="10"  style="width: 80px;" placeholder="2016-10-11"></input>
                <input  type="text" name="date_to" value="<?=(isset($search))? $search : '';?>" maxlength="10"  style="width: 80px;" placeholder="2016-10-11"></input> </div>
            <div id="s_button"  class="hide">
                <button name="btnSearch" >Search</button></div>
            </ul>
        </div>

<?php /////////////////////////////////////////////////////////

?>