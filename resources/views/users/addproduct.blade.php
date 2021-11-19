@extends('users.layout.app')

@section('body')
        <div class="central-meta item"
            style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; ">
            @if (session('success'))
                <div class="alert alert-success text-center" style="margin-bottom: 10px" novalidate>
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h3 class="card-title">
                        Add product
                    </h3>
                </div>
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                <div class="card-body newpst-input" style="background-color: #f5f5f5">
                    <div class="form-group">
                        <label>
                            Product
                        </label>
                        <input type="text" name="product" class="form-control" style="background-color: #fff" required>
                    </div>
                    <div class="form-group">
                        <label>
                            Category
                        </label>
                        <input name="new_category" id="new_category" onkeyup="javascript:hasValueHandler(this)"
                            placeholder="Create new category..." class="form-control" />
                        <div id="select_category">
                            <select name="category_id" onchange="javascript:catHasChangeHandler(this)">
                                <option value="">Select one&hellip;</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            Price
                        </label>
                        <input type="number" name="price" class="form-control" style="background-color: #fff" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Description
                        </label>
                        <textarea rows="3" name="description" class="form-control" style="background-color: #fff"
                            required></textarea>
                    </div>

                    <div class="form-group">
                        <label>
                            Product Image
                        </label>
                        <input type="file" name="productImage" class="form-control" style="background-color: #fff" required>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-success btn-sm" type="submit">
                        Add product
                    </button>
                </div>
            </form>
        </div>
@endsection

<!-- centerl meta -->
@push('custom-scripts')
    <script>
        let new_category = document.getElementById('new_category')

        const hasValueHandler = (evt) => {
            let select_category = document.getElementById('select_category')

            if (evt.value.length >= 1) {
                select_category.style.display = 'none'
            } else {
                select_category.style.display = 'block'
            }
        }

        const catHasChangeHandler = (evt) => {
            if (evt.value.length >= 1) {
                new_category.style.display = 'none'
            } else {
                new_category.style.display = 'block'
            }
        }
    </script>
@endpush
