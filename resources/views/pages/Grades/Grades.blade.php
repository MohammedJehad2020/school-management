<x-master>

    @push('css')
       @toastr_css
    @endpush

    <!-- page-header -->
    <x-page-header pageHeader="{{ trans('grades_trans.title_page') }}" />
    <!-- page-header -->


    <!-- page-content -->
    <x-page-content>
        <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
            {{ trans('grades_trans.add_Grade') }}
        </button>
        <br><br>

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
                                        <th>#</th>
                                        <th>{{ trans('grades_trans.Name') }}</th>
                                        <th>{{ trans('grades_trans.Notes') }}</th>
                                        <th>{{ trans('grades_trans.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grades as $grade)
                                    <tr>

                                        <td>{{ $grade->id }}</td>
                                        <td>{{ $grade->Name }}</td>
                                        <td>{{ $grade->Notes }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $grade->id }}" title="{{ trans('grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $grade->id }}" title="{{ trans('grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    <!-- edit-grade component -->
                                     <x-GradesModals.edit-grade :grade="$grade" />

                                    <!-- delete-grade component -->
                                    <x-GradesModals.delete-grade :grade="$grade" />

                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- add_modal_Grade -->
            <x-GradesModals.add-grade />

        </div>
    </x-page-content>
    <!-- page-content -->


    @push('js')
        @toastr_js
        @toastr_render
    @endpush
</x-master>