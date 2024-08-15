// Con esto nos aseguramos de que todo el contendio de la web se descargue antes de ejecutar el contenido.
document.addEventListener("DOMContentLoaded", function () {
  // Crearemos este objeto con el fin de verificar que todo está listo para activar el botón Enviar
  const email = {
    email: "",
    emailcc: "",
    asunto: "",
    mensaje: "",
  };

  // Seleccionar los elementos de la interfaz
  const inputEmail = document.querySelector("#email");
  const inputEmailCC = document.querySelector("#emailcc");
  const inputAsunto = document.querySelector("#asunto");
  const inputMensaje = document.querySelector("#mensaje");
  const formulario = document.querySelector("#formulario");
  const btnSubmit = document.querySelector(
    '#formulario button[type ="submit"]'
  );
  const btnReset = document.querySelector('#formulario button[type ="reset"]');
  const spinner = document.querySelector("#spinner");

  // Asignar eventos
  inputEmail.addEventListener("input", validar);
  inputEmailCC.addEventListener("input", validar);
  inputAsunto.addEventListener("input", validar);
  inputMensaje.addEventListener("input", validar);

  formulario.addEventListener("submit", enviarEmail);

  btnReset.addEventListener("click", function (e) {
    e.preventDefault();

    // Reiniciar el objeto
    resetFormulario();
  });

  function enviarEmail(e) {
    e.preventDefault();

    spinner.classList.add("flex");
    spinner.classList.remove("hidden");

    setTimeout(() => {
      spinner.classList.remove("flex");
      spinner.classList.add("hidden");

      // Reiniciar el objeto
      resetFormulario();

      // Crear alerta sobre el éxito de la ejecución
      const alertaExito = document.createElement("P");
      alertaExito.classList.add(
        "bg-green-500",
        "text-white",
        "p-2",
        "text-center",
        "rounded-lg",
        "mt-10",
        "font-bold",
        "text-sm",
        "uppercase"
      );
      alertaExito.textContent = "Mensaje enviado correctamente";

      formulario.appendChild(alertaExito);

      setTimeout(() => {
        alertaExito.remove();
      }, 3000);
    }, 3000);
  }

  function validar(e) {
    if (e.target.value.trim() === "" && e.target.id != "emailcc") {
      mostrarAlerta(
        `El campo ${e.target.id} es obligatorio`,
        e.target.parentElement
      );
      // Comprobar email
      email[e.target.name] = "";
      comprobarEmail();
      return;
    }

    if (e.target.id === "email" && !validarEmail(e.target.value)) {
      mostrarAlerta("El email no es válido", e.target.parentElement);
      // Comprobar email
      email[e.target.name] = "";
      comprobarEmail();
      return;
    }

    if (
      e.target.id === "emailcc" &&
      !validarEmailCC(e.target.value) &&
      e.target.value != ""
    ) {
      mostrarAlerta("El email CC no es válido", e.target.parentElement);
      // Comprobar email
      emailcc[e.target.name] = "";
      return;
    }

    limpiarAlerta(e.target.parentElement);

    // Asignar los valores al objeto (el del inicio del código)
    // Si el código se ha ejecutado hasta aquí es que ha superado las validaciones
    email[e.target.name] = e.target.value.trim().toLowerCase();

    // Compobar el objeto email
    comprobarEmail();
  }

  function mostrarAlerta(mensaje, referencia) {
    // Comprueba si ya existe una alerta (EVITAR ACUMULACIÓN DE ALERTAS)
    const alerta = referencia.querySelector(".bg-red-600");
    if (alerta) {
      alerta.remove();
    }

    // Generar alerta en HTML
    const error = document.createElement("P");
    error.textContent = mensaje;
    error.classList.add("bg-red-600", "text-white", "p-2", "text-center");

    referencia.appendChild(error);
  }

  function limpiarAlerta(referencia) {
    const alerta = referencia.querySelector(".bg-red-600");
    if (alerta) {
      alerta.remove();
    }
  }

  function validarEmail(email) {
    const regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
    const resultado = regex.test(email); //Esto devolverá ture o false según se cumpla o no la exp.regular
    return resultado;
  }

  function validarEmailCC(emailCC) {
    const regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
    const resultado = regex.test(emailCC); //Esto devolverá ture o false según se cumpla o no la exp.regular
    return resultado;
  }

  function comprobarEmail() {
    console.log(email);
    if (
      Object.keys(email).some((key) => key !== "emailcc" && email[key] === "")
    ) {
      btnSubmit.classList.add("opacity-50");
      btnSubmit.disabled = true;
    } else {
      btnSubmit.classList.remove("opacity-50");
      btnSubmit.disabled = false;
    }
  }

  function resetFormulario() {
    // Reiniciar el objeto
    email.email = "";
    email.emailcc = "";
    email.asunto = "";
    email.mensaje = "";
    formulario.reset();
    comprobarEmail();
  }
});
