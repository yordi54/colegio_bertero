<div class="container">
    <label for="" id="csrf" hidden="true">{{ csrf_token() }}</label>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="ratio ratio-16x9">
                <small class="fs-4" id="label_video_loading">Cargando video...</small>
                <video class="embed-responsive-item" id="video" autoplay muted></video>
            </div>
            <div class="video-info text-center p-2">
                <div class="video-info-container">
                    <div class="list-group">
                        
                        <small class="fs-4" id="label-waiting" style="display:none;">Analizando...</small>

                        <div class="" id="alert-analized" role="alert" style="display:none;">
                            <strong class="fs-4" id="label-result">Aceptado</strong>
                        </div>
                        
                        <div class="card" id="container-person" style="display:none;">
                            <strong class="fs-4">Nombre: </strong>
                            <small class="fs-4" id="name-result">Juan Perez Chumacero</small>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary m-2" id="btn-start">Comenzar</button>
                <strong class="fs-6" id="label-redirect"></strong>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/face_reconized.js')}}"></script>