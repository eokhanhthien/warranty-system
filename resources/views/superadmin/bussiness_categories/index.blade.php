@extends('layouts.superadmin')
@section('content')
@section('title', 'Danh mục doanh nghiệp')
@if(session('success'))
    <script>
        toastr.success('{!! html_entity_decode(session('success')) !!}');
    </script>
@endif

@if(session('error'))
    <script>
        toastr.error('{!! html_entity_decode(session('error')) !!}');
    </script>
@endif
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
                <div class="text-right">
                      <button class="btn btn-primary float-right m-3" data-toggle="modal" data-target="#myModal">Thêm</button>
                </div>
                <h5 class="card-header">Tất cả danh mục</h5>
                <div class="table-responsive text-nowrap">
                <table class="table" id="table_businesses">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach($bussinessCategories as $category)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $category->vi_name }}</td>
                      <td>{{ $category->slug }}</td>
                      <td>
                        <button class="btn btn-primary">
                          <a style="color: white" class="d-inline-block" href="{{route('superadmin.businesses.categories.edit',[$category->id])}}">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                          </a>
                        </button> 
           

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmationModal{{ $category->id }}">
                              <i class="bx bx-trash me-1"></i> Delete
                          </button>

                          <!-- Confirmation Modal -->
                          <div class="modal fade" id="confirmationModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="confirmationModalLabel">Confirm Delete</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          Are you sure you want to delete this item?
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                          <form id="deleteForm{{ $category->id }}" action="{{ route('superadmin.businesses.categories.destroy', ['id' => $category->id]) }}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger">Delete</button>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $bussinessCategories->links() }}
                </div>

                <!-- Modal -->
                <form action="{{ route('superadmin.businesses.categories.store') }}" method="POST" id="form-business-categories">
                    @csrf
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Thêm danh mục</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="projectName">Tên danh mục (Tiếng Việt)</label>
                                        <input type="text" class="form-control" id="" placeholder="Nhập tên danh mục" name="vi_name" >
                                        <span class="error-message" id="vi_name-error"></span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="projectName">Tên danh mục (Tiếng Anh)</label>
                                        <input type="text" class="form-control" id="projectName" placeholder="Nhập tên danh mục" name="en_name" oninput="generateSlug(0)">
                                        <span class="error-message" id="en_name-error"></span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="slug">Slug   <span  data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="" data-bs-original-title="<i class='bx bx-trending-up bx-xs' ></i> <span>Slug này sẽ là tên thư mục của doanh nghiệp</span>">
                                        <i class='bx bx-question-mark'></i>
                                        </span></label>
                                        <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" readonly>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label for="description	">Mô tả</label>
                                        <textarea  class="form-control" id="description" name="description"> </textarea>
                                        <span class="error-message" id="description-error"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
</div>
</div>
<!-- Gọi hàm validate để xử lý form -->
<script src="{{ asset('assets/js/validateForm.js') }}"></script>
<!-- Gọi hàm tạo slug -->
<script src="{{ asset('assets/js/slug.js') }}"></script>
<!-- Gọi hàm thêm search table -->
<script src="{{ asset('assets/js/data-table-js.js') }}"></script>
<script>
    $(document).ready(function() {
        var formId = '#form-business-categories';
        var validateUrl = '/validate-business-categories';

        setupFormValidation(formId, validateUrl);

        var id_table = '#table_businesses';
        searchDataTable(id_table,true, false);
    });
</script>
@endsection