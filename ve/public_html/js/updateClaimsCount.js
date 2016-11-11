var intervalcheckLastUpdateTime = null;
var intervalupdateClaimsCount = null;

$(document).ready(function()
{
    if(typeof(data) != "undefined" && data !== null) {
        checkLastUpdateTime(true,data)
    } else {
        updateClaimsCount();
    }
});
function checkLastUpdateTime(setTimer,claims) {
    var date = new Date();
    var now = date.getTime()/1000 | 0;
    if((now-claims.time)/60 >= 15){
        clearInterval(intervalupdateClaimsCount);
        clearInterval(intervalcheckLastUpdateTime);
        updateClaimsCount();
    } else if(setTimer){
        intervalcheckLastUpdateTime = setInterval(function () {
            checkLastUpdateTime(false,claims)
        },(5)*1000);
    }
}

function updateClaimsCount() {
    $.ajax({
        url : 'getclaimscount',
        data : {'company_id' : company_id},
        success:function (result) {
           var claims = result;
            $.each(result, function( index, value ) {
                if(index != 'time'){
                    if(value != 0){$('.nav-item-'+ index).text(value);}
                }
            });

            intervalupdateClaimsCount = setInterval(function () {
                checkLastUpdateTime(false,claims)
            },(5)*1000);
        }
    });
}
