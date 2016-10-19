<?php
   /* --------------------------------------------------------------------
   // purpose : handling communication between parent and iframe 
   // autho : Benjamin
   // Date : Oct 17, 2016
   -------------------------------------------------------------------- */
?>
<iframe class="hide" name="ifrm" id="ifrm" src="<?=URL;?>"></iframe>
<!-- local script functions -->
<script type='text/javascript'>
    function call_API(param) {
        document.getElementById('ifrm').src = "<?=URL;?>"+param;
    }

    // register callback
    document.getElementById('ifrm').onload = function() {
        var obj = document.getElementById("response");
        if(null != obj)
            alert(obj.value);
    }

    // define revice function
    function receiveEvent(obj) {
        //alert(var_dump(obj));
        if(typeof(window[obj.func]) == "function"){
            switch(obj.params.length) {
                case 0:
                    window[obj.func].call(null);
                    break;
                case 1:
                    window[obj.func].call(null, obj.params[0]);
                    break;
                case 2:
                    window[obj.func].call(null, obj.params[0], obj.params[1]);
                    break;
                case 3:
                    window[obj.func].call(null, obj.params[0], obj.params[1], obj.params[2]);
                    break;
                case 4:
                    window[obj.func].call(null, obj.params[0], obj.params[1], obj.params[2], obj.params[3]);
                    break;
                case 5:
                    window[obj.func].call(null, obj.params[0], obj.params[1], obj.params[2], obj.params[3], obj.params[3]);
                    break;
            }
        }
    }
</script>