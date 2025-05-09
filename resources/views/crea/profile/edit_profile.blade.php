@php
$user = \Illuminate\Support\Facades\Auth::user();
@endphp


<div id="EditProfileModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Perfil</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            <form method="POST" action="{{ route('crea.profile.update') }}" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-danger d-none" id="editProfileValidationErrorsBox"></div>
                    <input type="hidden" name="user_id" id="pfUserId">
                    <input type="hidden" name="is_active" value="1">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Nombre:</label><span class="required">*</span>
                            <input type="text" name="name" id="pfName" class="form-control" required autofocus tabindex="1">
                        </div>
                        @if($user->hasRole('admin'))
                        <div class="form-group col-sm-6 d-flex">
                            <div class="col-sm-4 col-md-6 pl-0 form-group">
                                <label>Logo del sistema:</label>
                                <br>
                                <label class="image__file-upload btn btn-primary text-white" tabindex="2"> Elegir
                                    <input type="file" name="logo" id="pfImage" class="d-none">
                                </label>
                            </div>
                            <div class="col-sm-3 preview-image-video-container float-right mt-1">
                            <img src="{{ asset('img/logo.png') }}?v={{ filemtime(public_path('img/logo.png')) }}" width="100">


                            </div>
                        </div>
                        @endif

                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Email:</label><span class="required">*</span>
                            <input type="text" name="email" id="pfEmail" class="form-control" required tabindex="3">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" id="btnPrEditSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing..." tabindex="5">Guardar</button>
                        <button type="button" class="btn btn-light ml-1 edit-cancel-margin margin-left-5"
                            data-dismiss="modal">Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>