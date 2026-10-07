@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">News and Events</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">News and Event</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title">All News and Events</h4>
                        @can('new-and-event-create')
                        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#createNewsEventModal"> <i class="fas fa-plus"></i> Create New</button>
                        @endcan
                    </div>

                    <table id="datatable" class="table table-bordered table-condensed table-custom dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thumbnail</th>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newsAndEvents as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset($item->thumnail_image) }}" alt="Thumbnail" height="50">
                                    </td>
                                    <td>{{ $item->type }}</td>
                                    <td><a href="{{ route('news-detail', ['slug' => $item->slug]) }}" target="_blank">{{ Str::limit($item->title, 30) }}</a></td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->author }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d M, Y') }}</td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            @can('new-and-event-edit')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit"
                                                data-bs-original-title="Edit">
                                                <button type="button" class="btn btn-sm btn-soft-warning"
                                                    data-bs-toggle="modal" data-bs-target="#editNewsEventModal{{ $item->id }}"
                                                    title="Edit">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                            </li>
                                            @endcan
                                            @can('new-and-event-delete')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"
                                                data-bs-original-title="Delete">
                                                <form action="{{ route('new-and-events.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-soft-danger delete-confirm"
                                                        title="Delete">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>
                                                </form>
                                            </li>
                                            @endcan
                                        </ul>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editNewsEventModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editLabel{{ $item->id }}">Edit News/Event</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('new-and-events.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Type <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="type" required>
                                                                <option value="News" {{ $item->type == 'News' ? 'selected' : '' }}>News</option>
                                                                <option value="Event" {{ $item->type == 'Event' ? 'selected' : '' }}>Event</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Title <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="title" value="{{ old('title', $item->title) }}" required>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Author <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="author" value="{{ old('author', $item->author) }}" required>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Read Time (mint) <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="mint" value="{{ old('mint', $item->mint) }}" required>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Date <span class="text-danger">*</span></label>
                                                            <input type="date" class="form-control" name="date" value="{{ old('date', $item->date) }}" required>
                                                        </div>
                                                        
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Description <span class="text-danger">*</span></label>
                                                            <textarea class="form-control tinymce-editor" name="description" rows="5">{{ old('description', $item->description) }}</textarea>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Current Thumbnail</label>
                                                            <div class="mb-2">
                                                                <img src="{{ asset($item->thumnail_image) }}" alt="Thumbnail" height="80">
                                                            </div>
                                                            <label class="form-label">Update Thumbnail Image</label>
                                                            <input type="file" class="form-control" name="thumnail_image" accept="image/*">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Current Cover</label>
                                                            <div class="mb-2">
                                                                <img src="{{ asset($item->cover_image) }}" alt="Cover" height="80">
                                                            </div>
                                                            <label class="form-label">Update Cover Image</label>
                                                            <input type="file" class="form-control" name="cover_image" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createNewsEventModal" tabindex="-1" aria-labelledby="createLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">Create News/Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('new-and-events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="type" required>
                                    <option value="News">News</option>
                                    <option value="Event">Event</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Author <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="author" value="{{ old('author') }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Read Time (mint) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="mint" value="{{ old('mint') }}" placeholder="e.g. 5 min read" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date" value="{{ old('date') }}" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control tinymce-editor" name="description" rows="5">{{ old('description') }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thumbnail Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="thumnail_image" accept="image/*" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Cover Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="cover_image" accept="image/*" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save News/Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <!-- Summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('script')
    <!-- Summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tinymce-editor').summernote({
                height: 300,
                styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endsection
