var boss = document.getElementById('boss');
var time = 1000;
var damage = 2.5;
var regenerate = damage / 2;
var progress = 100;
let moveInterval = setInterval(move,time);
let teleport = false;

function move()
{
    if(teleport) boss.style.transition = "0s"; else boss.style.transition = time+"ms";

    let randNum_V = Math.round(Math.random() * 100);
    let randNum_H = Math.round(Math.random() * 100);

    boss.style.top = randNum_V + "%";
    boss.style.left = randNum_H + "%";

    let array = document.getElementsByClassName('bossClone');
    for(let i = 0; i < array.length; i++) {
        if(progress <= 15) {
        array[i].style.display = "block";
        if(teleport) array[i].style.transition = "0s"; else array[i].style.transition = time+"ms";
        let randNum_V = Math.round(Math.random() * 100);
        let randNum_H = Math.round(Math.random() * 100);
    
        array[i].style.top = randNum_V + "%";
        array[i].style.left = randNum_H + "%";
        } else
        {
            array[i].style.display = "none";
        }
    }

    if(progress > 50)
    {
        document.getElementById('progress').style.backgroundColor = 'red';
        teleport = false;
    } else
    if(progress > 0 && progress <= 50)
    {
        document.getElementById('progress').style.backgroundColor = 'darkred';
        if(progress <= 25) 
        {
            progress += regenerate;
            document.getElementById('progress').style.width = progress + "%";
            document.getElementById('progress').style.backgroundColor = 'darkgreen';
        }
        teleport = true;
    } else
    if(progress <= 0)
    {
        document.getElementById('progress').style.width = progress + "%";
        alert('You win');
        clearInterval(moveInterval);
    }

}

boss.addEventListener('click', (e) =>
{
    var width = document.getElementById('progress').clientWidth;
    var parentWidth = document.getElementById('bar').offsetWidth;
    var percent = Math.round(100 * width / parentWidth);
    progress = percent - damage;

    if(progress <= 50)
    {
        document.getElementById('progress').style.backgroundColor = 'darkred';
    }

    document.getElementById('progress').style.width = progress + "%";
});

document.body.addEventListener('click', (e) =>
{
    mousePos = { x: e.clientX, y: e.clientY };
    let img = document.createElement('img');
    img.src = './img/bullethole.png';
    img.style.zIndex = -1;
    img.style.top = (mousePos.y-35+Math.round(Math.random() * 50))+'px';
    img.style.left = (mousePos.x-35+Math.round(Math.random() * 50))+'px';
    img.id = 'bullet';
    document.getElementById('space').appendChild(img);
});

let mousePos = { x: undefined, y: undefined };

window.addEventListener('mousemove', (event) => {
  mousePos = { x: event.clientX, y: event.clientY };
  document.getElementById('scope').style.top = (mousePos.y-35)+'px';
  document.getElementById('scope').style.left = (mousePos.x-35)+'px';
});