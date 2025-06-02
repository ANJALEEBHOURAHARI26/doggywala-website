@extends('front.layouts.app')
<style>
    .doggy-slider .banner-slide {
    height: 125vh;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 0 15px;
}

.doggy-slider h1 {
    font-size: 3rem;
    font-weight: 700;
}

.doggy-slider p {
    font-size: 1.25rem;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    width: 3rem;
    height: 3rem;
}
.section-0 {
    min-height: 803px;
    background-size: cover;
    background-position: center;
    position: relative;
}

</style>
@section('main')
<section class="section-0 lazy d-flex bg-image-style dark align-items-center" data-bg="{{ asset('assets/images/banner7.png') }}">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
               <h1>
                  <a href="{{ url('/') }}" class="hfe-breadcrumbs-text" style="color:#A8DF8E; text-decoration: none;">Home</a> 
                  <span style="color:white;">/ Blog</span>
                </h1>

            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background-color: #f9fff9;">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold" style="color: #1f2e4d;">Latest Dog Blogs</h2>

    <div class="row g-4">

      <!-- Blog Card 1 -->
      @foreach($blogDetails as $blogDetails)
      <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">        
            <img width="50" src="{{ asset('uploads/blogs/' . $blogDetails->image) }}" class="card-img-top rounded-top-4" alt="Dog Blog">
          <div class="card-body">
            <h5 class="fw-bold">{{$blogDetails->title}}</h5>
           <p class="text-muted small" id="blog-description-{{ $blogDetails->id }}">
              {{ Str::limit($blogDetails->description, 100) }}
              <span class="dots">...</span>
              <span class="more-text" style="display:none;">{{ substr($blogDetails->description, 100) }}</span>
           
              <a href="{{ route('blog.details', $blogDetails->id) }}" class="read-more-btn">
                    Read More <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </p>
 
              
            <span class="badge bg-danger mb-2">Dog Food</span>
            <div class="d-flex align-items-center gap-2 text-muted small">
              <i class="bi bi-person-circle text-primary"></i> {{$blogDetails->user->name}}
              <span class="ms-auto"><i class="bi bi-calendar-date text-primary"></i> {{ \Carbon\Carbon::parse($blogDetails->created_at)->format('d F Y') }}</span>
            </div>
          </div>
        </div>
      </div>
      @endforeach

     
  </div>
</section>


@endsection

<script>
  function toggleReadMore(id) {
    const dots = document.querySelector(`#blog-description-${id} .dots`);
    const moreText = document.querySelector(`#blog-description-${id} .more-text`);
    const btnText = document.getElementById(`readMoreBtn-${id}`);

    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerText = "Read More";
      moreText.style.display = "none";
    } else {
      dots.style.display = "none";
      btnText.innerText = "Read Less";
      moreText.style.display = "inline";
    }
  }
</script>
