@extends('admin.layout.base')

@section('title', 'Disputas ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            
            <div class="box box-block bg-white">
                @if(Setting::get('demo_mode', 0) == 1)
                    <div class="col-md-12" style="height:50px;color:red;">
                        ** Demo Mode : @lang('admin.demomode')
                    </div>
                @endif
                <h5 class="mb-1">@lang('admin.dispute.title')</h5>
                @can('dispute-create')
                <a href="{{ route('admin.dispute.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> @lang('admin.dispute.add_dispute')</a>
                @endcan

                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.dispute.dispute_type') </th>
                            <th>@lang('admin.dispute.dispute_name') </th>                             
                            <th>@lang('admin.status')</th>                         
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($dispute as $index => $dist)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dist->dispute_type == "provider" ? "Motorista" : "Passageiro" }}</td>
                            <td>{{ ucfirst($dist->dispute_name) }} </td>
                            <td>
                                @if($dist->status=='active')
                                    <span class="tag tag-success">@lang('admin.active')</span>
                                @else
                                    <span class="tag tag-danger">@lang('admin.inactive')</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.dispute.destroy', $dist->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    @if( Setting::get('demo_mode', 0) == 0)
                                    @can('dispute-edit')
                                    <a href="{{ route('admin.dispute.edit', $dist->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
                                    @endcan
                                    @can('dispute-delete')
                                    <button class="btn btn-danger" onclick="return confirm('Voc?? tem certeza?')"><i class="fa fa-trash"></i> @lang('admin.delete')</button>
                                    @endcan
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.dispute.dispute_type') </th>
                            <th>@lang('admin.dispute.dispute_name') </th>                              
                            <th>@lang('admin.status')</th>                            
                            <th>@lang('admin.action')</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
@endsection