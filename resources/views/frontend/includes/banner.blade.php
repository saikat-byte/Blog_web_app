<div class="main-banner header-text">
    <div class="container-fluid">
      <div class="owl-banner owl-carousel">

        @foreach ($slider_posts as $slider_post)
        <div class="item">
            <img src="{{asset('image/post/original/'. $slider_post->photo)}}" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>{{ $slider_post->category->category_name }}</span>
                </div>
                <a href="post-details.html"><h4>{{ $slider_post->title }}</h4></a>
                <ul class="post-info">
                  <li><a href="#">{{ $slider_post->user?->name }}</a></li>
                  <li><a href="#">{{ \Carbon\Carbon::parse($slider_post->created_at)->format('M-d-Y') }}</a></li>
                  <li><a href="#">12 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
        @endforeach


      </div>
    </div>
  </div>
