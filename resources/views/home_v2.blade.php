@extends('layouts.app')

@section('content')
    <div class="home">
        <section class="home__banner --section">
            <div class="home__logoCircle">
                <h1 class="home__logo">
                    Planks<br>Bier<br>Garten
                </h1>
                <p class="home__subtitle">German Village, Ohio</p>
            </div>
        </section>

        <section class="home__info --section --container">
            <div class="home__infoSection">
                <h4 class="home__icon">Dine-in</h4>
                <p class="home__infoCaption">
                    <strong>Mon-Sat:</strong> 11am-11pm<br>
                    <strong>Sunday:</strong> 12pm-9pm
                </p>
            </div>
            <div class="home__infoSection">
                <h4 class="home__icon">Carryout</h4>
                <p class="home__infoCaption">
                    Available during business hours<br>
                    <strong>614.445.8333</strong>
                </p>
            </div>
            <div class="home__infoSection">
                <h4 class="home__icon">Trivia</h4>
                <p class="home__infoCaption">
                    Join us Wednesday for bar trivia!<br>
                    Starts at 7:30pm
                </p>
            </div>
        </section>

        <section class="home__imageButtons --container">
            <div class="home__image" :class="{ '--active': showingFood }" @click="showFood">
                <img class="img img-fluid" src="{{ asset('img/brats-overhead.jpg') }}" alt="Bratwurst entree">
                <span class="home__imageButton">Food</span>
            </div>
            <div class="home__image --hiddenMobile" :class="{ '--active': showingBeer }" @click="showBeer">
                <img class="img img-fluid" src="{{ asset('img/beer-glass.png') }}" alt="Glass of beer">
                <span class="home__imageButton">Beer</span>
            </div>
        </section>

        <section class="home__menu --section --container">
            @foreach ($food_categories as $category)
                <div class="home__menuCategory" v-show="showingFood">
                    <h2 class="home__menuHeading" @click="toggleActiveFoodCategory('{{ $category->name }}')">
                        {{ $category->name }}
                        <i class="fa" :class="[foodCategoryIsActive('{{ $category->name }}') ? 'fa-minus' : 'fa-plus']"></i>
                    </h2>
                    <transition name="expand" @enter="enter" @after-enter="afterEnter" @leave="leave">
                        <div>
                            @if ($category->details)
                                <div v-show="foodCategoryIsActive('{{ $category->name }}')">
                                    <p class="home__menuCategoryDescription">
                                        {!! $category->details !!}
                                    </p>
                                </div>
                            @endif

                            <div class="home__menuItems" v-show="foodCategoryIsActive('{{ $category->name }}')">
                                @foreach($category->dishes ?? [] as $dish)
                                    <div class="menuItem">
                                        <h6 class="menuItem__heading">{{ $dish->name }}</h6>
                                        <p class="menuItem__description">{{ $dish->description }}</p>
                                        <p class="menuItem__price">{{ $dish->price }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </transition>
                </div>
            @endforeach

            @foreach ($beer_categories as $category)
                <div class="home__menuCategory" v-show="showingBeer">
                    <h2 class="home__menuHeading" @click="toggleActiveFoodCategory('{{ $category->name }}')">
                        {{ $category->name }}
                        <i class="fa" :class="[foodCategoryIsActive('{{ $category->name }}') ? 'fa-minus' : 'fa-plus']"></i>
                    </h2>
                    <transition name="expand" @enter="enter" @after-enter="afterEnter" @leave="leave">
                        <div class="home__menuItems" v-show="foodCategoryIsActive('{{ $category->name }}')">
                            @foreach($category->beers ?? [] as $beer)
                                <div class="menuItem">
                                    <h6 class="menuItem__heading">{{ $beer->name }}</h6>
                                    <p class="menuItem__description">{{ $beer->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </transition>
                </div>
            @endforeach
        </section>

        <section class="home__contact --section" id="contact-form">
            <div class="home__contactContent --container">
                <h1 class="home__contactHeading">Our History</h1>
                <div style="font-weight: 500;">
                    <p>
                        In 1939, shortly after the end of Prohibition, Walter Plank, Sr. saw an opportunity to open a bar in his beloved childhood neighborhood.
                        Walter Plank later entrusted the bar to his two sons, and it was one of those sons, William “Willie” Plank who purchased a nearby
                        restaurant in 1960 and began his own legacy with Planks Bier Garten.
                    </p>
                    <p>
                        Located in the heart of German Village, Planks offers an outdoor patio, large space for groups, and a place to experience
                        the beauty of one of Columbus’ most historic neighborhoods.
                    </p>

                    {{-- This is the old contact form. leaving it here in case things change with party bookings --}}
{{--                    <p>--}}
{{--                        Give us a call or fill out the form below to speak with one of our planners abour renting--}}
{{--                        our large Bier Garten with space for up to 100 guests!  --}}
{{--                        <strong>614.443.4570</strong>--}}
{{--                    </p>--}}
{{--                    <form class="home__contactForm" action="{{ route('contact.store') }}" method="POST" style="position: relative;">--}}
{{--                        --}}{{-- Start Coronavirus Form Blocker!!! --}}
{{--                            <div style="position: absolute; top: 0; left: 0; height: 103%; width: 103%; background: rgba(245, 245, 245, 0.9); display: flex; justify-content: center; align-items: center; margin-left: -1.5%; margin-top: -1.5%; color: #d46439; font-weight: bold; border-radius: 4px; padding: 0 12px;">--}}
{{--                                Due to evolving Coronavirus restrictions, we are unable to reliably book large groups at this time.--}}
{{--                            </div>--}}
{{--                        --}}{{-- End Coronavirus Form Blocker!!! --}}
{{--                        <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                        <div class="home__formGroup">--}}
{{--                            <input type="text" class="form-control bg-offwhite" name="name" placeholder="Name" required />--}}
{{--                            <input type="text" class="form-control bg-offwhite" name="phone" placeholder="Phone" required />--}}
{{--                            <input type="date" class="form-control bg-offwhite" name="date" placeholder="Date" required />--}}
{{--                        </div>--}}
{{--                        <div class="home__formGroup --description">--}}
{{--                            <textarea class="form-control bg-offwhite" name="description" placeholder="Number guests, type of event, etc."></textarea>--}}
{{--                            @if (session('flash_status') && session('flash_status') === 'success')--}}
{{--                                <button type="button" class="btn btn-success home__contactSubmit" disabled>Message received!</button>--}}
{{--                            @else--}}
{{--                                <button type="submit" class="btn btn-success home__contactSubmit">Contact Us!</button>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <span style="visibility: hidden; height: 0; margin: 0; padding: 0;" aria-hidden="true">--}}
{{--                            <label for="name_h_p_check"></label>--}}
{{--                            <input name="name_h_p_check" type="text" id="name_h_p_check" />--}}
{{--                        </span>--}}
{{--                    </form>--}}
{{--                    @if (session('flash_status') && session('flash_status') === 'danger')--}}
{{--                        <p style="border-top: 1px solid #fff; padding-top: 12px; margin-top: 12px;">--}}
{{--                            <i class="fa fa-warning"></i>--}}
{{--                            Something went wrong. Please try again or contact us directly at--}}
{{--                            <strong>614.443.4570</strong> if this problem persists.--}}
{{--                        </p>--}}
{{--                    @endif--}}
                </div>
            </div>
        </section>

        <section class="home__about --section --container">
{{--            <div>--}}
{{--                <img class="img img-fluid mx-auto mb-3" src="{{ asset('img/planks-historic.jpg') }}" alt="Historic photograph of Planks Bier Garten" />--}}
{{--            </div>--}}
            <div>
{{--                <p>--}}
{{--                    Over 60 years and 3 generations later, we are proud to continue serving our friends and family in the neighborhood we love!--}}
{{--                </p>--}}
{{--                <p>--}}
{{--                    In 1939, shortly after the end of Prohibition, Walter Plank, Sr. saw an opportunity to open a bar in his beloved childhood neighborhood.--}}
{{--                    Walter Plank later entrusted the bar to his two sons, and it was one of those sons, William “Willie” Plank who purchased a nearby--}}
{{--                    restaurant in 1960 and began his own legacy with Planks Bier Garten.--}}
{{--                </p>--}}
{{--                <p>--}}
{{--                    Located in the heart of German Village, Planks offers an outdoor patio, large space for groups, and a place to experience--}}
{{--                    the beauty of one of Columbus’ most historic neighborhoods.--}}
{{--                </p>--}}
                <p>
                    Over 60 years and 3 generations later, we are proud to continue serving our friends and family in the neighborhood we love!
                </p>
            </div>
            <div>
                <img class="img img-fluid mx-auto mb-3" src="{{ asset('img/planks-historic.jpg') }}" alt="Historic photograph of Planks Bier Garten" />
            </div>
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
      },
      afterEnter(element) {
        element.style.height = 'auto';
      },
      leave(element) {
        const height = getComputedStyle(element).height;

        element.style.height = height;

        // Force repaint to make sure the
        // animation is triggered correctly.
        getComputedStyle(element).height;

        requestAnimationFrame(() => {
          element.style.height = 0;
        });
      },
      enter(element) {
        const width = getComputedStyle(element).width;

        element.style.width = width;
        element.style.position = 'absolute';
        element.style.visibility = 'hidden';
        element.style.height = 'auto';

        const height = getComputedStyle(element).height;

        element.style.width = null;
        element.style.position = null;
        element.style.visibility = null;
        element.style.height = 0;

        // Force repaint to make sure the
        // animation is triggered correctly.
        getComputedStyle(element).height;

        // Trigger the animation.
        // We use `requestAnimationFrame` because we need
        // to make sure the browser has finished
        // painting after setting the `height`
        // to `0` in the line above.
        requestAnimationFrame(() => {
          element.style.height = height;
        });
      },
    }
  });
</script>
@endsection
