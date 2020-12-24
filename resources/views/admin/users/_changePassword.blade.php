  <!-- Modal Create-->
  <div class="modal fade" id="modal-change-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Categoría</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- FORMULARIO --}}
        <form id="form-change-password" action="{{ route('admin.users.password', auth()->user()) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="modal-body">
                <ul class="list-group mb-3 d-none" id="contentErrors"></ul>

                <div class="form-group">
                  <label for="password">Contraseña</label>
                  <input 
                      type="password" 
                      name="password" 
                      placeholder="Dejar en blanco si no desea cambiar su contraseña."
                      class="form-control">
              </div>
              
              <div class="form-group">
                  <label for="password_confirmation">Repita su Contraseña</label>
                  <input 
                      type="password" 
                      name="password_confirmation" 
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

        const modalChangePassword = 'modal-change-password';
        let formChangePassword = document.getElementById("form-change-password");
        let contenedorErrores = document.getElementById('contentErrors');
        

        formChangePassword.addEventListener('submit', e => {
            e.preventDefault();
            let data = {
                password: formChangePassword['password'].value,
                password_confirmation: formChangePassword['password_confirmation'].value
            }
            updatePassword(formChangePassword.getAttribute('action'), data);
        });

        async function updatePassword(url, data){
            try {
              const config = getConfigFetch('PUT', data)

              const resp = await fetch(url, config);
              const datos = await resp.json();    

              console.log(datos);

              if(datos.success){
                  successAction(datos, modalChangePassword)
              }else{
                  showErrors(datos.errors, contenedorErrores);
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

        $("#modal-change-password").on('hidden.bs.modal', function () {
            contenedorErrores.classList.add('d-none');
            clearInputsModal(modalChangePassword);
        });

      
  </script>

  @endpush