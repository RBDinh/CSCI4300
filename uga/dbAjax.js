var amount = 1000;
var curProg = 0;
var lastProg = 0;
for(i = 0; i < amount;i++)
{
    doAjax(i);
}
function doAjax(start)
{
    $.post("./populateDB.php",
    {
        st : start
    },
 /*Function Parameter on*/ function(data , status)
    { 
        var vals = data.split(",");
        lastProg = $("#prog").html();
        curProg = ((vals[1]/amount)*100);
        if(vals[1] != 0 && curProg > lastProg)
        {   
            $("#prog").html(curProg);
        }
        if(vals[0] != "null")
        {
            $("#bdy").append(vals[0] + "<br>");
        }
    });
}