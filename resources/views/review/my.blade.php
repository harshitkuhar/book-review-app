@extends('layout.main')

@section('title')
    Reviews
@endsection

@section('content')
    <div class="col-md-9">
        <div class="card border-0 shadow">
            <div class="card-header  text-white">
                Reviews
            </div>
            <div class="card-body pb-0">
                <table class="table  table-striped mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th width="80">Book</th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th width="100">Action</th>
                        </tr>
                        <tbody>
                            @if ($reviews->isNotEmpty())
                                @foreach ($reviews as $review)
                                <tr>
                                    <td>{{$review->books->title}}</td>
                                    <td>{{$review->review}}</td>
                                    <td><i class="fa-regular fa-star"></i> {{$review->rating}}</td>
                                    <td>
                                        <a href="{{route('review.myedit', $review->id)}}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" style="text-align: center;">No Reviews Found!</td>
                                </tr>
                            @endif
                        </tbody>
                    </thead>
                </table>
                {{$reviews->links('pagination::bootstrap-4')}}
            </div>

        </div>
    </div>
    </div>
</div>
@endsection


