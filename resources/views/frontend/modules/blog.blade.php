@extends('frontend.layouts.app')
@section('page_title', $title)

@section('banner')
<div class="heading-page header-text">
    <section class="page-heading">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-content">
                <h4>{{ $sub_title }}</h4>
                <h2>{{ $title }}</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('content')
<section class="blog-posts grid-system">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="all-blog-posts">
            <div class="row">

                @foreach($posts as $post)
                <div class="col-lg-6">
                    <div class="blog-post">
                      <div class="blog-thumb">
                        <img src="{{ asset('image/post/original/'. $post->photo) }}" alt="{{ $post->photo }}">
                      </div>
                      <div class="down-content">
                        <span>{{  $post->category->category_name }} <sub class="text-warning">{{  $post->subCategory?->sub_category_name }} </sub> </span>
                        <a href="{{route('frontend.single', $post->slug)}}"><h4>{{ $post->title }}</h4></a>

                        <div class="post-options">
                             <p>{{ strip_tags(substr($post->description, 0, 150)). '...' }}</p>
                            <div class="row">
                              <div class="col-lg-12">
                                <ul class="post-tags">
                                  <li><i class="fa fa-tags"></i></li>
                                  @foreach( $post->tag as $tag)
                                      <li><a href="{{ route('frontend.tag', $tag->slug_name) }}">{{  $tag->tag_name }}</a>,</li>
                                  @endforeach
                                </ul>
                              </div>
                            </div>
                          </div>
                        <ul class="post-info mb-3">
                          <li><a href="#">{{  $post->user->name }}</a></li>
                          <li><a href="#">{{ \Carbon\Carbon::parse($post->created_at)->format('M-d-Y') }}</a></li>
                          <li><a href="#">12 Comments</a></li>
                        </ul>
                        <a href="{{ route('frontend.single', $post->slug) }}"> <button class="btn btn-primary btn-sm read-more-btn">Readmore</button> </a>
                      </div>
                    </div>
                  </div>
                @endforeach

                @if(count($posts) < 1)
                    <h3 class="text-center text-danger">No post found</h3>
                @endif

              <div class="col-lg-12">
                {{ $posts->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
