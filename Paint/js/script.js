var mousePos = { x: undefined, y: undefined };
var painting = false;
var grosor = 2;
var color = document.getElementById('color').value;

document.getElementById('space').addEventListener('mousemove', (event) => {
  mousePos = { x: event.clientX, y: event.clientY };
  document.getElementById('scope').style.top = (mousePos.y)+'px';
  document.getElementById('scope').style.left = (mousePos.x)+'px';
});

for(let i = 0; i < 2300; i++)
{
    let img = document.createElement('img');
    img.src = './img/circle.png';
    img.style.width = grosor+"vw";
    img.style.height = grosor+"vh";
    img.style.backgroundColor = document.getElementById('bcolor').value;
    img.style.zIndex = -1;
    img.draggable = false;
    img.id = 'pixel';
    img.addEventListener('mouseover', (e) => {
        if(painting)
        {
            e.currentTarget.style.backgroundColor = color;
            console.log('Painting');
        }
    })
    document.getElementById('space').appendChild(img);
}

document.getElementById('space').addEventListener('mouseup', (e) =>
{
    painting = false;
});

document.getElementById('space').addEventListener('mousedown', (e) =>
{
    painting = true;
});

document.getElementById('color').addEventListener('change', (e) =>
{
    color = document.getElementById('color').value;
});

document.getElementById('r').addEventListener('change', (e) =>
{
    color = `rgba(${document.getElementById('r').value},${document.getElementById('g').value},${document.getElementById('b').value},${document.getElementById('a').value})`
    document.getElementById('previewColor').style.backgroundColor = color;
});
document.getElementById('g').addEventListener('change', (e) =>
{
    color = `rgba(${document.getElementById('r').value},${document.getElementById('g').value},${document.getElementById('b').value},${document.getElementById('a').value})`
    document.getElementById('previewColor').style.backgroundColor = color;
});
document.getElementById('b').addEventListener('change', (e) =>
{
    color = `rgba(${document.getElementById('r').value},${document.getElementById('g').value},${document.getElementById('b').value},${document.getElementById('a').value})`
    document.getElementById('previewColor').style.backgroundColor = color;
});
document.getElementById('a').addEventListener('change', (e) =>
{
    color = `rgba(${document.getElementById('r').value},${document.getElementById('g').value},${document.getElementById('b').value},${document.getElementById('a').value})`
    document.getElementById('previewColor').style.backgroundColor = color;
});

document.getElementById('bcolor').addEventListener('change', (e) =>
{
    document.querySelectorAll('#pixel').forEach((element) =>
    {
        element.style.backgroundColor = document.getElementById('bcolor').value;
    })
});
