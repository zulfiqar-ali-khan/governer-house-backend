@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Edit Governor Message & Profile</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('governor-messages.index') }}">Governor Messages</a></li>
                        <li class="breadcrumb-item active">Edit Message</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please resolve the following errors:</strong>
            <ul class="mb-0 mt-1 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('governor-messages.update', $governorMessage->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- 1. Basic Governor Information -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0 font-size-15">
                    <i class="mdi mdi-account-tie me-1 text-primary"></i> 1. Basic Governor Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $governorMessage->title) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $governorMessage->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation', $governorMessage->designation) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label for="from" class="form-label">From Date</label>
                        <input type="date" class="form-control" id="from" name="from" value="{{ old('from', $governorMessage->from) }}">
                    </div>

                    <div class="col-md-3">
                        <label for="to" class="form-label">To Date</label>
                        <input type="date" class="form-control" id="to" name="to" value="{{ old('to', $governorMessage->to) }}">
                    </div>

                    <div class="col-12">
                        <label for="short_description" class="form-label">Short Description (Message Quote) <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="short_description" name="short_description" rows="3" required>{{ old('short_description', $governorMessage->short_description) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">Full Message / Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $governorMessage->description) }}</textarea>
                    </div>

                    <div class="col-md-8">
                        <label for="image" class="form-label">Governor Portrait Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div class="form-text text-muted">Leave empty to keep existing image. Max 5 MB.</div>
                        @if($governorMessage->image)
                            <div class="mt-2 d-flex align-items-center gap-3">
                                <img src="{{ asset($governorMessage->image) }}" alt="Current Photo" class="rounded border" height="60">
                                <span class="text-muted font-size-12">Current image</span>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-4 d-flex align-items-center mt-md-4">
                        <div class="form-check form-switch form-switch-md">
                            <input class="form-check-input" type="checkbox" id="active" name="active" value="1" {{ old('active', $governorMessage->active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="active">Set as Active Governor</label>
                            <div class="form-text">Will activate on frontend homepage and profile.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Political Career (Rich Text Editor) -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0 font-size-15">
                    <i class="mdi mdi-bank me-1 text-primary"></i> 2. Parliamentary and Political Career
                </h5>
            </div>
            <div class="card-body">
                <p class="text-muted font-size-13">Enter parliamentary, speaker, assembly, and political party career details.</p>
                <textarea class="form-control tinymce-editor" id="political_career" name="political_career">{{ old('political_career', $governorMessage->political_career) }}</textarea>
            </div>
        </div>

        <!-- 3. Humanitarian and Public Leadership (Rich Text Editor) -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0 font-size-15">
                    <i class="mdi mdi-hand-heart me-1 text-primary"></i> 3. Humanitarian and Public Leadership
                </h5>
            </div>
            <div class="card-body">
                <p class="text-muted font-size-13">Enter Red Crescent, youth parliament, international delegations, and social welfare leadership details.</p>
                <textarea class="form-control tinymce-editor" id="public_leadership" name="public_leadership">{{ old('public_leadership', $governorMessage->public_leadership) }}</textarea>
            </div>
        </div>

        <!-- 4. Education -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0 font-size-15">
                    <i class="mdi mdi-school me-1 text-primary"></i> 4. Education
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="education_degree" class="form-label">Education Degree / Summary</label>
                        <input type="text" class="form-control" id="education_degree" name="education_degree" value="{{ old('education_degree', $governorMessage->education_degree) }}" placeholder="e.g. Law, Thames Valley College, London (2002)">
                    </div>

                    <div class="col-md-6">
                        <label for="education" class="form-label">Education Institution (At a Glance Sidebar)</label>
                        <input type="text" class="form-control" id="education" name="education" value="{{ old('education', $governorMessage->education) }}" placeholder="e.g. Thames Valley College, London">
                    </div>

                    <div class="col-12">
                        <label for="education_description" class="form-label">Education Description</label>
                        <textarea class="form-control" id="education_description" name="education_description" rows="3" placeholder="Enter detailed education background paragraphs">{{ old('education_description', $governorMessage->education_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. Family and Background & Ancestry Tree -->
        <div class="card">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 font-size-15">
                    <i class="mdi mdi-account-group me-1 text-primary"></i> 5. Family Background & Ancestry Tree
                </h5>
                <button type="button" class="btn btn-sm btn-outline-primary" id="addAncestryBtn">
                    <i class="mdi mdi-plus me-1"></i> Add Ancestor / Family Member
                </button>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label for="family_background" class="form-label">Family Background Description</label>
                    <textarea class="form-control" id="family_background" name="family_background" rows="3">{{ old('family_background', $governorMessage->family_background) }}</textarea>
                </div>

                <h6 class="font-size-14 fw-bold text-dark mb-2">Ancestry Timeline Members</h6>
                <p class="text-muted font-size-12 mb-3">Add family generation nodes (e.g. Great Grandfather, Grandfather, Maternal Grandfather, Father).</p>

                <div id="ancestryContainer">
                    <!-- Populated dynamically via JS -->
                </div>
            </div>
        </div>

        <!-- 6. Role of the Governor (Multiple Text List) -->
        <div class="card">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 font-size-15">
                    <i class="mdi mdi-gavel me-1 text-primary"></i> 6. Constitutional Roles of Governor
                </h5>
                <button type="button" class="btn btn-sm btn-outline-primary" id="addRoleBtn">
                    <i class="mdi mdi-plus me-1"></i> Add Role Item
                </button>
            </div>
            <div class="card-body">
                <p class="text-muted font-size-13 mb-3">List key constitutional functions and powers of the Governor.</p>
                <div id="rolesContainer">
                    <!-- Populated dynamically via JS -->
                </div>
            </div>
        </div>

        <!-- 7. At a Glance Sidebar Fields -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0 font-size-15">
                    <i class="mdi mdi-view-list me-1 text-primary"></i> 7. "At a Glance" Sidebar Metadata
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="born" class="form-label">Born (Place of Birth)</label>
                        <input type="text" class="form-control" id="born" name="born" value="{{ old('born', $governorMessage->born) }}" placeholder="e.g. Dera Ismail Khan">
                    </div>

                    <div class="col-md-6">
                        <label for="previous_office" class="form-label">Previous Office</label>
                        <input type="text" class="form-control" id="previous_office" name="previous_office" value="{{ old('previous_office', $governorMessage->previous_office) }}" placeholder="e.g. 17th Deputy Speaker, National Assembly (2008 to 2013)">
                    </div>

                    <div class="col-md-6">
                        <label for="also_serves_as" class="form-label">Also Serves As</label>
                        <input type="text" class="form-control" id="also_serves_as" name="also_serves_as" value="{{ old('also_serves_as', $governorMessage->also_serves_as) }}" placeholder="e.g. President, PRCS Khyber Pakhtunkhwa">
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Bar -->
        <div class="card border-0 bg-transparent mb-5">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('governor-messages.index') }}" class="btn btn-secondary px-4">Cancel</a>
                <button type="submit" class="btn btn-success px-4 font-size-15 fw-bold">
                    <i class="mdi mdi-content-save me-1"></i> Update Governor Message & Profile
                </button>
            </div>
        </div>
    </form>
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
            // Initialize Summernote
            $('.tinymce-editor').summernote({
                height: 250,
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'hr']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });

            // 1. Ancestry Repeater
            let ancestryIndex = 0;
            const existingAncestors = @json($governorMessage->ancestry_list ?? []);
            const defaultAncestors = [
                { relation: 'GREAT GRANDFATHER', name: 'Barrister Abdul Rahim Kundi', description: 'First Deputy Speaker of the Legislative Assembly, 1932 to 1937' },
                { relation: 'GRANDFATHER', name: 'Fazal Qadeem Kundi', description: 'Member, West Pakistan Assembly, 1960s' },
                { relation: 'MATERNAL GRANDFATHER', name: 'Justice (Retd.) Faizullah Khan Kundi', description: "Federal Minister for Establishment in Prime Minister Zulfiqar Ali Bhutto's first cabinet; Chairman, Federal Public Service Commission, 1972 to 1979" },
                { relation: 'FATHER', name: 'Fazal Karim Kundi', description: 'Chairman, District Council D.I. Khan, 1983 to 1991; elected Member of the National Assembly in 1990' }
            ];

            const initialAncestors = existingAncestors.length > 0 ? existingAncestors : defaultAncestors;

            function addAncestryRow(data = {}) {
                const relation = data.relation || '';
                const name = data.name || '';
                const desc = data.description || '';

                const rowHtml = `
                    <div class="dynamic-repeater-row" id="ancestryRow_${ancestryIndex}">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-3">
                                <label class="form-label font-size-12 mb-1">Relation / Title</label>
                                <input type="text" class="form-control" name="ancestry[${ancestryIndex}][relation]" value="${relation}" placeholder="e.g. GRANDFATHER">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label font-size-12 mb-1">Full Name</label>
                                <input type="text" class="form-control" name="ancestry[${ancestryIndex}][name]" value="${name}" placeholder="e.g. Barrister Abdul Rahim Kundi">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label font-size-12 mb-1">Role / Description</label>
                                <input type="text" class="form-control" name="ancestry[${ancestryIndex}][description]" value="${desc}" placeholder="e.g. First Deputy Speaker, 1932 to 1937">
                            </div>
                            <div class="col-md-1 text-end mt-md-4">
                                <button type="button" class="btn btn-outline-danger btn-sm remove-ancestry-btn" data-target="#ancestryRow_${ancestryIndex}" title="Remove Member">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                $('#ancestryContainer').append(rowHtml);
                ancestryIndex++;
            }

            initialAncestors.forEach(item => addAncestryRow(item));

            $('#addAncestryBtn').on('click', function() {
                addAncestryRow();
            });

            $(document).on('click', '.remove-ancestry-btn', function() {
                const target = $(this).data('target');
                $(target).remove();
            });

            // 2. Roles of Governor Repeater
            let roleIndex = 0;
            const existingRoles = @json($governorMessage->roles_list ?? []);
            const defaultRoles = [
                'Administers oaths to the Chief Minister and provincial ministers',
                'Summons and prorogues sessions of the Provincial Assembly',
                'Assents to bills passed by the Provincial Assembly',
                'Promulgates ordinances when the Assembly is not in session',
                'Serves as Chancellor of public sector universities',
                'Links the Federal and Provincial Governments'
            ];

            const initialRoles = existingRoles.length > 0 ? existingRoles : defaultRoles;

            function addRoleRow(val = '') {
                const rowHtml = `
                    <div class="dynamic-role-row" id="roleRow_${roleIndex}">
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="mdi mdi-check-circle-outline text-success"></i></span>
                            <input type="text" class="form-control" name="roles[]" value="${val}" placeholder="Enter constitutional function or responsibility">
                            <button type="button" class="btn btn-outline-danger remove-role-btn" data-target="#roleRow_${roleIndex}">
                                <i class="mdi mdi-delete-outline"></i>
                            </button>
                        </div>
                    </div>
                `;
                $('#rolesContainer').append(rowHtml);
                roleIndex++;
            }

            initialRoles.forEach(r => addRoleRow(r));

            $('#addRoleBtn').on('click', function() {
                addRoleRow();
            });

            $(document).on('click', '.remove-role-btn', function() {
                const target = $(this).data('target');
                $(target).remove();
            });
        });
    </script>
@endsection
