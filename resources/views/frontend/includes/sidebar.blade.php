<div class="col-lg-4">
    <div class="sidebar">
      <div class="row">
        <div class="col-lg-12">
          <div class="sidebar-item search">
            <form id="search_form" name="gs" method="GET" action="#">
              <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
            </form>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="sidebar-item recent-posts">
            <div class="sidebar-heading">
              <h2>Recent Posts</h2>
            </div>
            <div class="content">
              <ul>
                @foreach ($recent_posts as $post)
                <li><a href="{{ route('frontend.single', $post->slug) }}">
                    <h5>{{ $post->title }}</h5>
                    <span>{{ \Carbon\Carbon::parse($post->created_at)->format('M-d-Y') }}</span>
                  </a></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="sidebar-item categories">
            <div class="sidebar-heading">
              <h2>Categories</h2>
            </div>
            <div class="content">
              <ul>
                @foreach ($categories as $category)
                <li><a href="{{ route('frontend.category', $category->slug_name) }}">-{{ $category->category_name }}</a>

                    <ul class="sidebar-subcategory">
                        @foreach ($category->sub_categories as $sub_category)
                        <li><a href="{{ route('frontend.subcategory', [$category->slug_name, $sub_category->slug_name]) }}" class="sidebar-subcategory-list" >{{ $sub_category->sub_category_name }}</a></li>
                        @endforeach
                    </ul>

                </li>
                @endforeach


              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="sidebar-item tags">
            <div class="sidebar-heading">
              <h2>Tag Clouds</h2>
            </div>
            <div class="content">
              <ul>
                @foreach ($tags as $tag)
                <li><a href="{{ route('frontend.tag', $tag->slug_name) }}">{{ $tag->tag_name }}</a></li>
                @endforeach

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
