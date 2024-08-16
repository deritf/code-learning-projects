// Variables
const marca = document.querySelector("#marca");
const year = document.querySelector("#year");
const minimo = document.querySelector("#minimo");
const maximo = document.querySelector("#maximo");
const puertas = document.querySelector("#puertas");
const transmision = document.querySelector("#transmision");
const color = document.querySelector("#color");

// Contenedor para los resultados
const resultado = document.querySelector("#resultado");

const max = new Date().getFullYear();
const min = max - 10;

// Generar un objeto con los datos de búsqueda que vaya indicando el usuario
const datosBusqueda = {
  marca: "",
  year: "",
  minimo: "",
  maximo: "",
  puertas: "",
  transmision: "",
  color: "",
};

// Eventos
document.addEventListener("DOMContentLoaded", () => {
  mostrarCoches(coches); // Muestra los coches al cargar

  // Llena las opciones de años
  llenarSelect();
});

// Event listener para los select de búsqueda
marca.addEventListener("change", (e) => {
  datosBusqueda.marca = e.target.value;
  filtrarCoche();
});
year.addEventListener("change", (e) => {
  datosBusqueda.year = parseInt(e.target.value);
  filtrarCoche();
});
minimo.addEventListener("change", (e) => {
  datosBusqueda.minimo = e.target.value;
  filtrarCoche();
});
maximo.addEventListener("change", (e) => {
  datosBusqueda.maximo = e.target.value;
  filtrarCoche();
});
puertas.addEventListener("change", (e) => {
  datosBusqueda.puertas = parseInt(e.target.value);
  filtrarCoche();
});
transmision.addEventListener("change", (e) => {
  datosBusqueda.transmision = e.target.value;
  filtrarCoche();
});
color.addEventListener("change", (e) => {
  datosBusqueda.color = e.target.value;
  filtrarCoche();
});

console.log(datosBusqueda);

// Funciones
function mostrarCoches(coches) {
  limpiarHTML();

  coches.forEach((coche) => {
    const { marca, modelo, year, puertas, transmision, precio, color } = coche;
    const cocheHTML = document.createElement("p");

    cocheHTML.textContent = `
        ${marca} ${modelo} - ${year} - ${puertas} Puertas - Transmisión: ${transmision} - Precio: ${precio} - Color: ${color}
        `;

    // Insertar en el html
    resultado.appendChild(cocheHTML);
  });
}

// Limpiar HTML
function limpiarHTML() {
  while (resultado.firstChild) {
    //Mientras exista un hijo, se ejecutará el borrado del hijo, hasta eliminarlos todos.
    resultado.removeChild(resultado.firstChild);
  }
}

// Genera los años del select
function llenarSelect() {
  for (let i = max; i >= min; i--) {
    const opcion = document.createElement("option");
    opcion.value = i; // Añade el "value" en el HTML
    opcion.textContent = i; // Añade el texto visible de las opciones en el HTML
    year.appendChild(opcion); // Añade las opciones de años al Select
  }
}

// Función que filtra en base a la búsqueda
function filtrarCoche() {
  const resultado = coches
    .filter(filtrarMarca)
    .filter(filtrarYear)
    .filter(filtrarMinimo)
    .filter(filtrarMaximo)
    .filter(filtrarPuertas)
    .filter(filtrarTransmision)
    .filter(filtrarColor);

  if (resultado.length) {
    //console.log(resultado);
    mostrarCoches(resultado);
  } else {
    noResultado();
  }
}

function noResultado() {
  limpiarHTML();

  const noResultado = document.createElement("DIV");
  noResultado.classList.add("alerta", "error");
  noResultado.textContent =
    "No hay resultados. Prueba con otro datos de búsqueda...";
  resultado.appendChild(noResultado);
}

function filtrarMarca(coche) {
  if (datosBusqueda.marca) {
    return coche.marca === datosBusqueda.marca;
  }
  return coche;
}

function filtrarYear(coche) {
  if (datosBusqueda.year) {
    return coche.year === datosBusqueda.year;
  }
  return coche;
}

function filtrarMinimo(coche) {
  if (datosBusqueda.minimo) {
    return coche.precio >= datosBusqueda.minimo;
  }
  return coche;
}

function filtrarMaximo(coche) {
  if (datosBusqueda.maximo) {
    return coche.precio <= datosBusqueda.maximo;
  }
  return coche;
}

function filtrarPuertas(coche) {
  if (datosBusqueda.puertas) {
    return coche.puertas === datosBusqueda.puertas;
  }
  return coche;
}

function filtrarTransmision(coche) {
  if (datosBusqueda.transmision) {
    return coche.transmision === datosBusqueda.transmision;
  }
  return coche;
}

function filtrarColor(coche) {
  if (datosBusqueda.color) {
    return coche.color === datosBusqueda.color;
  }
  return coche;
}
