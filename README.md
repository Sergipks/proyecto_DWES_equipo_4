# proyecto_DWES_equipo_4

Funcionalidades mínimas del proyecto Re-Fores-Ta

    Newsletter - Marcos
        Formulario de suscripción al newsletter.
        Validación de campos (filtrado).
        Persistencia en BD (por ejemplo, inserción de flag de "alta en el newsletter" en usuarios).
        Mensaje de suscripción correcta (vista).

    Usuarios - Ken
        Altas de usuarios con validación de campos y persistencia en BD.
        Login de usuarios contra BD.
        Consulta y modificación de usuarios contra BD.
        Cálculo de karma de usuarios.
        El “karma” se calculará sabiendo que proponer una reforestación sumará 4 puntos de karma al usuario, participar en un evento de reforestación sumará 3 puntos, escribir un post en el blog 2 puntos e interactuar con un post 1 punto.

    Eventos - Jorge
        Alta de eventos contra BD.
        Consulta y modificación de eventos contra BD.
        Búsqueda de eventos contra BD.
        Listado de eventos en la página principal con los detalles de los mismos.

    Especies - Sergio
        Resumen de estadísticas de especies empleados en reforestaciones con detalle de las mismas.
        Resumen de estadísticas de cantidad de árboles reforestados por ubicación, fecha y especie.
        Formulario de contacto: solo validación de campos y respuesta de formulario enviado con éxito, sin persistencia ni gestión de correos.
