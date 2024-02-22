<!-- resources/views/categories/index.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="d-flex align-items-center mb-4">
            <img src="{{ URL('images/contact-list.png') }}" class="img-fluid mr-3" width="50" height="50"
                alt="Contact List Image">
            <h1 class="" style=" color: #052415;">Contacts</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('failure'))
            <div class="alert alert-danger">
                <ul>
                    @foreach (session('failure')->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <!-- categories.blade.php -->

        <!-- categories.blade.php -->
        <div class="col-12">
            <form action="{{ route('contacts.index') }}" method="get" class="mb-3">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3">
                        <div class="input-group" style="width: 100%;">
                            <input type="text" class="form-control" placeholder="Search by name" name="search"
                                value="{{ old('search', request('search')) }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex">
                        <!-- Dropdown for Status Tabs -->
                        <div class="input-group" style="width: 70%; margin-left: 10px;">
                            <select class="form-select" id="statusFilter" name="status">
                                <option value="" disabled selected>Filter by Status</option>
                                <option value="all" {{ old('status', request('status')) == 'all' ? 'selected' : '' }}>All
                                </option>
                                <option value="ACTIVE" {{ old('status', request('status')) == 'ACTIVE' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="INACTIVE"
                                    {{ old('status', request('status')) == 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="ml-auto mr-5">
                            <button class="btn btn-outline " style="background-color: #fcc80a;"
                                type="submit">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>



        <!-- Display contacts here -->


        <!-- Button to trigger create modal -->

        <button class="btn pmd-btn-fab pmd-ripple-effect btn-light pmd-btn-raised fixed-bottom-right circular-btn"
            data-bs-toggle="modal" data-bs-target="#createContactModal">
            <i class="material-icons pmd-sm">
                <img src="images/plus.png" alt="Brand Image" class="circular-img"
                    style="width: 32px; height: 40px; cursor: pointer;">
            </i>
        </button>

        <!-- Create Contact Modal -->
        <div class="modal fade" id="createContactModal" tabindex="-1" aria-labelledby="createContactModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createContactModalLabel">Create Contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Your create form goes here -->
                        <form method="post" action="{{ route('contacts.store') }}" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Contact Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="website" class="form-label">Website:</label>
                                <input type="text" class="form-control" id="website" name="website">
                            </div>
                            <div class="float-end">
                                <button type="submit" class="btn btn-primary">Save Contact</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Display the list of contacts in a table view -->
        <tbody>
            <div class="row ">
                @foreach ($contacts as $contact)
                    <!-- Edit button to trigger edit modal -->

                            <div class="col-sm-6 col-md-4 col-lg-3 brand-card" style="margin-bottom: 185px;">
             <a href="#" class="card-link">
             <div class=" card" style="margin-bottom: 185px; @if( $contact->status  == 'INACTIVE') background-color: #FAA0A0; @endif">
            <!-- Button in the top-right corner, pushed a bit down -->

                                <div class="card-body text-center" data-bs-toggle="modal"
                                    data-bs-target="#viewContactModal{{ $contact->id }}">
                                    <span class="material-symbols-outlined"  data-bs-toggle="modal" data-bs-target="#viewContactModal{{ $contact->id }}">
                                         contacts
                                        </span>

                <h4 class="card-title text-left pl-2"><a class="text-dark" href="#" style="font-size: 1rem;">{{ $contact->name }}</a></h4>
                <h4 class="card-title text-left pl-2"><a class="text-dark" href="#" style="font-size: 1rem;">{{ $contact->phone }}</a></h4>
            <p>
                <button type="button" class="btn btn-sm position-absolute top-0 end-0 edit-btn" style="z-index: 1;">
                    <img src="{{ asset('images/edit.png') }}" alt="Button Icon" style="max-width: 20px; max-height: 20px;" data-bs-toggle="modal"
                                data-bs-target="#editContactModal{{ $contact->id }}">
                </button>
            </div>
        </div>
         </div>
        </a>
          </tbody>
                    <!-- View Category Modal -->
                    <div class="modal fade" id="viewContactModal{{ $contact->id }}" tabindex="-1"
                        aria-labelledby="viewContactModalLabel{{ $contact->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewContactModalLabel{{ $contact->id }}">View Contacts
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Name:</strong> {{ $contact->name }}</p>
                                    <p><strong>Phone:</strong> {{ $contact->phone }}</p>
                                    <p><strong>Email:</strong> {{ $contact->email }}</p>
                                    <p><strong>Description:</strong> {{ $contact->description }}</p>
                                    <p><strong>Status:</strong> {{ $contact->status }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                    </div>
                    </a>
    </div>
        </tbody>
        <!-- View Category Modal -->
        <div class="modal fade" id="viewContactModal{{ $contact->id }}" tabindex="-1"
            aria-labelledby="viewContactModalLabel{{ $contact->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewContactModalLabel{{ $contact->id }}">View Contacts
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Name:</strong> {{ $contact->name }}</p>
                        <p><strong>Phone:</strong> {{ $contact->phone }}</p>
                        <p><strong>Email:</strong> {{ $contact->email }}</p>
                        <p><strong>Description:</strong> {{ $contact->description }}</p>
                        <p><strong>Status:</strong> {{ $contact->status }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        </tbody>
        </table>

        <div class="pagination-container">
            <nav aria-label="Page navigation">
                <ul class="pagination">

                    {{-- Previous Page Link --}}
                    @if ($contacts->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $contacts->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&laquo;</a>
                        </li>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($contacts->getUrlRange(1, $contacts->lastPage()) as $page => $url)
                        <li class="page-item {{ $contacts->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($contacts->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $contacts->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">&raquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">&raquo;</span>
                        </li>
                    @endif

                </ul>
            </nav>
        </div>






        <!-- Edit Contact Modals -->
        @foreach ($contacts as $contact)
            <div class="modal fade" id="editContactModal{{ $contact->id }}" tabindex="-1"
                aria-labelledby="editContactModalLabel{{ $contact->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editContactModalLabel{{ $contact->id }}">Edit Contact</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Your edit form goes here -->
                            <form method="post" action="{{ route('contacts.update', $contact->id) }}"
                                enctype="multipart/form-data">
                                
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="editName" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="editName" name="name"
                                        value="{{ $contact->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editEmail" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="editEmail" name="email"
                                        value="{{ $contact->email }}">
                                </div>
                                <div class="mb-3">
                                    <label for="editDescription" class="form-label">Description:</label>
                                    <textarea class="form-control" id="editDescription" name="description" rows="3">{{ $contact->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="editPhone" class="form-label">Phone:</label>
                                    <input type="text" class="form-control" id="editPhone" name="phone"
                                        value="{{ $contact->phone }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Contact Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo"
                                        accept="image/*" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editWebsite" class="form-label">Website:</label>
                                    <input type="text" class="form-control" id="editWebsite" name="website"
                                        value="{{ $contact->website }}">
                                </div>
                                <div class="mb-3">
                                    <label for="editStatus" class="form-label">Status:</label>
                                    <select class="form-select" id="editStatus" name="status">
                                        <option value="ACTIVE" {{ $contact->status == 'ACTIVE' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="INACTIVE" {{ $contact->status == 'INACTIVE' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                                <form style="margin-bottom: 0;">
                                    <!-- Your form elements go here -->
                                    <button type="submit" class="btn btn-primary float-end">Update contact</button>
                                </form>

                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="post"
                                    style="display:inline;">
                                    
                                    @method('delete')
                                    <div style="display: inline; margin-top: -33px;">
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
