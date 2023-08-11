    
    
    btnPdf = document.getElementById('btn-pdf');

    btnPdf.addEventListener('click', ()=>{
        const containerToPDF = document.getElementById('report-container'); // <-- Aquí puedes elegir cualquier elemento del DOM
        html2pdf()
            .set({
                margin: 1,
                filename: 'reporte.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3, // A mayor escala, mejores gráficos, pero más peso
                    letterRendering: true,
                },
                jsPDF: {
                    unit: "in",
                    format: "a3",
                    orientation: 'portrait' // landscape o portrait
                }
            })
            .from(containerToPDF)
            .toPdf().get('pdf').then( function (pdf){
                window.open(pdf.output('bloburl'), '_blank');
            })
            .catch(err => console.log(err));
    })   