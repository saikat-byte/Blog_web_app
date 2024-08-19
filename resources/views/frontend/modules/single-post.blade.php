@extends('frontend.layouts.app')
@section('page_title', 'Post Details')

@section('banner')
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>{{ $sub_title }}</h4>
                        <h2>{{ $post_title }}</h2>
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
                        {{-- single post start --}}
                        <div class="col-lg-12">
                            <div class="blog-post">
                                <div class="blog-thumb">
                                    <img src="{{asset('image/post/original/'. $posts->photo)}}"
                                        alt="{{ $posts->photo }}">
                                </div>
                                <div class="down-content">
                                    <span>{{ $posts->category->category_name }} <sub class="text-warning">{{
                                            $posts->subCategory?->sub_category_name }} </sub></span>
                                    <a href="{{route('frontend.single', $posts->slug)}}">
                                        <h4>{{ $posts->title }}</h4>
                                    </a>
                                    <ul class="post-info">
                                        <li><a href="#" >{{ $posts->user?->name }}</a></li>
                                        <li><a href="#">{{ \Carbon\Carbon::parse($posts->created_at)->format('M-d-Y')
                                                }}</a></li>
                                        <li><a href="#">{{ $posts->comment?->count() }} Comments</a></li>
                                        <li><a href="#">{{ $posts->post_read_count?->count }} Read</a></li>
                                    </ul>
                                    <div class="post-description">
                                        <p>
                                            {{ strip_tags($posts->description) }}
                                        </p>
                                    </div>

                                    <div class="post-options">
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-tags"></i></li>
                                                    @foreach($posts->tag as $tag)
                                                    <li><a href="{{ route('frontend.tag', $tag->slug_name) }}">{{
                                                            $tag?->tag_name }}</a>,</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="post-share">
                                                    <li><i class="fa fa-share-alt"></i></li>
                                                    <li><a href="#">Facebook</a>,</li>
                                                    <li><a href="#"> Twitter</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- single post end --}}
                        <div class="col-lg-12">
                            <div class="sidebar-item comments">
                                <div class="sidebar-heading">
                                    <h2>{{ $posts->comment->count() }} comments</h2>
                                </div>
                                <div class="content">
                                    <ul>
                                        @foreach ($posts->comment as $comment)
                                        <li>
                                            <div class="author-thumb">
                                                <img src="{{asset('frontend/assets/images/comment-author-01.jpg')}}" alt="">
                                            </div>
                                            <div class="right-content">
                                                <h4 class="text-capitalize">{{ $comment->user?->name }}<span>{{ \Carbon\Carbon::parse($comment->created_at)->format('M-d-Y') }}</span></h4>
                                                <p>{{ $comment->comment }}</p>
                                                <h4 class="mt-3">Write reply</h4>
                                                <form action="{{ route('comment.store') }}" method="POST">
                                                    @csrf
                                                    <input name="comment"  class="form-control border-1 my-2" placeholder="Write reply">
                                                    <input type="hidden" name="post_id" value="{{ $posts->id }}">
                                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                    <button type="submit" class="btn btn-success comment-btn btn-sm">Reply</button>
                                                </form>
                                            </div>
                                        </li>
                                        @foreach($comment->reply as $reply)
                                        <li class="replied">
                                            <div class="author-thumb">
                                                <img src="{{asset('frontend/assets/images/comment-author-02.jpg')}}" alt="">
                                            </div>
                                            <div class="right-content">
                                                <h4>{{ $reply->user?->name }}<span>{{ \Carbon\Carbon::parse($reply->created_at)->format('M-d-Y') }}</span></h4>
                                                <p>{{ $reply->comment }}</p>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endforeach

                                    </ul>

                                </div>
                            </div>
                        </div>

                        {{-- write comment start --}}
                        <div class="col-lg-12">
                            <div class="sidebar-item submit-comment">
                                <div class="sidebar-heading">
                                    <h2>Your comment</h2>
                                    @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="content">
                                    <form id="comment" action="{{ route('comment.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <input type="hidden" value="{{ $posts->id }}" name="post_id">
                                                <textarea name="comment" rows="6"
                                                    placeholder="Type your comment"></textarea>
                                            </div>
                                            <div class="col-lg-12">
                                                <button type="submit" class="main-button">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- write comment end --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.4/axios.min.js" integrity="sha512-6VJrgykcg/InSIutW2biLwA1Wyq+7bZmMivHw19fI+ycW0jIjsadm8wKQQLlfv3YUS4owfMDlZU38NtaAK6fSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">

        const readCount = () => {
            axios.get(window.location.origin+'/post-count/'+{{ $posts->id }})
        }

        setTimeout(() => {
            readCount();
        }, 10000);
    </script>
@endpush
@endsection
