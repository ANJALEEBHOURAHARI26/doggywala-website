<!DOCTYPE html>
<html lang="en">
    @php
        $settings = DB::table('general_setting')->first();
        
    @endphp
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ asset($settings->favicon ?? 'assets/img/applogo.png') }}" rel="icon">
  <title>{{ $settings->company_name ?? 'Abatement Solutions LLC' }} - Dashboard</title>
  <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/css/ruang-admin.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
   <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
   <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>


<!-- jQuery (Required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>




<style>
.container-fluid {
    height: calc(100vh - 60px); /* 60px = navbar height */
    overflow-y: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
    padding-top: 70px;
}

.container-fluid::-webkit-scrollbar {
  display: none;
}
input[type="checkbox"]:checked {
    accent-color: #D84055;
}
</style>
</head>

<body id="page-top">
    
  <div id="wrapper">