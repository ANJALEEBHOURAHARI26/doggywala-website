@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<style>
    #pdf-content {
    height: auto !important;
    max-height: none !important;
    overflow: visible !important;
}

#canvas {
    page-break-after: always;
}

.pdf-viewer{
    page-break-after: always;
}

@media print { 
        #canvas {
        page-break-after: always;
    }

    .pdf-viewer{
        page-break-after: always;
    }
}

                                h2 {
                                    text-align: center !important;
                                    margin-bottom: 0px;
                                }
                                h1 {
                                    text-align: center;
                                    font-size: 21px;
                                    margin-top: 41px;
                                    color: #28a2d9;
                                }
                                h5 {
                                    color: #1fb4f7;
                                    text-align: center;
                                }
                                small {
                                    text-align: center;
                                    display: block;
                                    font-size: 16px;
                                }
                                code {
                                    margin-left: 41%;
                                    margin-bottom: 108%;
                                    font-size: 143%;
                                    margin-top: 46%;
                                }
                                pre {
                                    text-align: center;
                                    font-size: 143%;
                                    color: orange;
                                    margin-top: 6%;
                                    font-weight: bold;
                                }
                                blockquote {
                                    text-align: center;
                                    font-size: 123%;
                                    margin-top: 8%;
                                }
                                details {
                                    text-align: center;
                                    font-size: 143%;
                                    color: orange;
                                    margin-top: 6%;
                                    font-weight: bold;
                                }
                            

</style>

<style>
    .pdf-viewer {
        max-width: 100%;
        overflow-x: auto;
    }

    .pdf-viewer canvas {
        width: 100% !important;
        height: auto !important;
        max-width: 793px; /* A4 page width */
        display: block;
        margin: 0 auto;
        page-break-after: always;
    }
