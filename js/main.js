console.log("Hola");
let btn1 = document.getElementById("equipo1");
let btn2 = document.getElementById("equipo2");

btn1.addEventListener("click", (e) => escuchar(e));
btn2.addEventListener("click", (e) => escuchar(e));

function escuchar(e) {
  const idGanador = e.currentTarget.dataset.id;
  const idEquipo1 = document.getElementById("equipo1").dataset.id;
  const idEquipo2 = document.getElementById("equipo2").dataset.id;
  const idPerdedor = (idGanador === idEquipo1) ? idEquipo2 : idEquipo1;

  console.log("Ganó: " + idGanador + " | Perdió: " + idPerdedor);

  fetch(BASE_URL + "votar/" + idGanador + "/" + idPerdedor)
    .then(response => response.json())
    .then(data => {
      console.log(data);
      if (data.status === 200) {
        window.location.href = BASE_URL + "duelo";
      }
    })
    .catch(error => console.log("Error:", error));
}
