@extends('layout.main')

@section('title')
    Book Detail
@endsection

@section('content')
<div class="container mt-3 ">
    <div class="row justify-content-center d-flex">
        <div class="col-md-12">
            <a href="{{route('home.books')}}" class="text-decoration-none text-dark ">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp; <strong>Back to books</strong>
            </a>
            <div class="row mt-4">
                <div class="col-md-4">
                    <img src="{{asset('images/book/' . $book->image)}}" alt="" class="card-img-top">
                </div>
                <div class="col-md-8">
                    <h3 class="h2 mb-3">{{$book->title}}</h3>
                    <div class="h4 text-muted">{{$book->author}}</div>
                    <div class="star-rating d-inline-flex ml-2" title="">
                        @foreach ($reviews as $review)
                            <span class="rating-text theme-font theme-yellow">{{$review->rating}}</span>
                        @endforeach
                        <div class="star-rating d-inline-flex ms-1 me-2" title="">
                            <div class="back-stars ">
                                <i class="fa fa-star " aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>

                                <div class="front-stars" style="width: 100%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <span class="theme-font text-muted">(0 Review)</span>
                    </div>

                    <div class="content mt-3">
                        <p>
                            {{$book->description}}
                        </p>

                    </div>

                    <div class="col-md-12 pt-2">
                        <hr>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h2 class="h3 mb-4">Readers also enjoyed</h2>
                        </div>
                        @foreach ($relatedBooks as $relatedBook)
                            <div class="col-md-4 col-lg-4 mb-4">
                                <div class="card border-0 shadow-lg">
                                    <a href="{{route('home.singlebook', $relatedBook->id)}}"><img src="{{$relatedBook->image ? asset('images/book/'. $relatedBook->image) : 'https://placehold.jp/261x403.png'}}" alt="" class="card-img-top"></a>
                                    <div class="card-body">
                                        <h3 class="h4 heading">{{$relatedBook->title}}</h3>
                                        <p>by {{$relatedBook->author}}</p>
                                        <div class="star-rating d-inline-flex ml-2" title="">
                                            <span class="rating-text theme-font theme-yellow">0.0</span>
                                            <div class="star-rating d-inline-flex mx-2" title="">
                                                <div class="back-stars ">
                                                    <i class="fa fa-star " aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>

                                                    <div class="front-stars" style="width: 70%">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="theme-font text-muted">(0)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="col-md-12 pt-2">
                        <hr>
                    </div>
                    <div class="row pb-3">
                        <div class="col-md-12 mt-4">
                            <div class="d-flex justify-content-between">
                                <h3>Post A Review</h3>
                            </div>
                            <div class="card border-0 shadow-lg my-2">
                                <div class="card-body" id="review">
                                    <form action="{{route('review.store')}}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="hidden" name="book_id" value="{{$book->id}}">
                                            <label for="review" class="form-label">Review</label>
                                            <textarea name="review" id="review" class="form-control" placeholder="Review" cols="30" rows="5"></textarea>
                                            @error('review')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="rating" class="form-label">Rating</label>
                                            <select name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            @error('rating')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary mt-2">Create</button>
                                        {{-- <a href="{{route('home.singlebook', $book->id)}}" class="btn btn-primary">Create</a> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 pt-2">
                        <hr>
                    </div>
                    <div class="row pb-5">
                        <div class="col-md-12 pt-3">
                            <div class="d-flex justify-content-between">
                                <h3>Reviews</h3>
                            </div>
                            @foreach ($reviews as $review)
                                <div class="card border-0 shadow-lg my-2">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="mb-3">{{$review->users->name}}</h4>
                                            <span class="text-muted">{{$review->created_at->format('d M, Y')}}</span>
                                        </div>

                                        <div class="mb-3">
                                            <div class="star-rating d-inline-flex" title="">
                                                <div class="star-rating d-inline-flex " title="">
                                                    <div class="back-stars ">
                                                        <i class="fa fa-star " aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>

                                                        <div class="front-stars" style="width: 20%">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="content">
                                            <p>{{$review->review}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
