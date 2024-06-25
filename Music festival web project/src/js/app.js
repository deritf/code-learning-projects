document.addEventListener("DOMContentLoaded", function () {
  navegacionFija();
  crearGaleria();
  resaltarEnlaces();
  scrollNav();
});

function navegacionFija() {
  const header = document.querySelector(".header");
  const sobreFestival = document.querySelector(".sobre-festival");

  document.addEventListener("scroll", function () {
    //!El siguiente código detectará cuando has pasado un elemento que ya no he visible en pantalla.
    if (sobreFestival.getBoundingClientRect().bottom < 1) {
      header.classList.add("fixed");
    } else {
      header.classList.remove("fixed");
    }
  });
}

function crearGaleria() {
  const CANTIDAD_IMAGENES = 16;
  const galeria = document.querySelector(".galeria-imagenes");

  for (let i = 1; i <= CANTIDAD_IMAGENES; i++) {
    /* La convención dice que debe ponerse en mayúscula, en lugar de img, será IMG, en lugar de div, será DIV. */
    const imagen = document.createElement("IMG");
    imagen.src = `src/img/gallery/full/${i}.jpg`;
    imagen.alt = "Imagen de Galería";

    //Event Handler: Esto es detectar y responder a la interacción de un usuario, por ejemplo por su click.
    imagen.onclick = function () {
      mostrarImagen(i);
    };

    galeria.appendChild(imagen);
  }
}

function mostrarImagen(i) {
  const imagen = document.createElement("IMG");
  imagen.src = `src/img/gallery/full/${i}.jpg`;
  imagen.alt = "Imagen de Galería";

  //Generar Modal:
  //En esta parte se generará el div.
  const modal = document.createElement("DIV");
  modal.classList.add("modal");

  //!Este evento onclick a diferencia del de mostrarImagen no lleva function porque no se le pasa ningún parametro, no como al mostrar imagen que se le pasa (i).
  modal.onclick = cerrarModal;

  //Botón cerrar modal
  const cerrarModalBtn = document.createElement("BUTTON");
  cerrarModalBtn.textContent = "X";
  cerrarModalBtn.classList.add("btn-cerrar");
  cerrarModalBtn.onclick = cerrarModal;

  modal.appendChild(imagen);
  modal.appendChild(cerrarModalBtn);

  //Agregar al HTML: Selecciono el body y añado el modal en el body.
  const body = document.querySelector("body");
  body.classList.add("overflow-hidden");
  body.appendChild(modal);
}

function cerrarModal() {
  const modal = document.querySelector(".modal");
  modal.classList.add("fade-out");

  //!SetTimeout retrasará la ejecución del código que contiene en medio segundo (500ms). Este retaso estará hecho para mostrar el efecto fadeout
  setTimeout(() => {
    //!En anteriores versiones se haría esto con un If que verificaría que existe el modal antes de borrarlo, con la actual versión de .JS simplemente con esto es suficiente.
    modal?.remove();

    const body = document.querySelector("body");
    body.classList.remove("overflow-hidden");
  }, 500);
}

//*Como puede verse, se ha creado una función para cada cosa, subdividiendo el problema en problemas mas pequeños, recordar y utilizar este método.

function resaltarEnlaces() {
  document.addEventListener("scroll", function () {
    const sections = document.querySelectorAll("section");
    const navLinks = document.querySelectorAll(".navegacion-principal a");

    let actual = "";
    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.clientHeight;

      if (window.scrollY >= sectionTop - sectionHeight / 3) {
        actual = section.id;
      }
    });

    navLinks.forEach((link) => {
      link.classList.remove("active");
      if (link.getAttribute("href") === "#" + actual) {
        link.classList.add("active");
      }
    });
  });
}

function scrollNav() {
  const navLinks = document.querySelectorAll(".navegacion-principal a");

  navLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const sectionScroll = e.target.getAttribute("href");
      const section = document.querySelector(sectionScroll);

      section.scrollIntoView({ behavior: "smooth" });
    });
  });
}
