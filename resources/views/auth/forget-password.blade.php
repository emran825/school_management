@extends('auth.layout.login-master')
@section('login-content')

<div class="app-container">
    <div class="h-100">
        <div class="h-100 no-gutters row">
            <div class="d-none d-lg-block col-lg-4">
                <div class="slider-light">
                    <div class="slick-slider">
                        <div>
                            <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                                <div class="slide-img-bg" style="background-image: url({{ asset('assets/theme/assets/images/originals/city.jpg')}}"></div>
                                <div class="slider-content"><h3>Ace Learning Plus Approach</h3>
                                    <p>At the centre, students are taught using conventional paper-based materials. Our students get weekly homework; parents get regular feedback on their child’s performance. Our students have full access to our online tools which will help them practice and improve their mathematical and English skills.</p></div>
                            </div>
                        </div>
                        <div>
                            <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                <div class="slide-img-bg" style="background-image: url({{ asset('assets/theme/assets/images/originals/citynights.jpg')}}"></div>
                                <div class="slider-content"><h3>Reliable tuitions for 11 plus exam</h3>
                                    <p>Your child will have a great time studying with us. The best way to prepare for 11 Plus is to start early and not to miss any class, while we support your child through the 11 Plus exam. As your child study with us, he/she will gain confidence and ability in core maths and English skills.</p></div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                <div class="mx-auto app-login-box col-sm-12 col-md-8 col-lg-6">
                    <div class="app-logo"><img src="{{ asset('assets/images/logo.png')}}" /> </div>
                    <h4>
                        <div>Forgot your Password?</div>
                        <span>Use the form below to recover it.</span></h4>
                    <div>
                        <form class="form-forgot" action="{{url('auth/forget/password')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-row">
                                @if(Session::has('message'))
                                <div class="alert alert-success btn-squared col-md-12" role="alert">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                                @endif
                                @if(Session::has('errormessage'))
                                <div class="alert alert-danger btn-squared  col-md-12" role="alert">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('errormessage') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="position-relative form-group"><label for="exampleEmail" class="">Email</label><input name="email" id="exampleEmail" placeholder="Email here..." type="email" class="form-control"></div>
                                </div>
                            </div>
                            <div class="mt-4 d-flex align-items-center"><h6 class="mb-0"><a href="{{url('/auth/login')}}" class="text-primary">Sign in existing account</a></h6>
                                <div class="ml-auto">
                                    <button class="btn btn-primary btn-lg">Recover Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection