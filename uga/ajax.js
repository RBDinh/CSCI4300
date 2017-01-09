var img = document.getElementById("refresh");
img.src = " data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAPFJREFUOI2l0rEuhEEYheHHbnQSxa/YsBIJvYhOTWyyd0ErEdtwATqJkkZDXMD2esUmOj2dhkJBomAVM2R2mPBzkilmzpd3Tk4+/qnmD/4yDjGLGzzV/aCDYTzP6NVN8IJHVJjBOiZwkQ+Oo4sz9L8BjWE3SdNJzTauEvMVrUKi4zhzmRsV3hLIVgEwl8xU0IjGQoz5gA2h/VxN3OI+3udTcyVS7+K94avOsSmUOsRSaraSaO1C/G2jPU3mA4NoHhUA00Z7GsS3T3UTc0/oJFcfJ1hT2KGDBHKNfWGNa2lH2PkP0GpdAEwJu3CKxb8Afq13AcE8JrleefwAAAAASUVORK5CYII=";

var btn = document.getElementById('ref');
function doAjax()
{
    $.post("./question.php",
    {
        id : $("#app").val()
    },
 /*Function Parameter on*/ function(data , status)
    { 
        if(data.length != 293)
        {
            $("#res").html(null);
             $("#ans").html(null);
            genStuff();
        }
        else
        {
            $("#res").html(null);
             $("#ans").html(null);
        }
        $("#next").html(data);
    });
}

//Massive Work around
function genStuff()
{
    var res = document.getElementById("res");
    var yes = document.createElement("input");
    var yesLbl = document.createElement("Label");
    var yesText = document.createTextNode("Yes");
    var noLbl = document.createElement("Label");
    var noText = document.createTextNode("No");
    var idkLbl = document.createElement("Label");
    var idkText = document.createTextNode("I don't Know");
    var no = document.createElement("input");
    var idk = document.createElement("input");
    yes.setAttribute("type","radio");
    yes.setAttribute("name","ans");
    yes.setAttribute("value","yes");
    yesLbl.setAttribute("class","label");
    yesLbl.appendChild(yesText);
    no.setAttribute("type","radio");
    no.setAttribute("name","ans");
    no.setAttribute("value","no");
    noLbl.setAttribute("class","label");
    noLbl.appendChild(noText);
    idk.setAttribute("type","radio");
    idk.setAttribute("name","ans");
    idk.setAttribute("value","IDK");
    idkLbl.setAttribute("class","label");
    idkLbl.appendChild(idkText);
    res.appendChild(yes);
    res.appendChild(yesLbl);
    res.appendChild(document.createElement("br"));
    res.appendChild(no);
    res.appendChild(noLbl);
    res.appendChild(document.createElement("br"));
    res.appendChild(idk);
    res.appendChild(idkLbl);
    res.appendChild(document.createElement("br"));

    yes.onclick = function()
    {
        $.post("./test.php",
        {
            answer : "yes"

        },function(data)
        {
             $("#ans").html(data);
        });
    }
    no.onclick = function()
    {
        $.post("./test.php",
        {
            answer : "no"

        },function(data)
        {
            $("#ans").html(data);
        });
    }
    idk.onclick = function()
    {
        $.post("./test.php",
        {
            answer : "IDK"

        },function(data)
        {
             $("#ans").html(data);
        });
    }
}
btn.onclick = doAjax;
$("#app").keyup(doAjax);
$("#gameSelect").change(function()
{
    $("#app").val($("#gameSelect").val());
    doAjax();
});