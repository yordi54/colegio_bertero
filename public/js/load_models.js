async function loadModels() {
    await Promise.all([
        faceapi.nets.faceRecognitionNet.loadFromUri("../faceapi/models"),
        faceapi.nets.faceLandmark68Net.loadFromUri("../faceapi/models"),
        faceapi.nets.ssdMobilenetv1.loadFromUri("../faceapi/models"),
    ]);
}

loadModels();