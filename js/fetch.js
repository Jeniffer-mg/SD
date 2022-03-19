const tabla = document.querySelector('#lista-usuarios tbody');
function cargarUsuario(){
    fetch('juegos.json')
    .then(respuesta => respuesta.json())//indica el formato en que se desea obtener la informacion
    .then(usuarios => {
        usuarios.forEach(usuario => {
            const row = document.createElement('tr');
            row.innerHTML += `
            <td>${usuario.id_juego}</td>
            <td>${usuario.nombre_juego}</td>
            <td>${usuario.fecha_lanzamiento}</td>
            <td>${usuario.descripcion}</td>
            `;   
            tabla.appendChild(row);       
          
        });
    })
    .catch(error=> console.log('Hubo un error:' + error.message))
}
cargarUsuario();