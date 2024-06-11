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
                            <th>User</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                        </tr>
                        <tbody>
                            @foreach ($reviews as $review)
                            <tr>
                                <td>{{$review->books->title}}</td>
                                <td>{{$review->review}}</td>
                                <td><i class="fa-regular fa-star"></i> {{$review->rating}}</td>
                                <td>{{$review->users->name}}</td>
                                <td>
                                    @if ($review->status)
                                        <span class="text-success">{{$review->status == 1 ? 'Active' : 'Inactive'}}</span>
                                    @else
                                        <span class="text-danger">{{$review->status == 1 ? 'Active' : 'Inactive'}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('review.edit', $review->id)}}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    {{-- <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a> --}}
                                </td>
                            </tr>
                            @endforeach
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


