<x-master>

    @push('css')
    @toastr_css
    @endpush

    <!-- page-header -->
    <x-page-header pageHeader="{{ trans('My_Class_trans.title_page') }}" />
    <!-- page-header -->


    <!-- page-content -->
    <x-page-content>
        <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
            {{ trans('My_Class_trans.add_class') }}
        </button>
        <button type="button" class="button x-small" id="btn_delete_all">
            {{ trans('My_Class_trans.delete_checkbox') }}
        </button>
        <br><br>

        <form action="{{ route('Filter_Classes') }}" method="POST">
            @csrf
            <select class="selectpicker" data-style="btn-info" name="Grade_id" required onchange="this.form.submit()">
                <option value="" selected disabled>{{ trans('My_Class_trans.Search_By_Grade') }}</option>
                @foreach ($grades as $Grade)
                <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                @endforeach
            </select>
        </form>


        <div class="row">
            <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">

                        <!-- alert errors -->
                        <x-alert-errors />
                        <!-- end alert errors -->

                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered p-0">
                                <thead>
                                    <tr>
                                        <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                        <th>#</th>
                                        <th>{{ trans('My_Class_trans.Name_class') }}</th>
                                        <th>{{ trans('My_Class_trans.Name_Grade') }}</th>
                                        <th>{{ trans('My_Class_trans.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (isset($details))

                                    <?php $List_Classes = $details ?>

                                    @else

                                    <?php $List_Classes = $classrooms ?>

                                    @endif
                                    <?php $i = 0; ?>

                                    @foreach ($List_Classes as $My_Class)
                                    <tr>
                                        <?php $i++; ?>
                                        <td><input type="checkbox" value="{{ $My_Class->id }}" class="box1"></td>
                                        <td>{{ $i }}</td>
                                        <td>{{ $My_Class->Name_Class }}</td>
                                        <td>{{ $My_Class->grades->Name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $My_Class->id }}" title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $My_Class->id }}" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    <!-- edit_modal_Grade -->
                                    <x-Classrooms.edit-class :classroom="$My_Class" :grades="$grades" />

                                    <!-- delete_modal_Grade -->
                                    <x-Classrooms.delete-class :classroom="$My_Class" />


                                    @endforeach
                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- add_modal_class -->
            <x-Classrooms.add-class :grades="$grades" />

            <!-- Delete_All_classes -->
            <x-Classrooms.delete-all-classes :grades="$grades" />
        </div>
        <!--  -->

        </div>
    </x-page-content>
    <!-- page-content -->


    @push('js')

    @toastr_js
    @toastr_render
    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                var selected = new Array();
                $("#datatable input[type=checkbox]:checked").each(function() {
                    selected.push(this.value);
                });
                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });
    </script>

    @endpush
</x-master>