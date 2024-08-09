document.addEventListener('DOMContentLoaded', function() {
    const editFormContainer = document.getElementById('editFormContainer');
    const editForm = document.getElementById('editForm');
    const editId = document.getElementById('editId');
    const editNombre = document.getElementById('editNombre');
    const editGenero = document.getElementById('editGenero');
    const editEdad = document.getElementById('editEdad');
    const editPeliculasfa = document.getElementById('editPeliculasfa');
    const editGénerospe = document.getElementById('editGénerospe');

    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function() {
            editId.value = this.dataset.id;
            editNombre.value = this.dataset.nombre;
            editGenero.value = this.dataset.genero;
            editEdad.value = this.dataset.edad;
            editPeliculasfa.value = this.dataset.peliculasfa;
            editGénerospe.value = this.dataset.génerospe;
            editFormContainer.style.display = 'block';
        });
    });

    editForm.addEventListener('submit', function(e) {
        if (!confirm('¿Está seguro de que desea actualizar este actor?')) {
            e.preventDefault();
        }
    });

    document.querySelectorAll('.deleteForm').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('¿Está seguro de que desea eliminar este actor?')) {
                e.preventDefault();
            }
        });
    });
});
