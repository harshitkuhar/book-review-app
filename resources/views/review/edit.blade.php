@extends('layout.main')

@section('title')
    Edit Review
@endsection

@section('content')
    <div class="col-md-9">
        <div class="card border-0 shadow">
            <div class="card-header  text-white">
                Edit Review
            </div>
            <div class="card-body">
                <form action="{{route('review.update', $review->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{$review->status == 1 ? 'selected' : ''}}>Active</option>
                            <option value="0" {{$review->status == 0 ? 'selected' : ''}}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
