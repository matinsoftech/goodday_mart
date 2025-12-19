@if ($categories->count() > 0 )
    <section class="pb-4 rtl">
        <div class="container">
            <div>
                <div class="h-100 max-md-shadow-0">
                    <div class="card-body px-0 mt-5">
                        <div class="d-flex justify-content-between pb-2 mb-5 home-title-border">
                            <div class="home-title m-0">
                                <span class="barlow-bold">Our {{ translate('categories')}}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <a class="text-capitalize view-all-text web-text-primary d-flex align-items-center gap-3"
                                   href="{{route('products')}}">{{ translate('view_all')}}
                                  <svg width="1.2rem" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.007 2c-5.518 0-9.998 4.48-9.998 9.998 0 5.517 4.48 9.997 9.998 9.997s9.998-4.48 9.998-9.997c0-5.518-4.48-9.998-9.998-9.998zm1.523 6.21s1.502 1.505 3.255 3.259c.147.147.22.339.22.531s-.073.383-.22.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.335.217-.526.217-.192-.001-.384-.074-.531-.221-.292-.293-.294-.766-.003-1.057l1.977-1.977h-6.693c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.693l-1.978-1.979c-.29-.289-.287-.762.006-1.054.147-.147.339-.221.53-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                  <!-- <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i> -->
                                </a>
                            </div>
                        </div>
                        <div class="">
                            {{-- <div class="row mt-3"> --}}
                            <div class="owl-carousel owl-theme" id="home-category-slider">
                                @foreach($categories as $key => $category)
                                    @if ($key<10)
                                        <div class=" __cate-item">
                                            <a href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">
                                                <div class="__img">
                                                    <img alt="{{ $category->name }}"
                                                         src="{{ getValidImage(path: 'storage/app/public/category/'.$category->icon, type: 'category') }}">
                                                </div>
                                                <p class="text-center home-category-title mt-2">{{Str::limit($category->name, 12)}}</p>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            {{-- </div> --}}
                        </div>
                        <div class="d-md-none">
                            <div class="owl-theme owl-carousel categories--slider mt-3">
                                @foreach($categories as $key => $category)
                                    @if ($key<10)
                                        <div class="text-center m-0 __cate-item w-100">
                                            <a href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">
                                                <div class="__img mw-100 h-auto">
                                                    <img alt="{{ $category->name }}"
                                                         src="{{ getValidImage(path: 'storage/app/public/category/'.$category->icon, type: 'category') }}">
                                                </div>
                                                <p class="text-center small mt-2">{{Str::limit($category->name, 12)}}</p>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
