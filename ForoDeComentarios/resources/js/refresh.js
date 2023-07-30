const path = "./resources/php/system.php";
const refreshElementID = "messages";
var rtime = 0;

function refresh()
{
    try{
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function()
        {
            document.getElementById(refreshElementID).innerHTML = this.responseText;
        }
        xhttp.open("GET", path);
        xhttp.send();    
    } catch
    {
        console.warn("Algo anda mal, compruebe que las constantes estan bien ingresadas y intentelo de nuevo.");
    }
}

function main()
{
    if(rtime == 1) return;
    if(rtime < -10)
    {
        refresh();
        rtime = 0;
    } else rtime -= 1;
}

setInterval(main, 1);

document.getElementById(refreshElementID).onmouseout = function()
{
    if(rtime == 1)
    {
        rtime = 0;
        document.getElementById('paused').textContent = "SIN PAUSA";
    } 
}

document.getElementById(refreshElementID).onmouseover = function()
{
    rtime = 1;
    document.getElementById('paused').textContent = "PAUSADO";
}
