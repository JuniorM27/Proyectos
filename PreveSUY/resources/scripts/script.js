function ira(vara)
{
    document.getElementById(vara).scrollIntoView();
}

function ingresar(vara)
{
    document.getElementById(vara).click();
}

if(document.title == "PreveSUY") {
document.documentElement.style.overflowY = "hidden";
sessionStorage.clear();
initScroll(10000, 'scrollImage');
initScroll(30000, 'noticias_scroll');
document.getElementById("logo").style.color = "transparent";
setTimeout(logoUp, 1500);
function logoUp()
{
    document.getElementById("logo").style.transform = "translateY(-100vh)";
    setTimeout(logoBar, 2500);
}
function logoBar()
{
    document.getElementById("logo").style.height = "20vh";
    document.getElementById("logo").style.color = "var(--titlefontcolor)";
    document.getElementById("logo").style.transform = "translateY(0vh)";
    document.getElementById("logoimg").style.width = "15vh";
    setTimeout(removeTransition, 2000);
}
function removeTransition()
{
    document.getElementById("logo").style.transition = "0s";
    document.getElementById("logoimg").style.transition = "0s";
    document.documentElement.style.overflowX = "hidden";
    document.documentElement.style.overflowY = "scroll";
}

function initScroll(time, elem)
{
    setInterval(autoScroll, time, elem);
}

function autoScroll(parent)
{
    let childs = document.getElementById(parent).children;

    sessionStorage.setItem(parent, Number(sessionStorage.getItem(parent))+1);
    if(Number(sessionStorage.getItem(parent)) >= childs.length)
    {
        sessionStorage.setItem(parent, 0);
    }

    document.getElementById(parent).scroll({
        left: (document.getElementById(parent).clientWidth * Number(sessionStorage.getItem(parent))),
        behavior: "smooth"
    });
}

function ToElement(id, parent)
{
    let childs = document.getElementById(parent).children;

    sessionStorage.setItem(parent, id);
    if(id >= childs.length)
    {
        sessionStorage.setItem(parent, id);
    }

    document.getElementById(parent).scroll({
        left: (document.getElementById(parent).clientWidth * id),
        behavior: "smooth"
    });
}


document.getElementById('scrollImage').addEventListener('load', () =>
{
    document.getElementById('scrollImage').style.animationName = "scrollImg";
})

function refreshTestimonios(id)
{
    let array = document.getElementsByClassName('testimonio_active');
    for(let i = 0; i < array.length; i++)
    {
        array[i].classList.toggle('testimonio_active');
    }
    document.getElementById('testimonios').children[id].classList.toggle('testimonio_active');
}

function changeMapImg(lat, long, nombre, numero, dire)
{
    document.getElementById('map').src = `https://maps-api-ssl.google.com/maps?hl=es&output=embed&q=${lat},${long}`;

    document.getElementById('titulo_centro').textContent = "CENTRO: " + nombre;
    document.getElementById('numero_centro').innerHTML = "NUMERO: <a href='tel:+598" + numero + "'>" + numero;
    document.getElementById('dir_centro').textContent = "DIRECCIÓN: " + dire;
}

document.getElementById("map_dep").addEventListener('change', () =>
{
    let id = document.getElementById("map_dep").value;
    let childs = document.getElementById("centros_ayuda").children;
    for(let i = 0; i < childs.length; i++)
    {
        if(id == 20)
        {
            if(!childs[i].classList.contains("centros_active")) childs[i].classList.toggle("centros_active");
        } else
        if(!childs[i].classList.contains("centro_"+id))
        {
            if(childs[i].classList.contains("centros_active")) childs[i].classList.toggle("centros_active");
        } else
        {
            if(!childs[i].classList.contains("centros_active")) childs[i].classList.toggle("centros_active");
        }
    }
});

function refreshSabias(id)
{
    let array = document.getElementsByClassName('sabias_active');
    for(let i = 0; i < array.length; i++)
    {
        array[i].classList.toggle('sabias_active');
    }
    document.getElementById('sabias_que').children[id].classList.toggle('sabias_active');
}

function refreshGrafico(año)
{
    let array = document.getElementsByClassName('grafico_active');
    for(let i = 0; i < array.length; i++)
    {
        array[i].classList.toggle('grafico_active');
    }
    document.getElementById('grafico_'+año).classList.toggle('grafico_active');

    refreshInfoGrafico(año, "URUGUAY")
}

function refreshInfoGrafico(año, child)
{
    let array = document.getElementsByClassName('dep_active');
    let array2 = document.getElementsByClassName('año_tabla_active');
    for(let i = 0; i < array.length; i++)
    {
        array[i].classList.toggle('dep_active');
    }
    for(let k = 0; k < array2.length; k++)
    {
        array2[k].classList.toggle('año_tabla_active');
    }
    document.getElementById('año_tabla_'+año).classList.toggle('año_tabla_active');
    for(let m = 0; m < document.getElementById('año_tabla_'+año).children.length; m++)
    {
        if(document.getElementById('año_tabla_'+año).children[m].id == child)
        {
            document.getElementById('año_tabla_'+año).children[m].classList.toggle('dep_active');
            break;
        }
    }
}

} else
{
    document.getElementById("logo").style.transition = "0s"
    document.getElementById("logo").style.position = "relative"
    document.getElementById("logo").style.height = "15vh";
    document.getElementById("logo").style.transform = "translateY(0vh)";
    document.getElementById("logoimg").style.transition = "0s";
    document.getElementById("logoimg").style.width = "14vh";
}