@extends('frontend.layouts.app')
@section('page_title', 'contact us')

@section('banner')
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Feel free to contact us</h4>
                        <h2>Contact us</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('content')
<section class="contact-us">
    <div class="container">
      <div class="row">

        <div class="col-lg-12">
          <div class="down-contact">
            <div class="row">
              <div class="col-lg-8">
                <div class="sidebar-item contact-form">
                    @if(session()->has("success"))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                     </div>
                    @else

                    @endif
                  <div class="sidebar-heading">
                    <h2>Send us a message</h2>
                  </div>
                  <div class="content">
                    <form id="contact" action="{{ route('contact.store') }}" method="post">
                        @csrf
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <input name="name" class="form-control  @error('name') is-invalid @enderror" type="text" value="{{ old('name') }}" id="name" placeholder="Your name">
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="{{ old('email') }}" id="email" placeholder="Your email">
                            @error('email')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <input name="phone" class="form-control  @error('phone') is-invalid @enderror" type="text" value="{{ old('phone') }}" id="phone" placeholder="Your phone">
                            @error('phone')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <input name="subject" class="form-control @error('subject') is-invalid @enderror" type="text" value="{{ old('subject') }}" id="subject" placeholder="Subject">
                            @error('subject')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <textarea name="message" class="form-control col-md-12 col-sm-12 @error('message') is-invalid @enderror" id="message" placeholder="Your Message">{{ old('message') }}</textarea>
                            @error('message')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" id="form-submit" class="main-button">Send Message</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="sidebar-item contact-information">
                  <div class="sidebar-heading">
                    <h2>contact information</h2>
                  </div>
                  <div class="content">
                    <ul>
                      <li>
                        <h5>090-484-8080</h5>
                        <span>PHONE NUMBER</span>
                      </li>
                      <li>
                        <h5>info@company.com</h5>
                        <span>EMAIL ADDRESS</span>
                      </li>
                      <li>
                        <h5>123 Aenean id posuere dui,
                            <br>Praesent laoreet 10660</h5>
                        <span>STREET ADDRESS</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div id="map">
            <iframe src="https://maps.google.com/maps?q=Av.+L%C3%BAcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
