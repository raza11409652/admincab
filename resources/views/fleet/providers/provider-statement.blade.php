@extends('fleet.layout.base')

@section('title', 'Ganhos de Motoristas ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h3>Ganhos de Motoristas</h3>

            <div class="row">

                <div class="row row-md mb-2" style="padding: 15px;">
                    <div class="col-md-12">
                        <div class="box bg-white">
                            <div class="box-block clearfix">
                                <h5 class="float-xs-left">@lang('admin.include.provider_earnings')</h5>
                                <div class="float-xs-right">
                                </div>
                            </div>

                            @if(count($Providers) != 0)
                            <table class="table table-striped table-bordered dataTable" id="table-4">
                                <thead>
                                    <tr>
                                        <td>@lang('admin.provides.provider_name')</td>
                                        <td>@lang('admin.mobile')</td>
                                        <td>@lang('admin.status')</td>
                                        <td>@lang('admin.provides.Total_Rides')</td>
                                        <td>@lang('admin.provides.Total_Earning')</td>
                                        <td>@lang('admin.provides.Commission')</td>
                                        <td>@lang('admin.provides.Joined_at')</td>
                                        <td>@lang('admin.provides.Details')</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $diff = ['-success', '-info', '-warning', '-danger']; ?>
                                    @foreach($Providers as $index => $provider)
                                    <tr>
                                        <td>
                                            {{$provider->first_name}}
                                            {{$provider->last_name}}
                                        </td>
                                        <td>
                                            {{$provider->mobile}}
                                        </td>
                                        <td>
                                            @if($provider->status == "approved")
                                            <span class="tag tag-success">Aprovado</span>
                                            @elseif($provider->status == "banned")
                                            <span class="tag tag-danger">Banido</span>
                                            @elseif($provider->status == "document")
                                                <span class="tag tag-warning">Aguadando valida????o</span>
                                            @elseif($provider->status == "onboarding")
                                                <span class="tag tag-danger">Faltando Documentos</span>
                                            @else
                                            <span class="tag tag-info">{{$provider->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($provider->rides_count)
                                            {{$provider->rides_count}}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            @if($provider->payment)
                                            {{currency($provider->payment[0]->overall)}}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            @if($provider->payment)
                                            {{currency($provider->payment[0]->commission)}}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            @if($provider->created_at)
                                            <span class="text-muted">{{$provider->created_at->diffForHumans()}}</span>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('fleet.provider.request', $provider->id)}}">Ver hist??rico</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                <tfoot>
                                    <tr>
                                        <td>@lang('admin.provides.provider_name')</td>
                                        <td>@lang('admin.mobile')</td>
                                        <td>@lang('admin.status')</td>
                                        <td>@lang('admin.provides.Total_Rides')</td>
                                        <td>@lang('admin.provides.Total_Earning')</td>
                                        <td>@lang('admin.provides.Commission')</td>
                                        <td>@lang('admin.provides.Joined_at')</td>
                                        <td>@lang('admin.provides.Details')</td>
                                    </tr>
                                </tfoot>
                            </table>
                            @include('common.pagination')
                            @else
                            <h6 class="no-result">Resultados n??o encontrados</h6>
                            @endif

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection
