  <!-- Modal Create-->
  <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Categoría</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- FORMULARIO --}}
        <form id="form-create" action="{{ route('admin.users.password', auth()->user()) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="modal-body">
                <ul class="list-group mb-3 d-none" id="contentErrorsCreate"></ul>

                <div class="form-group">
                  <label for="password">Contraseña</label>
                  <input 
                      type="password" 
                      name="password" 
                      id="password" 
                      placeholder="Dejar en blanco si no desea cambiar su contraseña."
                      class="form-control">
              </div>
              
              <div class="form-group">
                  <label for="password_confirmation">Repita su Contraseña</label>
                  <input 
                      type="password" 
                      name="password_confirmation" 
                      id="password_confirmation" 
                      placeholder="Repita su contraseña."
                      class="form-control">
              </div> 

            </div>
            
            <div class="modal-footer">
                <button type="close" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
            </div>
         </form>
      </div>
    </div>
  </div>

  @push('script')

  <script>

        const modalCreate = 'modal-create';
        let formCreate = document.getElementById("form-create");
        let contenedorCreate = document.getElementById('contentErrorsCreate');
        

        formCreate.addEventListener('submit', e => {
            e.preventDefault();
            let data = {
                password: formCreate['password'].value,
                password_confirmation: formCreate['password_confirmation'].value
            }
            updatePassword(formCreate.getAttribute('action'), data);
        });

        async function updatePassword(url, data){
            try {
              const config = getConfigFetch('PUT', data)

              const resp = await fetch(url, config);
              const datos = await resp.json();    

              console.log(datos);

              if(datos.success){
                  successAction(datos, modalCreate)
              }else{
                  showErrors(datos.errors, contenedorCreate);
              }

            } catch (error) {
                console.error(error)
            }
        }

        function getConfigFetch(method, data =  null){
            return {
                headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute('content')
                        },
                method: method,
                credentials: "same-origin",
                body: data ? JSON.stringify(data) : null
            }
        }

        function successAction(datos, modal){
            clearInputsModal(modal);
            closeModal(modal);
            showMessageSession(datos);
        }

        function closeModal(modal){
            $(`#${modal}`).modal('hide');
        }

        function clearInputsModal(modal){
            const inputsText = document.querySelectorAll(`#${modal} input[type="password"]`);
            for (let i = 0; i < inputsText.length; i++) {
                inputsText[i].value = '';
            }
        }

        function showErrors(errors, contenedor){
            contenedor.innerHTML = '';

            let li = '';

            for (const propiedad in errors) {
                li += `
                    <li class="list-group-item list-group-item-danger"> <strong>${propiedad}</strong> : ${errors[propiedad]}</li>
                `;
            }

            contenedor.innerHTML += li;
            contenedor.classList.remove('d-none');
        }

        function showMessageSession(datos){

          Swal.fire({
            title: `${datos.title}`,
            text: `${datos.message}`,
            icon: `${datos.icon}`,
            confirmButtonText: 'Cerrar'
          })

        }

        $("#modal-create").on('hidden.bs.modal', function () {
            contenedorCreate.classList.add('d-none');
            clearInputsModal(modalCreate);
        });

      
  </script>

  @endpush