async function uploadLabelAndDescriptors(data, images) { //Gardar descriptores a firestores
    try {
        const descriptors = await getDescriptors(images);
        
        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
        
        const raw = JSON.stringify({
            "fullname": data.fullname,
            "telefono": data.telefono,
            "direccion": data.direccion,
            "sexo": data.sexo,
            "descriptors": descriptors
        });

        var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: raw
        };
        
        const response = await fetch("https://micro-faceapi-ofi.onrender.com/api/faceapi/create-face", requestOptions);
        if(!response.ok){
            throw new Error(`Error en la solicitud: ${response.status}`);
        }
        const result = await response.json();
        console.log(result);
    } catch (error) {
        console.log(error);
    }

}

async function uploadLabelAndDescriptorsByUrl(data) {
    const { url_photo, ...datas } = data;
    const response = await fetch(url_photo);
    if(!response.ok){
        throw new Error("Error en la solicitud: " + response.status);
    }
    const blob = await response.blob();
    await uploadLabelAndDescriptors(datas, [blob]);
}

async function urlToBlob(url) {
    const response = await fetch(url);
    const blob = await response.blob();

    // Crear un objeto File a partir del blob
    const fileName = url.substring(url.lastIndexOf('/') + 1);
    const file = new File([blob], fileName, { type: blob.type });

    return file;
}

async function getDescriptors(images) {
    try {
        let counter = 0;
        const descriptions = [];

        for (let i = 0; i < images.length; i++) {
            const img = await faceapi.bufferToImage(images[i]);
            counter = (i / images.length) * 100;
            console.log(`Progress = ${counter}%`);

            const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
            descriptions.push({
                "face": Array.from(detections.descriptor)
            });
        }
        return descriptions;
    } catch (error) {
        console.log(error);
        return (error);
    }
}