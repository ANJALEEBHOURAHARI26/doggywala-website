@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<style>
    .doc-container {
        border: 2px solid #ddd;
        padding: 10px;
        border-radius: 8px;
        background: #f8f9fa;
        overflow: hidden;
        height: 150px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .small-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }

    .doc-preview {
        width: 100%;
        height: 140px;
        border-radius: 8px;
    }

    .file-name {
        font-size: 14px;
        margin-top: 8px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .download-btn {
        margin-top: 5px;
        background-color: #007bff;
        color: white;
        padding: 4px 12px;
        font-size: 13px;
        border-radius: 20px;
        text-decoration: none;
        display: inline-block;
    }

    .download-btn:hover {
        background-color: #0056b3;
        color: white;
        text-decoration: none;
    }

    .container, .container-fluid, .container-login {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        margin-top: -9px;
    }
    
    hr {
    margin-top: 2rem;
    margin-bottom: 1rem;
    border: 2;
    border-top: 3px solid rgb(219 27 26 / 12%);
}
</style>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            <a href="{{ route('document-list') }}" style="text-decoration: none; color: black;">Document/</a>
            <span style="color:black !important; font-weight: 600; font-size: 22px;">View Document</span>
        </h1>
    </div>

    <div class="container py-4">
        <div class="card shadow-lg rounded-lg border-0 p-4">
            <div class="col-lg-12">
                {{-- Display Attachment and Additional Document --}}
                <h5 class="font-weight-bold" style="margin-left: 14px; margin-bottom: 25px;color: #1f39e3 !important;">Details Document</h5>
                @foreach(['attachment' => 'Attachment', 'additional_document' => 'Additional'] as $column => $label)
                    @php 
                        $files = json_decode($projectDetails->$column ?? '[]', true);
                    @endphp
                     
                    @if(is_array($files) && count($files))
                        <div class="col-12 mb-4">
                            <h5 class="font-weight-bold text-dark">{{ $label }} Documents</h5>
                        </div>

                        @php $count = 0; @endphp
                        <div class="row">
                            @foreach($files as $file)
                                @php 
                                    $file_extension = pathinfo($file, PATHINFO_EXTENSION);
                                @endphp

                                <div class="col-md-4 mb-4">
                                    <div class="card border-0 shadow-sm text-center p-2">
                                        <div class="doc-container">
                                            @if(in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset($file) }}" alt="{{ $label }}" class="img-thumbnail small-image mx-auto d-block">
                                            @elseif($file_extension == 'pdf')
                                                <embed src="{{ asset($file) }}" type="application/pdf" class="doc-preview">
                                            @else
                                                <p class="text-danger">Unsupported file format</p>
                                            @endif
                                        </div>
                                        <div class="file-name">{{ $label }} Documents</div>
                                        <a href="{{ asset($file) }}" download class="download-btn">Download</a>
                                    </div>
                                </div>

                                @php $count++; @endphp
                                @if($count % 4 == 0)
                                    </div><div class="row">
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
                 <hr>
             <!-- Display Report Images -->
            @if(count($reportImages))
                <h5 class="font-weight-bold" style="color:#1f39e3 !important;margin-bottom: 19px;">Reports Manage Document</h5>
                <div class="row">
                    @foreach($reportImages as $item)
                        @php 
                            $file = $item['file'];
                            $title = $item['title'];
                            $file_extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm text-center p-2">
                                <div class="doc-container">
                                    @if(in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                                        <img src="{{ asset($file) }}" alt="Report Image" class="img-thumbnail small-image mx-auto d-block">
                                    @elseif($file_extension == 'pdf')
                                        <embed src="{{ asset($file) }}" type="application/pdf" class="doc-preview" width="100%" height="140px">
                                    @elseif(in_array($file_extension, ['mp3', 'wav', 'ogg']))
                                        <audio controls>
                                            <source src="{{ asset($file) }}" type="audio/{{ $file_extension }}">
                                        </audio>
                                    @elseif(in_array($file_extension, ['mp4', 'webm', 'ogg']))
                                        <video controls width="100%" height="140px">
                                            <source src="{{ asset($file) }}" type="video/{{ $file_extension }}">
                                        </video>
                                    @else
                                        <p class="text-danger">Unsupported file format</p>
                                    @endif
                                </div>
                                <div class="file-name">{{ $title }}</div>
                                <a href="{{ asset($file) }}" download class="download-btn">Download</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No report files available.</p>
            @endif
            
             <hr>
            <!-- Display Final Report Files -->
            @if(count($finalReportImages))
                <h5 class="font-weight-bold" style="color:#1f39e3 !important;margin-bottom: 19px;">Final Report Document</h5>
                <div class="row">
                    @foreach($finalReportImages as $item)
                        @php 
                            $file = $item['file'];
                            $title = $item['title'];
                            $file_extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm text-center p-2">
                                <div class="doc-container">
                                    @if(in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                                        <img src="{{ asset($file) }}" alt="Final Report Image" class="img-thumbnail small-image mx-auto d-block">
                                    @elseif($file_extension == 'pdf')
                                        <embed src="{{ asset($file) }}" type="application/pdf" class="doc-preview" width="100%" height="140px">
                                    @elseif(in_array($file_extension, ['mp3', 'wav', 'ogg']))
                                        <audio controls>
                                            <source src="{{ asset($file) }}" type="audio/{{ $file_extension }}">
                                        </audio>
                                    @elseif(in_array($file_extension, ['mp4', 'webm', 'ogg']))
                                        <video controls width="100%" height="140px">
                                            <source src="{{ asset($file) }}" type="video/{{ $file_extension }}">
                                        </video>
                                    @else
                                        <p class="text-danger">Unsupported file format</p>
                                    @endif
                                </div>
                                <div class="file-name">{{ $title }}</div>
                                <a href="{{ asset($file) }}" download class="download-btn">Download</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No final report files available.</p>
            @endif

            </div>

            <div class="card-footer text-right">
                <a href="{{route('document-list')}}" class="btn btn-secondary">Back to Document List</a>
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal -->
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
@include('layouts.footer')
