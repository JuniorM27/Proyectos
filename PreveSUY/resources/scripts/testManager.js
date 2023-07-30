var puntaje = 0;
var index = 0;

function siguiente()
{
    var points = document.getElementsByName('question_'+index); 
    for(var i = 0; i < points.length; i++){
    if(points[i].checked){
        puntaje = Number(puntaje) + Number(points[i].value);
    }
    }
    document.getElementById("quest_"+index).style.display = "none";
    index++;
    try{
        document.getElementById("quest_"+index).style.display = "block";
    } catch(e)
    {
        console.log('puntaje total: ' + puntaje);
        document.getElementById('test_resultado').style.display = "block";
        if(puntaje <= 10) // se encuentra bien
        {
            document.getElementById('resultado_text').textContent = "Los resultados arrojan que no necesitas ayuda profesional, de igual manera si lo necesitas puedes llamar a la linea de prevención de suicidio: ";
        } else if(puntaje <= 50) // no se encuentra bien pero no estaria en peligro
        {
            document.getElementById('resultado_text').textContent = "Los resultados arrojan que no estas pasando por un buen momento, Si lo necesitas puedes llamar a la linea de prevención de suicidio para que te ayuden a salir de esa idea: ";
        } else //se quiere matar
        {
            document.getElementById('resultado_text').textContent = "Los resultados arrojan que no estas bien, Porfavor contacta a la linea de ayuda para prevenir el suicidio y escucha lo que te dicen te ayudaran a salir: ";
        }
    }
}
