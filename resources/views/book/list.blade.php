@extends('layout.main')

@section('title')
    Books
@endsection

@section('content')
        <div class="col-md-9">
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    Books
                </div>
                <div class="card-body pb-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{route('book.create')}}" class="btn btn-primary">Add Book</a>
                        <form action="" method="GET">
                            <div class="d-flex">
                                <input type="text" id="search" value="{{Request::get('keyword')}}" name="keyword" class="form-control mx-1" placeholder="Search Here...">
                                <input type="submit" class="btn btn-primary mx-1" value="Search">
                                <a href="{{route('book.index')}}" class="btn btn-secondary">Clear</a>
                            </div>
                        </form>
                    </div>
                    <table class="table table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th width="150">Action</th>
                            </tr>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{$book->title}}</td>
                                        <td>{{$book->author}}</td>
                                        <td>3.0 (3 Reviews)</td>
                                        <td>{{$book->status == 1 ? 'Active' : 'Inactive'}}</td>
                                        <td style="display: flex;">
                                            <a href="#" class="btn btn-success btn-sm"><i class="fa-regular fa-star"></i></a>
                                            <a href="{{route('book.edit', $book->id)}}" class="btn btn-primary btn-sm mx-1"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{route('book.destroy', $book->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </thead>
                    </table>
                    <nav aria-label="Page navigation">
                        {{ $books->links('pagination::bootstrap-4') }}
                    </nav>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        var $ = jQuery;
        $('#search').on('input', function() {
            var keyword = $(this).val();
            //console.log(keyword);
        })
    </script>
@endsection
