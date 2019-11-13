let baseDir='http://localhost:80/DWS/frameworkApi';
var prod2={
      "id": 105,
      "nombre": "HP2 1500L",
      "descripcion": "xxxxxxImpresora Laser",
      "precio": 200
    };



function setup(){
  noCanvas();
}

function cargaInicio(){
  removeElements();
}

function cargaEquipo(){
  getJson(baseDir+'/jugadores');
}

function cargaHistoria(){
  removeElements();
}

function getJson(url){
  var get;
	var http = new XMLHttpRequest();
	http.open('GET', url, true);
	http.send();
	http.addEventListener('readystatechange', function(){
			if(http.readyState === 4 && http.status === 200) {
				get = JSON.parse(http.responseText); // prod = [{"id": “valor id”, "nombre":"nombre del articulo"..... },{},{}]
        pintarJugadores(get,"Lakers");
		}
	});
}

function postJson(url, post){
	var http = new XMLHttpRequest();
	http.open('POST', 'http://localhost:3000/articulos', true);
	//http.setRequestHeader("Content-type", "application/json");
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.send(JSON.stringify(post));
	http.addEventListener('readystatechange', function() {
			if(http.readyState === 4 && http.status === 200) {
				if(parseInt(http.responseText) === 1) alert("Todo ha ido bien");
				else alert("Ha habido un error al añadir el producto");
			}
	});
}

function pintarJugadores(players,team){
  removeElements();
  for(let player of players){
    if(player["Nombre_equipo"]==team){
      let a=createElement("div","");
      a.attribute("onclick","pintarJugador(this.value)");
      a.attribute("class","jugador");
      a.value(player);
      let fig=createElement("figure");
      fig.parent(a);
      fig.attribute("class","playersTeam");
      let img=createImg('../public/images/jugador.jpg',"player");
      img.attribute("class","imgPlayer");
      img.parent(fig);
      let fc=createElement("figcaption",player["Nombre"]);
      fc.parent(fig);
    }

  }


}

function pintarJugador(player){
  removeElements();
  let d=createElement("div","");
  let name=createElement("div",player["Nombre"]);
  name.parent(d);
  let peso=createElement("div",player["Peso"]);
  peso.parent(d);
  let pos=createElement("div",player["Posicion"]);
  pos.parent(d);
  let alt=createElement("div",player["Altura"]);
  alt.parent(d);
  let proc=createElement("div",player["Procedencia"]);
  proc.parent(d);
}
