---------------Aplicación para toma de Asistencia de Oficina----------------------------

Saludos, el presente programa se trata de una aplicación web para el control simple de asistencia en oficina,
por ello, lo importante es tener el programa en un servidor, y que sus equipos tengan un buscador común actual
como Chrome, Firefox, entre otros. Y por supuesto, que todos los equipos tengan acceso al servidor.

----------------------------Base de Datos-----------------------------------------------
Las características de la base de datos pueden ser modificadas a gusto propio según la seguridad y forma
de identificar que desee.
Actualmente la conexión a la base de datos está dada por sus datos por defecto:
seridor: "localhost"
usuario: "root"
contraseña: "" (sin contraseña)

y el nombre de la base de datos es: alcalsistance_database debido al origen de creación del programa, puede 
ser modificado, cambiando el nombre de la base de datos junto con el nombre en la conexión, cuya dirección
está en la carpeta partials de este repositorio, con el nombre de: database.php

-------------------------Creación de Administrador--------------------------------------

Para añadir un administrador a la aplicación debe dirigirse hacia el apartado de phpMyAdmin.
Luego deberá dirigirse a la base de datos del programa (alcalsistance_database por defecto),
en la tabla administradores deberá ingresar los datos especificados (nombre, apellido, usuario y contraseña.
El id se añade automáticamente con autoincremento). La contraseña debe ingresarse ya encriptada para que la
comprobación del programa se haga correcta con la encriptación a la hora de iniciar sesión (Si desea usar una
contraseña "123456" debe encriptarla e ingresar la contraseña encriptada en la base de datos, luego a la hora
de iniciar sesión debe ingresar la original: 123456). Para encriptar la contraseña debe ser en formato sha512.

----------------------------Encriptador SHA512------------------------------------------
Para añadir contraseña de administrador el ideal es encriptar primero la contraseña que se desea en sha512,
el resultado encriptado es el que se deberá agregar a la base de datos, mientras que en el programa se debe
iniciar sesión con la contraseña sin encriptar, ya que el proceso se encargará igual de encriptarla para leer
en la base de datos y comparar.

Página para encriptar:
https://coding.tools/es/sha512

----------------------------Registor y Login------------------------------------------
En la pagina inicial (index.php) se encuentran los botones de Ingresar, Administrador y Registrar.
-----------
Registrar te llevará a un formulario para ingresar tus datos o los datos del trabajador que se encargará
de gestionar la asistencia, ingresando: Nombre, Apellido, Nombre de Usuario con que va a ingresar, y la
contraseña junto con su confirmación. El usuario será registrado con exito si se siguen las indicaciones
importantes (nombre de usuario no repetido y contraseña mayor a 5 dígitos).
-----------
Administrador lleva a un formulario de inicio de sesión como administrador (la unica forma de crear un
administrador es como se indica arriba en Creación de Administrador). Luego en ella se encontrará un apartado
de 2 tablas, una para los usuarios registrados, y otra para los trabajadores a los cuales se les tomará el
control de asistencia. Allí pueden modificarse los atributos de los usuarios (exceptuando la contraseña),
puede eliminarse si no se necesia de dicha cuenta, y puede confirmar el uso de la cuenta para mayor seguridad.

    En la tabla de trabajadores igualmente se pueden ver todos los trabajadores registrados (activos), y sus 
    datos, pueden ser modificados y pueden cambiarse su estado de actividad e inactividad (si están Actualmente
    trabajando o se encuentran de vacaciones/reposo/despedidos/retirados/enntre otros).

    Debajo de las tablas se encuentran botones para consultar por filtro a los usuarios y trabajadores según
    los datos que se desean filtrar. También se encuentra el botón para agregar a un nuevo trabajador, que
    lleva a un formulario donde se ingresan los datos del mismo (Nombre, Apellido, Nº Cedula y Puesto de 
    trabajo.). Por ultimo está el botón de inactivos para ver a todos los trabajadores que están inactivos
    en la institución, y así cambiar el estado de la persona que se reincorpore de su situación.
-----------
Ingeesar igualmente lleva a un formulario como el de administrador, pero claramente para los datos de inicio
de usuario encargado de tomar la asistencia. Al iniciar se verá con una tabla con los trabajadores de estado
activo, pero se tomará justamente la asistencia la primera vez que se ingrese sesión de usuario en el día.
    
    Todos los trabajadores activos tendrán el estado de Ausente, pero según ellos lleguen a trabajar se deberá
    "gestionar" la asistencia e ingresar los datos de entrada, al igual que ingresar los de salida cuando deban
    retirarse, además viene con una justificación según se haya incumplido el horario (dejarlo en blanco 
    significará injustificado por defecto aunque no lo muestre en los reportes), al gestionar la asistencia el
    estado cambiará en la tabla principal, y la base de datos será actualizada con la asistencia.

    Al igual que las tablas en administrador, pueden filtrarse los trabajadores cuando uno en específico debe 
    gestionarse y desea agilizar la búsqueda en el caso de haber una gran cantidad de trabajadores activos.

    Por último, está el apartado de reporte, que lleva a un filtrador de fecha con los datos del trabajador a
    revisar. Se debe filtrar la fecha inicio y fecha final que se desea ver de asistencia del trabajador
    (Ejemplo: 2022-01-15 - 2022-01-30 como quincena). Al generar reporte se abrirá una nueva pestaña con el
    reporte de asistencia del trabajador en el rango de fecha indicado.

----------------------------Fecha-----------------------------------------------------
Actualmente el programa está estandarizado para tomar la fecha y hora de la zona de Caracas/Venezuela, pero
puede ser modificada según la zona que se desea usar o región. En el archivo alcalsistance.php en la página 
16 y 17 deben cambiarse los nombre de las variables, y los datos de zona horaria (no se debe cambiar la 
configuración de fecha Y-m-d ya que no se guardará en la base de datos).

------------------------------Detalles-------------------------------------------------
El proyecto fue dedicado a una Alcaldía en el Municipio Libertador de Caracas/Venezuela, y el presupuesto 
no es siquiera cercano para poder implementar un mejor sistema a base de huellas o tarjetas imantadas, sin
embargo puede libremente colaborar o tomar parte del proyecto para mejorarlo como desee. Igualmente se irán
mejorando ciertos detalles sobre el programa, sea para configuraciones generales o un mejor control de las 
cuentas y los trabajadores.

***************************************************************************************
Nota: El responsive está diseñado para 530 px como mínimo para poder ver el contenido de las tablas, si 
piensa revisar la aplicación a través de tablets o smartphones se recomienda verlo en horizontal.
***************************************************************************************

Agradecido con su colaboración, espero les sea de utilidad el programa, para utilización o aprendizaje.
Si desea comunicarse con el desarrollador puede visitar la siguiente página: 
http://portfoliocafv.000webhostapp.com/ 
Allí puede encontrar mis datos de instagram, github, linkedin y whatsapp, y puede contactarme por correo.

Saludos y éxitos.