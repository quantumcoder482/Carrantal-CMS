<?php
$action = route(1,'schema');

switch ($action){


    case 'schema':


        $message = Update::singleCommand();

        updateOption('build',$file_build);

        $message .= '---------------------------'.PHP_EOL;
        $message .= 'Redirecting, please wait...';



        $script = '<script>
    $(function() {
        var delay = 10000;
        var $serverResponse = $("#serverResponse");
        var interval = setInterval(function(){
   $serverResponse.append(\'.\');
}, 500);
        
        setTimeout(function(){ window.location = \''.U.'dashboard\'; }, delay);
    });
</script>';

        HtmlCanvas::createTerminal($message,$script);



        break;




}
