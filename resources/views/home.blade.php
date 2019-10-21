@extends('layouts.app')

@section('content')
<div class="home">
    <div class="home__hero">
        <img class="home__hero-img img-responsive" src="{{ asset('img/hero-logo.png') }}" />
    </div>

    <div class="home__banner">
        888 S. High St&nbsp;&nbsp;&bull;&nbsp;&nbsp;614-443-4570
    </div>

    <section class="home__wrapper">

        {{-- 3 Icon Section --}}
        <section class="home__section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 home__icon">
                        {{--{!! file_get_contents(base_path('/public/img/icons/circular-clock.svg')) !!}--}}
                        <i class="fa fa-clock-o fa-5x" aria-hidden="true"></i>
                        <div class="home__icon-heading">Hours</div>
                        <div class="home__icon-content">
                            <strong>Monday:</strong> 4pm-11pm<br>
                            <strong>Tue-Thu:</strong> 11am-11pm<br>
                            <strong>Fri & Sat:</strong> 11am-11pm*<br>
                            <em class="text-muted">*bar open until 2am</em><br>
                            <strong>Sun:</strong> 12pm-9pm
                        </div>
                    </div>

                    <div class="col-md-4 home__icon">
                        {{--{!! file_get_contents(base_path('/public/img/icons/beer-1.svg')) !!}--}}
                        <i class="fa fa-beer fa-5x" aria-hidden="true"></i>
                        <div class="home__icon-heading">Happy Hour</div>
                        <div class="home__icon-content">
                            <strong>Monday:</strong> 4pm-6pm<br>
                            <strong>Tue-Fri:</strong> 3pm-6pm<br>
                            <strong>Sunday:</strong> All Day!
                        </div>
                        <div class="home__icon-heading">1/2 Price Pizza</div>
                        <div class="home__icon-content">
                            <strong>Monday:</strong> 4pm-11pm*<br>
                            <em class="home__disclaimer">*dine-in only</em>
                        </div>
                    </div>

                    <div class="col-md-4 home__icon">
                        {{--{!! file_get_contents(base_path('/public/img/icons/pizza-slice.svg')) !!}--}}
                        <i class="fa fa-mobile fa-5x" aria-hidden="true"></i>
                        <div class="home__icon-heading">Carry Out</div>
                        <div class="home__icon-content">
                            All menu items available for carry out during kitchen hours.
                        </div>
                        <div class="home__icon-heading">614-445-8333</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Beer/Food Menu Images --}}
        <section class="container home__section">
            <div class="row center-content">
                <div class="col-md-5 center-content">
                    <div class="home__card-img-wrapper" :class="{ active: showingBeer }">
                        <img class="card-img-top" src="{{ asset('img/beer-glass.png') }}" alt="Glass of beer">
                        <span class="home__card-heading" :class="{ active: showingBeer }" @click="showBeer()">Beer</span>
                    </div>
                </div>

                <div class="col-md-5 offset-md-1">
                    <div class="home__card-img-wrapper" :class="{ active: showingFood }">
                        <img class="card-img-top" src="{{ asset('img/brats-overhead.jpg') }}" alt="Bratwurst entree">
                        <span class="home__card-heading" :class="{ active: showingFood }" @click="showFood()">Food</span>
                    </div>
                </div>
            </div>

            {{-- Food Menu --}}
            <div v-show="showingFood">
                <div class="row">
                    {{-- Food Accordion Menu --}}
                    <div id="food-accordion" class="offset-md-1 col-md-10">
                        @foreach ($food_categories as $category)
                            <div class="card home__menu-card">
                                <div class="card-header cursor-pointer" data-toggle="collapse" data-target="#{{ $category->name }}" aria-expanded="true" @click="toggleActiveFoodCategory('{{ $category->name }}')">
                                    <h5 class="home__menu-heading mb-0">
                                        {{ $category->name }}
                                        <i v-if="foodCategoryIsActive('{{ $category->name }}')" class="fa fa-minus"></i>
                                        <i v-else class="fa fa-plus"></i>
                                    </h5>
                                </div>
                                <div id="{{ $category->name }}" class="collapse">
                                    <div class="card-body">
                                        @if ($category->details)
                                            <div class="p-2 mb-3 text-secondary">
                                                {!! $category->details !!}
                                            </div>
                                        @endif

                                        @foreach($category->dishes ?? [] as $dish)
                                            <div class="card bg-light mb-2">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <h5 class="card-title">{!! $dish->name !!}</h5>
                                                            <p class="card-text">{!! $dish->description !!}</p>
                                                            <h6 class="card-subtitle mb-2 text-muted">{!! $dish->price !!}</h6>
                                                        </div>
                                                        @if ($dish->thumbnailUrl())
                                                            <div class="col-md-3">
                                                                <img class="home__menu-thumbnail pull-right img img-responsive" src="{{ $dish->thumbnailUrl() }}" />
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if ($food_pdf->id ?? false)
                    <div class="row">
                        <div class="offset-md-1 col-md-10 text-md-right">
                            <a href="{{ $food_pdf->getUrl() }}" class="home__pdf-link" target="_blank">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF Menu
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Beer Menu --}}
            <div v-show="showingBeer">
                <div class="row">
                    <div id="beer-accordion" class="offset-md-1 col-md-10">
                        @foreach ($beer_categories as $category)
                            <div class="card home__menu-card">
                                <div class="card-header cursor-pointer" data-toggle="collapse" data-target="#{{ $category->name }}" aria-expanded="true" @click="toggleActiveFoodCategory('{{ $category->name }}')">
                                    <h5 class="home__menu-heading mb-0">
                                        {!! $category->name !!}
                                        <i v-if="foodCategoryIsActive('{{ $category->name }}')" class="fa fa-minus"></i>
                                        <i v-else class="fa fa-plus"></i>
                                    </h5>
                                </div>

                                <div id="{{ $category->name }}" class="collapse">
                                    <div class="card-body">
                                        @if ($category->details)
                                            <div class="p-2 mb-3 text-secondary">
                                                {!! $category->details !!}
                                            </div>
                                        @endif

                                        @foreach($category->beers ?? [] as $beer)
                                            <div class="card bg-light mb-4">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <h5 class="card-title">{!! $beer->name !!}</h5>
                                                            <p class="card-text">{!! $beer->description !!}</p>
                                                        </div>
                                                        @if ($beer->thumbnailUrl())
                                                            <div class="col-md-3">
                                                                <img class="home__menu-thumbnail pull-right img img-responsive" src="{{ $beer->thumbnailUrl() }}" />
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if ($beer_pdf->id ?? false)
                    <div class="row">
                        <div class="offset-md-1 col-md-10 text-md-right">
                            <a href="{{ $beer_pdf->getUrl() }}" class="home__pdf-link" target="_blank">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF Menu
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        {{-- Contact Form --}}
        <section class="home__section home__section--grey" id="contact-form">
            <div class="container col-md-6">
                <div class="row">
                    <div class="container">
                        <h3>Host your next event with us!</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="container">
                        <p>
                            Our <span class="text-green cursor-pointer" data-toggle="modal" data-target="#garten-modal">Bier Garten</span> is the perfect place to host your next party or event. With space for
                            up to 100 guests, our large @if ($party_pdf->id ?? false) <a class="text-green" href="{{ $party_pdf->getUrl() }}" target="_blank">catering menu</a> @else catering menu @endif
                            and dedicated servers will help make your get together one to remember.
                        </p>
                        <p>
                            Give us a call or fill out the form below to speak with one of our planners:
                            <br>
                            <i class="fa fa-mobile fa-2x" aria-hidden="true"></i>&nbsp;<span class="home__phone">614-443-4570</span>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="container">
                        <form class="home__contact" action="{{ route('contact.store') }}" method="POST">
                            <div style="visibility: hidden; height: 0;" aria-hidden="true">
                                <label for="name_h_p_check"></label>
                                <input name="name_h_p_check" type="text" id="name_h_p_check" />
                            </div>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="name">Name*</label><br>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Name"/>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone*</label><br>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="614-443-4570" />
                            </div>
                            <div class="form-group">
                                <label for="date">Date of Event*</label><br>
                                <input type="date" class="form-control" id="date" name="date" />
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label><em class="small">&nbsp;optional</em><br>
                                <textarea class="form-control" id="description" placeholder="Type of event, number guests, etc. (optional)" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                @if (session('flash_message'))
                                    @include('partials.alert')
                                @else
                                    <button type="submit" class="btn btn-green">Contact Us</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Garten Gallery Modal --}}
            <div class="modal fade" id="garten-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- Image Carousel --}}
                            <div id="garten-carousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{ asset('img/garten-osu.jpg') }}" alt="Photograph of full Bier Garten.">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{ asset('img/garten-overhead.jpg') }}" alt="Overhead photograph of Bier Garten.">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{ asset('img/garten-food.jpg') }}" alt="Photograph of party portioned food.">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#garten-carousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#garten-carousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Our History --}}
        <section class="home__section">
            <div class="container col-md-8">
                <div class="col-xs-12">
                    <h2>Our History</h2>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="row">
                            <div class="container text-center">
                                <img class="img img-fluid mx-auto mb-3" src="{{ asset('img/planks-historic.jpg') }}" alt="Historic photograph of Planks Bier Garten" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="container">
                            <p>
                                In 1939, six years after the end of Prohibition, Walter Plank, Sr. saw an opportunity to open a bar and
                                restaurant in his beloved childhood neighborhood. After experiencing years of success, Walter Plank
                                entrusted the bar to his two sons who became the second generation of the family to enter the restaurant business.
                                It was one of those sons, William “Willie” Plank, who dared to expand, and in 1960 purchased a nearby restaurant
                                and began his own legacy with what is now Planks Bier Garten.
                            </p>
                            <p>
                                We are located in the heart of German Village and offer a large outdoor patio, space for groups and gatherings,
                                and a place to experience the beauty and history of one of Columbus’ most historic neighborhoods.
                            </p>
                            <p>
                                Over 50 years and 3 generations later, we are proud to continue serving our friends and family in the neighborhood we love!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
</div>
@endsection

@section('jsEmbed')
    <script>
        var home = new Vue({
            el: '.home',
            data: {
                showingBeer: false,
                showingFood: true,
                activeFoodCategories: []
            },
            methods: {
                showBeer: function() {
                    this.showingBeer = true;
                    this.showingFood  = false;
                },
                showFood: function() {
                    this.showingBeer = false;
                    this.showingFood  = true;
                },
                showNone: function() {
                    this.showingBeer = false;
                    this.showingFood = false;
                },
                toggleActiveFoodCategory: function(category) {
                    var index = this.activeFoodCategories.indexOf(category);
                    if (index === -1) {
                        this.activeFoodCategories.push(category);
                    }
                    else {
                        this.activeFoodCategories.splice(index, 1);
                    }
                },
                foodCategoryIsActive: function(category) {
                    return this.activeFoodCategories.indexOf(category) !== -1;
                },
                toggleAccordionIcon: function(element) {
                    alert(element);
                }
            }
        })
    </script>
@endsection
