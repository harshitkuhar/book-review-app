@extends('layout.main')

@section('title')
    Edit Book
@endsection

@section('content')
    <div class="col-md-9">
        <div class="card border-0 shadow">
            <div class="card-header  text-white">
                Edit Book
            </div>
            <div class="card-body">
                <form action="{{route('book.update', $book->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input value="{{$book->title}}" type="text" class="form-control" placeholder="Title" name="title" id="title" />
                        @error('title')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input value="{{$book->author}}" type="text" class="form-control" placeholder="Author"  name="author" id="author"/>
                        @error('author')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Description" cols="30" rows="5">{{$book->description}}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="Image" class="form-label">Image</label>
                        <input type="file" class="form-control"  name="image" id="image"/>
                        @error('image')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        <br>
                        <img src="{{asset('images/book/'. $book->image)}}" alt="" class="w-25">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{$book->status == 1 ? 'selected' : ''}}>Active</option>
                            <option value="0" {{$book->status == 0 ? 'selected' : ''}}>Inactive</option>
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
