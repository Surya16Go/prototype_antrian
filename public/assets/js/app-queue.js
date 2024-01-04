/**
 *  Form Wizard
 */

'use strict';

(function () {
    setInterval(function(){
        $.ajax({
            url: 'http://127.0.0.1:8000/get-latest-queue',
            type: 'GET',
            dataType: 'json',
            success: function(response){
                document.querySelector("#pendingCount").innerHTML = response.pendingCount;
                document.querySelector("#lastQueueNumber").innerHTML = response.lastQueueNumber;
            },
        });
    }, 2000);
})();
