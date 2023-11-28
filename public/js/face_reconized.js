const labelWaiting = document.getElementById("label-waiting");
const labelVideoLoading = document.getElementById("label_video_loading");
const alertAnalized = document.getElementById("alert-analized");

const containerPerson = document.getElementById("container-person");
const btnStart = document.getElementById("btn-start");

const video = document.getElementById("video")


function startVideo() {
    navigator.getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);
    navigator.getUserMedia(
        { video: {} },
        stream => {
            video.srcObject = stream;
            labelVideoLoading.style.display = "none";
        },
        err => console.log(err)
    )
}
startVideo();

btnStart.addEventListener("click", async () => { //Iniciar análisis
    clearInfo();
    labelWaiting.style.display = "block";

    const capture = await captureFrame();
    detectFace(capture)
    .then( (data) => {
        const { _label, _distance } = data[0];
        if(_label == "unknown"){ //Deny
            changeTextAlertAnalized("alert alert-danger", "Rechazado");
        }else { //Pass
            const labelRedirect = document.getElementById("label-redirect");
            labelRedirect.textContent = "Redirigido en 3sg";
            changeTextAlertAnalized("alert alert-success", "Aceptado");
            
            setTimeout( ()=> {
                labelRedirect.style.display = "none";
                window.location.href = 'mapas/confirmar';
            }, 3000);
        }
        changeTextContainerPerson(_label);
        labelWaiting.style.display = "none";
    })
    .catch( (error) => {
        console.log(error)
    });
});

function captureFrame() {
    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    return new Promise( (resolve, reject) => {
        canvas.toBlob( (blob) => {
            if(blob)
                resolve(blob);
            else
                reject(new Error("Error al crear el blob desde el canvas"));
        }, 'image/png');
    })
}  

function clearInfo() {
    labelWaiting.style.display = "none";
    alertAnalized.style.display = "none";
    containerPerson.style.display = "none";
}

function changeTextContainerPerson(name) { //Actualizar el nombre de la persona encontrada
    var nameResult = document.getElementById("name-result");
    nameResult.textContent = name;
    containerPerson.style.display = "block";
}

function changeTextAlertAnalized(classname, label) { //Actualizar el mensaje de alerta (aceptado o rechazado)
    var labelResult = document.getElementById("label-result");
    labelResult.textContent = label;
    alertAnalized.className = classname;
    alertAnalized.style.display = "block";
}

async function detectFace(image) {
    const labeledFaceDescriptors = await this.getLabeledFaceDescriptors();

    const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6);

    const img = await faceapi.bufferToImage(image);
    let temp = faceapi.createCanvasFromMedia(img);
    
    const displaySize = { width: img.width, height: img.height };
    faceapi.matchDimensions(temp, displaySize);
    
    const detections = await faceapi.detectAllFaces(img).withFaceLandmarks().withFaceDescriptors(); //Línea de código lenta en procesar
    
    console.log("Detections pass!!!");
    const resizedDetections = faceapi.resizeResults(detections, displaySize);
    const results = resizedDetections.map( d => faceMatcher.findBestMatch(d.descriptor) );
    return results;
}

async function getLabeledFaceDescriptors() {
    const response = await fetch("https://micro-faceapi-ofi.onrender.com/api/faceapi/faces");
    if(!response.ok){
        throw new Error(`Error en la solicitud: ${response.status}`);
    }
    const result = await response.json();
    const resp = result.result;

    let facesData = [];
    for(let i = 0; i < resp.length; i++) {
        const descriptors = [];
        for (let j = 0; j < resp[i].descriptors.length; j++) {
            descriptors.push(new Float32Array(Object.values(resp[i].descriptors[j].face)));
        }
        facesData.push( new faceapi.LabeledFaceDescriptors(resp[i].fullname, descriptors) )
    }
    return facesData;
}