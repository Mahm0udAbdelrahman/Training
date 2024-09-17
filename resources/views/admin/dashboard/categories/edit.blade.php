@extends('admin.layouts.app')
@section('content')
    <!--APP-CONTENT START-->


    <!-- Page Header -->

    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">Create Category</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </div>

    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .item {
            background-color: #f1f1f1;
            padding: 10px;
            margin-bottom: 10px;
             display: flex;
            align-items: center;
        }

        .item>* {
            margin-right: 10px;
        }

        .item button img {
            width: 20px;
            height: 20px;
        }

        .item select,
        .item input[type="text"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
    </style>







    @if (count($errors) > 0)
<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
@endif
@if (session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
    <!-- Page Header Close -->

    <!-- Start:: row-1 -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Add new
                    </div>

                </div>
                <form class="form-horizontal" method="POST" action="{{ route('categories.update', $category->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">









                     


                        <div class="form-group ">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('Status') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" name="status">
                                        <option disabled selected>{{ __('Choose Status...') }}</option>
                                        <option @if ($category->status == '1') selected @endif value="1">
                                            {{ __('Active') }}
                                        </option>
                                        <option @if ($category->status == '0') selected @endif value="0">
                                            {{ __('Unactive') }}
                                        </option>

                                    </select>

                                </div>
                            </div>
                        </div>
                        @error('status')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror



                        <div class="card hk-dash-type-1 overflow-hidden">
                            <div class="card-header pa-0">
                                <div class="nav nav-tabs nav-light nav-justified" id="dash-tab" role="tablist">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <a class="nav-item nav-link {{ $loop->first ? 'active' : '' }}"
                                            id="tab-{{ $localeCode }}" data-toggle="tab" href="#pane-{{ $localeCode }}"
                                            role="tab" aria-controls="pane-{{ $localeCode }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                @php
                                $translations = $category->getTranslationsArray()[$localeCode];
                                @endphp
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{ $localeCode }}"
                                        role="tabpanel" aria-labelledby="tab-{{ $localeCode }}">
                                        <div class="form-group">
                                            <label for="name-{{ $localeCode }}">{{ __('Name') }} {{ $localeCode }}</label>
                                            <input type="text" value="{{ $translations['name'] }}"
                                                name="{{ $localeCode }}[name]" id="name-{{ $localeCode }}"
                                                class="form-control">
                                            @error("$localeCode.name")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>




                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <button class="form-control btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>



        <!-- End:: row-3 -->


    </div>
    <!--APP-CONTENT CLOSE-->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Initialize CKEditor for all textareas with class 'ck-editor'
        ClassicEditor
            .create(document.querySelectorAll('.ck-editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    {{--  <script>
        const languages = @json($languages); // Assuming $languages is available as a JSON variable

        function addItem() {
            const container = document.getElementById("container");
            const newItem = document.createElement("div");
            newItem.className = "item";
            newItem.innerHTML = `
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-5">
                            <label class="form-label">Language</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" name="language_id[]">
                                <option disabled selected>Choose languages...</option>
                                @foreach ($language as $lang)
                                    <option @selected($translation->language_id == $lang->id) value="{{ $lang->id }}">{{ $lang->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-5">
                            <label class="form-label">Attribute</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" name="attribute[]">
                                <option disabled selected>{{ __('Choose Attribute...') }}</option>
                                <option @if ($translation->attribute == 'name') selected @endif value="name">{{ __('name') }}</option>
                                <option @if ($translation->attribute == 'description') selected @endif value="description"> {{ __('description') }} </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-4">
                            <label class="form-label">Translate</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="{{ $translation->translate }}" name="translate[]" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>
                </div>
                <a onclick="removeItem(this)"><i class="fa-solid fa-minus"></i></a>
                <a onclick="addItem()"><i class="fa-solid fa-plus"></i></a>
            `;
            container.appendChild(newItem);
        }

        function removeItem(btn) {
            const item = btn.parentNode;
            item.parentNode.removeChild(item);
        }
    </script>  --}}

    <script>
        const languages = @json($languages); // Assuming $languages is available as a JSON variable

        function addItem() {
            const container = document.getElementById("container");
            const newItem = document.createElement("div");
            newItem.className = "item";
            newItem.innerHTML = `

                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-5">
                            <label class="form-label">Language</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" name="language_id[]">
                                <option disabled selected>Choose languages...</option>
                                @foreach ($languages as $lang)
                                    <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-5">
                            <label class="form-label">Attribute</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" name="attribute[]">
                                <option disabled selected>{{ __('Choose Attribute...') }}</option>
                                <option value="name">{{ __('name') }}</option>
                                <option value="description">{{ __('description') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-4">
                            <label class="form-label">Translate</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="translate[]" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-12">
                            <a onclick="removeItem(this)"><i class="fa-solid fa-minus"></i></a>
                            <a onclick="addItem()"><i class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                </div>

            `;
            container.appendChild(newItem); // Add new item at the end
        }

        function removeItem(btn) {
            const item = btn.closest('.item'); // Find the closest item container
            item.remove(); // Remove the item
        }
    </script>






@endsection
