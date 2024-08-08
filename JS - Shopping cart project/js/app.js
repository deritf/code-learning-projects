// Variables
const carrito = document.querySelector("#carrito");
const contenedorCarrito = document.querySelector("#lista-carrito tbody");
const vaciarCarritoBtn = document.querySelector("#vaciar-carrito");
const listaCursos = document.querySelector("#lista-cursos");
// Carrito de compras que será un array inicialmente vacío
let articulosCarrito = [];

cargarEventListeners();
function cargarEventListeners() {
  // Cuando agregar un curso presionando en el botón: "Agregar al Carrito"
  listaCursos.addEventListener("click", agregarCurso);

  // Elimina cursos del carrito
  carrito.addEventListener("click", eliminarCurso);

  // Botón de eliminar todo el contenido del carrito
  vaciarCarritoBtn.addEventListener("click", () => {
    articulosCarrito = []; // Reseteamos el array devolviendolo a vacío
    limpiarHTML(); // Llamamos a la función para actualizar el estado del carrito
  });
}

// Funciones
function agregarCurso(e) {
  // Este preventDefault es añadido para evitar que la página se vaya hacia
  // arriba cada vez que se presione el botón "Agregar al carrito" ya que
  // tiene href="#" y # por defecto te lleva al incio de la página.
  e.preventDefault();

  if (e.target.classList.contains("agregar-carrito")) {
    const cursoSeleccionado = e.target.parentElement.parentElement;
    leerDatosCurso(cursoSeleccionado);
  }
}

// Elimina un curso del carrito
function eliminarCurso(e) {
  if (e.target.classList.contains("borrar-curso")) {
    const cursoId = e.target.getAttribute("data-id");

    // Elimina del arreglo de articulosCarrito utilizando su data-id
    articulosCarrito = articulosCarrito.filter((curso) => curso.id !== cursoId);

    // Es necesario volver a llamar a la función que imprime los valores en el HTML para que muestre los actualizados
    carritoHTML();
  }
}

// Lee el contenido del HTML al que le dimos click y extrae la información del curso
function leerDatosCurso(curso) {
  console.log(curso);

  // Crear un objeto con el contenido del curso actual
  const infoCurso = {
    imagen: curso.querySelector("img").src,
    titulo: curso.querySelector("h4").textContent,
    precio: curso.querySelector(".precio span").textContent,
    id: curso.querySelector("a").getAttribute("data-id"),
    cantidad: 1,
  };

  // Revisar si un elemento ya existe en el carrito
  const existe = articulosCarrito.some((curso) => curso.id === infoCurso.id);
  if (existe) {
    // Actualizamos la cantidad
    const cursos = articulosCarrito.map((curso) => {
      if (curso.id === infoCurso.id) {
        curso.cantidad++;
        return curso; // retorna el objeto actualizado.
      } else {
        return curso; // retorna los objetos qeu no son los duplicados.
      }
    });
    articulosCarrito = [...cursos];
  } else {
    // Agregamos el curso al carrito

    // Añadie elementos al array articulosCarrito (tamibén se puede hacer con push)
    // en este caso se utilizarán los spread operators, así se logrará que sea
    // acumulativo y que los cursos que se vayan seleccionando se vayan agregando
    // al carrito.
    articulosCarrito = [...articulosCarrito, infoCurso];
    console.log(articulosCarrito);
  }

  carritoHTML();
}

// Muestra el Carrito de compras en el HTML
function carritoHTML() {
  // Limpiar el HTML. Esto es necesario para evitar duplicados de cursos en el carrito
  limpiarHTML();

  // Recorre el carrito y genera el HTML
  articulosCarrito.forEach((curso) => {
    const { imagen, titulo, precio, cantidad, id } = curso;
    const row = document.createElement("tr");
    row.innerHTML = `
    <td>
    <img src="${imagen}" width="100">
    </td>
    <td>${titulo}</td>
    <td>${precio}</td>
    <td>${cantidad}</td>
    <td>
    <a href="#" class="borrar-curso" data-id="${id}"> X </a>
    </td>
    `;

    // Añade el HTML del carrito en el tbody
    contenedorCarrito.appendChild(row);
  });
}

// Elimina los cursos del tbody
function limpiarHTML() {
  // Forma lenta de hacer el borrado:
  //contenedorCarrito.innerHTML = "";

  // Forma rápida de hacer el borrado:
  while (contenedorCarrito.firstChild) {
    contenedorCarrito.removeChild(contenedorCarrito.firstChild);
  }
}