</style>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            <a href="{{route('final-report',$finalReports->project_id)}}" style="color:black !important; font-weight: 600; font-size: 28px;">Final Report /</a> <span style="color:black !important; font-weight: 600; font-size: 22px;">View Final Report</span>
        </h1>
    </div>

    <div class="row justify-content-center ">
        <div class="col-md-12">
            <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header text-white" style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none; font-size: 20px; font-weight: bold;">
                    Final Report Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Date</h6>
                                <p class="mb-20">{{$finalReports->date->format('F d Y') ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Title</h6>
                                <p class="mb-20">{{$finalReports->title ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-group">
                                <h6>Remark</h6>
                                <p class="mb-20">{{$finalReports->remark ?? 'N/A' }}</p>
                            </div>
                        </div>
                       
                       @if(session('selected_case_type') == 'Testing')
                        <div class="detail-group">
                            <h6>Description</h6>
                            <p class="mb-20"></p>
                            <div id="pdf-content" style="border: 1px solid black; height: auto; overflow-y: auto; padding: 10px; background: #f9f9f9;">
                                {!! $finalReports->description !!}
                                
                                </br>
                                @php
                                    $files = json_decode($finalReports->report_one, true);
                                @endphp
                        
                                @if (!empty($files))
                                    @foreach ($files as $file)
                                        @php
                                            $filePath = asset(ltrim($file, '/'));
                                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                        @endphp
                        
                                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                                            <img src="{{ $filePath }}" class="img-fluid mt-2 pdf-pages" style="max-width: 100%; height: auto; display: block; margin: auto;">
                                        
                                        @elseif ($fileExtension == 'pdf')
                                            <div class="pdf-viewer mt-2" style="page-break-before:always;" data-pdf="{{ $filePath }}"></div>
                        
                                        @elseif (in_array($fileExtension, ['doc', 'docx']))
                                            <p><a href="{{ $filePath }}" target="_blank" class="btn btn-info">View Document</a></p>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        
                              <button id="downloadBtn" class="btn btn-primary d-block mx-auto mt-2">
                                Download Final Report (PDF)
                            </button>

                        </div>
                        
                        <!-- JS Libraries -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
                        <script>
                            document.getElementById('downloadBtn').addEventListener('click', function () {
                            
                                const button = this;
                                button.disabled = true;
                                button.innerText = 'Downloading...';
                            
                                fetch("{{ route('download.final.report', $finalReports->id) }}", {
                                    method: 'GET',
                                    headers: {
                                        'Accept': 'application/pdf',
                                    }
                                })
                                .then(response => response.blob())
                                .then(blob => {
                                    const url = window.URL.createObjectURL(blob);
                                    const a = document.createElement('a');
                                    a.href = url;
                                    a.download = "{{ $finalReports->title }}.pdf";
                                    document.body.appendChild(a);
                                    a.click();
                                    a.remove();
                                    window.URL.revokeObjectURL(url);
                                    button.disabled = false;
                                    button.innerText = 'Download Final Report (PDF)';
                                })
                                .catch(error => {
                                    console.error('Download failed:', error);
                                    button.disabled = false;
                                    button.innerText = 'Download Final Report (PDF)';
                                    alert('Download failed. Please try again.');
                                });
                            });
                            </script>

                        <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            document.querySelectorAll(".pdf-viewer").forEach(function (viewer) {
                                    let pdfUrl = viewer.getAttribute("data-pdf");
                            
                                    pdfjsLib.getDocument(pdfUrl).promise.then(doc => {
                                        let totalPages = doc.numPages;
                            
                                        for (let i = 1; i <= totalPages; i++) {
                                            doc.getPage(i).then(page => {
                                                let viewport = page.getViewport({ scale: 1.5 });
                                                let canvas = document.createElement("canvas");
                                                let context = canvas.getContext("2d");
                            
                                                canvas.width = viewport.width;
                                                canvas.height = viewport.height;
                                                viewer.appendChild(canvas);
                            
                                                let renderTask = page.render({ canvasContext: context, viewport: viewport });
                                                renderTask.promise.then(() => {
                                                    console.log("Page rendered:", i);
                                                });
                                            });
                                        }
                                    }).catch(error => {
                                        console.error("Error loading PDF:", error);
                                    });
                                });
                            });
                            
                            document.getElementById('download-pdf').addEventListener('click', function () {
                                const { jsPDF } = window.jspdf;
                                const pdf = new jsPDF('p', 'mm', 'a4');
                                let contentElement = document.getElementById("pdf-content");
                            
                                document.getElementById('download-text').textContent = "Downloading...";
                                document.getElementById('download-loader').classList.remove('d-none');
                            
                                html2canvas(contentElement, { scale: 2 }).then(canvas => {
                                    const imgData = canvas.toDataURL('image/png');
                                    let imgWidth = 190; 
                                    let imgHeight = (canvas.height * imgWidth) / canvas.width;
                                    let pageHeight = 280;
                                    let position = 10;
                                    let heightLeft = imgHeight;
                                    let y = 0;
                            
                                    while (heightLeft > 0) {
                                        let canvasSplit = document.createElement('canvas');
                                        let splitHeight = Math.min(heightLeft, pageHeight) * (canvas.width / imgWidth);
                                        canvasSplit.width = canvas.width;
                                        canvasSplit.height = splitHeight;
                                        
                                        let ctx = canvasSplit.getContext('2d');
                                        ctx.drawImage(canvas, 0, y, canvas.width, splitHeight, 0, 0, canvas.width, splitHeight);
                                        
                                        let splitImg = canvasSplit.toDataURL('image/png');
                                        
                                        if (y > 0) pdf.addPage();
                                        pdf.addImage(splitImg, 'PNG', 10, position, imgWidth, (splitHeight * imgWidth) / canvas.width);
                                        
                                        y += splitHeight;
                                        heightLeft -= pageHeight;
                                    }
                            
                                    addImagesToPDF(pdf);
                                });
                            });
                            
                            function addImagesToPDF(pdf) {
                                let imageElements = document.querySelectorAll('.pdf-pages');
                                let index = 0;
                            
                                function processNextImage() {
                                    if (index >= imageElements.length) {
                                        pdf.save('Final_Report.pdf');
                                        resetDownloadButton();
                                        return;
                                    }
                            
                                    let imgElement = imageElements[index];
                                    html2canvas(imgElement, { scale: 2 }).then(imgCanvas => {
                                        let imgData2 = imgCanvas.toDataURL('image/png');
                                        let imgW = 190;
                                        let imgH = (imgCanvas.height * imgW) / imgCanvas.width;
                                        pdf.addPage();
                                        pdf.addImage(imgData2, 'PNG', 10, 10, imgW, imgH);
                                        index++;
                                        processNextImage();
                                    });
                                }
                                processNextImage();
                            }
                            
                            function resetDownloadButton() {
                                document.getElementById('download-text').classList.remove('d-none');
                                document.getElementById('download-loader').classList.add('d-none');
                            }
                        </script>

                       @elseif(session('selected_case_type') == 'Abatement/Miscellaneous')
                        <div class="detail-group">
                            <h6>Description</h6>
                        
                            <div id="pdf-content" style="max-height: 500px; overflow-y: auto; padding: 10px; border: 1px solid #ddd;">
                                <p id="report-description">
                                    {{ str_replace('&nbsp;', ' ', html_entity_decode(strip_tags($finalReports->description))) }}
                                </p>
                        
                                @php
                                    $files = json_decode($finalReports->report_one, true);
                                @endphp
                        
                                @if (!empty($files))
                                    @foreach ($files as $file)
                                        @php
                                            if (strpos($file, 'uploads/finalReport/') !== false) {
                                                $filePath = asset($file);
                                            } else {
                                                $filePath = asset('uploads/finalReport/' . $file);
                                            }
                                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                        @endphp
                        
                                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                                            <img src="{{ $filePath }}" class="img-fluid mt-2 pdf-pages"
                                                 style="max-width: 100%; height: auto; display: block; margin: auto;">
                        
                                        @elseif ($fileExtension == 'pdf')
                                            <div class="pdf-viewer mt-2" data-pdf="{{ $filePath }}"></div>
                        
                                        @elseif (in_array($fileExtension, ['doc', 'docx']))
                                            <p><a href="{{ $filePath }}" target="_blank" class="btn btn-info">View Document</a></p>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        
                            <h5 class="text-center mt-2">Final Report</h5>
                            <button id="download-pdf" class="btn btn-primary d-block mx-auto mt-2">
                                Download Full Report
                            </button>
                        </div>
                        
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
                        
                        <script>
                            document.querySelectorAll('.pdf-viewer').forEach(container => {
                                const pdfUrl = container.getAttribute('data-pdf');
                        
                                pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
                                    for (let i = 1; i <= pdf.numPages; i++) {
                                        pdf.getPage(i).then(page => {
                                            const canvas = document.createElement('canvas');
                                            const context = canvas.getContext('2d');
                        
                                            const viewport = page.getViewport({ scale: 1.5 }); 
                                            canvas.height = viewport.height;
                                            canvas.width = viewport.width;
                        
                                            container.appendChild(canvas);
                                            canvas.classList.add("pdf-pages");
                        
                                            page.render({ canvasContext: context, viewport: viewport });
                                        });
                                    }
                                }).catch(error => {
                                    console.error("PDF Load Error:", error);
                                });
                            });
                        
                            document.getElementById('download-pdf').addEventListener('click', function () {
                                const button = this;
                                button.disabled = true;
                                button.innerHTML = 'Downloading... <span class="spinner-border spinner-border-sm"></span>';
                        
                                const { jsPDF } = window.jspdf;
                                const pdf = new jsPDF('p', 'mm', 'a4');
                        
                                let description = document.getElementById("report-description").innerText;
                                pdf.setFontSize(12);
                                let marginLeft = 10;
                                let marginTop = 20;
                                let maxWidth = 190;
                                let lineHeight = 8;
                        
                                let lines = pdf.splitTextToSize(description, maxWidth);
                                lines.forEach((line, index) => {
                                    pdf.text(line, marginLeft, marginTop + (index * lineHeight));
                                });
                        
                                let elements = document.querySelectorAll('.pdf-pages');
                        
                                function addNextImage(index) {
                                    if (index >= elements.length) {
                                        pdf.save('Final_Report.pdf');
                                        button.innerHTML = 'Download Full Report';
                                        button.disabled = false;
                                        return;
                                    }
                        
                                    html2canvas(elements[index], { scale: 2 }).then(canvas => {
                                        const imgData = canvas.toDataURL('image/png');
                        
                                        let imgWidth = 200;
                                        let imgHeight = (canvas.height * imgWidth) / canvas.width;
                        
                                        if (index > 0) {
                                            pdf.addPage();
                                        } else {
                                            pdf.addPage();
                                        }
                                        pdf.addImage(imgData, 'PNG', 5, 20, imgWidth, imgHeight);
                        
                                        addNextImage(index + 1);
                                    });
                                }
                        
                                addNextImage(0);
                            });
                        </script>
                    @else
                    <div class="detail-group">
                            <h6>Description</h6>
                            <p class="mb-20"></p>
                            <div id="pdf-content" style="border: 1px solid black; height: auto; overflow-y: auto; padding: 10px; background: #f9f9f9;">
                                {!! $finalReports->description !!}
                                
                                </br>
                                @php
                                    $files = json_decode($finalReports->report_one, true);
                                @endphp
                        
                                @if (!empty($files))
                                    @foreach ($files as $file)
                                        @php
                                            $filePath = asset(ltrim($file, '/'));
                                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                        @endphp
                        
                                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                                            <img src="{{ $filePath }}" class="img-fluid mt-2 pdf-pages" style="max-width: 100%; height: auto; display: block; margin: auto;">
                                        
                                        @elseif ($fileExtension == 'pdf')
                                            <div class="pdf-viewer mt-2" style="page-break-before:always;" data-pdf="{{ $filePath }}"></div>
                        
                                        @elseif (in_array($fileExtension, ['doc', 'docx']))
                                            <p><a href="{{ $filePath }}" target="_blank" class="btn btn-info">View Document</a></p>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        
                              <button id="downloadBtn" class="btn btn-primary d-block mx-auto mt-2">
                                Download Final Report (PDF)
                            </button>

                        </div>
                        
                        <!-- JS Libraries -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
                        <script>
                            document.getElementById('downloadBtn').addEventListener('click', function () {
                                   
                                const button = this;
                                button.disabled = true;
                                button.innerText = 'Downloading...';
                            
                                fetch("{{ route('download.final.report', $finalReports->id) }}", {
                                    method: 'GET',
                                    headers: {
                                        'Accept': 'application/pdf',
                                    }
                                })
                                .then(response => response.blob())
                                .then(blob => {
                                    const url = window.URL.createObjectURL(blob);
                                    const a = document.createElement('a');
                                    a.href = url;
                                   a.download = "{{ $finalReports->title }}.pdf";
                                    document.body.appendChild(a);
                                    a.click();
                                    a.remove();
                                    window.URL.revokeObjectURL(url);
                                    button.disabled = false;
                                    button.innerText = 'Download Final Report (PDF)';
                                })
                                .catch(error => {
                                    console.error('Download failed:', error);
                                    button.disabled = false;
                                    button.innerText = 'Download Final Report (PDF)';
                                    alert('Download failed. Please try again.');
                                });
                            });
                            </script>

                        <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            document.querySelectorAll(".pdf-viewer").forEach(function (viewer) {
                                    let pdfUrl = viewer.getAttribute("data-pdf");
                            
                                    pdfjsLib.getDocument(pdfUrl).promise.then(doc => {
                                        let totalPages = doc.numPages;
                            
                                        for (let i = 1; i <= totalPages; i++) {
                                            doc.getPage(i).then(page => {
                                                let viewport = page.getViewport({ scale: 1.5 });
                                                let canvas = document.createElement("canvas");
                                                let context = canvas.getContext("2d");
                            
                                                canvas.width = viewport.width;
                                                canvas.height = viewport.height;
                                                viewer.appendChild(canvas);
                            
                                                let renderTask = page.render({ canvasContext: context, viewport: viewport });
                                                renderTask.promise.then(() => {
                                                    console.log("Page rendered:", i);
                                                });
                                            });
                                        }
                                    }).catch(error => {
                                        console.error("Error loading PDF:", error);
                                    });
                                });
                            });
                            
                            document.getElementById('download-pdf').addEventListener('click', function () {
                                const { jsPDF } = window.jspdf;
                                const pdf = new jsPDF('p', 'mm', 'a4');
                                let contentElement = document.getElementById("pdf-content");
                            
                                document.getElementById('download-text').textContent = "Downloading...";
                                document.getElementById('download-loader').classList.remove('d-none');
                            
                                html2canvas(contentElement, { scale: 2 }).then(canvas => {
                                    const imgData = canvas.toDataURL('image/png');
                                    let imgWidth = 190; 
                                    let imgHeight = (canvas.height * imgWidth) / canvas.width;
                                    let pageHeight = 280;
                                    let position = 10;
                                    let heightLeft = imgHeight;
                                    let y = 0;
                            
                                    while (heightLeft > 0) {
                                        let canvasSplit = document.createElement('canvas');
                                        let splitHeight = Math.min(heightLeft, pageHeight) * (canvas.width / imgWidth);
                                        canvasSplit.width = canvas.width;
                                        canvasSplit.height = splitHeight;
                                        
                                        let ctx = canvasSplit.getContext('2d');
                                        ctx.drawImage(canvas, 0, y, canvas.width, splitHeight, 0, 0, canvas.width, splitHeight);
                                        
                                        let splitImg = canvasSplit.toDataURL('image/png');
                                        
                                        if (y > 0) pdf.addPage();
                                        pdf.addImage(splitImg, 'PNG', 10, position, imgWidth, (splitHeight * imgWidth) / canvas.width);
                                        
                                        y += splitHeight;
                                        heightLeft -= pageHeight;
                                    }
                            
                                    addImagesToPDF(pdf);
                                });
                            });
                            
                            function addImagesToPDF(pdf) {
                                let imageElements = document.querySelectorAll('.pdf-pages');
                                let index = 0;
                            
                                function processNextImage() {
                                    if (index >= imageElements.length) {
                                        pdf.save('Final_Report.pdf');
                                        resetDownloadButton();
                                        return;
                                    }
                            
                                    let imgElement = imageElements[index];
                                    html2canvas(imgElement, { scale: 2 }).then(imgCanvas => {
                                        let imgData2 = imgCanvas.toDataURL('image/png');
                                        let imgW = 190;
                                        let imgH = (imgCanvas.height * imgW) / imgCanvas.width;
                                        pdf.addPage();
                                        pdf.addImage(imgData2, 'PNG', 10, 10, imgW, imgH);
                                        index++;
                                        processNextImage();
                                    });
                                }
                                processNextImage();
                            }
                            
                            function resetDownloadButton() {
                                document.getElementById('download-text').classList.remove('d-none');
                                document.getElementById('download-loader').classList.add('d-none');
                            }
                        </script>

                     @endif
                </div>

                <div class="card-footer text-right">
                    <a href="{{route('final-report',$finalReports->project_id)}}" class="btn btn-secondary">Back to Final Report</a>
                </div>
            </div>
            
            <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <form action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
</div>
</div>
@include('layouts.footer')
